<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

class AdminController extends Controller
{	
	public function __construct(){
		$this->middleware('auth');
	}
    public function index(){
    	$searchs = DB::table('search_queries')->select('word')->orderBy('updated_at','desc')->take(10)->get();
    	$videos = DB::table('videos')->select(['viewer_vid','title_vid','id_vid'])->orderBy('viewer_vid','desc')->take(10)->get();
    	return view('pages.admin.index',compact('searchs','videos'));
    }

    public function indexPublic(){

    }
}
