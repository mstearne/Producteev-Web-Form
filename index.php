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




?>	
	
                <article>
                    <header>
                        <h1>Fill out this form to start a new development or creative task</h1>
                        <p>Fill out the form below to create a new task for the development and creative team.</p>
                    </header>
                    <section>


                        <p>
	                        
	                        

<form class="form-horizontal" action="addTask.php" method="post">
<fieldset>

<!-- Form Name -->
<legend>Create Task</legend>


<!-- Select Basic -->
<div class="control-group">
  <label class="control-label" for="project">Select Client</label>
  <div class="controls">
    <select id="project" name="project" class="input-xlarge">
    <?
/// need to call multiple times because only 50 at a time are returned

if(file_exists("tmp/projects.txt")&&(time()-filemtime("tmp/projects.txt") < 23 * 3600)){


	print file_get_contents("tmp/projects.txt");

}else{

unlink("tmp/projects.txt");
ob_start();

	for($j=1;$j<6;$j++){
	
	$projects=makeAPICall("https://www.producteev.com/api/networks/".$producteevNetworkID."/projects?page=$j");
	$projectsObj=json_decode($projects['content']);
	//print_r($projectsObj);
	
	
	    $projectsArray=$projectsObj->projects;
	    for($i=0;$i<count($projectsArray);$i++){
		    
		    ?>
		  <option value="<?=$projectsArray[$i]->id?>"><?=$projectsArray[$i]->title?></option>  
		    <?
		    
	    }
	
	}    

$cacheFile=ob_get_contents();

file_put_contents("tmp/projects.txt", $cacheFile);

ob_end_flush();
	
}
    ?>
    
    </select>
  </div>
</div>


<!-- Select Basic -->
<div class="control-group">
  <label class="control-label" for="label">Select Task Type:</label>
  <div class="controls">
    <select id="labelid" name="labelid" class="input-xlarge">
    <?
/// need to call multiple times because only 50 at a time are returned

if(file_exists("tmp/tasks.txt")&&(time()-filemtime("tmp/tasks.txt") < 22 * 3600)){

	print file_get_contents("tmp/tasks.txt");

}else{

unlink("tmp/tasks.txt");

ob_start();



for($j=1;$j<12;$j++){

$labels=makeAPICall("https://www.producteev.com/api/networks/".$producteevNetworkID."/labels?page=$j");
$labelsObj=json_decode($labels['content']);
//print_r($labelsObj);


    $labelsArray=$labelsObj->labels;
    for($i=0;$i<count($labelsArray);$i++){
	    
	    
	    
	    if(substr($labelsArray[$i]->title, 5,3)=="---"){
	    
	    switch (substr($labelsArray[$i]->title, 0,1)){
		    
		    case 1:
		    	$prefix="SEO/Social";
		    break;
		    case 2:
		    	$prefix="PPC";
		    break;
		    case 3:
		    	$prefix="WEB";
		    break;
		    
	    }
	    ?>
	    
	  <option value="<?=$labelsArray[$i]->id?>"><?=$prefix?> client <?= str_replace("-", " ", substr($labelsArray[$i]->title,8,strlen($labelsArray[$i]->title)-7))?></option>  
	    <?
	    }
    }

}    

$cacheFile=ob_get_contents();

file_put_contents("tmp/tasks.txt", $cacheFile);

ob_end_flush();
	
}


    ?>
    
    </select>
  </div>
</div>



<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="taskname">Task Name</label>
  <div class="controls">
    <input id="taskname" name="taskname" type="text" placeholder="" class="input-xlarge" required="required" style="width:100%;">
    
  </div>
</div>

<!-- Textarea -->
<div class="control-group">
  <label class="control-label" for="description">Task Description</label>
  <div class="controls">                     
    <textarea id="description" name="description" required="required" class="field span12" style="width:100%;height:100px" ></textarea>
  </div>
</div>






  
  
  
  <script type="text/javascript" src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
  <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
  
<!--   <link rel="stylesheet" type="text/css" href="/css/result-light.css"> -->
  
    
  
  <style type='text/css'>

.date-form { margin: 10px; }
label.control-label i { cursor: pointer; }
  </style>
  


<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){
$(".date-picker").datepicker();

$(".date-picker").on("change", function () {
    var id = $(this).attr("id");
    var val = $("label[for='" + id + "']").text();
});
});//]]>  

</script>


<div class="control-group">
  <label class="control-label" for="due">Desired Completion Date</label>
</div>


    
            <div class="input-group" style="width:225px">
                <input id="date-picker-2" type="text" class="date-picker form-control" name="duedate" required="required"/>
                <label for="date-picker-2" class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i>

                </label>
            </div>
















<!-- Button -->
<div class="control-group">
  <label class="control-label" for="submittask"></label>
  <div class="controls">
    <button id="submittask" name="submittask" class="btn btn-primary">Create Task</button>
  </div>
</div>


</fieldset>
</form>

	                        
                        </p>
                    </section>















































	
	
<?	
}  /// End Producteev Session Check

include_once("footer.php");
?>

