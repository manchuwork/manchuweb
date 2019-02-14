<!DOCTYPE html>
<html lang="mnc"><!-- Manchu 满语 -->
<head>
    <meta charset="utf-8"/>
    <meta name="description" content="Manchu,满语,ᠮᠠᠨᠵᡠ,ᡤᡳᠰᡠᠨ,满族空间,www.manchu.work 满族空间是个学习满语的空间">
    <meta name="keywords" content="Manchu,满语,ᠮᠠᠨᠵᡠ,ᡤᡳᠰᡠᠨ,满族空间,www.manchu.work">
    <meta name="baidu-site-verification" content="21DYokPZhR" />

    <title>满族空间 Manchu 满语 ᠮᠠᠨᠵᡠ ᡤᡳᠰᡠᠨ</title>
    <style> .spinner {
            margin: 10px auto;
            width: 60px;
            height: 60px;
            text-align: center;
            font-size: 10px;
            float: left;
        }

        .spinner > div {
            background-color: #67CF22;
            height: 100%;
            width: 6px;
            display: inline-block;
            -webkit-animation: stretchdelay 1.2s infinite ease-in-out;
            animation: stretchdelay 1.2s infinite ease-in-out;
        }

        .spinner .rect2 {
            -webkit-animation-delay: -1.1s;
            animation-delay: -1.1s;
        }

        .spinner .rect3 {
            -webkit-animation-delay: -1.0s;
            animation-delay: -1.0s;
        }

        .spinner .rect4 {
            -webkit-animation-delay: -0.9s;
            animation-delay: -0.9s;
        }

        .spinner .rect5 {
            -webkit-animation-delay: -0.8s;
            animation-delay: -0.8s;
        }

        @-webkit-keyframes stretchdelay {
            0%, 40%, 100% {
                -webkit-transform: scaleY(0.4)
            }
            20% {
                -webkit-transform: scaleY(1.0)
            }
        }

        @keyframes stretchdelay {
            0%, 40%, 100% {
                transform: scaleY(0.4);
                -webkit-transform: scaleY(0.4);
            }
            20% {
                transform: scaleY(1.0);
                -webkit-transform: scaleY(1.0);
            }
        }

        body {
            font-family: Thoma, Microsoft YaHei, 'Lato', Calibri, Arial, sans-serif;
        }

        .loadBar {
            margin: 10px auto;
            width: 85%;
            height: 30px;
            border: 3px solid #212121;
            border-radius: 20px;
            position: relative;
        }

        .loadBar div {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
        }

        .loadBar div span, .loadBar div i {
            box-shadow: inset 0 -2px 6px rgba(0, 0, 0, .4);
            width: 0%;
            display: block;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            border-radius: 20px;
        }

        .loadBar div i {
            width: 100%;
            -webkit-animation: move .8s linear infinite;
            background: -webkit-linear-gradient(left top, #7ed047 0%, #7ed047 25%, #4ea018 25%, #4ea018 50%, #7ed047 50%, #7ed047 75%, #4ea018 75%, #4ea018 100%);
            background-size: 40px 40px;
        }

        .loadBar .percentNum {
            position: absolute;
            top: 100%;
            right: 10%;
            padding: 1px 15px;
            border-bottom-left-radius: 16px;
            border-bottom-right-radius: 16px;
            border: 1px solid #222;
            background-color: #222;
            color: #fff;
        }

        @-webkit-keyframes move {
            0% {
                background-position: 0 0;
            }
            100% {
                background-position: 40px 0;
            }
        }

        .mnc {
            font-family: 'Manchu Bold';
            font-size: 1em;
            -webkit-text-orientation: sideways-right;
            text-orientation: sideways-right;
        }
    </style>
    @include("layout.tj")
</head>
<body>
<h1>满族空间
    <small>www.manchu.work</small>
</h1>
<div style="margin:0 0;text-align:center;"><img align="center" src="manchu_crest.png" alt="满族空间,www.manchu.work ,The manchu family crest" />
</div>

<h5>资源加载中... <span id="process">0%</span></h5>
<div class="spinner">
    <div class="rect1"></div>
    <div class="rect2"></div>
    <div class="rect3"></div>
    <div class="rect4"></div>
    <div class="rect5"></div>
</div>

<div id="loadBar01" class="loadBar">
    <div><span class="percent"><i></i></span></div>
    <span class="percentNum">0%</span></div>
<div class="english-right">@Copy Right 2018 http://www.manchu.work/ <span
            class="mnc">ᠮᠠᠨᠵᡠ ᡤᡳᠰᡠᠨ</span></div>
<div><a href="/home"><span class="mnc">ᠮᠠᠨᠵᡠ<span class="zh">首页</span></span></a><a href="/posts"><span
                class="zh">常用语句</span></a><a href="/dicts"><span class="zh">满语字典</span></a><a href="/books"><span class="zh">图书列表</span></span>
    </a></div>
<div id="himg" style="left:-1000px;top:-1000px;display:none">

</div>

<script>

    function test(){
        var url = '{{$url}}';
        var reg = new RegExp(/^((http)s?:\/\/)?(www\.)?manchu.work(\/.+)*$/);

        if(url == undefined || url == ''){
            window.location.href = '/home';
            return;
        }

        if(!reg.test(url)){
            window.location.href = '/home';
            return;
        }
        window.location.href = url;
    }

    test();


    var img_arr = ['http://www.manchu.work/img/to_left', 'http://www.manchu.work/img/hy_icons'];
    var js_arr = ['http://www.manchu.work/js/jquery', 'http://www.manchu.work/js/dragword', 'http://www.manchu.work/js/manchu_dragword'];
    var css_arr = ['http://www.manchu.work/fonts/font-manchu', 'http://www.manchu.work/css/main', 'http://www.manchu.work/css/mini'];
    var total = img_arr.length + js_arr.length + css_arr.length;
    var start = 0;

    function LoadingBar(id, onCompleted) {
        this.loadbar = document.getElementById(id);
        this.percentEle = document.getElementsByClassName("percent")[0];
        this.percentNumEle = document.getElementsByClassName("percentNum")[0];
        this.processSpan = document.getElementById('process');
        this.max = 100;
        this.currentProgress = 0;
        this.onCompleted = onCompleted;
    }

    LoadingBar.prototype = {
        constructor: LoadingBar, setMax: function (maxVal) {
            this.max = maxVal;
        }, setProgress: function (val) {
            if (val >= this.max) {
                val = this.max;
                if (this.onCompleted) {
                    this.onCompleted();
                }
            }
            this.currentProgress = parseInt((val / this.max) * 100) + "%";
            this.percentEle.style.width = this.currentProgress;
            this.percentNumEle.innerHTML = this.currentProgress;
            this.processSpan.innerHTML = this.currentProgress;
        }
    };
    var loadbar = new LoadingBar("loadBar01", function () {
        var url = '{{$url}}';
        var reg = new RegExp(/^((http)s?:\/\/)?(www\.)?manchu.work(\/.+)*$/);

        if(empty(url)  || !reg.test(url)){
            window.location.href = '/home';
            return;
        }
        window.location.href = url;
    });
    loadbar.setMax(total);

    var head = document.getElementsByTagName("head")[0];
    for (var j in css_arr) {
        var link = document.createElement('link');
        link.href = css_arr[j];
        link.setAttribute('rel', 'stylesheet');
        link.setAttribute('charset', 'utf-8');
        link.setAttribute('media', 'all');
        link.setAttribute('type', 'text/css');
        head.appendChild(link);


        (function (i) {
            console.log("link " + i +" init, loading..., src:"+ link.href );
            link.onload = function () {
                start++;
                loadbar.setProgress(start);
                console.log("link " + i +" load success, src:"+ link.href)
            };

            link.onerror = function () {
                start++;
                loadbar.setProgress(start);
                console.log("link "+ i +" load fail, src:"+ link.href);

            };
        })(j);
    }


    for (var k in js_arr) {
        var js = document.createElement('script');
        js.type = 'text/javascript';
        js.async = true;
        js.src = js_arr[k];
        head.appendChild(js);

        (function (i) {
            console.log("script "+ i +" init, loading..., src:"+ js.src);
            js.onload = function () {
                start++;
                loadbar.setProgress(start);
                console.log("script "+ i +" load success, src:"+ js.src);
            };
            js.onerror = function () {
                start++;
                loadbar.setProgress(start);
                console.log("script " + i +" load fail, src:"+ js.src);
            };
        })(k);
    }

    for (var i in img_arr) {
        var img = document.createElement('img');
        img.src = img_arr[i];

        document.getElementById('himg').appendChild(img);
        (function (i) {
            console.log("img " + i +" init, loading..., src:"+ img.src );
            img.onload = function () {
                start++;
                loadbar.setProgress(start);

                console.log("img " + i +" load success, src:"+ img.src )
            };
            img.onerror = function () {
                start++;
                loadbar.setProgress(start);
                console.log("img " + i +" load fail, src:"+ img.src);
            };
        })(i);
    }

</script>
</body>
</html>