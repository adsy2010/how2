<?php


namespace App\Http\Controllers;


use App\Approval;
use App\Category;
use App\Feedback;
use App\Guide;
use App\Steps;
use App\SupplementaryContent;
use App\Traits\Logging;
use App\Traits\Role;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuideController extends Controller
{
    use Role;
    use Logging;
    public function showCreate()
    {
        if($this->permissions('Create Submission')){
            return view('guides.add', ['categories' => Category::orderBy('name', 'ASC')->get()->pluck('name', 'id')]);
        }
        return redirect()->to(Route('home'))->withErrors('Unable to create a guide, you do not have permission!');
    }

    public function unpublish(Request $request, Guide $id)
    {
        //unpublish removes from searchable results and requires approval again before being republished.
        $id->published = 0;
        $id->draft = 1;
        $id->publishedTime = null;
        $id->save();

        return; // redirect to homepage?
    }

    public function submit(Request $request)
    {
        //TODO: Create guide
        //TODO: Add steps
        //TODO: Add supplementary content
        //TODO: Add to approval list

        if (!$request->isMethod('post'))
            return redirect()->to(Route('home'))
                ->withErrors(__('admin.error-badmethod'))
                ->send();

        //TODO: use validation properly

        $this->validate($request,
            [
                'name' => 'required|min:3|unique:guide',
                'category' => 'required|exists:category,id'
            ]);

        $tags = (!empty($request->tags)) ? $request->tags : '';
        $restrictedGroup = (!empty($request->tags)) ? $request->restrictedGroup : '';

        $guide = Guide::create([
            'name' => $request->name,
            'description' => $request->description,
            'publisher' => Auth::id(),
            'category' => $request->category,
            'draft' => 1,
            'published' => 0,
            'tags' => $tags,
            'restrictedGroup' => $restrictedGroup,
        ]);

        $guide->save();

        foreach ($request->step['content'] as $key => $value) {
            $step = Steps::create([
                'stepNumber' => $key + 1,
                'stepContent' => $value,
                'guide' => $guide->id
            ]);
            $step->save();

        }

        if ($request->hasFile('step.supplementary'))
        {
            $files = $request->file('step.supplementary');

            foreach ($files as $key => $file)
            {
                try {
                    //storage /guide/content/guideID
                    $stepnumber = $key + 1;
                    $path = "/images/guide/content/{$guide->id}";
                    $mime = $file->getMimeType();
                    $datatype = (substr($mime, 0, strlen('video')) === 'video') ? 1 : 0;
                    $filename = $stepnumber .'.'. $file->getClientOriginalExtension();
                    $file->storeAs($path, $filename);

                    //Get the associated step so we can link its ID
                    $stepId = Steps::where('guide', $guide->id)->where('stepNumber', $stepnumber)->first();

                    //run a foreach on each step creation adding uploaded content if required
                    SupplementaryContent::create([
                        'step' => $stepId->id,
                        'contentLocation' => $path .'/'. $filename,
                        'dataType' => $datatype
                    ]);
                    //technically the content location is not needed now as only 1 item per step can be recorded.

                } catch (Exception $exception) {
                    //problem with supplementary content
                    return redirect()->to(Route('guide.view', ['id' => $guide->id]))->withErrors(__('guide.error-supplemntaryContentUpload'));
                }
            }

        }

        // Assuming we got this far, submit as an approval. Consider this as an optional step.

        Approval::create([
            'user' => Auth::id(),
            'guide' => $guide->id
        ]);

        $this->createLog("Submission for guide {$guide->id} was created.");

        return redirect()->to(Route('guide.view', ['id' => $guide->id])); //redirect on success or failure

    }

    /**
     * Shows a guide loaded from the database if its published or not with the correct permissions
     * Returns errors if guide is missing or permissions dictate otherwise
     *
     * @param Request $request Request ID used to load Guide
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show(Request $request)
    {
        $id = Guide::find($request->id);
        
        if($id == null) return redirect()->to(Route('root'))->withErrors('Selected guide is not available at this time')->send();

        if(!($id->published == 1)){
            if(!(Auth::id() == $id->publisher || Auth::user()->hasPermission('Administrator')))
            {
                return redirect()->to(Route('root'))->withErrors('Selected guide is not available at this time')->send();
            }
        }

        return view('guides.view', ['guide' => $id]);
    }

    public function update()
    {
        //TODO: Set guide as unpublished
        //TODO: Make modifications to guide, steps or supplementary content
        //TODO: Add to approval list
    }

    public function rate(Request $request, Guide $id)
    {
        //TODO: adjust rating of guide up or down a point
        if($request->helpful)
            $id->helpful++;
        if($request->unhelpful)
            $id->unhelpful++;
        $id->save();

        // Use from an API link?
        /*
        return redirect()->to(Route('guide.view', ['id' => $id->id]))
            ->with('success', __('guides.success-rating'))
            ->send();*/

    }

    public function guideData(Request $request, Guide $id)
    {
        return $id;
    }

    public function feedback(Request $request, Guide $id)
    {
        if(auth()->user()->hasPermission('Feedback'))
        {
            if(!$request->isMethod('post'))
                return redirect()->to(Route('guide.view', ['id' => $id->id])) //TODO: Fill route name here
                ->withErrors(__('admin.error-badmethod'))
                    ->send();

            if($validation = $this->validate($request, [
                'feedback' => 'required|min:5'
            ]))
            {
                Feedback::create([
                    'user' => Auth::id(),
                    'guide' => $id->id,
                    'comment' => $request->feedback
                ]);

                $this->createLog("Feedback for guide {$id->id} was created.");

                return redirect()->to(Route('guide.view', ['id' => $id->id]))
                    ->with('success', __('guides.success-feedback'))
                    ->send();
            }
            return redirect()->to(Route('guide.view', ['id' => $id->id]))->withErrors($validation)->send();//TODO: return errors
        }
        return redirect()->to(Route('guide.view', ['id' => $id->id]))
            ->withErrors('You do not have permission to provide feedback.');



    }

    /**
     * Show the latest guides added to the system
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function latest()
    {
        return view('guides.latest', ['viewname' => 'Latest', 'guides' => Guide::where('published', 1)->orderBy('publishedTimestamp', 'DESC')->paginate(9)]);
    }

    /**
     * Show the latest guides added to the system by a specific user
     *
     * @param Request $request
     * @param User $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function user(Request $request, User $id)
    {
        return view('guides.latest', ['viewname' => $id->name, 'guides' => Guide::where('published', 1)->where('publisher', $id->id)->orderBy('publishedTimestamp', 'DESC')->paginate(9)]);
    }
}