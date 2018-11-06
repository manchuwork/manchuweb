@extends("layout.main")
@section("title")ᠮᠠᠨᠵᡠ manchu满语图书@endsection

@section("content")
    @include("olbook.nav")
    <link rel="stylesheet" href="/css/book">

    <section class="column-list">
        <div class="bd">
            <ul class="list-col list-col5">

                @foreach($olbooks as $book)
                    <li class="column-item zh">
                        <div class="cover shadow-cover"><a href="/olbooks/{{$book->id}}">
                                @if(!empty($book->pic))
                                    <img src="{{ asset('/pic/'.$book->pic) }}" alt="图片">
                                @else
                                    <img src="" alt="图片">
                                @endif</a>
                        </div>
                        <h4 class="title"><a href="/olbooks/{{$book->id}}">{{$book->title}}</a></h4>
                        <div class="author">{{$book->author}}</div>
                        <!--<div class="subscribe"><span class="sub-number">8121人订阅</span>-->
                        <!--<span class="finished-text">&nbsp;| 已完结</span>-->
                        <!--</div>-->
                    </li>
                @endforeach

                {{$olbooks->links()}}
                @if( !$olbooks || sizeof($olbooks) == 0)
                    <div class="zh">还没有图书！</div>
                @endif
            </ul>
        </div>
    </section>
@endsection
