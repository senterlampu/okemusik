<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Video;

class SitemapController extends Controller
{
    public function index()
    {
    	$videos = Video::where('viewer_vid','>','3')->orderBy('created_at', 'desc')->get();
		return response()->view('layouts.sitemap', [
		    'videos' => $videos
		])->header('Content-Type', 'text/xml');
    }
}
