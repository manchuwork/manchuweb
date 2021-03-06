<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Keywords" content="满族空间,音乐播放器,音乐盒">
    <meta name="Description" content="满族空间,音乐播放器，可搜索">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    <meta name="renderer" content="webkit">
    <meta name="generator" content="KodCloud">
    <meta http-equiv="Cache-Control" content="no-siteapp">
    <link rel="stylesheet" href="/fonts/font-manchu">


    <!-- 一些移动设备的全屏 -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="full-screen" content="yes">
    <meta name="browsermode" content="application">
    <meta name="x5-fullscreen" content="true">
    <meta name="x5-page-mode" content="app">

    <title>满族空间音乐播放器</title>

    <!-- 引入jQuery官方类库 -->
    <script src="/player/js/jquery.min.js"></script>
    <!-- 总样式表 -->
    <link rel="stylesheet" type="text/css" href="/player/css/index.css">
    <!-- 响应式优化 -->
    <link rel="stylesheet" type="text/css" href="/player/css/mobile.css">
    <!-- 滚动条美化 -->
    <link rel="stylesheet" type="text/css" href="/player/css/jquery.mCustomScrollbar.min.css">
    <!-- layer弹窗插件 -->
    <link rel="stylesheet" href="/player/js/layer/skin/default/layer.css?v=3.0.2302" id="layuicss-skinlayercss">
    <!-- 加载动画 -->
    <link type="text/css" rel="stylesheet" href="/player/css/kr-loading.css" />
</head>
<body>

<div id="blur-img"></div><!-- 头部logo -->
<div class="header">
    <div class="logo">
        <a href="/" class="logo">满族空间</a> 音乐
    </div>
    <div style="float:right" class="social-share" data-wechat-qrcode-title="请打开微信扫一扫" data-title="@yield('title','Manchu 满语 ᠮᠠᠨᠵᡠ 满族空间')" data-description="@yield('title','Manchu 满语 ᠮᠠᠨᠵᡠ 满族空间') 满族空间是学习满语的空间，欢迎一起学习满语 ᠮᠠᠨᠵᡠ ᡤᡳᠰᡠᠨ manchu.work"></div>
    <!--  css & js -->
    <link rel="stylesheet" href="/share/css/share.min.css">
    <script src="/share/js/social-share.min.js"></script>

</div>

<!-- 中间 -->
<div class="center">
    <div class="container">
        <div class="btn-bar">
            <!-- tab按钮区 -->
            <div class="btn-box" id="btn-area">
                <span class="btn" data-action="player" hidden>正在播放</span>
                <span class="btn active" data-action="list" title="正在播放列表">播放列表</span>
            </div>
            <div class="serchsongs">
                <input type="text" name="keywords" maxlength="17" id="krserwords" value="{{$searchWord}}"/>
                <div class="searchDivIcon"><span class="searchIcon"></span></div>
            </div>
        </div>

        <div class="data-area">
            <!--音乐播放列表-->
            <div id="main-list" class="music-list data-box">

            </div>
        </div>

        <!-- 右侧封面及歌词展示 -->
        <div class="player" id="player">
            <!--歌曲封面-->
            <div class="cover">
                <img src="/player/images/player_cover.png" class="music-cover" id="music-cover">
            </div>
            <!--滚动歌词-->
            <div class="lyric_mnc">
                <ul id="lyric_mnc">
                    <li class='lyric-tip'>满族空间，快乐生活</li>
                </ul>
            </div>
            <!--滚动歌词-->
            <div class="lyric">
                <ul id="lyric">
                    <li class='lyric-tip'>满族空间，快乐生活</li>
                </ul>
            </div>
            <div id="music-info" title="点击查看歌曲信息"></div>
        </div>
    </div>
</div>

<!--播放器-->
<audio id="audio"></audio>

<!-- 播放器底部区域 -->
<div class="footer">
    <div class="container">
        <div class="con-btn">
            <a href="javascript:;" class="player-btn btn-prev" title="上一首"></a>
            <a href="javascript:;" class="player-btn btn-play" title="播放"></a>
            <a href="javascript:;" class="player-btn btn-next" title="下一首"></a>
        </div>


        <div class="vol">
            <div class="quiet">
                <a href="javascript:;" class="player-btn btn-quiet" title="静音"></a>
            </div>
            <div class="volume">
                <div class="volume-box">
                    <div id="volume-progress" class="mkpgb-area">
                        <div class="mkpgb-bar"></div>
                        <div class="mkpgb-cur"></div>
                        <div class="mkpgb-dot"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="others">
            <a href="javascript:;" class="player-btn btn-order" title="列表循环"></a>
            <a href="javascript:;" class="player-btn btn-download" title="下载"></a>
        </div>

        <div class="progress">
            <div class="progress_msg">
                <div class="music_title">满族空间，快乐生活</div>
                <div class="time_area">
                    <span class="current_time">00:00</span> /
                    <span class="all_time">00:00</span>
                </div>
                <div class="clear"></div>
            </div>
            <div class="progress-box">
                <div id="music-progress" class="mkpgb-area">
                    <div class="mkpgb-bar"></div>
                    <div class="mkpgb-cur"></div>
                    <div class="mkpgb-dot"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--下载按钮-->
<a id="downabo" download=""></a>

<!-- 加载动画相关js -->
<script src="/player/js/sg.js"></script>
<script src="/player/js/kr_util.js"></script>
<!-- layer弹窗插件 -->
<script src="/player/js/layer/layer.js"></script>
<!-- 滚动条美化插件 -->
<script src="/player/js/jquery.mCustomScrollbar.concat.min.js"></script>
<!-- 粘贴复制的插件 -->
<script type="text/javascript" src="/player/js/clipboard.min.js"></script>
<!-- 列表方法 -->
<script src="/player/js/list_function.js"></script>
<!-- 注册播放器 -->
<script src="/player/js/music_play.js"></script>
<!-- 歌词解析装载 -->
<script src="/player/js/loadlyc.js"></script>
<!-- 背景模糊化插件 -->
<script src="/player/js/background-blur.min.js"></script>

</body>
</html>