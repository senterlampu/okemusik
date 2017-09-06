<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public $incrementing = false;
    protected $primaryKey = 'id_vid';
    protected $fillable = array('id_vid', 'title_vid', 'url_vid','small_thumbnail_vid','thumbnail_vid');
 	
 	public function download(){
 		return $this->belongsTo(DownloadVideo::class,'id_vid','id_vid_down');
 	}

 	public function audio(){
 		return $this->hasMany(DownloadAudio::class,'id_vid_down','id_vid');
 	}

 	public function video(){
 		return $this->hasMany(DownloadVideo::class,'id_vid_down','id_vid');
 	}
}
