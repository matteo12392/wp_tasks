let tasks = [];
let cols = [];
let oldTasks = [];
let oldCols = [];

async function refreshIndex() {
    tasks.forEach(function (t, i) {
        t.index = $("div#" + t.id + ".card").parent().index();
        console.log(t.index + " id: " + t.id);
    });
    console.log("done");
    return;
}
function updateAllTasks() {
    tasks.forEach(function (t, i) {
        if (oldTasks[i].status != t.status || oldTasks[i].index != t.index) {
            oldTasks[i].index = t.index;
            oldTasks[i].status = t.status;
            $.ajax({
                type: "POST",
                data: {
                    move_task: true, id: t.id, status: t.status, index: t.index
                },
                success: function () {
                    console.log("updated status to " + t.status + " and index to " + t.index + " of task with id " + t.id);
                }
            });
        }
    });
}
function createTask(colId) {
    const title = $("#title"+colId).val();
    const descr = $("#descr"+colId).val();
    const status = $("#status"+colId).val();
    const index = $("ul#" + status + " li").length;
    $(".submitTask").prop("disabled", true);
    if (title != "") {
        $.ajax({
            type: "POST",
            data: {
                create_task: true, title: title, descr: descr, status: status, index: index
            },
            success: function () {
                $(".submitTask").prop("disabled", false);
                $("#title"+colId).val(null);
                $("#descr"+colId).val("");
                const newId = parseInt($(".newId").val()) + 1;
                $(".newId").val(newId.toString());
                console.log("created new task");
                tasks.push({ id: newId-1, status: status, index: $("ul#" + status + " li").length });
                oldTasks.push({ id: newId-1, status: status, index: $("ul#" + status + " li").length });
                $("ul#" + status + ".lucz-tasks").append(printTask(title, descr, newId-1));
            }
        });
    }
    else {
        alert("In order to create a new task, you need to choose a title");
        $("#submitTask").prop("disabled", false);
    }
}
function deleteTask(id) {
    console.log(id);
    $(".lucz-delete-task").prop("disabled", true);
    $.ajax({
        type: "POST",
        data: {
            del: true, id: id
        },
        success: function () {
            $(".lucz-delete-task").prop("disabled", false);
            console.log("task deleted");
            $("#" + id + ".card").parent().remove();
        }
    });
}
function printTask(title, descr, id) {
    return `<li>
    <div class="card mb-2 lucz-task" id="`+ id + `" status="status">
        <h4 class="card-title">`+ title + `</h4>
        <p>`+ descr + `</p>
        <button onclick="deleteTask(`+ id + `)"  name="del" class="btn btn-danger lucz-delete-task"><i class="bi bi-x-lg"></i></button>
    </div>
  </li>`;
}

function createCol() {
    const title = $("#titleCol").val();
    const descr = $("#descrCol").val();
    const index = $("ul.lucz-columns" + " li.col").length;
    $(".submitTask").prop("disabled", true);
    if (title != "") {
        $.ajax({
            type: "POST",
            data: {
                create_col: true, title: title, descr: descr, index: index
            },
            success: function () {
                $(".submitTask").prop("disabled", false);
                $("#titleCol").val(null);
                $("#descrCol").val(null);
                console.log("created new column");
                location.reload();
            }
        });
    }
    else {
        alert("In order to create a new columns, you need to choose a title");
        $("#submitTask").prop("disabled", false);
    }
}
function refreshColumns() {
    cols.forEach(function (c) {
        c.index = $('li[col-id=' + c.id + ']').index();
        $.ajax({
            type: "POST",
            data: {
                move_col: true, id: c.id, index: c.index
            },
            success: function () {
                console.log("updated index to " + c.index + " of col with id " + c.id);
            }
        });
        console.log(c.index + " id: " + c.id);
    });
    console.log("done");
    return;
}
$(window).on("load", function () {
    $(".lucz-task").each(function () {
        let t = {};
        t.id = $(this).attr("id");
        t.status = $(this).attr("status");
        t.index = $(this).parent().index();
        tasks.push(t);
        oldTasks.push({ id: t.id, status: t.status, index: t.index });
    });
    $(".lucz-col").each(function () {
        let c = {};
        c.id = $(this).attr("col-id");
        c.index = $(this).index();
        cols.push(c);
        oldCols.push({ id: c.id, index: c.index });
    });

    $('ul.row').sortable({
        items: 'li.col',
        toleranceElement: '> h3',
        start: function (event, ui) {
            $(ui.item.children()).addClass("dragging-col");
        },
        stop: function (event, ui) {
            $(ui.item.children()).removeClass("dragging-col");
        },
        update: async function (event, ui) {
            console.log(ui.item);
            refreshColumns();
        }
    });
    $('ul.lucz-tasks').sortable({
        items: 'li',
        connectWith: "ul.lucz-tasks",
        toleranceElement: '> div',
        start: function (event, ui) {
            console.log(ui.item.children());
            $(ui.item.children()).addClass("dragging-task");
        },
        stop: function (event, ui) {
            $(ui.item.children()).removeClass("dragging-task");
        },
        update: async function (event, ui) {
            let taskId = ui.item.children().attr("id");
            let columnId = $(this).attr("id");
            console.log(ui.item.children().attr("id"));
            console.log($(this));
            let arrIndexTask = tasks.findIndex(x => x.id == taskId);
            tasks[arrIndexTask].status = columnId;
            await refreshIndex();
            updateAllTasks();
        }
    });
});