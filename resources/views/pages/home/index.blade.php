@extends('layouts.default')
@section('htmlheader_title','OkeMusik.com - Download Lagu Terbaru dan Terpopuler')
@section('main-content')
{{-- {{ csrf_field() }} --}}
<div class="row">
	<div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h1><img alt="Logo Oke Musik Download Mp3 Gratis Dengan Mudah" src="{{ asset('img/logov2.png') }}" class="img-responsive center-block"></h1>
        </div>
        <!-- /.box-header -->
        <div class="box-body text-center">
          <form method="POST" action="{{ url(route('postSearch')) }}">
          {{ csrf_field() }}
          <div class="input-group">
            <input type="text" class="form-control input-lg txt-auto OkeSearch" name="q">
            <span class="input-group-btn">
              <button class="btn btn-info btn-flat btn-lg" type="submit"><i class="fa fa-search"></i></button>
            </span>
            </div><!-- /input-group -->
          </form>
        </div>
        <div class="box-body">
        </div>
        <!-- /.box-body -->
      </div>
    </div>
</div>
<div class="row">
	<div class="col-md-5 col-md-offset-1 col-sm-6 col-xs-12">
	    <div class="box box-primary">
	        <div class="box-header with-border">
	          <a href="{{ route('chartPrambors') }}"><h2 class="box-title">40 Top Chart Prambors</h2></a>
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
	                <a href="{{ route('getContent',['slug'=>$item->url_vid]) }}" class="product-title text-capitalize">

	                <h2 class="h4 no-padding no-margin">{{ $item->title_vid }}</h2>
	                </a>
	                    <span class="product-description">
                    	@if(is_null($item->audio->where('abr','128 kbps')->first()))
                    		<button class="btn btn-danger btn-flat btn-sm disabled" disabled="disabled"><i class="fa fa-download"></i>  Link Error</button>
                    		<button class="btn btn-primary btn-flat btn-sm pull-right"><i class="fa fa-info"></i> Laporkan</button>
                    	@else
							<a href="{{ $item->audio->where('abr','128 kbps')->first()->url }}" class="btn btn-default btn-flat btn-sm" download="download" rel="nofollow"><i class="fa fa-download"></i> Download MP3 <strong>({{ $item->audio->where('abr','128 kbps')->first()->size }})</strong></a>
                    	@endif
	                    </span>
	              </div>
	            </li>
	            @endforeach
	            <!-- /.item -->
	          </ul>
	        </div>
	        <!-- /.box-body -->
	        <div class="box-footer text-center">
	          <a href="{{ route('chartPrambors') }}" class="btn btn-flat btn-info btn-block btn-sm uppercase"><i class="fa fa-folder-open"></i>  Lihat Semua</a>
	        </div>
	        <!-- /.box-footer -->
	    </div>
	</div> {{-- end col md 12 --}}
	<div class="col-md-5 col-sm-6 col-xs-12">
	    <div class="box box-primary">
	        <div class="box-header with-border">
	          <a href="{{ route('chartIndonesia') }}"><h2 class="box-title">40 Top Musik Indonesia Terpopuler</h2></a>
	          <div class="box-tools pull-right">
	            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
	            </button>
	          </div>
	        </div>
	        <!-- /.box-header -->
	        <div class="box-body">
	          <ul class="products-list product-list-in-box">
	            @foreach ($chartIndonesia as $number => $item) 
	            <li class="item">
	              <div class="product-img">
	                <img src="{{ asset($item->small_thumbnail_vid) }}" alt="{{ $item->title_vid }}">
	              </div>
	              <div class="product-info">
	                <a href="{{ route('getContent',['slug'=>$item->url_vid]) }}" class="product-title text-capitalize">

	                <h2 class="h4 no-padding no-margin">{{ $item->title_vid }}</h2>
	                </a>
	                @if(!is_null($item->audio->where('abr','128 kbps')->first())) 
					<span class="product-description">
                      <a href="{{ $item->audio->where('abr','128 kbps')->first()->url }}" class="btn btn-default btn-flat btn-sm" download="download" rel="nofollow"><i class="fa fa-download"></i> Download MP3 <strong>({{ $item->audio->where('abr','128 kbps')->first()->size }})</strong></a>
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
	        <div class="box-footer text-center">
	          <a href="{{ route('chartIndonesia') }}" class="btn btn-flat btn-info btn-block btn-sm uppercase"><i class="fa fa-folder-open"></i>  Lihat Semua</a>
	        </div>
	        <!-- /.box-footer -->
	    </div>
	</div> {{-- end col md 12 --}}
	<div class="col-md-10 col-md-offset-1 col-xs-12">
		<div class="box box-primary">
	        <div class="box-header with-border">
	          <h2 class="box-title">OkeMusik - Pencarian Terpopuler</h2>
	          <div class="box-tools pull-right">
	            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
	            </button>
	          </div>
	        </div>
	        <!-- /.box-header -->
	        <div class="box-body">
