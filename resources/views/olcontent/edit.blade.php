@extends("layout.main")
@section("title")
    ᠮᠠᠨᠵᡠ manchu编辑页面
@endsection
@section("content")
    @include("olcontent.nav")
    <script src="/js/common_edit"></script>
    <div class="content-wrap">

        <div><span class="zh">「内容」</span>*</div>
        <div id="content" tabindex="0"  contentEditable="true" class="input zh" placeholder="请输入内容"></div>

        <form id="form" action="/books/{{$book->id}}" enctype="multipart/form-data" method="POST">
            {{csrf_field()}}
            {{method_field("PUT")}}
            <input id="title_hidden" name="title" type="hidden" value="">
            <input id="title_mnc_hidden" name="title_mnc" type="hidden" value="">
            <input id="author_hidden" name="author" type="hidden" value="">
            <input id="translator_hidden" name="translator" type="hidden" value="">
            <input id="page_count_hidden" name="page_count" type="hidden" value="">
            <input id="price_hidden" name="price" type="hidden" value="">
            <input id="isbn_hidden" name="isbn" type="hidden" value="">

            <input id="brief_intro_hidden" name="brief_intro" type="hidden" value="">
            <input id="about_the_author_hidden" name="about_the_author" type="hidden" value="">
            <input id="catalogue_hidden" name="catalogue" type="hidden" value="">
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