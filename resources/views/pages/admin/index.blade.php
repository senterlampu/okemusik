@extends('layouts.admin')
@section('htmlheader_title','Hai min...')
@section('main-content')
<div class="row">
	<div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Visitor</span>
              <span class="info-box-number">90<small>%</small></span>
            </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
	</div>
	<div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Page View</span>
              <span class="info-box-number">90<small>%</small></span>
            </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
	</div>
	<div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Download</span>
              <span class="info-box-number">90<small>%</small></span>
            </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
	</div>
</div>
<div class="row">
	<div class="col-md-4 col-sm-6 col-xs-12">
	    <div class="box box-primary">
	        <div class="box-header with-border">
	          <h2 class="box-title">Hasil Pencarian Terbanyak</h2>
	          <div class="box-tools pull-right">
	            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
	            </button>
	          </div>
	        </div>
	        <!-- /.box-header -->
	        <div class="box-body">
	        	<table class="table table-hover table-condensed table-stripped table-bordered">
	        		<thead>
	        			<tr>
	        				<th>Word</th>
	        			</tr>
	        		</thead>
	        		<tbody>
	        			@foreach($searchs as $search)
	        			<tr>
	        				<td>{{ $search->word }}</td>
	        			</tr>
	        			@endforeach
	        		</tbody>
	        	</table>
	        </div>
	        <!-- /.box-body -->
	        <div class="box-footer">
	        </div>
	        <!-- /.box-footer -->
	    </div>
	</div> {{-- end col md 12 --}}
	<div class="col-md-8 col-sm-6 col-xs-12">
	    <div class="box box-primary">
	        <div class="box-header with-border">
	          <h2 class="box-title">Konten Paling Banyak Dimuat</h2>
	          <div class="box-tools pull-right">
	            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
	            </button>
	          </div>
	        </div>
	        <!-- /.box-header -->
	        <div class="box-body">
	        	<table class="table table-hover table-condensed table-stripped table-bordered">
	        		<thead>
	        			<tr>
	        				<th class="text-center">View</th>
	        				<th>Judul</th>
	        				<th>ID Video</th>
	        			</tr>
	        		</thead>
	        		<tbody>
	        			@foreach($videos as $video)
	        			<tr>
	        				<td class="text-center">{{ $video->viewer_vid }}</td>
	        				<td>{{ $video->title_vid }}</td>
	        				<td>{{ $video->id_vid }}</td>
	        			</tr>
	        			@endforeach
	        		</tbody>
	        	</table>
	        </div>
	        <!-- /.box-body -->
	        <div class="box-footer">
	        </div>
	        <!-- /.box-footer -->
	    </div>
	</div> {{-- end col md 12 --}}
</div>
@endsection