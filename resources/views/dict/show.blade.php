@extends("layout.main")
@section("title"){{$title_prefix}}, ᠮᠠᠨᠵᡠ, manchu, manju,满语字典-查看@endsection
@section("keywords"){{$title_prefix}}, ᠮᠠᠨᠵᡠ, manchu, manju,满语字典-查看@endsection
@section("description"){{$description}}, ᠮᠠᠨᠵᡠ, manchu, manju,满语字典-查看@endsection
@section("content")
    @include("dict.nav")
    <script src="/js/edit"></script>

    <div class="content-wrap">
        <div><span class="zh">「满语」</span><span class="mnc">{{ $dict->manchu }}</span></div>
        {{--<div class="mnc-trans-blod">{{$dict->manchu }}</div>--}}
        <div><span class="zh">「转写」</span><span class="en">{{ $dict->trans }}</span></div>
        <div><span class="zh">「注音」</span><span class="zh">{{$dict->trans_zh }}</span></div>
        <div><span class="zh">「解释」</span><span class="zh">{{ $dict->chinese}}</span></div>
        @if(!empty($dict->word_types))
            <div><span class="zh">「词性」</span><span class="zh">（{{$dict->word_types }}）</span></div>
        @endif
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
    @include("ad.ad_container_once")
@endsection