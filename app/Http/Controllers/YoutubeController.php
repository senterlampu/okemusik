<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use stdClass;

use App\Playlist;
use App\PlaylistDetail;
use App\Video;

use DB;
use Youtube;
use Image;

class YoutubeController extends Controller
{
    public function imageLarge($url,$name="x_null_"){
		//        $img = Image::make($url);
		//        $img->fit(565,398);

		//        $img->insert('img/album_cover.png','bottom-right',0,0);
		        // $img->crop(565, 398, 0, 0); //crop 
		//        $img->save('image/' .  str_slug($name, "-") . '.jpg');
		//        return 'image/' . str_slug($name, "-") . '.jpg'; }
        
	return 'img/logov2.png';}

    public function imageSmall($url,$name="x_null_"){
        //$img = Image::make($url);
        //$img->fit(50,50);
        // $img->crop(50, 50, 0, 0); //crop 
        //$img->save('image/' .  str_slug($name, "-") . '-50-50.jpg');
        //return 'image/' .  str_slug($name, "-") . '-50-50.jpg'; }
	return 'img/logov2.png';}

    public function setImageLarge($thumbnails){
        // if (!empty($thumbnails->high->url)) {
        //     $urlImageSmall = $thumbnails->high->url;
        // } elseif (!empty($thumbnails->medium->url)) {
        //     $urlImageSmall = $thumbnails->medium->url;
        // } elseif (!empty($s->default->url)) {
        //     $urlImageSmall = $thumbnails->default->url;
        // } else {
            $urlImageSmall = null;
        // }

        return $urlImageSmall; }

    public function setImageSmall($thumbnails){
        // if (!empty($thumbnails->default->url)) {
        //     $urlImageLarge = $thumbnails->default->url;
        // } elseif (!empty($thumbnails->medium->url)) {
        //     $urlImageLarge = $thumbnails->medium->url;
        // } elseif (!empty($thumbnails->high->url)) {
        //     $urlImageLarge = $thumbnails->high->url;
        // } elseif (!empty($thumbnails->standard->url)) {
        //     $urlImageLarge = $thumbnails->standard->url;
        // } elseif (!empty($thumbnails->maxres->url)) {
        //     $urlImageLarge = $thumbnails->maxres->url;
        // } else {
            $urlImageLarge = null;
        // }

        return $urlImageLarge; }

    public function getImage($videoInfo,$type="both"){
        if ($type == "both") {
            $image["small"] = $this->imageLarge($this->setImageSmall($videoInfo->snippet->thumbnails),$videoInfo->snippet->title);
            $image["large"] = $this->imageSmall($this->setImageLarge($videoInfo->snippet->thumbnails),$videoInfo->snippet->title);
            return $image;
        } elseif ($type == "large") {
            return $this->imageLarge($this->setImageLarge($videoInfo->snippet->thumbnails),$videoInfo->snippet->title);
        } elseif ($type == "small"){
            return $this->imageSmall($this->setImageSmall($videoInfo->snippet->thumbnails),$videoInfo->snippet->title);
        } else {
            return false;
        } }

    public function removeWord($value){
        $removeWord = array('official','officials','video','lyrics','lyric','lirik','lagu','mp3','audio','videos','music','()','( )','(  )','(   )','[]','[ ]','[  ]','[   ]');
        return str_ireplace($removeWord, '', $value); }

    public function checkDiff($a){
        // parameter menggunakan array semua // [1, 2, 3, 4, 5]
        // $a videoId yg di api, $b yang di database

        $b = Video::find($a);
     
        foreach ($b as $video) {
            $b[] = $video->id_vid;
        }

        $collection = collect($a);
        $diff = $collection->diff($b);
        return $diff->all(); 
    }

    public function checkVideo($videoId){  //single
        // Untuk cek apakah video sudah ada database
        // Jika belum ada akan melakukan insertVideo
        if (is_array($videoId)) {
            $videoId = $this->checkDiff($videoId);
            
            if (!empty($videoId) || !is_null($videoId) ) {
                $this->insertVideo($videoId);
            }

        } else {
            if (is_null(Video::find($videoId))) {
                $this->insertVideo($videoId);
            }

            // if (is_null(DB::table('download_videos')->where('id_vid_down',$videoId)->first()) && is_null(DB::table('download_audios')->where('id_vid_down',$videoId)->first())) {
            //     $this->downloadAudio($videoId);
            //     $this->downloadVideo($videoId);
            // } elseif (is_null(DB::table('download_audios')->where('id_vid_down',$videoId)->first())) {
            //     $this->downloadAudio($videoId);
            // } elseif (is_null(DB::table('download_videos')->where('id_vid_down',$videoId)->first())) {
            //     $this->downloadVideo($videoId);
            // }
            // return $this->selectVideo($videoId);
        }
    }

    public function selectVideo($videoId){
        return Video::find($videoId);
    }
    
