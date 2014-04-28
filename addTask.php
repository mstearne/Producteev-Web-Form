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


$projectData=makeAPICall( "https://www.producteev.com/api/projects/".$_REQUEST['projectid']);

//$projectData['content'];
$projectData['content']=str_replace("\/","/",$projectData['content']);

print_r($projectData['content']);
/*

	$taskData='{ "task":["'.$producteevNetworkID.'"], "projects":[], "priorities":[], "statuses":[0], "responsibles":[],"creators":[], "labels":["'.$_REQUEST['labelid'].'"], "deadline":{}, "created_at":{}, "updated_at":{}, "search":{}}';





$projectData=makeAPICall( "https://www.producteev.com/api/projects/".$_REQUEST['projectid']);

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


Logged in.










<?	
}  /// End Producteev Session Check

include_once("footer.php");
?>

