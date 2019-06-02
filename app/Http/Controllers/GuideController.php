<?php


namespace App\Http\Controllers;


use App\Approval;
use App\Feedback;
use App\Guide;
use App\Steps;
use App\SupplementaryContent;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    public function showCreate()
    {
        return view('guides.add');
    }

    public function submit(Request $request)
    {
        //TODO: Create guide
        //TODO: Add steps
        //TODO: Add supplementary content
        //TODO: Add to approval list

        if (!$request->isMethod('post'))
            return redirect()->to(Route(''))//TODO: Fill route name here
            ->withErrors(__('admin.error-badmethod'))
                ->send();

        Guide::create([
            'name',
            'publisher',
            'category',
            'draft' => 1,
            'published' => 0,
            'tags',
            'restrictedGroup',
        ]);
        //run a foreach step or something

        $i = 1;
        $stepContentCounter = 'stepContent' . $i;


        while (!empty($request->$stepContentCounter))
        {
            $stepContentCounter = 'stepContent' . $i;
            Steps::create([

            ]);


            if($supplementaryContentExists) // TODO: get the correct content and check it
            {
                //run a foreach on each step creation adding uploaded content if required
                SupplementaryContent::create([

                ]);
            }
            $i++;
        }


        // Assuming we got this far, submit as an approval. Consider this as an optional step.
        Approval::create([
            'user',
            'guide'
        ]);

        return; //redirect on success or failure

    }

    public function show(Request $request)//, Guide $id)
    {
        //TODO: Pull guide and steps with supplementary content
        //if($id->isEmpty())
          //  return redirect()->to(Route('root'))->withErrors('Guide does not exist')->send();
        return view('guides.view');//, ['guide' => $id]);
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
        return redirect()->to(Route('')) // TODO: fill in redirection route
            ->with('success', __('guide.success-rating'))
            ->send();

    }

    public function feedback(Request $request)
    {
        //TODO: create feedback on guide and link to guide
        if(!$request->isMethod('post'))
            return redirect()->to(Route('')) //TODO: Fill route name here
            ->withErrors(__('admin.error-badmethod'))
                ->send();

        Feedback::create([
            'user' => Auth::id(),
            'guide' => $request->guide,
            'comment' => $request->comment
        ]);
    }
}