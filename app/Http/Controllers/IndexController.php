<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;

// use App\Http\Controllers\CrudController;
use App\Http\Controllers\YoutubeController;

use Youtube;
use DB;
use Image;
use File;
use Debugbar;

use App\Playlist;
use App\PlaylistDetail;
use App\Video;
use App\Pages;

class IndexController extends Controller
{
	public function __construct(){
	$this->youtube = new YoutubeController();
        $this->idPlaylistChartPrambors = Pages::where('place','chartprambors')->first()->id_playlist;
        $this->idPlaylistChartIndonesia = Pages::where('place','chartindonesia')->first()->id_playlist;
	}

    public function index(){ 
        $chartPrambors = $this->playlist($this->idPlaylistChartPrambors,false,10);
    	$chartIndonesia = $this->playlist($this->idPlaylistChartIndonesia,false,10);
	return view('pages.home.index',compact('chartIndonesia','chartPrambors'));
    }

    public function playlist($playlistId,$pageToken=false,$maxResults = 50){
        $playlistItems = Youtube::getPlaylistItemsByPlaylistId($playlistId,$pageToken,$maxResults);
        
        foreach ($playlistItems['results'] as $item) {
            $videoId[] = $item->contentDetails->videoId;
        }
        
        $videos = Video::find($videoId);

        foreach ($videos as $video) {
            $b[] = $video->id_vid;
        }
        
        if (!empty($b)) {
            $collection = collect($videoId);
            $diff = $collection->diff($b);

            $checkVideoId = $diff->all(); 

            if (!empty($checkVideoId))  {
                foreach ($checkVideoId as $videoIdd) {
                    $this->youtube->insertVideo($videoIdd);
                }   
            }
        } else {
            $this->youtube->insertVideo($videoId);
        }
        
	return Video::find($videoId);

    }
}
