<?php


namespace App\Http\Controllers;


class SearchController extends Controller
{
    /**
     * Check if a search entry is in the database and is not out of date
     */
    public function basicSearch()
    {

    }

    /**
     * Perform a thorough search based on search keyword request and save a cached copy
     */
    public function advancedSearch()
    {

        //
        // Levels
        // title keywords - ignore "how to"
        // rank score 3 per keyword
        //
        // rating percentage
        // if no rating or negative rating present (below 50%), score 0
        // if positive rating present score 1
        //
        // keywords in steps
        // rank score 1 per keyword found
        //

        // max results 50 per search
        // remove old results if any exist for keyword chain
        // repopulate
        //
    }

    /**
     * May use as a helper function to advanced search
     */
    private function rankResult($keywords, $rankdata, $type)
    {

    }

    private function rankData($keywords, $rankdata, $type)
    {
        $wordcount = 0;

        foreach (explode(' ', $keywords) as $word)
        {
            $wordcount += substr_count($rankdata, $word);
        }

        switch($type)
        {
            // title
            case 1:
                {
                    return $wordcount * 4;
                    break;
                }
            //tags
            case 2:
                {
                    return $wordcount * 3;
                }
            //steps
            case 3:
                {
                    return $wordcount;
                }
        }
    }
}
