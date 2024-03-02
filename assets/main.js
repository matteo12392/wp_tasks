let tasks = [];
let oldTasks = [];
function updateAllTasks() {
    tasks.forEach(function(t, i) {
        if(oldTasks[i].status != t.status)
        {
            oldTasks[i].status = t.status;
            $.ajax({
                type: "POST",
                data: {
                    move: true, id: t.id, status: t.status
                },
                success: function() {
                    console.log("updated status to "+ t.status +" of task with id " + t.id);
                }
            });    
        }
    });
}
$(window).on("load", function() {
    $(".card").each(function() {
        let t = {};
        t.id = $(this).attr("id");
        t.status = $(this).attr("status");
        console.log("ciao");
        tasks.push(t);
        oldTasks.push({id: t.id, status: t.status}); // senza questo sarebbe una copia costante di task
    });

    // Create droppable zones for each column
    $(".col ul").sortable({
        connectWith: ".col ul",
        update: function (event, ui) {
            let cardId = ui.item.children().attr("id");
            let columnId = $(this).attr("id");
            let indexTask = tasks.findIndex(x => x.id == cardId);
            tasks[indexTask].status = columnId;
            updateAllTasks();
            console.log("Card"+ indexTask + " moved to column " + columnId);
            console.log(tasks);
          }      
    });
    
});