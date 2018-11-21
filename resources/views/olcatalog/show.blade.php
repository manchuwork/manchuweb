@extends("layout.main")
@section("title")ᠮᠠᠨᠵᡠ manchu图书查看@endsection
@section("content")
    <link rel="stylesheet" href="/css/bookinfo">
    @include("olcatalog.nav")

    <div><span class="zh">「标题」</span>*</div>
    <div id="entry" class="zh" placeholder="请输入标题">{{$olcatalog->entry}}</div>
    <div><span class="zh">「满语标题」</span></div>
    <div id="entry_mnc" class="mnc" placeholder="请输入满语标题">{{$olcatalog->entry_mnc}}</div>
    <div><span class="zh">「转写」</span></div>
    <div id="entry_trans" class="en" placeholder="请输入转写">{{$olcatalog->entry_trans}}</div>
    @can('update', $olcatalog)
        @if($isShow)
            <a class="zh"  href="/olcatalogs/{{$olcatalog->id}}/edit">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true">编辑</span>
            </a>
            <a class="zh"  href="/olcatalogs/{{$olcatalog->id}}/delete">
                <span class="glyphicon glyphicon-remove" aria-hidden="true">删除</span>
            </a>
        @endif
    @endcan
    <hr/>
    <section class="column-list">
        <div class="bd">
            <ul class="list-col list-col5">
                @foreach($olcontents as $olcontent)
                    <li class="column-item zh">
                            <div>{!! $olcontent->content !!}</div>
                            <a class="zh"  href="/olcontents/{{$olcontent->id}}/edit?olcatalog_id={{$olcatalog->id}}">
                                编辑文章
                            </a>
                    </li>
                @endforeach

                {{$olcontents->links()}}
                @if( !$olcontents || sizeof($olcontents) == 0)
                    <div class="zh">还没有图书！</div>
                        <a class="zh"  href="/olcontents/create?olcatalog_id={{$olcatalog->id}}">
                            添加文章
                        </a>
                @endif
            </ul>
        </div>
    </section>

@endsection