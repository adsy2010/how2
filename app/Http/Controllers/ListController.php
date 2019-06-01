<?php


namespace App\Http\Controllers;


use App\GuideList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListController extends Controller
{
    public function myLists()
    {
        $myLists = GuideList::where('user', Auth::id())->get();
    }

    public function createList(Request $request)
    {
        if(!$request->isMethod('post'))
            return redirect()->to(Route('')) //TODO: Fill route name here
            ->withErrors(__('admin.error-badmethod'))
                ->send();

        GuideList::create([
            'name' => $request->name,
            'user' => Auth::id()
        ]);
    }

    public function modifyList(Request $request, GuideList $guideList)
    {
        if(!$request->isMethod('post'))
            return redirect()->to(Route('')) //TODO: Fill route name here
            ->withErrors(__('admin.error-badmethod'))
                ->send();

        $guideList->name = $request->name;
        $guideList->save();
    }

    public function removeList(Request $request, GuideList $guideList)
    {
        if(!$request->isMethod('post'))
            return redirect()->to(Route('')) //TODO: Fill route name here
            ->withErrors(__('admin.error-badmethod'))
                ->send();

        $guideList->delete(); //TODO: Delete list items too
    }

    public function showList(Request $request, GuideList $guideList)
    {
        //Get guide list items
    }
}