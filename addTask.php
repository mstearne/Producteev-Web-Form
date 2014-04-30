<?php 
session_start();

include_once("header.php");

//print_r($_SESSION);
include_once("include.php");


if(!$_SESSION['producteev_access_token']){   /// Start Producteev Session Check

?>	

<a href="https://www.producteev.com/oauth/v2/auth?client_id=53518db120bce50455000004_1gphpxybebesgc04s8sw4s8kwooocsw80ocwc04kwkco0wsw4w&response_type=code&redirect_uri=http%3A%2F%2Fwww.pathinteractive.com%2Finternal%2Fproducteev%2Fauth.php">Please log in to Producteev</a>	

<?	
}else{  /// We have a valid Producteev Session


$projectData=makeAPICall( "https://www.producteev.com/api/projects/".$_REQUEST['project']);

//$projectData['content'];
$projectData['content']=str_replace("\/","/",$projectData['content']);

$pData2=json_decode($projectData['content']);

//print_r($pData2->project->id);

//print_r($projectData['content']);

$taskData='{"task":{"title":"'.addslashes($_REQUEST['taskname']).'","project":{"id":"'.$pData2->project->id.'"}}}';


$newTaskData=makeAPICall( "https://www.producteev.com/api/tasks", $taskData);

///print_r($newTaskData);

if($newTaskData['http_code']=="201"){
/// task created successfully	
	
	$createdTaskData=json_decode($newTaskData['content']);

/// TODO
///  Get the new task ID
//print_r($createdTaskData);
$newTaskID=$createdTaskData->task->id;
//print $newTaskID;

?>

<h3>New task successfully added. <a href="https://www.producteev.com/workspace/t/<?=$newTaskID?>" class="btn btn-primary">Click to view</a></h3>



<?

$updateTaskData='{}';


//// Update the task to add the label
$updateTask=makeAPICall( "https://www.producteev.com/api/tasks/$newTaskID/labels/".$_REQUEST['labelid'],$updateTaskData,"PUT");



$updateTaskData='{"task":{"deadline":"'.$_REQUEST['duedate'].'T20:00:00+0000",
      "deadline_timezone":"EST"
      
      
}}';


//// Update the task to add the label
$updateTask=makeAPICall( "https://www.producteev.com/api/tasks/$newTaskID",$updateTaskData,"PUT");

/// Update the task add the desc

$newNoteData='{
  "note":{
    "message":"'.addslashes($_REQUEST['description']).'",
    "task":{
      "id":"'.$newTaskID.'"
    }
  }
}';



$updateTaskNotes=makeAPICall( "https://www.producteev.com/api/notes",$newNoteData,"POST");


//api/notes?access_token=OGRlMWI1YmM5MDEyMjM3M2FkZmQ0ZjI2ZWUwYzJmYzZkOGZiMGJmMjZhZDYzMTliZDdhODY0NThkZjQ0M2UwMQ




//print_r($updateTask);



//// Update the task to add the attached images


//// update the task to add Dev Team as a follower  (or Tom King)
	
	
	
}else{
	?>
	
	
	There was a problem. Please try again.
	
	<?
	
	
}

//print_r($taskData);

/*
//$projectData['content'];
$projectData['content']=str_replace("\/","/",$projectData['content']);

for($i=0;$i<count($tasksToMove);$i++){
$updateTask="";
	print "Updating...";
	print "<br>Looking to move to project id ".$_REQUEST['projectid'].":";
	print "<br>".$tasksToMove[$i];


$taskDataToSend='{"task":'.$projectData['content'].'}';

/// move the task into the project
$updateTask=makeAPICall( "https://www.producteev.com/api/tasks/".$tasksToMove[$i],$taskDataToSend,"PUT");

//print_r($taskDataToSend);
//exit();

//print_r($updateTask);

//print($taskDataToSend);
?>
<?
// {"task":{"labels":["519b6a79bcd3e02c6d0000ba"]}} 

// remove the label from the task
//$updateTask=makeAPICall("https://www.producteev.com/api/tasks/".$tasksToMove[$i]."/labels/".$_REQUEST['labelid'],"","DELETE");


*/
 


?>	










<?	
}  /// End Producteev Session Check

include_once("footer.php");
?>

