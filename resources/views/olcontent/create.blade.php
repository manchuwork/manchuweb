@extends("layout.main")
@section("title")ᠮᠠᠨᠵᡠ manchu 图书创建页面@endsection
@section("content")
    @include("olcontent.nav")
    <script src="/js/common_edit"></script>

    <style>
        .column {
            height: auto;
            width: auto;
            float: top;
            border: 2px solid black;
            background-color: green;
            margin-right: 5px;
            text-align: center;
            cursor: move;
        }

        .column header {
            color: black;
            text-shadow: #000 0 1px;
            box-shadow: indianred; /*5px;*/
            padding: 5px;
            background: red;
            border-bottom: 1px solid black;
        }

        .column.over {
            border: 3px dashed #000;
        }

    </style>
    <div class="content-wrap">
        <h1>{{$olcatalog->entry}}</h1>
        <div><span class="zh">「内容」</span>*</div>
        <div id="columns">
            <div draggable="true" class="column">
                <header>div1</header>
                <div class="mnc">我是中国人</div>
                <div class="en">我是中国人</div>
                <div class="zh">我是中国人</div>
            </div>
            <div draggable="true" class="column">
                <header>div2</header>
            </div>
            <div draggable="true" class="column">
                <header>div3</header>
            </div>
        </div>
        <button class="box box1 zh add" v="tpl01">添加</button>

        <div id="tpl01" draggable="true" class="column" style="display: none;">
            <div class="content-wrap">
                <div class="mnc">ᠮᠠᠨᠴᡠ →</div>
                <div tabindex="0" contentEditable="true" class="input mnc" placeholder="请输入满语"></div>
                <div class="en">transcription ↑</div>
                <div tabindex="0" contentEditable="true" class="input en" placeholder="请输入转写"></div>
                <div class="zh">中文 ↑</div>
                <div tabindex="1" contentEditable="true" class="input zh" placeholder="请输入中文" ></div>

            </div>
        </div>

        <div id="content" tabindex="0"  contentEditable="true" class="input zh" placeholder="请输入内容"></div>
        <form id="form" action="/olcontents" enctype="multipart/form-data" method="POST">
            {{csrf_field()}}
            <input name="ol_book_id" type="hidden" value="{{$olbook_id}}">
            <input name="ol_catalog_id" type="hidden" value="{{$olcatalog_id}}">
            <input id="content_hidden" name="content" type="hidden" value="">
        </form>
        @include('layout.error')
        <button id="btnCommit" class="box box1">提交数据</button>
    </div>
    <script>
        var dragEl = null;

        var btns = document.querySelectorAll('.add');
        var columnsWrapper = document.getElementById('columns');
        var columnsLast = document.querySelector('#columns .column');
        var tpl01 = document.getElementById('tpl01');
        btns.forEach(function (e) {

            e.addEventListener("click", function (e) {

                var newDiv = document.createElement('div');
                newDiv.innerHTML = tpl01.innerHTML;
                newDiv.classList = tpl01.classList;
                newDiv.setAttribute('draggable',true);
                columnsWrapper.appendChild(newDiv);

                addDragEvent(newDiv);
            }, false);


        });


        function getAllColumns() {
            return document.querySelectorAll('#columns .column');
        }

        [].forEach.call(getAllColumns(),function(column){addDragEvent(column)} );

        function addDragEvent(column) {
            column.addEventListener("dragstart", domdrugstart, false);
            column.addEventListener('dragenter', domdrugenter, false);
            column.addEventListener('dragover', domdrugover, false);
            column.addEventListener('dragleave', domdrugleave, false);
            column.addEventListener('drop', domdrop, false);
            column.addEventListener('dragend', domdrapend, false);
        }

        function domdrugstart(e) {
            e.target.style.opacity = '0.5';

            // 记录拖拽元素是谁
            dragEl = this;
            e.dataTransfer.effectAllowed = "move";

            e.dataTransfer.setData("text/html",this.innerHTML);
        }

        function domdrugenter(e) {
            e.target.classList.add('over');
        }

        function domdrugover(e) {
            if (e.preventDefault) {
                e.preventDefault();
            }
            e.dataTransfer.dropEffect = 'move';
            return false;
        }

        function domdrugleave(e) {
            e.target.classList.remove('over');
        }


        function domdrop(e) {
            if (e.stopPropagation) {
                e.stopPropagation();
            }
            /* 位置互换 */
            if (dragEl != this) {
                dragEl.innerHTML = this.innerHTML;
                this.innerHTML = e.dataTransfer.getData('text/html');
            }
            return false;
        }

        function domdrapend(e) {
            [].forEach.call(getAllColumns(), function (column) {
                column.classList.remove('over');
                column.style.opacity = '1';
            });
        }
    </script>
@endsection