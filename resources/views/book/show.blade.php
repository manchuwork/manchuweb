@extends("layout.main")
@section("title")ᠮᠠᠨᠵᡠ manchu图书查看@endsection
@section("content")
    <link rel="stylesheet" href="/css/bookinfo">
    @include("book.nav")
    <h1 class="zh">{{$book->title}}</h1>
    <h1 class="mnc">{{$book->title_mnc}}</h1>
    <div class="subject clearfix">
        @if(!empty($book->pic))
            <img src="{{ asset('/pic/'.$book->pic) }}" style="width: 135px" alt="{{$book->title}}" rel="v:photo"
                 style="width: 135px">
        @else
            <img src="img/s28950702.jpg"  title="点击看大图" alt="{{$book->title}}" rel="v:photo"
                 style="width: 135px"/>
        @endif

        <div id="mainpic" class=""><a class="nbg" href="{{$book->pic}}"
                                      title="{{$book->title}}">
            </a></div>
        <div id="info" class="zh"><span><span class="pl"> 作者</span>: {{$book->author}}</span><br><span
                    class="pl">出版社:</span> {{$book->publisher}}<br><span class="pl">副标题:</span> {{$book->subtitle}}<br><span class="pl">出版年:</span>{{$book->publish_year}}<br><span
                    class="pl">页数:</span> <span class="en">{{$book->page_count}}</span><br><span class="pl">定价:</span><span class="en">{{$book->price}}</span> 元<br><span class="pl">装帧:</span> {{$book->binding}}<br><span
                    class="pl">ISBN:</span> {{$book->isbn}}<br></div>
    </div>
    <div class="related_info zh">
        <h2><span class="">内容简介</span></h2>
        {{$book->brief_intro}}
        <h2><span class="">作者</span></h2>
        {{$book->about_the_author}}
        <h2><span class="">目录</span></h2>
        {{$book->catalogue}}
    </div>
    @if(!empty($book->file))
        <a class="zh"  href="{{ asset('/file/'.$book->file) }}" target="_blank">下载</a>
        <a class="zh" href="http://localhost:8000/reader/index.html#{{$book->file}}" target="_blank">阅读</a>
    @else

    @endif
    @can('update', $book)
        @if($isShow)
            <a class="zh"  href="/books/{{$book->id}}/edit">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true">编辑</span>
            </a>
            <a class="zh"  href="/books/{{$book->id}}/delete">
                <span class="glyphicon glyphicon-remove" aria-hidden="true">删除</span>
            </a>
        @endif
    @endcan
@endsection