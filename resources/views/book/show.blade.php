@extends("layout.main")
@section("title")ᠮᠠᠨᠵᡠ manchu图书查看@endsection
@section("content")
    <link rel="stylesheet" href="/css/book">
    <link rel="stylesheet" href="/css/bookinfo">
    @include("book.nav")
    <h1 class="zh">{{$book->title}}</h1>
    <h1 class="mnc">{{$book->title_mnc}}</h1>
    <div class="subject clearfix">
        @if(!empty($book->pic))
            <img src="{{ asset('/pic/'.$book->pic) }}" style="width: 135px" alt="{{$book->title}}" rel="v:photo"
                 style="width: 135px">
        @else
            <img src="/img/default_book_cover.png"  alt="{{$book->title}}" rel="v:photo"
                 style="width: 135px"/>
        @endif

        <div id="info" class="zh">
            @if(!empty($book->author))<span class="pl">作者</span>{{$book->author}}<br>@endif
            @if(!empty($book->translator))<span class="pl">翻译人</span>{{$book->translator}}<br>@endif
            @if(!empty($book->subtitle))<span class="pl">副标题</span>{{$book->subtitle}}<br>@endif
            @if(!empty($book->publisher))<span class="pl">出版社</span>{{$book->publisher}}<br>@endif
            @if(!empty($book->publish_year))<span class="pl">出版年</span><span class="en">{{$book->publish_year}}</span><br>@endif
            @if(!empty($book->page_count))<span class="pl">页数</span><span class="en">{{$book->page_count}}</span><br>@endif
            @if(!empty($book->price))<span class="pl">定价</span><span class="en">{{$book->price}}</span> 元<br>@endif
            @if(!empty($book->binding))<span class="pl">装帧</span>{{$book->binding}}<br>@endif
            @if(!empty($book->isbn))<span class="pl">ISBN</span><span class="en">{{$book->isbn}}</span><br>@endif
        </div>
    </div>
    <div class="related_info zh">
        @if(!empty($book->brief_intro))
        <h2><span class="col_title">「内容简介」</span></h2>
        {{$book->brief_intro}}
        @endif
        @if(!empty($book->about_the_author))<h2><span class="col_title">「作者」</span></h2>
        {{$book->about_the_author}}@endif
        @if(!empty($book->catalogue))<h2><span class="col_title">「目录」</span></h2>
        {{$book->catalogue}}@endif
    </div>
    @if(!empty($book->buy_url))
        <a class="zh" href="{{ $book->buy_url }}" target="_blank">购买</a>
    @endif
    @if(!empty($book->file))
        <a class="zh"  href="{{ asset('/file/'.$book->file) }}" target="_blank">下载</a>

        @if(!empty($book->file_ext) && $book->file_ext == 'doc' || $book->file_ext == 'docx' || $book->file_ext == 'ppt' || $book->file_ext == 'pptx')
            <a class="zh" href="/msreader?p={{ $book->file }}" target="_blank">阅读</a>
        @elseif(!empty($book->file_ext && $book->file_ext == 'pdf') )
            <a class="zh" href="/reader/index.html#{{$book->file}}" target="_blank">阅读</a>
        @endif
    @endif
    @can('update', $book)
        @if($isShow)
            <a class="zh"  href="/books/{{$book->id}}/edit">
                <span class="" aria-hidden="true">编辑</span>
            </a>
            <a class="zh"  href="/books/{{$book->id}}/delete">
                <span class="" aria-hidden="true">删除</span>
            </a>
        @endif
    @endcan
@endsection