
/* 装载歌词 */
var lyricArea = $("#lyric"); // 歌词显示
var lyricAreaMnc = $("#lyric_mnc"); // 歌词显示

var lyricText;
var lyricTextMnc;

var lastLyric;

var lastLyricMnc;
var DEFAULT_TIP_TEXT = '满族音乐空间';
var lyricMncHost = '';////manchu.work'
// 在歌词区显示提示语
function lyricTip(str) {
    lyricArea.html("<li class='lyric-tip'>"+str+"</li>");     // 显示内容

}

function lyricMncTip(str) {
    lyricAreaMnc.html("<li class='lyric-tip'>"+str+"</li>");     // 显示内容

}

var lyric_loaded = false;
// 歌曲加载完后的回调函数
function lyricCallback(url,music_title, author) {

    lyric_loaded = false;

    $.ajax({  //异步请求获取歌词
        url:lyricMncHost +'/lyric/search?title='+ music_title+'&author=' + author,
        type:"get",
        success:function(data){

            var data;
            try{
                data = JSON.parse(data); //由JSON字符串转换为JSON对象

            }catch (e) {
                data = {};
                data.lyric_mnc = '';
                data.lyric = '';
            }

            loadLyricRenderMnc(data.lyric_mnc);

            if(data.lyric){
                loadLyricRender(data.lyric, true);
            }


        }
    });


    $.ajax({  //异步请求获取歌词
        url:url,
        type:"post",
        success:function(data){

            loadLyricRender(data);
        }
    });
}
function loadLyricRenderMnc(data) {
    console.log('mnc loadLyricRenderMnc===>'+data);

    if(!data || data == '' || data == '暂无歌词'){
        console.log('mnc loadLyricRenderMnc null===>'+data);

        lyricMncTip(DEFAULT_TIP_TEXT);
        return false;
    }


    lyricTextMnc = parseLyric(data);    // 解析获取到的歌词

    if(lyricTextMnc === '') {
        lyricMncTip(DEFAULT_TIP_TEXT);
        return false;
    }

    lyricAreaMnc.html('');   // 清空歌词区域的内容
    lyricAreaMnc.scrollLeft(0);    // 滚动到顶部

    lastLyricMnc = -1;

    // 显示全部歌词
    var i = 0;
    for(var k in lyricTextMnc){
        var txt = lyricTextMnc[k];
        if(txt.indexOf('纯音乐') != -1){
            lyricMncTip(DEFAULT_TIP_TEXT);
            return false;
        }
        if(!txt) txt = "&nbsp;";

        var mncCls = '';
        if(checkIsMnc(txt)){
            mncCls = ' mnc';
        }
        if(checkIsChinese(txt)){
            mncCls = ' zh';
        }

        var li = $("<li data-no='"+i+"' class='lrc-item"+mncCls+"'>"+txt+"</li>");
        lyricAreaMnc.append(li);
        i++;
    }
}

function checkIsChinese(val){
    var reg = new RegExp("[\\u4E00-\\u9FFF]+","g");
    //if(reg.test(val)){alert("包含汉字！"); }
    return reg.test(val);
}

function checkIsMnc(val){
    var reg = new RegExp("[\\u1800-\\u18AF]+","g");
    //if(reg.test(val)){alert("包含汉字！"); }
    return reg.test(val);
}
function loadLyricRender(data, manchuwork_lyric= false) {

    if(lyric_loaded){
        return;
    }
    if(data == '暂无歌词') {
        lyricTip(DEFAULT_TIP_TEXT);
        return false;
    }

    lyricText = parseLyric(data);    // 解析获取到的歌词

    if(lyricText === '') {
        lyricTip(DEFAULT_TIP_TEXT);
        return false;
    }

    if(manchuwork_lyric){
        lyric_loaded = true;
    }

    lyricArea.html('');     // 清空歌词区域的内容

    lyricArea.scrollTop(0);    // 滚动到顶部

    // lyricAreaMnc.html('');   // 清空歌词区域的内容
    // lyricAreaMnc.scrollLeft(0);    // 滚动到顶部

    lastLyric = -1;

    // 显示全部歌词
    var i = 0;
    for(var k in lyricText){
        var txt = lyricText[k];
        if(txt.indexOf('纯音乐') != -1 || txt.indexOf('暂无歌词') != -1){
            lyricTip(DEFAULT_TIP_TEXT);
            return false;
        }
        if(!txt) txt = "&nbsp;";
        var li = $("<li data-no='"+i+"' class='lrc-item'>"+txt+"</li>");
        lyricArea.append(li);

        // var liMnc = $("<li data-no='"+i+"' class='lrc-item'>"+txt+"</li>");
        // lyricAreaMnc.append(liMnc);
        i++;
    }
}

