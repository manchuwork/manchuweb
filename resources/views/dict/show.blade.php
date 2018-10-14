@extends("layout.main")
@section("title")ᠮᠠᠨᠵᡠ manchu查看页面@endsection
@section("content")
    @include("dict.nav")
    <script src="/js/edit"></script>

    <div class="content-wrap">
        <div><span class="zh">「满语」</span><span class="mnc">{!! $dict->manchu !!}</span></div>
        {{--<div class="mnc-trans-blod">{{$dict->manchu }}</div>--}}
        <div><span class="zh">「转写」</span> <span class="en">{!! $dict->trans !!}</span></div>
        <div><span class="zh">「解释」</span><span class="zh">{!! $dict->chinese!!}</span></div>
        {{--<span class="mnc">ᠮᠠᠨᠵᡠ →</span>--}}
        {{--<div class="mnc">{{ $dict->manchu }}</div>--}}
        {{--<div class="en">transcription ↑</div>--}}
        {{--<div class="en">{{$dict->trans }}</div>--}}
        {{--<div class="zh">中文 ↑</div>--}}
        {{--<div class="zh">{{ $dict->chinese }}</div>div--}}

        @if(!empty($dict->pic))
            <div>
                <img src="{!! asset('/pic/'.$dict->pic) !!}" alt="图片">
            </div>
        @endif
        <p class="en">{{$dict->created_at}} by <a href="#">{{$dict->user->name}}</a></p>
        @can('update', $dict)
            @if($isShow)
                <a class="zh"  href="/dicts/{{$dict->id}}/edit">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true">编辑</span>
                </a>
                <a class="zh"  href="/dicts/{{$dict->id}}/delete">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true">删除</span>
                </a>
            @endif
        @endcan
    </div>
@endsection