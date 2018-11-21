var dragEl = null;

var btns = document.querySelectorAll('.add');
var columnsWrapper = document.getElementById('drag_content');
var columnsLast = document.querySelector('#drag_content .column');
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
    return document.querySelectorAll('#drag_content .column');
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