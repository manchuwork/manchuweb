@extends("layout.main")
@section("title")
    ᠮᠠᠨᠵᡠ manchu编辑页面
@endsection
@section("content")
    @include("olcontent.nav")
    <link rel="stylesheet" href="/css/drag">
    <style>
        #drag_content *{
            line-height: 50px;
        }
    </style>
    <div class="content-wrap">

        <div><span class="zh">「内容」</span>*</div>
        <div id="drag_content">{!! $olcontent->content !!}</div>
        <div id="tpl01" draggable="true" style="display:none;">
            <div class="content-wrap">
                <div><span class="zh">「满语」</span><span tabindex="0" contentEditable="true" class="input mnc" placeholder="请输入满语"></span></div>
                <div><span class="zh">「转写」</span><span tabindex="0" contentEditable="true" class="input en" placeholder="请输入转写"></span></div>
                <div><span class="zh">「解释」</span><span tabindex="1" contentEditable="true" class="input zh" placeholder="请输入中文"></span></div>
            </div>
        </div>
        <form id="form" action="/olcontents/{{$olcontent->id}}" enctype="multipart/form-data" method="POST">
            {{csrf_field()}}
            {{method_field("PUT")}}
            <input name="ol_book_id" type="hidden" value="{{$olcontent->ol_book_id}}">
            <input name="ol_catalog_id" type="hidden" value="{{$olcontent->ol_catalog_id}}">
            <input id="content_hidden" name="content" type="hidden" value="">
        </form>
        @include('layout.error')
        <button class="box box2 zh add" v="tpl01">添加</button>
        <button id="btnCommit" class="box box3 zh">提交数据</button>
    </div>
    <script src="/js/drag"></script>
    <script>
        $(function () {
            $("[tabindex]").each(function () {
                var id = $(this).attr('id');
                if(id){
                    $("#" + id + "_hidden").val(getText($(this)));
                }
                $(this).attr("contentEditable",'true');
                $(this).addClass("input");
            });
        });
    </script>
    <script src="/js/common_edit"></script>

@endsection