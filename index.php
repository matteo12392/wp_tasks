<?php
require_once("server.php");
$taskNewId = $lucz_tasks->getAutoIncrementValue($lucz_tasks->tasks);
?>
<div class="container my-5">
  <div class="accordion">
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#newCol-collapseOne" aria-expanded="false" aria-controls="newCol-collapseOne">
          New Column
        </button>
      </h2>
      <div id="newCol-collapseOne" class="accordion-collapse collapse">
        <div class="accordion-body d-grid">
          <div class="input-group mb-2">
            <input type="text" class="form-control" placeholder="Title of Column" id="titleCol" maxlength="50">
          </div>
          <div class="input-group input-group-sm mb-2">
            <textarea class="form-control" maxlength="200" id="descrCol"></textarea>
          </div>
          <button onclick="createCol()" class="btn btn-primary submitTask"><b>Create New Column</b></button>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid my-5">
  <ul class="row lucz-columns">
    <?php $lucz_tasks->echoAllColumns()?>
  </ul>
</div>