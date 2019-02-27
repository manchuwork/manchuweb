@extends("layout.main")
@section("title")满族空间首页
@endsection
@section("content")
    <a href="http://i.manchu.work/article/list_2_1.html" class="zh">满族历史<img src="/assets/nav/manchu_history.jpg" alt="满族历史 manchu history, manju"/></a>
    <hr>
    <a href="http://i.manchu.work/article/list_5_4.html" class="zh">满族艺术<img src="/assets/nav/manchu_culture.jpg" alt="满族艺术 manchu culture, manju"/></a>
    <hr>
    <a href="http://i.manchu.work/article/list_7_5.html" class="zh">满族神话<img src="/assets/nav/manchu_myth.jpg" alt="满族神话 manchu myth, manju"/></a>
    <hr>
    <a href="http://i.manchu.work/article/list_4_3.html" class="zh">满语教程<img src="/assets/nav/manchu_language.jpg" alt="满语教程 manchu language, manju gisun"/></a>
    <hr>
    <script src="/js/dict"></script>
    <h1 class="zh">满族字典搜索</h1>
    @include("dict.search_head")

    <br/>
    <h1 class="zh">满语字典</h1>
    <hr/>
    <div class="zh">
        @foreach($dicts as $dict)
            <div class="content-wrap">
                <span class="mnc">{{ $dict->manchu }}</span>
                <span class="en">[{{ $dict->trans }}</span> <span class="zh">{{ $dict->trans_zh }}</span><span class="en">]</span>
                <span class="zh">{{ $dict->chinese }}</span>
                @if(!empty($dict->word_types))（<span class="zh">{{ $dict->word_types }}</span>）@endif
                @if(!empty($dict->pic))
                    <div>
                        <img src="{{ asset('/pic/'.$dict->pic) }}" alt="图片">
                    </div>
                @endif
                <p class="en"><a href="/dicts/{{$dict->id}}">{{$dict->created_at}}</a>
                    @if(!empty($dict->user))
                        <span class="en">{{$dict->user->name}}</span>
                    @endif
                </p>
            </div>
        @endforeach
        <a href="/dicts">查看更多：字典</a>
    </div>

    <br/>
    @if(!empty($post))
        <h1 class="zh">常用满语对话</h1>
        <hr/>

        <div class="zh">
            @foreach($posts as $post)
                <div class="content-wrap">
                    <div class="mnc">{!! $post->manchu !!}</div>
                    <div class="en">{!! $post->trans !!}</div>
                    <div class="zh">{!! $post->chinese!!}</div>
                    @if(!empty($post->pic))
                        <div>
                            <img src="{{ asset('/pic/'.$post->pic) }}" alt="图片">
                        </div>
                    @endif
                    <p class="blog-post-meta en"><a href="/posts/{{$post->id}}">{{$post->created_at}}</a> <a href="/user/{{$post->user->id}}" class="zh">{{$post->user->name}}</a></p>

                    <p class="blog-post-meta zh">赞 {{$post->zans_count}}  | 评论 {{$post->comments_count}}</p>
                </div>
            @endforeach

        </div>
        <a href="/posts">查看更多：满语常用语句</a>
    @endif


@endsection