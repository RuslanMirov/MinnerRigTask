<?php

require_once 'base.php';


# add new algo
if (isset($_POST["update_uuid"])) {
	# $uuid, $name, $miner, $miner_parameters, $comment
	addUpdateTask ([
		'uuid' => $_POST["update_uuid"], 
		'name' => $_POST["name"], 
		'miner' => $_POST["miner"], 
		'miner_parameters' => $_POST["miner_parameters"],
		'def_miner' => $_POST["def_miner"],
		'def_miner_param' => $_POST["def_miner_param"],
		'comment' => $_POST["comment"], 
		'def_comment' => $_POST["def_comment"], 
		 ]);
}


# get uuid, return miner and miner_parameters for remote system
function getTaskByUuid($uuid) {
	$query = "SELECT * FROM `tasks` WHERE `uuid` = '$uuid'";
	$return = base_query ($query);
	
	if ($return = $return->fetch_array(MYSQLI_ASSOC)) {
	$tasks_from_file = $return;

	$return_tasks["miner"] = $tasks_from_file["miner"];
	$return_tasks["miner_parameters"] = $tasks_from_file["miner_parameters"];
	
	# update last access time
	addUpdateTask (['uuid' => $uuid, 'time' => time()]);

	return $return_tasks;
	} else {
	# if new rig connected, add it to file with blank fields
			# $uuid, $name, $miner, $miner_parameters, $comment
			addUpdateTask (['uuid' => $uuid, 'time' => time()]);
			return false;
	}
}

# if we received post request to add/update task
# update tasks in base accordingly
# $uuid, $name, $miner, $miner_parameters, $comment
function addUpdateTask ($args) {
	$uuid = $args["uuid"];

	$query = "SELECT * FROM `tasks` WHERE `uuid` = '$uuid'";
	
	$return = base_query ($query);
	
	# if uuid was found then update
	if ($return = $return->fetch_array(MYSQLI_ASSOC)) {

	$tasks_from_file = $return;
	
	$tasks_from_file = array (
	"name" => (isset($args["name"])) ? $args["name"] : $tasks_from_file["name"],
	"miner" => (isset($args["miner"])) ? $args["miner"] : $tasks_from_file["miner"],
	"miner_parameters" => (isset($args["miner_parameters"])) ? $args["miner_parameters"] : $tasks_from_file["miner_parameters"],
	"def_miner" => (isset($args["def_miner"])) ? $args["def_miner"] : $tasks_from_file["def_miner"],
	"def_miner_param" => (isset($args["def_miner_param"])) ? $args["def_miner_param"] : $tasks_from_file["def_miner_param"],
	"comment" => (isset($args["comment"])) ? $args["comment"] : $tasks_from_file["comment"],
	"def_comment" => (isset($args["def_comment"])) ? $args["def_comment"] : $tasks_from_file["def_comment"],
	"time" => (isset($args["time"])) ? $args["time"] : $tasks_from_file["time"]
	);

	$query = "UPDATE `tasks` SET 
	
	`name` = '".mysql_escape_string($tasks_from_file["name"])."', 
	`miner` = '".mysql_escape_string($tasks_from_file["miner"])."', 
	`miner_parameters` = '".mysql_escape_string($tasks_from_file["miner_parameters"])."', 
	`def_miner` = '".mysql_escape_string($tasks_from_file["def_miner"])."', 
	`def_miner_param` = '".mysql_escape_string($tasks_from_file["def_miner_param"])."', 
	`comment` = '".mysql_escape_string($tasks_from_file["comment"])."', 
	`def_comment` = '".mysql_escape_string($tasks_from_file["def_comment"])."', 
	`time` = '".mysql_escape_string($tasks_from_file["time"])."'
   
	WHERE `uuid` = '$uuid'";
	} else {
		# for new record add it to base
		$query = "INSERT INTO `tasks` SET 
	`time` = '".time()."', 
	`uuid` = '$uuid'";
	}
	
	$return = base_query ($query);
	
}