// 强制刷新当前时间点的歌词 秒为单位
function refreshLyric(time) {



    if(lyricText === '') return false;

    time = parseInt(time);  // 时间取整
    var i = 0;
    for(var k in lyricText){
        if(k >= time) break;
        i = k;      // 记录上一句的
    }
    scrollLyricZh(i);
    i = 0;
    for(var j in lyricTextMnc){
        if(j >= time) break;
        i = j;      // 记录上一句的
    }
    scrollLyricMnc(i);
}

// 滚动歌词到指定句
function scrollLyric(time) {
    scrollLyricZh(time);
    scrollLyricMnc(time);
}

function scrollLyricZh(time) {
    if(lyricText === '') return false;

    time = parseInt(time);  // 时间取整

    if(lyricText === undefined || lyricText[time] === undefined) return false;  // 当前时间点没有歌词

    if(lastLyric == time) return true;  // 歌词没发生改变

    var i = 0;  // 获取当前歌词是在第几行
    for(var k in lyricText){
        if(k == time) break;
        i ++;
    }
    lastLyric = time;  // 记录方便下次使用
    $("#lyric .lplaying").removeClass("lplaying");     // 移除其余句子的正在播放样式
    $("#lyric .lrc-item[data-no='" + i + "']").addClass("lplaying");    // 加上正在播放样式

    var scroll = (lyricArea.children().height() * i) - ($(".lyric").height() / 2);
    lyricArea.stop().animate({scrollTop: scroll}, 1000);  // 平滑滚动到当前歌词位置(更改这个数值可以改变歌词滚动速度，单位：毫秒)
}

// 滚动歌词到指定句
function scrollLyricMnc(time) {
    if(lyricTextMnc === '') return false;

    time = parseInt(time);  // 时间取整

    if(lyricTextMnc === undefined || lyricTextMnc[time] === undefined) return false;  // 当前时间点没有歌词

    if(lastLyricMnc == time) return true;  // 歌词没发生改变

    var i = 0;  // 获取当前歌词是在第几行
    for(var k in lyricTextMnc){
        if(k == time) break;
        i ++;
    }
    lastLyricMnc = time;  // 记录方便下次使用
    $("#lyric_mnc .lplaying").removeClass("lplaying");     // 移除其余句子的正在播放样式
    $("#lyric_mnc .lrc-item[data-no='" + i + "']").addClass("lplaying");    // 加上正在播放样式


    var scrollMnc = (lyricAreaMnc.children().width() * i) - ($("#lyric_mnc").width() / 2);
    lyricAreaMnc.stop().animate({scrollLeft: scrollMnc}, 1000);  // 平滑滚动到当前歌词位置(更改这个数值可以改变歌词滚动速度，单位：毫秒)

}

// 解析歌词
function parseLyric(lrc) {
    if(lrc === '') return '';
    var lyrics = lrc.split("\n");
    var lrcText = {};
    for(var i=0;i<lyrics.length;i++){
        var lyric = decodeURIComponent(lyrics[i]);
        var timeReg = /\[\d*:\d*((\.|\:)\d*)*\]/g;
        var timeRegExpArr = lyric.match(timeReg);
        if(!timeRegExpArr)continue;
        var clause = lyric.replace(timeReg,'');
        for(var k = 0,h = timeRegExpArr.length;k < h;k++) {
            var t = timeRegExpArr[k];
            var min = Number(String(t.match(/\[\d*/i)).slice(1)),
                sec = Number(String(t.match(/\:\d*/i)).slice(1));
            var time = min * 60 + sec;
            lrcText[time] = clause;
        }
    }
    return lrcText;
}
