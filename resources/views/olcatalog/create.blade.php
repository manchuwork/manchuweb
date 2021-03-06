@extends("layout.main")
@section("title")ᠮᠠᠨᠵᡠ manchu 图书创建页面@endsection
@section("content")
    @include("olcatalog.nav")
    <script src="/js/common_edit"></script>
    <div class="content-wrap">

        <div><span class="zh">「标题」</span>*</div>
        <div id="entry" tabindex="0"  contentEditable="true" class="input zh" placeholder="请输入标题"></div>
        <div><span class="zh">「满语标题」</span></div>
        <div id="entry_mnc" tabindex="0"  contentEditable="true" class="input mnc" placeholder="请输入满语标题"></div>
        <div><span class="zh">「转写」</span></div>
        <div id="entry_trans" tabindex="1" contentEditable="true" class="input zh" placeholder="请输入转写"></div>

        <form id="form" action="/olcatalogs" enctype="multipart/form-data" method="POST">
            {{csrf_field()}}
            <input name="ol_book_id" type="hidden" value="{{$olbook_id}}"/>

            <input id="entry_hidden" name="entry" type="hidden" value="">
            <input id="entry_mnc_hidden" name="entry_mnc" type="hidden" value="">
            <input id="entry_trans_hidden" name="entry_trans" type="hidden" value="">
        </form>
        @include('layout.error')
        <button id="btnCommit" class="box box1">提交数据</button>
    </div>

@endsection