@extends("layout.main")
@section("title")ᠮᠠᠨᠵᡠ manchu满语字典@endsection

@section("content")
    @include("dict.nav")
    <script src="/js/dict"></script>
    <div ><span class="mnc">ᠮᠠᠨᠵᡠ  →</span><span class="en">transcription</span> <span class="zh">汉语</span></div>
    <hr/>
    <div id="word" tabindex="0" contentEditable="true" class="input mnc"
         placeholder="请输入满语、汉语或转写">{{ $word or '' }}</div>
    <div class="box"> </div>
    <button id="btnCommit" class="box box1">提交数据</button>
    <form id="form" action="/dicts" method="POST">
        {{csrf_field()}}
        <input id="word_hidden" name="word" type="hidden" value="">
    </form>

    @if(isset($dicts) && (sizeof($dicts) > 0))

    @foreach($dicts as $dict)

        <div class="content-wrap">
            <div class="mnc">{!! $dict->manchu !!}</div>
            {{--<div class="mnc-trans-blod">{{$dict->manchu }}</div>--}}
            <div class="en">{!! $dict->trans !!}</div>
            <div class="zh">{!! $dict->chinese!!}</div>
            @if(!empty($dict->pic))
                <div>
                    <img src="{{ asset('/pic/'.$dict->pic) }}" alt="图片">
                </div>
            @endif
            <p class="blog-post-meta en"><a href="/dicts/{{$dict->id}}">{{$dict->created_at}}</a> <a href="/user/{{$dict->user->id}}" class="zh">{{$dict->user->name}}</a></p>
        </div>
    @endforeach
    @elseif(isset($word))
        <div class="mnc"><span class="zh" >没有查找到</span> "{{ $word}}"</div>

    @endif
@endsection
