<?php
include("server.php");
$sqlT = "SELECT * FROM $tasks WHERE status = 0";
$resT = $wpdb->get_results($sqlT);
$sqlI = "SELECT * FROM $tasks WHERE status = 1";
$resI = $wpdb->get_results($sqlI);
$sqlC = "SELECT * FROM $tasks WHERE status = 2";
$resC = $wpdb->get_results($sqlC);
?>
<div class="container my-5">
  <form method="post">
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
<div class="container my-5">
  <div class="row" id="cards-container">
    <div class="col">
      <h3 class="mb-3">To Do</h3>
      <ul id="0" class="cards">
        <?php foreach ($resT as $row) { ?>
          <li>
            <div class="card mb-2" id="<?php echo $row->id ?>" status="<?php echo $row->status ?>">
              <form method="post" class="card-body">
                <h4 class="card-title"><?php echo $row->title ?></h4>
                <p><?php echo $row->descr ?></p>
                <button type="submit" name="del" class="btn btn-danger" id="delete-task"><i class="bi bi-x-lg"></i></button>
                <input type="hidden" name="status" value="<?php echo $row->status ?>">
                <input type="hidden" name="id" value="<?php echo $row->id ?>">
              </form>
            </div>
          </li>
        <?php } ?>
      </ul>
    </div>
    <div class="col">
      <h3 class="mb-3">In Progress</h3>
      <ul id="1" class="cards">
        <?php foreach ($resI as $row) { ?>
          <li>
            <div class="card mb-2" id="<?php echo $row->id ?>" status="<?php echo $row->status ?>">
              <form method="post" class="card-body">
                <h4 class="card-title"><?php echo $row->title ?></h4>
                <p><?php echo $row->descr ?></p>
                <button type="submit" name="del" class="btn btn-danger" id="delete-task"><i class="bi bi-x-lg"></i></button>
                <input type="hidden" name="status" value="<?php echo $row->status ?>">
                <input type="hidden" name="id" value="<?php echo $row->id ?>">
              </form>
            </div>
          </li>
        <?php } ?>
      </ul>
    </div>
    <div class="col">
      <h3 class="mb-3">Completed</h3>
      <ul id="2" class="cards">
        <?php foreach ($resC as $row) { ?>
          <li>
            <div class="card mb-2" id="<?php echo $row->id ?>" status="<?php echo $row->status ?>">
              <form method="post" class="card-body">
                <h4 class="card-title"><?php echo $row->title ?></h4>
                <p><?php echo $row->descr ?></p>
                <button type="submit" name="del" class="btn btn-danger" id="delete-task"><i class="bi bi-x-lg"></i></button>
                <input type="hidden" name="status" value="<?php echo $row->status ?>">
                <input type="hidden" name="id" value="<?php echo $row->id ?>">
              </form>
            </div>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</div>