@extends("layout.main")
@section("title"){{$title_prefix}}, ᠮᠠᠨᠵᡠ, manchu, manju,search满语字典-搜索@endsection
@section("keywords"){{$title_prefix}}, ᠮᠠᠨᠵᡠ, manchu, manju,search满语字典-搜索@endsection
@section("description"){{$description}}, ᠮᠠᠨᠵᡠ, manchu, manju,search满语字典-搜索@endsection
@section("content")
    @include("book.nav")

    @include("book.search_head")
    <link rel="stylesheet" href="/css/book">
    <section class="column-list">
        {{--<div class="hd lined"><h3>悬疑小说</h3>--}}
        {{--<span class="more-links"><a href="/kind/508?works_type=1&amp;sort=hot&amp;icn=columns-kind">更多</a></span>--}}
        {{--</div>--}}
        <div class="bd">
            <ul class="list-col list-col5">

                @if(isset($dicts) && (sizeof($dicts) > 0))

                @foreach($books as $book)
                    <li class="column-item zh">
                        <div class="cover shadow-cover"><a href="/books/{{$book->id}}">
                                @if(!empty($book->pic))
                                    <img src="{{ asset('/pic/'.$book->pic) }}" alt="图片">
                                @else
                                    <img src="/img/default_book_cover.png"  title="点击看大图" alt="{{$book->title}}" rel="v:photo"
                                         width="110px"/>
                                @endif</a>
                        </div>
                        <h4 class="title"><a href="/books/{{$book->id}}">{{$book->title}}</a></h4>
                        <div class="author">{{$book->author}}</div>
                        <!--<div class="subscribe"><span class="sub-number">8121人订阅</span>-->
                        <!--<span class="finished-text">&nbsp;| 已完结</span>-->
                        <!--</div>-->
                    </li>
                @endforeach
                {{$books->links()}}
                @elseif(empty($word))
                    <div class="mnc"></div>
                @elseif(isset($word))
                    <div class="zh">还没有图书！</div>
                @endif
            </ul>
        </div>
    </section>
    @include("ad.ad_container_once")
@endsection
