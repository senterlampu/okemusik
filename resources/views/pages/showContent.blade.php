@extends('layouts.default')
@section('htmlheader_title','Download Lagu ' . $content->title_vid . ' 1X Klik')
@section('htmlheader_metadesc','Download lagu dan video gratis ' . $content->title_vid . ' dengan kualitas audio mp3 128 kbps sampai 320 kbps dan video 360p, 760p dan 1080p')
@section('main-content')
<div class="row">
	<div class="col-md-8 col-sm-6 col-xs-12 no-padding">
	    <div class="box box-primary">
	        <div class="box-header with-border">
	          <a href="{{ route('getContent',['slug'=>$content->url_vid]) }}"><h1 class="box-title text-capitalize">Download Lagu {{ $content->title_vid }}</h1></a>
	          <div class="box-tools pull-right">
	            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
	            </button>
	          </div>
	        </div>
	        <!-- /.box-header -->
	        <div class="box-body">
	        @if(!is_null($downloadMp3128))
	        <a href="javascript:convert2mp3('{{$content->id_vid}}')" class="btn btn-default btn-flat btn-block" rel="nofollow"><i class="fa fa-download"></i>  Download MP3 - {{ $downloadMp3128->abr }} ({{ $downloadMp3128->size }})</a>
	        @else
	        -- ERROR --
	        @endif

	        @if(!is_null($downloadMp3320))
	        <a href="javascript:convert2mp3('{{$content->id_vid}}')" class="btn btn-info btn-flat btn-block" rel="nofollow"><i class="fa fa-download"></i>  Download MP3 - {{ $downloadMp3320->abr }} ({{ $downloadMp3320->size }})</a>
	        @else
			-- ERROR --
			@endif
	        <p class="h5" style="line-height:20px">Download lagu gratis {{ $content->title_vid }} dengan kualitas bagus tentunya. Anda bisa unduh lagu mp3 dan video dengan mudah dan pilihan kualitas yang banyak hanya di <a href="{{ route('indexHome') }}">OkeMusik.com</a>. Koleksi mp3 kami sangat banyak sekali mulai dari lagu populer, mp3 hits dan semua genre atau kategori musik seperti Jazz, Dangdut, Metal alternatif, balada, country, dansa, dunia, electronica, gospel, hip hop, house, pop, populer, rock, rok.</p>
			<p>
	        Kualitas Lagu mp3 di OkeMusik antara lain 64 Kbps, 128 Kbps, 192 Kbps, 256 Kbps dan 320 Kbps
	        Semakin tinggi "KBPS-nya" semakin bagus juga kualitasnya.table-condensed

	        Untuk download video {{ $content->title_vid }} klik lihat video kemudian dibawahnya akan muncul pilihan download dengan pilihan kualitas yang banyak dari 128kbps sampai 320Kbps.</p>

	        <img src="{{ URL::to($content->thumbnail_vid) }}" class="img-responsive center-block img-thumbnail" alt="{{ $content->title_vid }}">
	        <h2 class="text-center h3 text-capitalize">{{ $content->title_vid }}</h2>
	        <hr>
	        <div class="col-md-6 col-xs-12">
		        <span class="h4 center-block">Download MP3</span>
		        <table class="table table-hover table-condensed table-striped">
		        	<thead>
		        		<tr>
		        			<th class="text-center">Ukuran</th>
		        			<th class="text-center">Kualitas</th>
		        			<th class="text-center">Bit Rate</th>
		        			<th class="text-center"><i class="fa fa-download"></i></th>
		        		</tr>
		        	</thead>
		        	<tbody>
		        		@foreach($downloads->audio as $download)
		        		<tr>
		        			<td class="text-center">{{ $download->size }}</td>
		        			<td class="text-center">
		        				@if($download->abr == '128 kbps')
									<span class="label label-primary">Rekomendasi</span>
		        				@else
									
		        				@endif
		        			</td>
		        			<td class="text-center">{{ $download->abr }}</td>
		        			<td class="text-center"><a href="javascript:convert2mp3('{{$content->id_vid}}')" class="btn btn-block btn-flat btn-default btn-xs">Download</a></td>
		        		</tr>
		        		@endforeach
		        	</tbody>
		        </table>
		    </div>
	        {{-- <hr class="hidden-md hidden-lg hidden-sm"> --}}
	        <div class="col-md-6 col-xs-12">
		        <span class="h4 center-block">Download Video</span>
		        <table class="table table-hover table-condensed table-striped">
		        	<thead>
		        		<tr>
		        			<th class="text-center col-xs-3">Ukuran</th>
		        			<th class="text-center col-xs-3">Ext</th>
		        			<th class="text-center col-xs-3">Res</th>
		        			<th class="text-center"><i class="fa fa-download"></i></th>
		        		</tr>
		        	</thead>
		        	<tbody>
		        		@foreach($downloads->video as $download)
		        		<tr>
		        			<td class="text-center">{{ $download->size }}</td>
		        			<td class="text-center">{{ $download->ext }}</td>
		        			<td class="text-center">{{ $download->res }}</td>
		        			<td class="text-center"><a href="{{ $download->url }}" rel="nofollow" download="" class="btn btn-block btn-flat btn-default btn-xs">Download</a></td>
		        		</tr>
		        		@endforeach
		        	</tbody>
		        </table>
		    </div>
	        <div class="clearfix"></div>
	        <hr>
	        <button type="button" class="btn btn-info btn-flat btn-block" data-toggle="collapse" data-target="#demo"></i><i class="fa fa-eye"></i>  Lihat Video</button>
	        <div id="demo" class="collapse">
		        <div class="video-container">
					<object class="center-block box-footer" width="auto" height="auto" data="http://www.youtube.com/embed/{{ $content->id_vid }}"></object>

				</div>
			</div>

	        </div>
	        <!-- /.box-body -->
	    </div>
	    <div class="box box-success">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="box-header with-border">
            	<h3 class="box-title">Lagu Terkait</h3>
            	<div class="box-tools pull-right">
            		<i class="fa fa-eye"></i>
            	</div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-stacked">
              	@foreach ($relatedVideo as $number => $item) 
                <li><a href="{{ route('getContent',['slug'=>$item->url_vid]) }}"><h3 class="h5 no-padding no-margin text-capitalize">{{ $item->title_vid }}<span class="pull-right badge bg-blue">{{ $item->viewer_vid }}</span></h3> </a></li>
                @endforeach
              </ul>
            </div>
        </div>
	</div> 
	{{-- end col md 12 --}}
	
	<div class="col-md-4 col-sm-6 col-xs-12">
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
	              <button class="btn btn-info btn-flat" type="submit"><i class="fa fa-search"></i></button>
	            </span>
	            </div><!-- /input-group -->
	          </form>
	        </div>
		</div>
		
		<div class="box box-primary">
	        <!-- Add the bg color to the header using any of the bg-* classes -->
	        <div class="box-header with-border">
	        	<h3 class="box-title">Cari Musikmu!</h3>
	        	<div class="box-tools pull-right"><i class="fa fa-search"></i></div>
	        </div>
			<div class="box-body text-center center-block">
			    
	        </div>
		</div>
		
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
@push('script')
<script type="text/javascript" src="http://api.convert2mp3.cc/api.js"></script>
@endpush
@push('css')
<style type="text/css">
	.video-container {
	    position: relative;
	    padding-bottom: 56.25%;
	    padding-top: 30px; height: 0; overflow: hidden;
	}
	 
	.video-container iframe,
	.video-container object,
	.video-container embed {
	    position: absolute;
	    top: 0;
	    left: 0;
	    width: 100%;
	    height: 100%;
	}
</style>
@endpush
