{{ header("Cache-Control: no-transform") }}
<!DOCTYPE html>
<html lang="en">

@section('htmlheader')
    @include('layouts.partials.htmlheader')
@show
<body class="skin-black-light layout-top-nav">
<style type="text/css">
    .widget-user .widget-user-header {
    padding: 20px;
    height: 60px;
    border-top-right-radius: 3px;
    border-top-left-radius: 3px;
    }
    .widget-user .box-footer {
        padding-top: 10px;
    }

    .products-list .product-description {
        display: block;
        color: #999;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        padding-top: 5px;
    }
    @media screen and (max-width: 768px){
      *[class*='col-xs-12']{
        padding: 2px !important;
      }

      .products-list .product-img {
            display: none !important;
            visibility: hidden !important;
        }
        .products-list .product-info {
            margin-left: 1px !important;
        }
    }
</style>
@stack('css')
<div class="wrapper">
    @include('layouts.partials.mainheader')
    <div class="content-wrapper">
        <div class="container no-padding">
            <section class="content">
                <article>
                @yield('main-content')
                </article>
            </section>
        </div>
    </div>
    @include('layouts.partials.footer')

</div>
@section('scripts')
    @include('layouts.partials.scripts')
@show
<script type="text/javascript">
    var suggestCallBack; 
    $(document).ready(function () {
        $(".OkeSearch").autocomplete({
            source: function(request, response) {
                $.getJSON("http://suggestqueries.google.com/complete/search?callback=?",
                    {
                      "hl":"en", 
                      "ds":"yt", 
                      "jsonp":"suggestCallBack", 
                      "q":request.term, 
                      "client":"youtube" 
                    }
                );
                suggestCallBack = function (data) {
                    var suggestions = [];
                    $.each(data[1], function(key, val) {
                        suggestions.push({"value":val[0]});
                    });
                    suggestions.length = 7; 
                    response(suggestions);
                };
            },
        });
    });
</script>
@stack('script')
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-80929634-1', 'auto');
  ga('send', 'pageview');

</script>
</body>

</html>
