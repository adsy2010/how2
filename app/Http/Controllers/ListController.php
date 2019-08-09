<?php


namespace App\Http\Controllers;


use App\GuideList;
use App\GuideListItem;
use App\SharedGuideList;
use App\Traits\Role;
use App\UserGroup;
use App\UserGroupMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListController extends Controller
{
    /**
     * Retrieve lists where current user is the owner
     */
    public function myLists()
    {
        $myLists = GuideList::where('user', Auth::id())->get();
    }

    /**
     * Create a list
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Update a list name
     *
     * @param Request $request
     * @param GuideList $guideList
     * @return \Illuminate\Http\RedirectResponse
     */
    public function modifyList(Request $request, GuideList $guideList)
    {
        if(!$request->isMethod('post'))
            return redirect()->to(Route('')) //TODO: Fill route name here
            ->withErrors(__('admin.error-badmethod'))
                ->send();

        $guideList->name = $request->name;
        $guideList->save();
    }

    /**
     * Remove a list
     *
     * @param Request $request
     * @param GuideList $guideList
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function removeList(Request $request, GuideList $guideList)
    {
        if(!$request->isMethod('post'))
            return redirect()->to(Route('')) //TODO: Fill route name here
            ->withErrors(__('admin.error-badmethod'))
                ->send();

        $guideList->delete(); //TODO: Delete list items too
    }

    /**
     * Show a specific list
     */
    public function showList(Request $request, GuideList $guideList)
    {
        //Get guide list items
    }

    /**
     * Adds a guide to the end of a list
     */
    public function addGuideToList(Request $request, GuideList $id)
    {
        $item = GuideListItem::create([
            'guidelist' => $id->id,
            'guide' => $request->guide
        ])->save();

        //TODO: Find last item position in list, add 1 and resave.

        //TODO: Return to previous page OR if using jquery, return true on completion
    }

    /**
     * Shares a list with a group or user. If group is selected, current group members will receive the share but future group members will not
     */
    public function shareGuideList(Request $request, GuideList $id)
    {
        SharedGuideList::create([
            'user' => $request->user,
            'guidelist' => $id->id
        ]);
    }

    /**
     * Ensures that a shared list is shared with the correct members of a group
     *
     * @param int $groupId The id of  the group to share the list with
     * @param int $guidelist The id of the guidelist to share with the members
     */
    public function updateSharedGroupMembers($groupId, $guidelist)
    {
        $g = UserGroup::where('id', $groupId)->get();
        foreach ($g->members as $member)
        {
            SharedGuideList::create([
                'user' => $member->id,
                'guidelist' => $guidelist
            ]);
        }
    }
}