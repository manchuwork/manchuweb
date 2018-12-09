@extends("layout.main")
@section("title")满族空间首页
@endsection
@section("content")

    <script src="/js/dict"></script>
    <h1 class="zh">满族字典搜索</h1>

    <div id="word" tabindex="0" contentEditable="true" class="input mnc"
         placeholder="请输入满语、汉语或转写">{{ $word or '' }}</div>
    <div class="box"> </div>
    <button id="btnCommit" class="box box1">搜索</button>
    <form id="form" action="/dicts/search" method="GET">
        {{csrf_field()}}
        <input id="word_hidden" name="word" type="hidden" value="">
    </form>
    <br/>
    <h1 class="zh">满语字典</h1>
    <hr/>
    <div class="zh">
        @foreach($dicts as $dict)
            <div class="content-wrap">
                <span class="mnc">{{ $dict->manchu }}</span>
                <span class="en">[{{ $dict->trans }}</span> <span class="zh">{{ $dict->trans_zh }}</span><span class="en">]</span>
                <span class="zh">{{ $dict->chinese }}</span>
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