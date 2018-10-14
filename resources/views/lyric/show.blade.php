@extends("layout.main")
@section("title")ᠮᠠᠨᠵᡠ manchu歌词查看@endsection
@section("content")
    <link rel="stylesheet" href="/css/bookinfo">
    @include("lyric.nav")
    <h1 class="zh">{{$lyric->title}}</h1>
    <div class="zh">{{$lyric->author}}</div>

    <a class="zh" href="{{ asset('/text/'. $lyric->file) }}" target="_blank">歌词下载</a>
    @can('update', $lyric)
        @if($isShow)
            <a class="zh"  href="/lyrics/{{$lyric->id}}/edit">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true">编辑</span>
            </a>
            <a class="zh"  href="/lyrics/{{$lyric->id}}/delete">
                <span class="glyphicon glyphicon-remove" aria-hidden="true">删除</span>
            </a>
        @endif
    @endcan
@endsection