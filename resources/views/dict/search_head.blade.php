 <h1 class="zh">满语字典 &nbsp;<span class="zh desc-tip">输入满语、罗马转写或中文查询</span></h1>
    <hr/>
    <div id="word" tabindex="0" contentEditable="true" class="input mnc"
         placeholder="请输入满语、汉语或转写">{{ $word or '' }}</div>

    <form id="form" action="/dicts/search" method="GET">
        {{csrf_field()}}
        <input id="word_hidden" name="word" type="hidden" value="">
        <select name="search_type">
            <option value="">模糊</option>
            <option value="pre" @if(isset($search_type) && $search_type == 'pre')selected @endif>前缀</option>
            <option value="suffix" @if(isset($search_type) && $search_type == 'suffix')selected @endif>后缀</option>
            <option value="full" @if(isset($search_type) && $search_type == 'full')selected @endif>精确</option>
        </select>
    </form>
    <button id="btnCommit" class="box box3">搜索</button>
    <div class="box"></div>
    <hr/>