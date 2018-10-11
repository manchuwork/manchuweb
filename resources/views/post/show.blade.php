@extends("layout.main")
@section("title")查看页面@endsection
@section("content")
    @include("post.nav")
    <script src="/js/edit.js"></script>

    <div class="content-wrap">
        <div><span class="zh">「满语」</span><span class="mnc">ᠮᠠᠨᠵᡠ →</span></div>
        <div class="mnc">{{ $post->manchu }}</div>
        <div><span class="zh">「转写」</span><span class="en">transcription ↑</span></div>
        {{-- <div class="mnc-trans-blod">{{$post->manchu }}</div --}}
        {{--<div class="en">transcription ↑</div>--}}
        <div><span class="en">{{$post->trans }}</span></div>
        <div><span class="zh">「解释」</span><span class="zh">中文 ↑</span></div>
        <div class="zh">{{ $post->chinese }}</div>
        @if(!empty($post->pic))
            <div>
                <img src="{{ asset('/pic/'.$post->pic) }}" alt="图片">
            </div>
        @endif
        <p class="en">{{$post->created_at}} by <a href="#">{{$post->user->name}}</a></p>
        @can('update', $post)
            @if($isShow)
                <a style="margin: auto"  href="/posts/{{$post->id}}/edit">
                    <span class="zh" aria-hidden="true">编辑</span>
                </a>
                <a style="margin: auto"  href="/posts/{{$post->id}}/delete">
                    <span class="zh" aria-hidden="true">删除</span>
                </a>
            @endif
        @endcan
        <div>
            @if($post->zan(\Auth::id())->exists())
                <a href="/posts/{{$post->id}}/unzan" type="button" class="btn btn-primary btn-lg">取消赞</a>
            @else
                <a href="/posts/{{$post->id}}/zan" type="button" class="btn btn-primary btn-lg">赞</a>


            @endif
        </div>

        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">评论</div>

            <!-- List group -->
            <ul class="list-group">
                @foreach($post->comments as $comment)
                    <li class="zh">
                        <span class="en">{{$comment->created_at}} by {{$comment->user->name}}</span>
                        <div class="en">
                            {{$comment->content}}
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="zh">发表评论</div>

            <!-- List group -->
            <ul class="list-group">
                <div id="content" tabindex="1" contentEditable="true" class="input zh"
                     placeholder="请输入评论"></div>
                <button id="btnCommitComment" class="zh box box1" type="submit">提交</button>

                <form id="formComment" action="/posts/{{$post->id}}/comment" method="POST">
                    {{csrf_field()}}
                    <li class="list-group-item">
                        <input id="content_hidden" name="content" type="hidden">
                        {{--<textarea id="content_hidden" name="content" class="input mnc" rows="10"></textarea>--}}
                        @include('layout.error')

                    </li>
                </form>

            </ul>
        </div>
    </div>

    <script type="application/javascript">
        $(function () {
            function getText($Node){
                $Node.children("style").remove();

                description = $Node.html();
                console.log("$Node.description remove style:"+ description);
                description = description.replace(/(\n)/g, "");
                description = description.replace(/(\t)/g, "");
                description = description.replace(/(\r)/g, "");
                description = description.replace(/<\/?[^>]*>/g, "");
                //description = description.replace(/\s*/g, "");

                return description.trim();
            }

            $("div[contentEditable]").each(function () {

                $(this).blur(function () {
                    var text = getText($(this));
                    $(this).html(text);
                });
            });
            $("#btnCommitComment").click(function () {

                $("#content_hidden").val(getText($("#content")));
                $("#formComment").submit();
            });
        });
    </script>
@endsection