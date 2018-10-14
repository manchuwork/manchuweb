@extends("layout.main")
@section("title")ᠮᠠᠨᠵᡠ manchu 歌词上传创建页面，满族空间@endsection
@section("content")
    @include("lyric.nav")
    <script src="/js/common_edit"></script>
    <div class="content-wrap">

        <div><span class="zh">「标题」</span>*</div>
        <div id="title" tabindex="0"  contentEditable="true" class="input zh" placeholder="请输入标题"></div>
        <div><span class="zh">「作者」</span></div>
        <div id="author" tabindex="1" contentEditable="true" class="input zh" placeholder="请输入作者"></div>


        <form id="form" action="/lyrics" enctype="multipart/form-data" method="POST">
            {{csrf_field()}}
            <input id="title_hidden" name="title" type="hidden" value="">
            <input id="author_hidden" name="author" type="hidden" value="">
            <p class="zh">上传图片</p>
            <input name="file" type="file" value="">
        </form>
        @include('layout.error')
        <button id="btnCommit" class="box box1">提交数据</button>
    </div>

@endsection