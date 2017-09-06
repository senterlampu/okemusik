<header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <div class="h1 no-margin no-padding"><a href="{{ route('indexHome') }}" class="navbar-brand"><b>Oke</b>Musik</a></div>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="{{ route('indexHome') }}"><i class="fa fa-home"></i>  Home <span class="sr-only">(current)</span></a></li>
            <li><a href="{{ route('chartPrambors') }}"><i class="fa fa-list-ol"></i>  40 Top Prambors</a></li>
            <li><a href="{{ route('chartIndonesia') }}"><i class="fa fa-list-ol"></i>  40 Top Musik Indonesia</a></li>
            {{-- <li><a href="{{ route('chartIndonesia') }}"><i class="fa fa-circle-o"></i>  Most View</a></li> --}}
            <li><a>Disclaimer</a></li>
            <li><a>Contact US</a></li>
          </ul>
          <form class="navbar-form navbar-left" role="search" method="POST" action="{{ route('postSearch') }}">
          {{ csrf_field() }}
            <div class="form-group">
              <div class="input-group">
                <input type="text" class="form-control OkeSearch" placeholder="Cari Musikmu..." name="q">
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-info btn-flat">Cari!</button>
                </span>
              </div>
            </div>
          </form>
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>