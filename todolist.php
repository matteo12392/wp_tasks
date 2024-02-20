<?php
include("server.php");
$sqlT = "SELECT * FROM $tasks WHERE status = 0";
$resT = $wpdb->get_results($sqlT);
$sqlI = "SELECT * FROM $tasks WHERE status = 1";
$resI = $wpdb->get_results($sqlI);
$sqlC = "SELECT * FROM $tasks WHERE status = 2";
$resC = $wpdb->get_results($sqlC);
?>
<div class="container mt-5">
  <form method="post" class="mb-5">
    <div class="accordion" id="accordionPanelsStayOpenExample">
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">
            New Task
          </button>
        </h2>
        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse">
          <div class="accordion-body d-grid">
            <div class="input-group mb-2">
              <input type="text" class="form-control" placeholder="Title" aria-label="Title" aria-describedby="basic-addon1" name="title" maxlength="50" required>
            </div>
            <div class="input-group input-group-sm mb-2">
              <textarea class="form-control" aria-label="Description" name="descr" maxlength="200"></textarea>
            </div>
            <select class="form-select mb-2" name="status">
              <option value="0" selected>To Do</option>
              <option value="1">In Progress</option>
              <option value="2">Completed</option>
            </select>
            <button type="submit" name="save_task" class="btn btn-primary"><b>Save Task</b></button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<div class="container">
  <div class="row">
    <div class="col">
      <h1 class="text-center fs-4">To Do</h1>
      <?php foreach ($resT as $row) { ?>
        <div class="card mb-2">
          <form method="post" class="card-body">
            <h4 class="card-title"><?php echo $row->title ?></h4>
            <p><?php echo $row->descr ?></p>
            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
              <div class="btn-group me-2" role="group" aria-label="Second group">
                <button type="submit" name="move" value="l" class="btn btn-secondary" disabled><i class="bi bi-caret-left-fill"></i></button>
                <button type="submit" name="move" value="r" class="btn btn-secondary"><i class="bi bi-caret-right-fill"></i></button>
              </div>
              <div class="btn-group" role="group" aria-label="Third group">
                <button type="submit" name="del" class="btn btn-danger"><i class="bi bi-x-lg"></i></button>
              </div>
              <input type="hidden" name="status" value="<?php echo $row->status ?>">
              <input type="hidden" name="id" value="<?php echo $row->id ?>">
            </div>
          </form>
        </div>
      <?php } ?>
    </div>
    <div class="col">
      <h1 class="text-center fs-4">In Progress</h1>
      <?php foreach ($resI as $row) { ?>
        <form method="post" class="card mb-2">
          <div class="card-body">
            <h4 class="card-title"><?php echo $row->title ?></h4>
            <p><?php echo $row->descr ?></p>
            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
              <div class="btn-group me-2" role="group" aria-label="Second group">
                <button type="submit" name="move" value="l" class="btn btn-secondary"><i class="bi bi-caret-left-fill"></i></button>
                <button type="submit" name="move" value="r" class="btn btn-secondary"><i class="bi bi-caret-right-fill"></i></button>
              </div>
              <div class="btn-group" role="group" aria-label="Third group">
                <button type="submit" name="del" class="btn btn-danger"><i class="bi bi-x-lg"></i></button>
              </div>
              <input type="hidden" name="status" value="<?php echo $row->status ?>">
              <input type="hidden" name="id" value="<?php echo $row->id ?>">
            </div>
          </div>
        </form>
      <?php } ?>
    </div>
    <div class="col">
      <h1 class="text-center fs-4">Completed</h1>
      <?php foreach ($resC as $row) { ?>
        <form method="post" class="card mb-2">
          <div class="card-body">
            <h4 class="card-title"><?php echo $row->title ?></h4>
            <p><?php echo $row->descr ?></p>
            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
              <div class="btn-group me-2" role="group" aria-label="Second group">
                <button type="submit" name="move" value="l" class="btn btn-secondary"><i class="bi bi-caret-left-fill"></i></button>
                <button type="submit" name="move" value="r" class="btn btn-secondary" disabled><i class="bi bi-caret-right-fill"></i></button>
              </div>
              <div class="btn-group" role="group" aria-label="Third group">
                <button type="submit" name="del" class="btn btn-danger"><i class="bi bi-x-lg"></i></button>
              </div>
              <input type="hidden" name="status" value="<?php echo $row->status ?>">
              <input type="hidden" name="id" value="<?php echo $row->id ?>">
            </div>
          </div>
        </form>
      <?php } ?>
    </div>
  </div>

</div>