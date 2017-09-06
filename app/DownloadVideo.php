<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DownloadVideo extends Model
{
    public function video(){
    	return $this->belongsTo(Video::class);
    }
}
