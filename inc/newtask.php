<div class="accordion mt-3">
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#newTask-collapse<?php echo $colId ?>" aria-expanded="false" aria-controls="newTask-collapseOne">
                New Task
            </button>
        </h2>
        <div id="newTask-collapse<?php echo $colId ?>" class="accordion-collapse collapse">
            <div class="accordion-body d-grid">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" placeholder="Title" id="title<?php echo $colId ?>" maxlength="50">
                    <input type="text" value="<?php echo $currentId ?>" hidden class="newId">
                </div>
                <div class="input-group input-group-sm mb-2">
                    <textarea class="form-control" maxlength="200" id="descr<?php echo $colId ?>"></textarea>
                </div>
                <input type="number" value="<?php echo $colId ?>" hidden id="status<?php echo $colId ?>">
                <button onclick="createTask(<?php echo $colId ?>)" class="btn btn-primary submitTask"><b>Create Task</b></button>
            </div>
        </div>
    </div>
</div>