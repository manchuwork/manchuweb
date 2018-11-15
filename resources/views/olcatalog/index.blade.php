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
                        <h4 class="title"><a href="/olcatalogs/{{$olcatalog->id}}">{{$olcatalog->entry}}</a></h4>
                        <div class="mnc">{{$olcatalog->entry_mnc}}</div>
                        <div class="en">{{$olcatalog->entry_trans}}</div>
                    </li>
                @endforeach

                {{$olcatalogs->links()}}
                @if( !$olcatalogs || sizeof($olcatalogs) == 0)
                    <div class="zh">还没有目录！</div>


                @endif


            </ul>
        </div>
        @can('update', $olbook)
            @if($isShow)
                <a class="zh"  href="/olcatalogs/create?olbook_id={{$olbook->id}}">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true">添加目录</span>
                </a>
            @endif
        @endcan
    </section>
@endsection
