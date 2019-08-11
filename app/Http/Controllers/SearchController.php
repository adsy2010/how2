<?php


namespace App\Http\Controllers;


use App\Guide;
use App\SearchCache;
use App\SearchTerm;
use App\Steps;
use http\Client\Request;

class SearchController extends Controller
{
    /**
     * Check if a search entry is in the database and is not out of date
     * @param Request $request
     * @return SearchTerm $term
     */
    public function basicSearch($searchterm)
    {
        $term = SearchTerm::where('term', $searchterm)->with('cache')->first();
        if(count($term) > 0)
        {
            // TODO: check date last updated and determine whether advanced search needs rerunning
            return $term;
        } // return the cached search term list
        else return $this->advancedSearch($searchterm);
    }

    /**
     * Perform a thorough search based on search keyword request and save a cached copy
     * @param string $term
     * @return SearchTerm $termId
     */
    public function advancedSearch($term)
    {
        //gather data
        // Category name (later)
        // Guide name
        // Guide step

        $termId = SearchTerm::create(['term' => $term])->save();
        $terms = explode(' ', $term);

        foreach ($terms as $t)
        {
            $guideConditions[] = ['name', 'like', "%{$t}%"];
            $stepConditions[] = ['stepContent', 'like', "%{$t}%"];
        }

        $guides = Guide::orWhere($guideConditions)->get();
        $steps = Steps::orWhere($stepConditions)->get();
        $guidecache = array();

        foreach($guides as $g)
        {
            //COMPILE GUIDE ID
            $guideExplode = explode(" ", $g->name);
            foreach ($guideExplode as $exploded)
            {
                if(in_array($exploded, $terms))
                {
                    $guidecache[$g->id] = $guidecache[$g->id]+3;
                }
            }
        }

        foreach ($steps as $s)
        {
            //COMPILE GUIDE ID
            $stepExplode = explode(" ", $g->name);
            foreach ($stepExplode as $exploded)
            {
                if (in_array($exploded, $terms))
                {
                    $guidecache[$s->guide->id]++;
                }
            }
        }

        foreach ($guidecache as $key => $cache)
        {
            SearchCache::create([
                'guideId' => $key,
                'rank' => $cache,
                'termId' => $termId->id
            ]);
        }

        return $termId;


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

    public function search(Request $request)
    {
        $results = $this->basicSearch($request->term);
        return view('searchresults', ['results' => $results]);
    }
}
