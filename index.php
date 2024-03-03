<?php 
require_once("server.php");
$id = $lucz_tasks->getAutoIncrementValue($lucz_tasks->tasks);
?>
<div class="container my-5">
  <div class="accordion">
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">
          New Task
        </button>
      </h2>
      <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse">
        <div class="accordion-body d-grid">
          <div class="input-group mb-2">
            <input type="text" class="form-control" placeholder="Title" aria-label="Title" id="title" name="title" maxlength="50">
            <input type="text" value="<?php echo $id?>" hidden id="newId">
          </div>
          <div class="input-group input-group-sm mb-2">
            <textarea class="form-control" aria-label="Description" name="descr" maxlength="200" id="descr"></textarea>
          </div>
          <select class="form-select mb-2" name="status" id="status">
            <option value="0" selected>To Do</option>
            <option value="1">In Progress</option>
            <option value="2">Completed</option>
          </select>
          <button onclick="createTask()" class="btn btn-primary" id="submitTask"><b>Save Task</b></button>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container my-5">
  <div class="row">
    <div class="col">
      <h3 class="mb-3">To Do</h3>
      <ul id="0" class="lucz-tasks">
        <?php $lucz_tasks->echoTasks($lucz_tasks->getTasksOfCol(0))?>
      </ul>
    </div>
    <div class="col">
      <h3 class="mb-3">In Progress</h3>
      <ul id="1" class="lucz-tasks">
        <?php $lucz_tasks->echoTasks($lucz_tasks->getTasksOfCol(1))?>
      </ul>
    </div>
    <div class="col">
      <h3 class="mb-3">Completed</h3>
      <ul id="2" class="lucz-tasks">
        <?php $lucz_tasks->echoTasks($lucz_tasks->getTasksOfCol(2))?>
      </ul>
    </div>
  </div>
</div>