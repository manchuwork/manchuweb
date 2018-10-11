@extends("layout.main")
@section("title")
    创建页面
@endsection

@section("content")
    @include("post.nav")
    @foreach($posts as $post)
        <div class="content-wrap">
            <div class="mnc">{!! $post->manchu !!}</div>
            {{--<div class="mnc-trans-blod">{{$post->manchu }}</div>--}}
            <div class="en">{!! $post->trans !!}</div>
            <div class="zh">{!! $post->chinese!!}</div>
            @if(!empty($post->pic))
                <div>
                    <img src="{{ asset('/pic/'.$post->pic) }}" alt="图片">
                </div>
            @endif
            <div class="en">{{$post->created_at}} {{$post->user->name}}</div>
            <p class="blog-post-meta zh"><a href="/posts/{{$post->id}}">查看详情</a>
            @if(!empty($post->zans_count) || !empty($post->comments_count))
            <p class="blog-post-meta zh">赞 {{$post->zans_count}} | 评论 {{$post->comments_count}}</p>
            @endif

        </div>
    @endforeach

    {{$posts->links()}}
    @if( !$posts || sizeof($posts) == 0)
        <div class="zh">还没有文章！</div>
    @endif
@endsection