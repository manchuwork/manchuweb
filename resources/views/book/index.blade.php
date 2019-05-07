@extends("layout.main")
@section("title"){{$title_prefix}} ᠮᠠᠨᠵᡠ manchu满语图书@endsection
@section("keywords"){{$title_prefix}}, ᠮᠠᠨᠵᡠ, manchu, manju,图书查看@endsection
@section("description"){{$description}}, ᠮᠠᠨᠵᡠ, manchu, manju,图书查看@endsection
@section("content")
    @include("book.nav")
    <link rel="stylesheet" href="/css/book">
    <section class="column-list">
        {{--<div class="hd lined"><h3>悬疑小说</h3>--}}
            {{--<span class="more-links"><a href="/kind/508?works_type=1&amp;sort=hot&amp;icn=columns-kind">更多</a></span>--}}
        {{--</div>--}}
        <div class="bd">
            <ul class="list-col list-col5">

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
                @if( !$books || sizeof($books) == 0)
                    <div class="zh">还没有图书！</div>
                @endif


                {{--<li class="column-item">--}}
                    {{--<div class="cover shadow-cover"><a href="/column/8291818/?"><img src="https://img3.doubanio.com/view/ark_column_banner_cover/retina/public/7fa85bea295b4646924902676db7c2c5.jpg"></a></div><h4 class="title"><a href="/column/8291818/?">无限恐怖（二）</a></h4><div class="author">秦淮明月</div><div class="subscribe"><span class="sub-number">1096人订阅</span>--}}
                        {{--<span class="finished-text">&nbsp;| 已完结</span>--}}
                    {{--</div>--}}
                {{--</li>--}}

                {{--<li class="column-item">--}}
                    {{--<div class="cover shadow-cover"><a href="/column/8408925/?"><img src="https://img3.doubanio.com/view/ark_column_banner_cover/retina/public/54bdbd2d518340f1a3c1fc82b8914961.jpg"></a></div><h4 class="title"><a href="/column/8408925/?">古董珍珑劫</a></h4><div class="author">高烁臣</div><div class="subscribe"><span class="sub-number">648人订阅</span>--}}
                    {{--</div>--}}
                {{--</li>--}}

                {{--<li class="column-item">--}}
                    {{--<div class="cover shadow-cover"><a href="/column/6250083/?"><img src="https://img1.doubanio.com/view/ark_column_banner_cover/retina/public/fda6878b9bab4239a93d9898927dac39.jpg"></a></div><h4 class="title"><a href="/column/6250083/?">梁家兴教授探案集</a></h4><div class="author">北派二舅</div><div class="subscribe"><span class="sub-number">4334人订阅</span>--}}
                        {{--<span class="finished-text">&nbsp;| 已完结</span>--}}
                    {{--</div>--}}
                {{--</li>--}}

                {{--<li class="column-item">--}}
                    {{--<div class="cover shadow-cover"><a href="/column/8144929/?"><img src="https://img3.doubanio.com/view/ark_column_banner_cover/retina/public/3cf8403473254565a7f09aacc9e9bca5.jpg"></a></div><h4 class="title"><a href="/column/8144929/?">无限恐怖</a></h4><div class="author">秦淮明月</div><div class="subscribe"><span class="sub-number">1171人订阅</span>--}}
                        {{--<span class="finished-text">&nbsp;| 已完结</span>--}}
                    {{--</div>--}}
                {{--</li>--}}
            </ul>
        </div>
    </section>
@endsection
