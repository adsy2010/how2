<?php


namespace App\Http\Controllers;


use App\Approval;
use App\Category;
use App\Feedback;
use App\Guide;
use App\Steps;
use App\SupplementaryContent;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuideController extends Controller
{
    public function showCreate()
    {
        return view('guides.add', ['categories' => Category::orderBy('name', 'ASC')->get()->pluck('name', 'id')]);
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
            'publisher' => Auth::id(),
            'category' => $request->category,
            'draft' => 1,
            'published' => 0,
            'tags' => $tags,
            'restrictedGroup' => $restrictedGroup,
        ]);

        $guide->save();

        //run a foreach step or something

        $i = 1;
        $stepContentCounter = 'stepContent' . $i;

        foreach ($request->step['content'] as $key => $value)
        {
            $step = Steps::create([
                'stepNumber' => $key+1,
                'stepContent' => $value,
                'guide' => $guide->id
            ]);
        }
        die();
        /*while (!empty($request->$stepContentCounter))
        {
            $stepContentCounter = 'stepContent' . $i;
            $supplementaryContent = 'supplementaryContent' . $i;

            //Create the step
            $step = Steps::create([
                'stepNumber' => $i,
                'stepContent' => $request->$stepContentCounter,
                'guide' => $guide->id
            ]);

            //If file is attached, create supplementary content
            if($request->hasFile($supplementaryContent)) // TODO: get the correct content and check it
            {
                try{
                    //storage /guide/content/guideID/Step
                    $path = "guide/content/{$guide->id}/$i";
                    $request->file($supplementaryContent)->store($path);
                    $mime = $request->file($supplementaryContent)->getMimeType();
                    $datatype = (substr($mime, 0, strlen('video')) === 'video') ? 1 : 0;

                    //run a foreach on each step creation adding uploaded content if required
                    SupplementaryContent::create([
                        'step' => $step->id,
                        'contentLocation' => $path,
                        'dataType' => $datatype
                    ]);
                }
                catch (Exception $exception)
                {
                    //problem with supplementary content
                }

            }
            $i++;
        }*/



        // Assuming we got this far, submit as an approval. Consider this as an optional step.

        /*Approval::create([
            'user' => Auth::id(),
            'guide' => $guide->id
        ]);*/

        return redirect()->back(); //redirect on success or failure

    }

    public function show(Request $request, Guide $id)
    {
        //TODO: Pull guide and steps with supplementary content
        //if($id->isEmpty())
          //  return redirect()->to(Route('root'))->withErrors('Guide does not exist')->send();
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
        if(!$request->isMethod('post'))
            return redirect()->to(Route('guide.view', ['id' => $id->id])) //TODO: Fill route name here
            ->withErrors(__('admin.error-badmethod'))
                ->send();

        if($this->validate($request, [
            'feedback' => 'required|min:5'
        ]))
        {
            Feedback::create([
                'user' => Auth::id(),
                'guide' => $id->id,
                'comment' => $request->feedback
            ]);

            return redirect()->to(Route('guide.view', ['id' => $id->id]))
                ->with('success', __('guides.success-feedback'))
                ->send();
        }

        return;//TODO: return errors

    }
}