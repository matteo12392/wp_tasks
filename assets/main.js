$(window).on("load", function () {
    // Create droppable zones for each column
    $(".col ul").sortable({
        connectWith: ".col ul",
        update: function (event, ui) {
            let cardId = $(".card").attr("id");
            let columnId = $(this).attr("id");
            console.log("Card"+ cardId + " moved to column " + columnId);
          }      
    });
});