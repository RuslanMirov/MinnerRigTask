<?php
# this file returns tasks to miners depending on uuid

include_once("functions.php");

if (isset($_POST["uuid"])) {
  $task = getTaskByUuid($_POST["uuid"]);
  echo json_encode($task);
}

if (isset($_GET["uuid"])) {
  $task = getTaskByUuid($_GET["uuid"]);
  echo json_encode($task);
}


?>