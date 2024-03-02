let tasks = [];
let oldTasks = [];
async function refreshIndex() {
    tasks.forEach(function (t, i){
        t.index = $("div#"+t.id+".card").parent().index();
        console.log(t.index + " id: "+ t.id);
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
                    move: true, id: t.id, status: t.status, index: t.index
                },
                success: function () {
                    console.log("updated status to " + t.status + " and index to "+ t.index + " of task with id " + t.id);
                }
            });
        }
    });
}
function createTask() {
    const title = $("#title").val();
    const descr = $("#descr").val();
    const status = $("#status").val();
    $("#submitTask").prop("disabled", true);
    $.ajax({
        type: "POST",
        data: {
            save_task: true, title: title, descr: descr, status: status
        },
        success: function () {
            $("#submitTask").prop("disabled", false);
            console.log("created new task");
            $("ul#"+status+".cards").append(`<li>
            <div class="card mb-2" id="`+tasks.length+`" status="status">
              <form method="post" class="card-body">
                <h4 class="card-title">`+title+`</h4>
                <p>`+descr+`</p>
                <button type="submit" name="del" class="btn btn-danger" id="delete-task"><i class="bi bi-x-lg"></i></button>
                <input type="hidden" name="status" value="`+status+`">
                <input type="hidden" name="id" value="`+tasks.length+`">
              </form>
            </div>
          </li>`);
        }
    });
}
function deleteTask(id) {
    console.log(id);
    $(".delete-task").prop("disabled", true);
    $.ajax({
        type: "POST",
        data: {
            del: true, id: id
        },
        success: function () {
            $(".delete-task").prop("disabled", false);
            console.log("task deleted");
            $("#"+id+".card").parent().remove();
        }
    });
}

$(window).on("load", function () {
    $(".card").each(function () {
        let t = {};
        t.id = $(this).attr("id");
        t.status = $(this).attr("status");
        t.index = $(this).parent().index();
        console.log("ciao");
        tasks.push(t);
        oldTasks.push({ id: t.id, status: t.status, index: t.index }); // senza questo sarebbe una copia costante di task
    });

    // Create droppable zones for each column
    $(".col ul").sortable({
        connectWith: ".col ul",
        update: async function (event, ui) {
            let taskId = ui.item.children().attr("id");
            let columnId = $(this).attr("id");
            let indexTask = ui.item.index();
            let arrIndexTask = tasks.findIndex(x => x.id == taskId);
            tasks[arrIndexTask].status = columnId;
            await refreshIndex();
            updateAllTasks();
        }
    });

});