    public function insertVideo($videoId){
        $videoInfos = Youtube::getVideoInfo($videoId);
        if (is_array($videoId)) {
            foreach ($videoInfos as $videoInfo) {
                $video =  new Video();
                $video -> id_vid = $videoInfo -> id;
                $video -> title_vid = $this->removeWord($videoInfo->snippet->title);
                $video -> url_vid = str_slug($this->removeWord($videoInfo->snippet->title)) . '-mp3';

                $video -> thumbnail_vid = $this->imageLarge($this->setImageLarge($videoInfo->snippet->thumbnails),$videoInfo->snippet->title);
                $video -> small_thumbnail_vid = $this->imageSmall($this->setImageSmall($videoInfo->snippet->thumbnails),$videoInfo->snippet->title);
                $video -> tags_vid = null;
                $video -> duration_vid = null;
                $video -> save();
                if (is_null(DB::table('download_videos')->where('id_vid_down',$video->id_vid)->first()) && is_null(DB::table('download_audios')->where('id_vid_down',$video->id_vid)->first())) {
                    $this->downloadAudio($video->id_vid);
                    $this->downloadVideo($video->id_vid);
                } elseif (is_null(DB::table('download_audios')->where('id_vid_down',$video->id_vid)->first())) {
                    $this->downloadAudio($video->id_vid);
                } elseif (is_null(DB::table('download_videos')->where('id_vid_down',$video->id_vid)->first())) {
                    $this->downloadVideo($video->id_vid);
                }
            }
        } else {
            if ($videoInfos === false) {
                $video =  new Video();
                $video -> id_vid = 'undefined_' . $videoId . '_' . rand(5, 15);
                $video -> title_vid = 'undefined';
                $video -> url_vid = 'undefined';
                $video -> thumbnail_vid = null;
                $video -> small_thumbnail_vid = null;
                $video -> tags_vid = null;
                $video -> duration_vid = null;
                $video -> save();
            } else {
                $video =  new Video();
                $video -> id_vid = $videoInfos->id;
                $video -> title_vid = $this->removeWord($videoInfos->snippet->title);
                $video -> url_vid = str_slug($this->removeWord($videoInfos->snippet->title)) . '-mp3';
                $video -> thumbnail_vid = $this->imageLarge($this->setImageLarge($videoInfos->snippet->thumbnails),$videoInfos->snippet->title);
                $video -> small_thumbnail_vid = $this->imageSmall($this->setImageSmall($videoInfos->snippet->thumbnails),$videoInfos->snippet->title);
                $video -> tags_vid = null;
                $video -> duration_vid = null;
                $video -> save();

                if (is_null(DB::table('download_videos')->where('id_vid_down',$video->id_vid)->first()) && is_null(DB::table('download_audios')->where('id_vid_down',$video->id_vid)->first())) {
                    $this->downloadAudio($video->id_vid);
                    $this->downloadVideo($video->id_vid);
                } elseif (is_null(DB::table('download_audios')->where('id_vid_down',$video->id_vid)->first())) {
                    $this->downloadAudio($video->id_vid);
                } elseif (is_null(DB::table('download_videos')->where('id_vid_down',$video->id_vid)->first())) {
                    $this->downloadVideo($video->id_vid);
                }
            }
            return $video;
        }
    }

    public function downloadVideo($videoId){
        $downloadInfo = json_decode(file_get_contents('https://savevideos.xyz/api?v=' . $videoId));
        if ($downloadInfo->title !== 'This video is not available') {    
            if (is_array($downloadInfo->video))  {
                for ($i=0; $i < count($downloadInfo->video) ; $i++) { 
                    $data['video'][$i]['id_vid_down'] = $videoId;
                    $data['video'][$i]['quality'] = $downloadInfo->video[$i]->quality;
                    $data['video'][$i]['size'] = $downloadInfo->video[$i]->size;
                    $data['video'][$i]['url'] = $downloadInfo->video[$i]->url;
                    $data['video'][$i]['res'] = $downloadInfo->video[$i]->res;
                    $data['video'][$i]['ext'] = $downloadInfo->video[$i]->ext;
                    $data['video'][$i]['abr'] = $downloadInfo->video[$i]->abr;
                    }
                DB::table('download_videos')->insert($data['video']);                    
                }
        }
    }

    public function downloadAudio($videoId){
        $downloadInfo = json_decode(file_get_contents('https://savevideos.xyz/api?v=' . $videoId));
        if ($downloadInfo->title !== 'This video is not available') {
            if (is_array($downloadInfo->audio))  {
                for ($i=0; $i < count($downloadInfo->audio) ; $i++) { 
                    $data['audio'][$i]['id_vid_down'] = $videoId;
                    $data['audio'][$i]['size'] = $downloadInfo->audio[$i]->size;
                    $data['audio'][$i]['url'] = $downloadInfo->audio[$i]->url;
                    $data['audio'][$i]['ext'] = $downloadInfo->audio[$i]->ext;
                    $data['audio'][$i]['abr'] = $downloadInfo->audio[$i]->abr;
                    }
                DB::table('download_audios')->insert($data['audio']);                    
            }
        }
    }

    public function playlist($playlistId,$pageToken=false,$maxResults = 50){
        $playlistItems = Youtube::getPlaylistItemsByPlaylistId($playlistId,$pageToken,$maxResults);
        
        foreach ($playlistItems['results'] as $item) {
            $videoId[] = $item->contentDetails->videoId;
        }

        $checkVideoId = $this->checkDiff($videoId);

        if (!empty($checkVideoId))  {
            foreach ($checkVideoId as $videoId) {
                $this->insertVideo($videoId);
            }   
        }
        return $this->selectVideo($videoId);
    }

    public function relatedVideo($videoId){
        $data = Youtube::getRelatedVideos($videoId);
        foreach ($data as $key => $value) {
            $this->checkVideo($value->id->videoId);
            $data['videoId'][] = $value->id->videoId;
        }
        return $this->selectVideo($data['videoId']);
    }

    public function getSearch($q){
        $searchResult = Youtube::searchVideos($q);
        DB::table('search_queries')->insert(['word'=>$q]);
        foreach ($searchResult as $key => $value) {
            $videoId[] = $value->id->videoId;
        }

        return Youtube::getVideoInfo($videoId);
    }
}
