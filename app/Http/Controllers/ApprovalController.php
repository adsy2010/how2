<?php


namespace App\Http\Controllers;


use App\Approval;
use App\Guide;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class ApprovalController
{
    /**
     * Approval page and confirmation
     *
     * @param Request $request
     * @param Approval $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     * @throws \Exception
     */
    public function approveSubmission(Request $request, Approval $id)
    {
        if($request->isMethod('post'))
        {
            //run the approval
            try{
                $guide = Guide::findOrFail($id->guide);
                $guide->publishedTimestamp = Carbon::now();
                $guide->published = 1;
                $guide->draft = 0;
                $guide->save();
                $id->delete();

            }
            catch (Exception $exception)
            {
                return;  //redirect fail
            }
            //TODO: Log transaction

            return; //redirect success
        }

        //show the view for the guide to be approved
        return view('approval.approve', ['approval' => $id]);
    }

    /**
     * Rejection page and confirmation
     *
     * @param Request $request
     * @param Approval $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     * @throws \Exception
     */
    public function declineSubmission(Request $request, Approval $id)
    {
        if($request->isMethod('post'))
        {
            //run the rejection
            try{
                $guide = Guide::findOrFail($id->guide);
                $guide->published = 0;
                $guide->draft = 1;
                $guide->save();
                $id->delete();
            }
            catch (Exception $exception)
            {
                return; // redirect fail
            }
            //TODO: Log transaction

            return; //redirect success
        }

        //show the view for the guide to be rejected
        return view('approval.reject', ['approval' => $id]);
    }

    /**
     * View list of pending approvals
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listSubmissions()
    {
        //Show all pending submissions
        $approvals = Approval::all();

        return view('approval.list', ['approvals' => $approvals]);
    }

    /**
     * View a specific approval
     *
     * @param Request $request
     * @param Approval $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showSubmission(Request $request, Approval $id)
    {
        return view('approval.view', ['approval' => $id]);
    }
}