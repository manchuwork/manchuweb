@extends("layout.main")
@section("title")ᠮᠠᠨᠵᡠ manchu图书查看@endsection
@section("content")
    <link rel="stylesheet" href="/css/bookinfo">
    @include("olbook.nav")
    <h1 class="zh">{{$olbook->title}}</h1>
    <h1 class="mnc">{{$olbook->title_mnc}}</h1>
    <div class="subject clearfix">
        @if(!empty($olbook->pic))
            <img src="{{ asset('/pic/'.$olbook->pic) }}" style="width: 135px" alt="{{$olbook->title}}" rel="v:photo"
                 style="width: 135px">
        @else
            <img src="img/s28950702.jpg"  title="点击看大图" alt="{{$olbook->title}}" rel="v:photo"
                 style="width: 135px"/>
        @endif

        <div id="mainpic" class=""><a class="nbg" href="{{$olbook->pic}}"
                                      title="{{$olbook->title}}">
            </a></div>
        <div id="info" class="zh"><span><span class="pl"> 作者</span>: {{$olbook->author}}</span><br>
            </div>
    </div>
    <div class="related_info zh">
        <h2><span class="">内容简介</span></h2>
        {{$olbook->brief_intro}}
    </div>
    <h2><span class="">内容简介</span></h2>
    @can('update', $olbook)
        @if($isShow)
            <a class="zh"  href="/olbooks/{{$olbook->id}}/edit">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true">编辑</span>
            </a>
            <a class="zh"  href="/olbooks/{{$olbook->id}}/delete">
                <span class="glyphicon glyphicon-remove" aria-hidden="true">删除</span>
            </a>
        @endif
    @endcan
@endsection