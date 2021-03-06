@extends("layout.main")
@section("title")
    ᠮᠠᠨᠵᡠ manchu创建页面
@endsection

@section("content")
    @include("dict.nav")
    <script src="/js/common_edit"></script>
    <div class="content-wrap">

        <div class="box" tabindex="1" contentEditable="true" ></div>
        <div><span class="zh">「满语」</span><span class="mnc">ᠮᠠᠨᠵᡠ →</span></div>
        <div id="manchu" tabindex="0"  contentEditable="true" class="input mnc" placeholder="请输入满语"></div>
        <div><span class="zh">「转写」</span><span class="en">transcription ↑</span></div>
        <div id="trans" tabindex="1" contentEditable="true" class="input en" placeholder="请输入转写"></div>
        <div><span class="zh">「注音」</span><span class="en">中文 ↑</span></div>
        <div id="trans_zh" tabindex="1" contentEditable="true" class="input zh" placeholder="请输入转写"></div>
        <div><span class="zh">「解释」</span><span class="zh">中文 ↑</span></div>
        <div id="chinese" tabindex="2" contentEditable="true" class="input zh" placeholder="请输入中文"></div>

        <form id="form" action="/dicts/create" enctype="multipart/form-data" method="POST">
            {{csrf_field()}}
            @foreach($wordTypes as $wordType)
                <span style="border: lightblue dashed 1px"><input type="checkbox" name="word_type[]" value="{!! $wordType->title !!}"/><span class="zh" title="({!! $wordType->desc !!})">{!! $wordType->title !!}</span></span>
            @endforeach
            <input id="manchu_hidden" name="manchu" type="hidden" value="">
            <input id="trans_hidden" name="trans" type="hidden" value="">
            <input id="chinese_hidden" name="chinese" type="hidden" value="">
            <input id="trans_zh_hidden" name="trans_zh" type="hidden" value="">
            <input name="pic" type="file" value="">
        </form>
        @include('layout.error')
        <button id="btnCommit" class="box box1">提交数据</button>
    </div>

@endsection