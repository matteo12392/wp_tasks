<?php
class lucz_tasks {
    private $wpdb;
    public $tasks = "wp_tasks";

    public function __construct() {
        global $wpdb;
        $this->wpdb = $wpdb;
    }

    public function createTask($title, $descr, $status, $index) {
        $res = $this->wpdb->insert($this->tasks, array("title" => $title, "descr" => $descr, "status" => $status, "i" => $index));
        return $res;
    }

    public function moveTask($id, $newStatus, $newIndex) {
        $res = $this->wpdb->update($this->tasks, array("status" => $newStatus, "i" => $newIndex), array("id" => $id));
        return $res;
    }

    public function delTask($id) {
        $res = $this->wpdb->delete($this->tasks, array("id" => $id));
        return $res;
    }

    public function getAllTasks() {
        $sql = "SELECT * FROM $this->tasks";
        $res = $this->wpdb->get_results($sql);
        return $res;
    }

    public function getTasksOfCol($col) {
        $sql = "SELECT * FROM $this->tasks WHERE status = $col ORDER BY i ASC";
        $res = $this->wpdb->get_results($sql);
        return $res;
    }

    public function echoTasks($res) {
        foreach ($res as $row) { ?>
          <li>
            <div class="card mb-2 lucz-task" id="<?php echo $row->id ?>" status="<?php echo $row->status ?>">
                <h4 class="card-title"><?php echo $row->title ?></h4>
                <p><?php echo $row->descr ?></p>
                <button onclick="deleteTask(<?php echo $row->id ?>)"  name="del" class="btn btn-danger lucz-delete-task"><i class="bi bi-x-lg"></i></button>
            </div>
          </li>
        <?php }
    }

    public function getAutoIncrementValue($table) {
        $sqlId = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = '$table';";
        $resId = $this->wpdb->get_results($sqlId);
        $id = $resId[0]->AUTO_INCREMENT;
        return $id;
    }
}
?>