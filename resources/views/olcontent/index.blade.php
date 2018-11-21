@extends("layout.main")
@section("title")ᠮᠠᠨᠵᡠ manchu满语图书@endsection

@section("content")
    @include("olcontent.nav")
    <link rel="stylesheet" href="/css/book">

    <section class="column-list">
        <div class="bd">
            <ul class="list-col list-col5">

                @foreach($olcontents as $olcontent)
                    <li class="column-item zh">
                        <div class="cover shadow-cover"><a href="/olcontents/{{$olcontent->id}}">
                                id
                            </a>
                            <div>{!! $olcontent->content !!}</div>
                        </div>
                    </li>
                @endforeach

                {{$olcontents->links()}}
                @if( !$olcontents || sizeof($olcontents) == 0)
                    <div class="zh">还没有图书！</div>
                @endif
            </ul>
        </div>
    </section>
@endsection
