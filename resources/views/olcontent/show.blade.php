@extends("layout.main")
@section("title")ᠮᠠᠨᠵᡠ manchu图书查看@endsection
@section("content")
    <link rel="stylesheet" href="/css/bookinfo">
    @include("olcontent.nav")
    <div><span class="zh">「内容」</span>*</div>
    <div id="content" tabindex="0"  contentEditable="true" class="input zh" placeholder="请输入内容">{{$olcontent->content}}</div>

    @can('update', $olcontent)
        @if($isShow)
            <a class="zh"  href="/olcontents/{{$olcontent->id}}/edit">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true">编辑</span>
            </a>
            {{--<a class="zh"  href="/olcontents/{{$olcontent->id}}/delete">--}}
                {{--<span class="glyphicon glyphicon-remove" aria-hidden="true">删除</span>--}}
            {{--</a>--}}
        @endif
    @endcan
@endsection