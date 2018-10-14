@extends("layout.main")
@section("title")ᠮᠠᠨᠵᡠ manchu满语图书@endsection

@section("content")
    @include("lyric.nav")
    <link rel="stylesheet" href="/css/book">

    <section class="column-list">
        {{--<div class="hd lined"><h3>悬疑小说</h3>--}}
            {{--<span class="more-links"><a href="/kind/508?works_type=1&amp;sort=hot&amp;icn=columns-kind">更多</a></span>--}}
        {{--</div>--}}
        <div class="bd">
            <ul class="list-col list-col5">

                @foreach($lyrics as $lyric)
                    <li class="column-item zh">

                        <h4 class="title"><a href="/lyrics/{{$lyric->id}}">{{$lyric->title}}</a></h4>
                        <div class="author">{{$lyric->author}}</div>

                    </li>
                @endforeach

                {{$lyrics->links()}}
                @if( !$lyrics || sizeof($lyrics) == 0)
                    <div class="zh">还没有歌词！</div>
                @endif

            </ul>
        </div>
    </section>
@endsection
