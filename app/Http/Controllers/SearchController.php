<?php


namespace App\Http\Controllers;


use App\Guide;
use App\SearchCache;
use App\SearchTerm;
use App\Steps;
use Illuminate\Http\Request;

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
        if(!empty($term))
        {
            // TODO: check date last updated and determine whether advanced search needs rerunning
            return $term;
        } // return the cached search term list
        else return $this->advancedSearch($searchterm);
    }

    /**
     * Perform a thorough search based on search keyword request and save a cached copy
     * @param string $term
     * @param SearchTerm null $termId
     * @return SearchTerm $termId
     */
    public function advancedSearch($term, SearchTerm $termId = null)
    {
        //gather data
        // Category name (later)
        // Guide name
        // Guide step

        if($termId == null){
            $termId = SearchTerm::create(['term' => $term]);
            $termId->save();
        }

        $terms = explode(' ', $term);

        foreach ($terms as $t)
        {
            $guideConditions[] = ['name', 'like', "%{$t}%"];
            $guideTagsConditions[] = ['tags', 'like', "%{$t}%"];
            $stepConditions[] = ['stepContent', 'like', "%{$t}%"];
        }

        $guides = Guide::orWhere($guideConditions)->get();
        $tags = Guide::orWhere($guideTagsConditions)->get();
        $steps = Steps::orWhere($stepConditions)->with('guideInfo')->get();
        $guidecache = array();

        foreach($guides as $g)
        {
            //COMPILE GUIDE ID
            $guideExplode = explode(" ", $g->name);
            foreach ($guideExplode as $exploded)
            {
                if(in_array($exploded, $terms))
                {
                    if($g->published == 1)
                    {
                        $guidecache[$g->id] = (!isset($guidecache[$g->id])) ? 3 : $guidecache[$g->id]+3;
                    }
                }
            }
        }

        foreach ($tags as $tag)
        {
            $tagExplode = explode(",", $tag->tags);
            foreach ($tagExplode as $exploded)
            {
                if (in_array($exploded, $terms))
                {
                    if($tag->published == 1)
                    {
                        $guidecache[$tag->id] = (!isset($guidecache[$tag->id])) ? 2 : $guidecache[$tag->id]+2;
                    }
                }
            }
        }

        foreach ($steps as $s)
        {
            //COMPILE GUIDE ID
            $stepExplode = explode(" ", $s->stepContent);
            foreach ($stepExplode as $exploded)
            {
                //replace in array with an array filter
                if (in_array($exploded, $terms))
                {
                    if($s->guideInfo->published == 1)
                    {
                        $guidecache[$s->guideInfo->id] = (!isset($guidecache[$s->guideInfo->id])) ? 1 : $guidecache[$s->guideInfo->id] + 1;
                    }
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
        //tags??

        // max results 50 per search
        // remove old results if any exist for keyword chain
        // repopulate
        //
    }

    /**
     * Keep search terms but recache database
     * Perform this rarely especially on large databases as this could take a while
     */
    public function reCache()
    {
        $this->clearCache(1); // anything sent prevents redirecting too early
        foreach (SearchTerm::all() as $searchTerm)
        {
            $this->advancedSearch($searchTerm->term, $searchTerm);
        }
        return redirect()->back()->with('success', 'Successfully recached search terms')->send();
    }

    /**
     * Clear search cache except search terms
     * @param null $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clearCache($id = null)
    {
        SearchCache::truncate();
        if($id == null) return redirect()->back()->with('success', 'Successfully cleared search cache')->send();
    }

    /**
     * Remove all search entries and cache
     */
    public function clearSearch()
    {
        SearchTerm::truncate();
        SearchCache::truncate();
        return redirect()->back()->with('success', 'Successfully cleared all search terms')->send();
    }

    public function search(Request $request)
    {
        $results = $this->basicSearch($request->searchterm);
        return view('searchresults', ['results' => $results]);
    }

    public function searchId(Request $request, SearchTerm $id)
    {
        if(!empty($id)) {
            return view('searchresults', ['results' => $id]);
        }
    }

    public function dashboard(Request $request)
    {
        $terms = SearchTerm::with('cache')->paginate(50);
        return view('admin.SearchDashboard', ['terms' =>  $terms]);
    }
}
