<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SearchController extends Controller
{
    public function getSearch($q){
        $searchResult = Youtube::searchVideos($q);
        DB::table('search_queries')->insert(['word'=>$q]);
        foreach ($searchResult as $key => $value) {
            $videoId[] = $value->id->videoId;
        }

        return Youtube::getVideoInfo($videoId);
    }
}
