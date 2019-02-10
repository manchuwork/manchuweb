<!DOCTYPE html>
<html lang="mnc"><!-- Manchu 满语 -->
<head>
    <meta charset="utf-8"/>
    <meta name="description" content="Manchu 满语 ᠮᠠᠨᠵᡠ ᡤᡳᠰᡠᠨ 满族空间 www.manchu.work">
    <meta name="keywords" content="Manchu 满语 ᠮᠠᠨᠵᡠ ᡤᡳᠰᡠᠨ 满族空间  www.manchu.work">
    <link rel="stylesheet" href="/fonts/font-manchu">
    <link rel="stylesheet" href="/css/main">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"content="width=device-width,initial-scale=1.0,maximum-scale=1,user-scalable=no" />

    <script src="/js/jquery"></script>
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/core.js"></script>--}}
    <link rel="stylesheet" href="/css/mini">
    <title>@yield('title','Manchu 满语 ᠮᠠᠨᠵᡠ') Manchu 满语 ᠮᠠᠨᠵᡠ ᡤᡳᠰᡠᠨ manchu.work</title>
    @include("layout.tj")
</head>
<body class="container">
@include("layout.nav")
{{--@include("layout.welcome")--}}

@yield("content")
@include("layout.share")
@include("layout.footer")
</body>
</html>