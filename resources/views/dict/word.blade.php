var dict=document.getElementById('icIBahyI-main_cont');
try{
    var loading=document.getElementById('loading');
    loading.style.display = "none";
    dict.innerHTML='<div id=\"icIBahyI-dict_main\">'
    +' <script src="/js/dragword"></script>'
    @if(isset($dicts) && (sizeof($dicts) > 0))

        @foreach($dicts as $dict)
            +' <div class="content-wrap container-dict">'
                +'   <div><span class="zh">「满语」</span><span class="mnc">{!! $dict->manchu !!}</span></div>'
                +'  <div><span class="zh">「转写」</span> <span class="en">{!! $dict->trans !!}</span></div>'
                +'  <div><span class="zh">「解释」</span><span class="zh">{!! $dict->chinese!!}</span></div>'
                @if(!empty($dict->word_types))
                    +' <div><span class="zh">「词性」</span><span class="zh">（{{$dict->word_types }}）</span></div>'
                @endif
                @if(!empty($dict->pic))
                    +'   <div> <img src="{!! asset('/pic/'.$dict->pic) !!}" alt="图片"></div>'
                @endif
                {{--+'   <p class="blog-post-meta en"><a href="/dicts/{{$dict->id}}">{{$dict->created_at}}</a> <a href="/user/{{$dict->user->id}}" class="zh">{{$dict->user->name}}</a></p>'--}}
            +'  </div>'
        @endforeach

{{--       +'{{$dicts->links()}}'--}}
    @else
        +'<div class="mnc"><span class="zh" >没有查找到</span></div>'
    @endif
    {{--<div class=\"icIBahyI-suggest2\">第二章</div>--}}
    +'</div>';
    dict.style.display = "block";
}catch (e){
    alert("暂无找到 id为dict的DIV");
}

{{--function scb_scroll(){--}}
    {{--window.location.href = "http://my.iciba.com/?returnurl=" + window.location.href;--}}
{{--}--}}

{{--document.getElementById('icIBahyI-scbbtn').style.display = "block";--}}
{{--document.getElementById('icIBahyI-morebtn').style.width = "50%";--}}
{{--document.getElementById('more_info').href = "http://www.iciba.com/%E1%A1%9D%E1%A1%B5%E1%A1%9D%E1%A1%B5%E1%A1%9D%E1%A0%A9%E1%A1%A4%E1%A1%9D";--}}

