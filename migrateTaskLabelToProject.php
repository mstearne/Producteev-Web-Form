<?
session_start();

//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');

/*
curl -v -X POST --data '{ "networks":[], "projects":[], "priorities":[4, 5], "statuses":[0], "responsibles":["51e83dd4fa46341808000a58"],"creators":[], "labels":[], "deadline":{}, "created_at":{}, "updated_at":{"from":1372636800, "to":1375315199}, "search":{}}' "https://www.producteev.com/api/tasks/search" --header "Content-Type:application/json" --header "Authorization:Bearer 5Fm-kYL08PpPU3VkYzTbCNO3-Ldzk8-COtjp3_7Xmto"
*/
//print "<br>label id:".$_REQUEST['labelid']." project id:".$_REQUEST['projectid']."<br>";
if($_REQUEST['labelid']&&$_REQUEST['projectid']){
	//print_r($_SESSION);
	include_once("include.php");

	$data='{ "networks":["'.$producteevNetworkID.'"], "projects":[], "priorities":[], "statuses":[0], "responsibles":[],"creators":[], "labels":["'.$_REQUEST['labelid'].'"], "deadline":{}, "created_at":{}, "updated_at":{}, "search":{}}';

?>
<ol>
<?	
$x=0;	
for($j=1;$j<3;$j++){
	
	$tasks=makeAPICall("https://www.producteev.com/api/tasks/search?sort=created_at&order=desc&page=$j",$data);
//	print_r($tasks);
	$tasksObj=json_decode($tasks['content']); 

    $tasksArray=$tasksObj->tasks;
    for($i=0;$i<count($tasksArray);$i++){
	    
	    ?>
	    <li>
	  <strong><?=$tasksArray[$i]->title?></strong> <em>in project <?=$tasksArray[$i]->project->title?></em> 
	  <?print $tasksArray[$i]->id;
	  
	  $tasksToMove[$x++]=$tasksArray[$i]->id;
		  
	  ?>
	    </li>  
	    <?
	    
    }

//	print_r($tasksArray);
 
}	
?>
	    </ol>
<?	    	

///tasks are in $tasksArray
// for each task, add the project id of $_REQUEST['projectid'] and remove the label id of $_REQUEST['labelid']

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
/* {"task":{"labels":["519b6a79bcd3e02c6d0000ba"]}} */

// remove the label from the task
$updateTask=makeAPICall("https://www.producteev.com/api/tasks/".$tasksToMove[$i]."/labels/".$_REQUEST['labelid'],"","DELETE");


/*

curl -v -X DELETE "https://www.producteev.com/api/tasks/51e83db1fa46341808000075/labels/51e83dd6fa46341808000399" --header "Authorization:Bearer 5Fm-kYL08PpPU3VkYzTbCNO3-Ldzk8-COtjp3_7Xmto"


*/


}



}
?>