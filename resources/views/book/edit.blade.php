@extends("layout.main")
@section("title")
    ᠮᠠᠨᠵᡠ manchu编辑页面
@endsection
@section("content")
    @include("book.nav")
    <script src="/js/common_edit"></script>
    <div class="content-wrap">

        <div><span class="zh">「标题」</span>*</div>
        <div id="title" tabindex="0"  contentEditable="true" class="input zh" placeholder="请输入标题">{{ $book->title }}</div>
        <div><span class="zh">「满语标题」</span></div>
        <div id="title_mnc" tabindex="0"  contentEditable="true" class="input mnc" placeholder="请输入满语标题">{{ $book->title_mnc }}</div>
        <div><span class="zh">「作者」</span></div>
        <div id="author" tabindex="1" contentEditable="true" class="input zh" placeholder="请输入作者">{{ $book->author }}</div>
        <div><span class="zh">「翻译人」</span></div>
        <div id="translator" tabindex="1" contentEditable="true" class="input zh" placeholder="请输入翻译人">{{ $book->translator }}</div>
        <div><span class="zh">「页数」</span></div>
        <div id="page_count" tabindex="2" contentEditable="true" class="input zh" placeholder="请输入页数">{{ $book->page_count }}</div>
        <div><span class="zh">「价格」</span></div>
        <div id="price" tabindex="2" contentEditable="true" class="input zh" placeholder="请输入价格">{{ $book->price }}</div>
        <div><span class="zh">「isbn」</span></div>
        <div id="isbn" tabindex="2" contentEditable="true" class="input zh" placeholder="请输入isbn">{{ $book->isbn }}</div>
        <div><span class="zh">「图书简介」</span></div>
        <div id="brief_intro" tabindex="2" contentEditable="true" class="input zh" placeholder="请输入图书简介">{{ $book->brief_intro }}</div>
        <div><span class="zh">「作者简介」</span></div>
        <div id="about_the_author" tabindex="2" contentEditable="true" class="input zh" placeholder="请输入作者简介">{{ $book->about_the_author }}</div>
        <div><span class="zh">「目录」</span></div>
        <div id="catalogue" tabindex="2" contentEditable="true" class="input zh" placeholder="请输入目录">{{ $book->catalogue }}</div>

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
            <div><span class="zh">选择图片</span></div>
            <input id="filed" name="pic" type="file" value="" title="选择图片">
            <div><span class="zh">选择文件</span><span class="en"> .pdf</span></div>
            <input name="file" type="file" value="" title="选择图片">
        </form>
        @include('layout.error')
        <button id="btnCommit" class="box box1">提交数据</button>
    </div>
@endsection