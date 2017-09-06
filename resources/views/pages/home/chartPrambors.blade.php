@extends('layouts.default')
@section('htmlheader_title','40 Top Chart Prambors - OkeMusik.com')
@section('htmlheader_metadesc','40 Top Chart Prambors Radio')
@section('main-content')
<div class="row">
	<div class="col-md-8 col-sm- col-xs-12 no-padding">
	    <div class="box box-primary">
	        <div class="box-header with-border">
	          <h1 class="box-title">40 Top Chart Prambors</h1>

	          <div class="box-tools pull-right">
	            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
	            </button>
	          </div>
	        </div>
	        <!-- /.box-header -->
	        <div class="box-body">
	          <ul class="products-list product-list-in-box">
	            @foreach ($chartPrambors as $number => $item) 
	            <li class="item">
	              <div class="product-img">
	                <img src="{{ asset($item->small_thumbnail_vid) }}" alt="{{ $item->title_vid }}">
	              </div>
	              <div class="product-info">
	                <a href="{{ route('getContent',['slug'=>$item->url_vid]) }}" class="product-title text-capitalize"><h2 class="h4 no-margin no-padding">{{ $item->title_vid }}</h2></a>
	                    @if(!empty($item->audio->where('abr','128 kbps')->first()->url))
	                    <span class="product-description">
	                      <a href="{{ $item->audio->where('abr','128 kbps')->first()->url }}" class="btn btn-primary btn-flat btn-sm" download="download"><i class="fa fa-download"></i> Download MP3 <strong>({{ $item->audio->where('abr','128 kbps')->first()->size }})</strong></a>
	                    </span>
	                    @else 
	                    	-- ERROR --
	                	@endif
	              </div>
	            </li>
	            @endforeach
	            <!-- /.item -->
	          </ul>
	        </div>
	        <!-- /.box-body -->
	    </div>
	</div> 
	{{-- end col md 12 --}}
	<div class="col-md-4 col-sm-6 col-xs-12">
      <!-- Widget: user widget style 1 -->
      	<div class="box box-success">
	        <!-- Add the bg color to the header using any of the bg-* classes -->
	        <div class="box-header with-border">
	        	<h3 class="box-title">Lagu Terpopuler Saat Ini</h3>
	        	<div class="box-tools pull-right">
	        		<i class="fa fa-eye"></i>
	        	</div>
	        </div>
	        <div class="box-body no-padding">
	          <ul class="nav nav-stacked">
	          	@foreach ($popularView as $number => $item) 
	            <li><a href="{{ route('getContent',['slug'=>$item->url_vid]) }}"><h3 class="h5 no-padding no-margin text-capitalize">{{ $item->title_vid }}<span class="pull-right badge bg-blue">{{ $item->viewer_vid }}</span></h3> </a></li>
	            @endforeach
	          </ul>
	        </div>
	    </div>
      <!-- /.widget-user -->
    </div>
</div> {{-- end row --}}


@endsection
