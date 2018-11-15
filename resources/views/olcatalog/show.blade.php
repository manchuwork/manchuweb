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
    <div><span class="zh">「文章添加」</span></div>
    <a class="zh"  href="/olcontents/create?olcatalog_id={{$olcatalog->id}}">
        编辑文章
    </a>
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
@endsection