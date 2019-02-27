@extends("layout.main")
@section("title")
    ᠮᠠᠨᠵᡠ manchu编辑页面
@endsection
@section("content")
    @include("dict.nav")
    <script src="/js/common_edit"></script>

    <div class="content-wrap">
        <div><span class="zh">「满语」</span><span class="mnc">ᠮᠠᠨᠵᡠ →</span></div>
        <div id="manchu" tabindex="0" contentEditable="true" class="input mnc"
             placeholder="请输入满语">{{ $dict->manchu }}</div>
        <div><span class="zh">「转写」</span><span class="en">transcription ↑</span></div>
        <div id="trans" tabindex="0" contentEditable="true" class="input en" placeholder="请输入转写">{{$dict->trans }}</div>
        <div><span class="zh">「注音」</span><span class="en">中文 ↑</span></div>
        <div id="trans_zh" tabindex="1" contentEditable="true" class="input zh" placeholder="请输入转写">{{$dict->trans_zh }}</div>
        <div><span class="zh">「解释」</span><span class="zh">中文 ↑</span></div>
        <div id="chinese" tabindex="1" contentEditable="true" class="input zh"
             placeholder="请输入中文">{{ $dict->chinese }}</div>

        @if(!empty($dict->pic))
            <div>
                <img src="{{ asset('/pic/'.$dict->pic) }}" alt="图片">
            </div>
        @endif


        {{--<style>--}}
            {{--#filed {--}}
                {{--width:150px;--}}
                {{--height:20px;--}}
                {{--/*background-color:red;*/--}}
                {{--margin:70px -88px;--}}
                {{--transform:rotate(90deg);--}}
                {{---ms-transform:rotate(90deg); /* Firefox */--}}
                {{---moz-transform:rotate(90deg); /* Firefox */--}}
                {{---webkit-transform:rotate(90deg); /* Safari and Chrome */--}}
                {{---o-transform:rotate(90deg); /* Safari and Chrome */--}}
            {{--}--}}

        {{--</style>--}}

        <form id="form" action="/dicts/{{$dict->id}}" enctype="multipart/form-data" method="POST">
            {{csrf_field()}}
            {{method_field("PUT")}}
            @foreach($wordTypes as $wordType)
                <span style="border: lightblue dashed 1px"><input type="checkbox" name="word_type[]" value="{!! $wordType->title !!}" @if(in_array($wordType->title,$dictWordTypes)) checked @endif/><span class="zh" title="({!! $wordType->desc !!})">{!! $wordType->title !!}</span></span>
            @endforeach
            <input id="manchu_hidden" name="manchu" type="hidden" value="">
            <input id="trans_hidden" name="trans" type="hidden" value="">
            <input id="chinese_hidden" name="chinese" type="hidden" value="">
            <input id="trans_zh_hidden" name="trans_zh" type="hidden" value="">
            <div>
            <span id="imgshowWrap" style="display: none;">
                <p class="zh">预览图片</p>
                <img id="imgshow" width="200" height="200">
            </span>
                <input id="filed" name="pic" type="file" value="">
            </div>
        </form>
        @include('layout.error')
        <div class="box"> </div>
        <button id="btnCommit" class="box box1">提交数据</button>
    </div>

    <script>
        //在input file内容改变的时候触发事件
        $('#filed').change(function(){
            //获取input file的files文件数组;
            //$('#filed')获取的是jQuery对象，.get(0)转为原生对象;
            //这边默认只能选一个，但是存放形式仍然是数组，所以取第一个元素使用[0];
            var file = $('#filed').get(0).files[0];
            //创建用来读取此文件的对象
            var reader = new FileReader();
            //使用该对象读取file文件
            reader.readAsDataURL(file);
            //读取文件成功后执行的方法函数
            reader.onload=function(e){
                //读取成功后返回的一个参数e，整个的一个进度事件
                console.log(e);
                //选择所要显示图片的img，要赋值给img的src就是e中target下result里面
                //的base64编码格式的地址
                $('#imgshowWrap').attr("style","display:block");
                $('#imgshow').get(0).src = e.target.result;
            }
        })
    </script>
@endsection