<?
session_start();

/*
curl -v -X POST --data '{ "networks":[], "projects":[], "priorities":[4, 5], "statuses":[0], "responsibles":["51e83dd4fa46341808000a58"],"creators":[], "labels":[], "deadline":{}, "created_at":{}, "updated_at":{"from":1372636800, "to":1375315199}, "search":{}}' "https://www.producteev.com/api/tasks/search" --header "Content-Type:application/json" --header "Authorization:Bearer 5Fm-kYL08PpPU3VkYzTbCNO3-Ldzk8-COtjp3_7Xmto"
*/

if($_REQUEST['labelid']){
	//print_r($_SESSION);
	include_once("include.php");

	$data='{ "networks":["'.$producteevNetworkID.'"], "projects":[], "priorities":[], "statuses":[0], "responsibles":[],"creators":[], "labels":["'.$_REQUEST['labelid'].'"], "deadline":{}, "created_at":{}, "updated_at":{}, "search":{}}';

?>
<ol>
<?	
	
for($j=1;$j<3;$j++){
	
	$tasks=makeAPICall("https://www.producteev.com/api/tasks/search?sort=created_at&order=desc&page=$j",$data);
//	print_r($tasks);
	$tasksObj=json_decode($tasks['content']);

    $tasksArray=$tasksObj->tasks;
    for($i=0;$i<count($tasksArray);$i++){
	    
	    ?>
	    <li>
	  <strong><?=$tasksArray[$i]->title?></strong> <em>in project <?=$tasksArray[$i]->project->title?></em> 
	  <?=$tasksArray[$i]->id?>
	    </li>  
	    <?
	    
    }

//	print_r($tasksArray);

}	
?>
	    </ol>
<?	    	
}
?>