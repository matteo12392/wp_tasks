let tasks = [];
let oldTasks = [];
function refreshIndex() {
    tasks.forEach(function (t, i){
        t.index = $("div#"+t.id+".card").parent().index();
        console.log(t.index + " id: "+ t.id);
    });
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
    const title = $("title");
    const descr = $("descr");
    const status = $("status");
    $.ajax({
        type: "POST",
        data: {
            save_task: true, title: title, descr: descr, status: status
        },
        success: function () {
            console.log("created new task");

        }
    });
}

$(window).on("load", function () {
    $(".card").each(function () {
        let t = {};
        t.id = $(this).attr("id");
        t.status = $(this).attr("status");
        t.index = $(this).index();
        console.log("ciao");
        tasks.push(t);
        oldTasks.push({ id: t.id, status: t.status, index: t.index }); // senza questo sarebbe una copia costante di task
    });

    // Create droppable zones for each column
    $(".col ul").sortable({
        connectWith: ".col ul",
        update: function (event, ui) {
            let taskId = ui.item.children().attr("id");
            let columnId = $(this).attr("id");
            let indexTask = ui.item.index();
            let arrIndexTask = tasks.findIndex(x => x.id == taskId);
            tasks[arrIndexTask].status = columnId;
            refreshIndex();
            updateAllTasks();
        }
    });

});