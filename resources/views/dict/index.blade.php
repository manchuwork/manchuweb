@extends("layout.main")
@section("title"){{$title_prefix}}, ᠮᠠᠨᠵᡠ, manchu, manju,满语字典-列表@endsection
@section("keywords"){{$title_prefix}}, ᠮᠠᠨᠵᡠ, manchu, manju,满语字典-列表@endsection
@section("description"){{$description}}, ᠮᠠᠨᠵᡠ, manchu, manju,满语字典-列表@endsection
@section("content")
    @include("dict.nav")
    <script src="/js/dict"></script>
    @include("dict.search_head")

    @if(isset($dicts) && (sizeof($dicts) > 0))

        @foreach($dicts as $dict)
            <div class="content-wrap">
                <div><span class="zh">「满语」</span><span class="mnc">{!! $dict->manchu !!}</span></div>
                {{--<div class="mnc-trans-blod">{{$dict->manchu }}</div>--}}
                <div><span class="zh">「转写」</span> <span class="en">{!! $dict->trans !!}</span></div>
                @if(!empty($dict->trans_zh))
                    <div><span class="zh">「注音」</span><span class="zh">{{$dict->trans_zh }}</span></div>
                @endif
                @if(!empty($dict->word_types))
                    <div><span class="zh">「词性」</span><span class="zh">（{{$dict->word_types }}）</span></div>
                @endif
                <div><span class="zh">「解释」</span><span class="zh">{!! $dict->chinese!!}</span></div>
                @if(!empty($dict->pic))
                <div>
                    <img src="{{ asset('/pic/'.$dict->pic) }}" alt="图片,manchu.work,www.manchu.work,满族空间，满语学习，{{$dict->manchu}} ，{{$dict->trans_zh }}">
                </div>
                @endif
                @if(!empty($dict->user))
                <div class="en">{{$dict->created_at}} {{$dict->user->name}}</div>
                @endif
                <p class="blog-post-meta zh"><a href="/dicts/{{$dict->id}}">查看详情</a>
                    {{--<a href="/user/{{$dict->user->id}}" class="zh"></a></p>--}}
            </div>
        @endforeach

        {{$dicts->links()}}
    @else
        <div class="mnc"><span class="zh" >没有查找到</span></div>

    @endif
@endsection
