@extends('layouts.default')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.pagenotfound') }}
@endsection

@section('contentheader_title')
    {{ trans('adminlte_lang::message.404error') }}
@endsection

@section('$contentheader_description')
@endsection

@section('main-content')
    <div class="error-page">
    <h2 class="headline text-yellow"> 404</h2>

    <div class="error-content">
      <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>

      <p>
        Maaf, Sistem tidak bisa menemukan halaman yang Anda cari
        Anda bisa pergi ke <a href="{{ route('indexHome') }}"> HOME </a> untuk kembali ke beranda atau cari Musik lainnya
      </p>

      <form method="POST" class="search-form" action="{{ route('postSearch') }}">
      {{ csrf_field() }}
        <div class="input-group">
          <input type="text" name="q" class="form-control OkeSearch" placeholder="Search">

          <div class="input-group-btn">
            <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i>
            </button>
          </div>
        </div>
        <!-- /.input-group -->
      </form>
    </div>
    <!-- /.error-content -->
    </div>
    <!-- /.error-page -->
@endsection


