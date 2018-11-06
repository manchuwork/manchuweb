@extends("layout.main")
@section("title")ᠮᠠᠨᠵᡠ manchu 图书创建页面@endsection
@section("content")
    @include("olbook.nav")
    <script src="/js/common_edit"></script>
    <div class="content-wrap">

        <div><span class="zh">「标题」</span>*</div>
        <div id="title" tabindex="0"  contentEditable="true" class="input zh" placeholder="请输入标题"></div>
        <div><span class="zh">「满语标题」</span></div>
        <div id="title_mnc" tabindex="0"  contentEditable="true" class="input mnc" placeholder="请输入满语标题"></div>
        <div><span class="zh">「转写」</span></div>
        <div id="title_trans" tabindex="1" contentEditable="true" class="input zh" placeholder="请输入翻译人"></div>
        <div><span class="zh">「子标题」</span></div>
        <div id="subtitle" tabindex="2" contentEditable="true" class="input zh" placeholder="请输入子标题"></div>

        <div><span class="zh">「作者」</span></div>
        <div id="author" tabindex="1" contentEditable="true" class="input zh" placeholder="请输入作者"></div>
        <div><span class="zh">「图书简介」</span></div>
        <div id="brief_intro" tabindex="2" contentEditable="true" class="input zh" placeholder="请输入图书简介"></div>

        <form id="form" action="/olbooks" enctype="multipart/form-data" method="POST">
            {{csrf_field()}}
            <input id="title_hidden" name="title" type="hidden" value="">
            <input id="title_mnc_hidden" name="title_mnc" type="hidden" value="">
            <input id="title_trans_hidden" name="title_trans" type="hidden" value="">
            <input id="author_hidden" name="author" type="hidden" value="">
            <input id="subtitle_hidden" name="subtitle" type="hidden" value="">

            <input id="brief_intro_hidden" name="brief_intro" type="hidden" value="">
            <span id="imgshowWrap" style="display: none;">
                <p class="zh">预览图片</p>
                <img id="imgshow" width="135" height="206">
            </span>
            <input id="filed" name="pic" type="file" value="">
        </form>
        @include('layout.error')
        <button id="btnCommit" class="box box1">提交数据</button>
    </div>

@endsection