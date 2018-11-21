@extends("layout.main")
@section("title")ᠮᠠᠨᠵᡠ manchu 图书创建页面@endsection
@section("content")
    @include("olcontent.nav")
    <script src="/js/common_edit"></script>

    <style>


    </style>
    <div class="content-wrap" id="content">
        <h1>{{$olcatalog->entry}}</h1>
        <div><span class="zh">「内容」</span>*</div>

        <div id="drag_content">
            <div draggable="true">
                <div class="content-wrap">
                    <div><span class="zh">「满语」</span><span tabindex="0" contentEditable="true" class="input mnc" placeholder="请输入满语"></span></div>
                    <div><span class="zh">「转写」</span><span tabindex="0" contentEditable="true" class="input en" placeholder="请输入转写"></span></div>
                    <div><span class="zh">「解释」</span><span tabindex="1" contentEditable="true" class="input zh" placeholder="请输入中文"></span></div>
                </div>
            </div>
        </div>
        <button class="box box1 zh add" v="tpl01">添加</button>

        <div id="tpl01" draggable="true" class="column" style="display: none;">
            <div>
                <div><span class="zh">「满语」</span><span tabindex="0" contentEditable="true" class="input mnc" placeholder="请输入满语"></span></div>
                <div><span class="zh">「转写」</span><span tabindex="0" contentEditable="true" class="input en" placeholder="请输入转写"></span></div>
                <div><span class="zh">「解释」</span><span tabindex="1" contentEditable="true" class="input zh" placeholder="请输入中文"></span></div>
            </div>
        </div>

        {{--<div id="content" tabindex="0"  contentEditable="true" class="input zh" placeholder="请输入内容"></div>--}}
        <form id="form" action="/olcontents" enctype="multipart/form-data" method="POST">
            {{csrf_field()}}
            <input name="ol_book_id" type="hidden" value="{{$olcatalog->ol_book_id}}">
            <input name="ol_catalog_id" type="hidden" value="{{$olcatalog_id}}">
            <input id="content_hidden" name="content" type="hidden" value="">
        </form>
        @include('layout.error')
        <button id="btnCommit" class="box box1">提交数据</button>
    </div>
    <script>

    </script>
@endsection