@extends("layout.main")
@section("title"){{$title_prefix}}, ᠮᠠᠨᠵᡠ, manchu, manju,search满语字典-搜索@endsection
@section("keywords"){{$title_prefix}}, ᠮᠠᠨᠵᡠ, manchu, manju,search满语字典-搜索@endsection
@section("description"){{$description}}, ᠮᠠᠨᠵᡠ, manchu, manju,search满语字典-搜索@endsection
@section("content")
    @include("dict.nav")
    <script src="/js/dict"></script>
    @include("dict.search_head")
    @include("ad.ad_header_js_css")
    <div id="adContainer1" class="ad-container"></div>
    <script>
        // 调用 loadAd 函数并传入广告位容器的ID和广告数据的URL
        loadAd('adContainer1', '{{config('app.ad_url')}}/api/ad?adzone_id={{config('app.adzone_id')}}');
    </script>
    @if(isset($dicts) && (sizeof($dicts) > 0))

    @foreach($dicts as $dict)

        <div class="content-wrap">
            <div><span class="zh">「满语」</span><span class="mnc">{{ $dict->manchu }}</span></div>
            {{--<div class="mnc-trans-blod">{{$dict->manchu }}</div>--}}
            <div><span class="zh">「转写」</span><span class="en">{{ $dict->trans }}</span></div>
            @if(!empty($dict->trans_zh))
            <div><span class="zh">「注音」</span><span class="zh">{{$dict->trans_zh }}</span></div>
            @endif
            <div><span class="zh">「解释」</span><span class="zh">{{ $dict->chinese}}</span></div>
            @if(!empty($dict->word_types))
                <div><span class="zh">「词性」</span><span class="zh">（{{$dict->word_types }}）</span></div>
            @endif
            @if(!empty($dict->pic))
                <div>
                    <img src="{{ asset('/pic/'.$dict->pic) }}" alt="图片">
                </div>
            @endif
            <p class="blog-post-meta en"><a href="/dicts/{{$dict->id}}">{{$dict->created_at}}</a>
                @if(!empty($dict->user))
                <a href="/user/{{$dict->user->id}}" class="en">{{$dict->user->name}}</a>
                @endif
            </p>
        </div>
    @endforeach
    {{$dicts->appends('word',$word)->links()}}
    <div id="adContainer2" class="ad-container"></div>
    <script>
        // 调用 loadAd 函数并传入广告位容器的ID和广告数据的URL
        loadAd('adContainer2', '{{config('app.ad_url')}}/api/ad?adzone_id={{config('app.adzone_id')}}');
    </script>
    @elseif(empty($word))
        <div class="mnc"></div>

    @elseif(isset($word))
        <div class="mnc"><span class="zh" >没有查找到</span> "{{ $word}}"</div>

    @endif
@endsection
