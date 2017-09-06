<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    <url>
      <loc>{{ route('indexHome') }}</loc>
      <changefreq>daily</changefreq>
      <priority>1</priority>
      <image:image>
        <image:loc>{{ URL::to('image/logo.png') }}</image:loc>
        <image:caption>OkeMusik.com Download Lagu Mp3 Gratis Tanpa Ribet</image:caption>
        <image:title>OkeMusik.com Download Lagu Mp3 Gratis Tanpa Ribet</image:title>
      </image:image>
    </url>
    <url>
      <loc>{{ route('chartPrambors') }}</loc>
      <changefreq>weekly</changefreq>
      <priority>1</priority>
      <image:image>
        <image:loc>{{ URL::to('image/logo.png') }}</image:loc>
        <image:caption>OkeMusik.com Download Lagu Mp3 Gratis Tanpa Ribet</image:caption>
        <image:title>OkeMusik.com Download Lagu Mp3 Gratis Tanpa Ribet</image:title>
      </image:image>
    </url>
    <url>
      <loc>{{ route('indexHome') }}</loc>
      <changefreq>weekly</changefreq>
      <priority>1</priority>
      <image:image>
        <image:loc>{{ URL::to('image/logo.png') }}</image:loc>
        <image:caption>OkeMusik.com Download Lagu Mp3 Gratis Tanpa Ribet</image:caption>
        <image:title>OkeMusik.com Download Lagu Mp3 Gratis Tanpa Ribet</image:title>
      </image:image>
    </url>
    @foreach ($videos as $video) 
    <url>
      <loc>{{ URL::to("download/" . $video->url_vid) }}</loc>
      <changefreq>monthly</changefreq>
      <priority>0.5</priority>
      <image:image>
        <image:loc>{{ URL::to($video->thumbnail_vid) }}</image:loc>
        <image:caption>{{ $video->title_vid }}</image:caption>
        <image:title>{{ $video->title_vid }}</image:title>
      </image:image>
    </url>
    @endforeach
</urlset>