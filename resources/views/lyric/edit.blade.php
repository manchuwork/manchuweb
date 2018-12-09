@extends("layout.main")
@section("title")
    ᠮᠠᠨᠵᡠ manchu编辑页面
@endsection
@section("content")
    @include("lyric.nav")
    <script src="/js/common_edit"></script>
    <div class="content-wrap">

        <div><span class="zh">「标题」</span>*</div>
        <div id="title" tabindex="0"  contentEditable="true" class="input zh" placeholder="请输入标题">{{$lyric->title}}</div>
        <div><span class="zh">「作者」</span></div>
        <div id="author" tabindex="1" contentEditable="true" class="input zh" placeholder="请输入作者">{{$lyric->author}}</div>


        <form id="form" action="/lyrics/{{$lyric->id}}" enctype="multipart/form-data" method="POST">
            {{csrf_field()}}
            {{method_field("PUT")}}
            <input id="title_hidden" name="title" type="hidden" value="">
            <input id="author_hidden" name="author" type="hidden" value="">
            <p class="zh">上传歌词转写、中文歌词</p>
            <input name="file" type="file" value="">
            @if(isset($lyric->file))
            <a class="zh" href="{{ asset('/text/'. $lyric->file) }}" target="_blank">歌词下载</a>@endif
            <p class="zh">上传歌词满文歌词</p>
            <input name="file_mnc" type="file"  value="">
            @if(isset($lyric->file))
                <a class="zh" href="{{ asset('/text/'. $lyric->file_mnc) }}" target="_blank">歌词下载</a>@endif

        </form>
        @include('layout.error')
        <button id="btnCommit" class="box box1">提交数据</button>
    </div>
@endsection