<?php


namespace App\Http\Controllers;


use App\Guide;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    public function showCreate()
    {
        return view('guide.add');
    }

    public function submit(Request $request)
    {
        //TODO: Create guide
        //TODO: Add steps
        //TODO: Add supplementary content
        //TODO: Add to approval list
    }

    public function show(Request $request, Guide $guide)
    {
        //TODO: Pull guide and steps with supplementary content
        return view('guide.view', $guide);
    }

    public function update()
    {
        //TODO: Set guide as unpublished
        //TODO: Make modifications to guide, steps or supplementary content
        //TODO: Add to approval list
    }

    public function rate()
    {
        //TODO: adjust rating of guide up or down a point
    }

    public function feedback()
    {
        //TODO: create feedback on guide and link to guide
    }
}