# returns control form to add/remove zombie rigs
function getControlForm() {
	$query = "SELECT * FROM `tasks`";
	$return = base_query ($query);
	
			$table = '<table class="table table-striped table-bordered table-hover table-sm">';
			$table .= '
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Status</th>
					<th>Comment</th>
					<th>Setup</th>					
				</tr>
			</thead>
			';

	$total_counter = 0;
	$online_counter = 0;
	while ($uuid_task_data = $return->fetch_array(MYSQLI_ASSOC)) {
		$total_counter ++;

			$uuid = $uuid_task_data["uuid"];
			# if last request from rig was less than 70 seconds ago,
			# show rig as online
			# otherwise - offline
			if (time() - $uuid_task_data["time"] < 70) {
				$online_status = '<span class="badge badge-success">Online</span>';
				$online_counter++;
			} else {
				$online_status = '<span class="badge badge-danger">Offline</span>';	
			}
			
			$update_task_form = '';
			$update_task_form .= '	
			<form method="POST">'.
			$online_status.
			' <b>'.$uuid_task_data["name"].'</b>'.
			' ('.$uuid.')'.
			':
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text" >Rig name:</span>
					</div>
				<input type="text" name="name" class="form-control" aria-label="name" placeholder="name" value="'.$uuid_task_data["name"].'">
				</div>

				<div class="input-group">
					<input type="text" name="miner" class="form-control" aria-label="miner" placeholder="miner" value="'.$uuid_task_data["miner"].'">
					<input type="text" name="miner_parameters" class="form-control" aria-label="miner_parameters" placeholder="miner_parameters" value="'.$uuid_task_data["miner_parameters"].'">
				    <input type="text" name="def_miner" class="form-control" aria-label="def_miner" placeholder="def_miner" value="'.$uuid_task_data["def_miner"].'">
					<input type="text" name="def_miner_param" class="form-control" aria-label="def_miner_param" placeholder="def_miner_param" value="'.$uuid_task_data["def_miner_param"].'">
					<div class="input-group-append">
					<button class="btn btn-warning" type="submit" name="update_uuid" value="'.$uuid.'">Update</button>
		    		</div>
				</div>

				<input type="text" name="comment" class="form-control" aria-label="comment" placeholder="comment" value="'.$uuid_task_data["comment"].'">
				<input type="text" name="def_comment" class="form-control" aria-label="def_comment" placeholder="def_comment" value="'.$uuid_task_data["def_comment"].'">

			</form>
			';
            
			 
			$table .= '<tr> <form method="POST">';
			$table .= "<td>".
			$uuid.
			'<div class="input-group">'.
				'<input type="text" id="input_miner_'.$uuid.'" style="display: none;" name="miner" class="form-control" aria-label="miner" placeholder="miner" value="'.$uuid_task_data["miner"].'">'.
				'<input type="text" id="input_miner_parameters_'.$uuid.'" style="display: none;" name="miner_parameters" class="form-control" aria-label="miner_parameters" placeholder="miner_parameters" value="'.$uuid_task_data["miner_parameters"].'">'.
				'<input type="text" id="def_miner_'.$uuid.'" style="display: none;" name="def_miner" class="form-control" aria-label="def_miner" placeholder="def_miner" value="'.$uuid_task_data["def_miner"].'">'.
				'<input type="text" id="def_miner_param_'.$uuid.'" style="display: none;" name="def_miner_param" class="form-control" aria-label="def_miner_param" placeholder="def_miner_param" value="'.$uuid_task_data["def_miner_param"].'">'.
			'</div>'.
			"</td>";
			$table .= "<td>".
			$uuid_task_data["name"].
			'<input type="text" id="input_name_'.$uuid.'" style="display: none;" name="name" class="form-control" aria-label="name" placeholder="name" value="'.$uuid_task_data["name"].'">'.
			"</td>";
			$table .= "<td>".$online_status."</td>";
			$table .= "<td>".
			$uuid_task_data["comment"].
			'<input type="text" id="input_comment_'.$uuid.'" style="display: none;" name="comment" class="form-control" aria-label="comment" placeholder="comment" value="'.$uuid_task_data["comment"].'">'.
			'<input type="text" id="def_comment_'.$uuid.'" style="display: none;" name="def_comment" class="form-control" aria-label="def_comment" placeholder="def_comment" value="'.$uuid_task_data["def_comment"].'">'.
			"</td>";
			$table .= "<td>".
			'<button id="'.$uuid.'" class="btn btn-info" type="button" name="set_update_uuid" value="'.$uuid.'"
			
			onclick="$(\'#input_miner_'.$uuid.','.'#input_miner_parameters_'.$uuid.','.'#input_name_'.$uuid.','.'#input_comment_'.$uuid.','.'#update_button_'.$uuid.','.'#'.$uuid.'\').toggle();" 
			>Setup</button>'.
			' <button id="update_button_'.$uuid.'" style="display:none;" class="btn btn-warning" type="submit" name="update_uuid" value="'.$uuid.'">Update</button>'.
			' <button id="'.$uuid.'" style="display:none;" class="btn btn-warning" name="default_button" type="button" value="'.$uuid_task_data["def_miner"].'&'.$uuid_task_data["def_miner_param"].'&'.$uuid_task_data["def_comment"].'"">Default</button>'.
			
			
			
			'<button id="'.$uuid.'" class="btn btn-info" type="button" name="setup_uuid" value="'.$uuid.'"
			
			onclick="$(\'#def_miner_'.$uuid.','.'#def_miner_param_'.$uuid.','.'#def_comment_'.$uuid.','.'#update_button_'.$uuid.'\').toggle();" 
			>SetDefault</button>'.
			"</td>";
			$table .= "</form> </tr>";

		}
        
		$table .= "
		<tr class=\"table-info\">
			<td>$total_counter total</td> 
			<td></td>
			<td>$online_counter/$total_counter online</td>
			<td></td>
			<td></td>
		</tr>
		";
		$table .= "</table>";

	$add_zombie_rig_form = '
		<form method="POST">
		  <div class="input-group">
		  <div class="input-group-prepend">
		    <span class="input-group-text" >UUID:</span>
		  </div>
		
		    <input type="text" class="form-control" name="rig_to_add" placeholder="UUID to add">
		
		    <div class="input-group-append">
		      <button class="btn btn-success" style="width: 72px;" type="submit">Add</button>
		    </div>
		  </div>
		</form>
			';

	$controlForm = $table.$add_zombie_rig_form;
	return $controlForm;
	
}



?>