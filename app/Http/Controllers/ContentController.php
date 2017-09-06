<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\YoutubeController;

use App\Http\Requests;

use Youtube;
use DB;
use Image;
use Debugbar;

use App\Playlist;
use App\PlaylistDetail;
use App\Video;
use App\DownloadVideo;
use App\DownloadAudio;
use App\Pages;

class ContentController extends Controller
{
	public function __construct(){
		$this->youtube = new YoutubeController();
	}

    public function error404(){
    // abort(404);
        return redirect('http://okemusik.com');
        // return view('errors.404');
    }

    public function getPage(){

    }
    
    public function getContent($slug){
        $content = Video::where('url_vid',$slug)->select('id_vid','title_vid','url_vid','thumbnail_vid','small_thumbnail_vid','viewer_vid')->first();
        // dd($content);
        if($content === false OR is_null($content) OR empty($content)){
            // abort(404);
        	// $replace = str_replace("-"," ",$slug);
        	// return redirect(route('postSearch',['q'=>$replace]));
            return redirect('http://okemusik.com');
        }

        $videoId = $content->id_vid;

        if (is_null(DB::table('download_videos')->where('id_vid_down',$videoId)->first()) && is_null(DB::table('download_audios')->where('id_vid_down',$videoId)->first())) {
            $this->youtube->downloadAudio($videoId);
            $this->youtube->downloadVideo($videoId);
        } elseif (is_null(DB::table('download_audios')->where('id_vid_down',$videoId)->first())) {
            $this->youtube->downloadAudio($videoId);
        } elseif (is_null(DB::table('download_videos')->where('id_vid_down',$videoId)->first())) {
            $this->youtube->downloadVideo($videoId);
            }

        $download['audios'] = DB::table('videos')
                        ->join('download_audios','download_audios.id_vid_down','=','videos.id_vid')
                        ->where('id_vid',$content->id_vid)
                        ->select('download_audios.*')
                        ->get();

        $download['videos'] = DB::table('videos')
                        ->join('download_videos','download_videos.id_vid_down','=','videos.id_vid')
                        ->where('id_vid',$content->id_vid)
                        ->select('download_videos.*')
                        ->get();

        $popularView = Video::orderBy('viewer_vid','desc')->take(10)->get();
        
        if (is_null($content->thumbnail_vid)) {
            $videoInfo = Youtube::getVideoInfo($content->id_vid);
            $youtube = new YoutubeController();
            $image = $youtube -> imageLarge($youtube -> setImageLarge($videoInfo->snippet->thumbnails),$videoInfo->snippet->title);
            $content->thumbnail_vid = $image;
        }

        $content->viewer_vid += 1;
        $content->save(); 
        
        $downloads = Video::find($content->id_vid);

        $downloadMp3128 = DownloadAudio::where('id_vid_down',$content->id_vid)->where('abr','LIKE','%128%')->first();
        $downloadMp3320 = DownloadAudio::where('id_vid_down',$content->id_vid)->where('abr','LIKE','%320%')->first();

        if (is_null($downloadMp3128)) {
	    $this -> youtube -> downloadAudio($content->id_vid);
            
        }

        
        $downloadVideo = DownloadVideo::where('id_vid_down',$content->id_vid)->where('ext','mp4')->where('res','LIKE','%360%')->first();

        if (is_null($downloadVideo)) {
            $this -> youtube -> downloadVideo($content->id_vid);
        }

        $relatedVideos = Youtube::getRelatedVideos($videoId);
        foreach ($relatedVideos as $key => $value) {
            Video::firstOrNew([
                'id_vid'=>$value->id->videoId,
                'title_vid'=>$this->youtube->removeWord($value->snippet->title),
                'url_vid'=>str_slug($this->youtube->removeWord($value->snippet->title)) . '-mp3'
                ]);
            $data['videoId'][] = $value->id->videoId;
        }

        $relatedVideo = Video::find($data['videoId']);

        return view('pages.showContent',compact('content','popularView','chartPrambors','relatedVideo','downloads','downloadMp3128','downloadMp3320','downloadVideo'));
    }

    public function search(Request $req){
    	$val = $req->q;
    	$results = $this->youtube->getSearch($req->q);
    	$popularView = Video::orderBy('viewer_vid','desc')->take(10)->get();
    	return view('pages.search',compact('results','val','popularView'));
    }    

    public function setSearch($id_vid){
        if(is_null(Video::find($id_vid))){
            $this->youtube->insertVideo($id_vid);
        };
        $video = Video::find($id_vid);
        if (is_null($video)) {
            // abort(404);
            return redirect('http://okemusik.com');
        } else {
        return redirect(route('getContent',$video->url_vid)); }
    }
}