download lagu terbaru

lagu baru



lagu pop
lagu pop indonesia
lagu indonesia terbaru
download lagu pop
free
lagu
musik
music

	        download lagu dangdut
bursamp3
search 
download lagu baru
video
bee
web

download lagu indonesia terbaru
down
cari
mpe
	        download mp3
donlot
mendownload
unduh
app
gratis
d0wnl0ad
on
daowload
link
d0wnload
linkin
dengerin
mencari
daulot
downloadmusic

download mp3 terbaru

beatles
www
mpp3
minta
downloadlagu
lihat
nyari
bursa
website
mp3free
untuk
4sared
pencarian
lagu2
mp3downlod
donload
dounload
dwonload
dowmload
douwnload
donlod
downliad
dowload
downloand
downlod
file
donwload
downlot
dowbload
doenload
dowonload
m3
donwold
recording
dowloand
donloat
album
freemp3
mau
donwlod
donlwod
dwoanload
donwlond
diwnload
dowlod
freedownload
google
burn
teks
terbaru
baru
downloader
pop
player

for
online
park
of
classical
hits
lg
com
song
full
mf3
load
nasyid
downloud
indonesia
imp3
musick
lama
lgu
natal
dangdut
downloads
rohani
karaoke
terkini
jazz
a
audio
terfavorit
lengkap
band
di
the
and
teranyar
play
melayu
an
terpaporit
geratis
to
downloder
ungu
cd
songs

	        </div>
	        <!-- /.box-body -->
	    </div>
		

	</div>
</div> {{-- end row --}}


@endsection

@push('script')
{{-- <script type="text/javascript">
	swal.setDefaults({
  confirmButtonText: 'Next &rarr;',
  showCancelButton: true,
  animation: false,
  progressSteps: ['1', '2', '3']
});

var steps = [
  {
  	title: 'Cara Baru Download Video & Mp3',
    // title: 'Langkah 1',
    text: 'Langkah 1 - Lihat Gambar',
    imageUrl: '{{ asset('/img/t1.png') }}',
  	// imageWidth: 400,
  	// imageHeight: 200,
  },
  {
    // title: 'Langkah 2',
    text: 'Langkah 2 - Lihat Gambar',
    imageUrl: '{{ asset('/img/t2.png') }}',
  	// imageWidth: 400,
  	// imageHeight: 200,
  },
  {
    // title: 'Langkah 3',
    text: 'Langkah 3 - Lihat Gambar',
    imageUrl: '{{ asset('/img/t3.png') }}',
  	// imageWidth: 400,
  	// imageHeight: 200,
  },
];

swal.queue(steps).then(function() {
  swal.resetDefaults();
  swal({
    title: 'Selesai!',
    confirmButtonText: 'Saya mengerti!',
    showCancelButton: false
  });
}, function() {
  swal.resetDefaults();
})
</script> --}}
@endpush