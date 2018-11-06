@extends("layout.main")
@section("title")ᠮᠠᠨᠵᡠ manchu满语图书@endsection

@section("content")
    @include("olcatalog.nav")
    <link rel="stylesheet" href="/css/book">

    <section class="column-list">
        <div class="bd">
            <ul class="list-col list-col5">

                @foreach($olcatalogs as $olcatalog)
                    <li class="column-item zh">
                        <div class="cover shadow-cover"><a href="/olcatalogs/{{$olcatalog->id}}">
                                @if(!empty($olcatalog->pic))
                                    <img src="{{ asset('/pic/'.$olcatalog->pic) }}" alt="图片">
                                @else
                                    <img src="" alt="图片">
                                @endif</a>
                        </div>
                        <h4 class="title"><a href="/olcatalogs/{{$olcatalog->id}}">{{$olcatalog->title}}</a></h4>
                        <div class="author">{{$olcatalog->author}}</div>
                        <!--<div class="subscribe"><span class="sub-number">8121人订阅</span>-->
                        <!--<span class="finished-text">&nbsp;| 已完结</span>-->
                        <!--</div>-->
                    </li>
                @endforeach

                {{$olcatalogs->links()}}
                @if( !$olcatalogs || sizeof($olcatalogs) == 0)
                    <div class="zh">还没有图书！</div>
                @endif
            </ul>
        </div>
    </section>
@endsection
