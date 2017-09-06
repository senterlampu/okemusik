@extends('layouts.default')
@section('htmlheader_title','Halaman Pencarian OkeMusik.com')
@section('main-content')
<div class="row">
	<div class="col-md-8 col-sm-6 col-xs-12 no-padding">
		<div class="box box-primary">
	        <!-- Add the bg color to the header using any of the bg-* classes -->
	        <div class="box-header with-border">
	        	<h3 class="box-title">Cari Musikmu!</h3>
	        	<div class="box-tools pull-right"><i class="fa fa-search"></i></div>
	        </div>
			<div class="box-body text-center">
	          <form method="POST" action="{{ route('postSearch') }}">
	          {{ csrf_field() }}
	          <div class="input-group">
	            <input type="text" class="form-control OkeSearch" name="q">
	            <span class="input-group-btn">
	              <button class="btn btn-primary btn-flat" type="submit"><i class="fa fa-search"></i></button>
	            </span>
	            </div><!-- /input-group -->
	          </form>
	        </div>
		</div>
	    <div class="box box-success">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="box-header with-border">
            	<h3 class="box-title"><i class="fa fa-search"></i> Hasil Pencarian untuk : {{ $val }}</h3>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-stacked">
              	@foreach ($results as $number => $item) 
                <li><a href="{{ route('setSearch',['id'=>$item->id]) }}"><h3 class="h5 no-padding no-margin">{{ $number +1 }}.  {{ $item->snippet->title }}<span class="pull-right badge bg-blue"></span></h3> </a></li>
                @endforeach
              </ul>
            </div>
        </div>
	</div> 
	{{-- end col md 12 --}}
	
	<div class="col-md-4 col-sm-6 col-xs-12">
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
    </div>
</div> {{-- end row --}}
@endsection