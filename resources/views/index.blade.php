@extends("layout.main")
@section("title")满族空间首页
@endsection
@section("content")
    <div class="content-wrap">
        <div class="mnc">ᠮᠠᠨᠵᡠ →</div>
        <div class="zh">满族空间，是学习满族语言交流空间</div>
    </div>
    <div class="zh">
        @foreach($dicts as $dict)
            <div class="content-wrap">
                <span class="mnc">{!! $dict->manchu !!}</span>
                <span class="en">{!! $dict->trans !!}</span>
                <span class="zh">{!! $dict->chinese!!}</span>
                @if(!empty($dict->pic))
                    <div>
                        <img src="{{ asset('/pic/'.$dict->pic) }}" alt="图片">
                    </div>
                @endif
                <p class="en"><a href="/dicts/{{$dict->id}}">{{$dict->created_at}}</a> <a href="/user/{{$dict->user->id}}" class="en">{{$dict->user->name}}</a></p>
            </div>
        @endforeach
        <a href="/dicts">查看更多：字典</a>
    </div>
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
        <a href="/posts">查看更多：满语常用语句</a>
    </div>
@endsection