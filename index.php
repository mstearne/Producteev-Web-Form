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
                        <h1>Fill out this form to start a new Producteev task</h1>
                        <p>Fill out the form below to create a new task for the development and creative team.</p>
                    </header>
                    <section>


                        <p>
	                        
	                        

<form class="form-horizontal">
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
    ?>
    
    </select>
  </div>
</div>


<!-- Select Basic -->
<div class="control-group">
  <label class="control-label" for="label">Select Label</label>
  <div class="controls">
    <select id="label" name="label" class="input-xlarge">
    <?
/// need to call multiple times because only 50 at a time are returned

for($j=1;$j<12;$j++){

$labels=makeAPICall("https://www.producteev.com/api/networks/".$producteevNetworkID."/labels?page=$j");
$labelsObj=json_decode($labels['content']);
//print_r($labelsObj);


    $labelsArray=$labelsObj->labels;
    for($i=0;$i<count($labelsArray);$i++){
	    
	    ?>
	    
	  <option value="<?=$labelsArray[$i]->id?>"><?=$labelsArray[$i]->title?></option>  
	    <?
    }

}    
    ?>
    
    </select>
  </div>
</div>



<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="taskname">Task Name</label>
  <div class="controls">
    <input id="taskname" name="taskname" type="text" placeholder="" class="input-xlarge" required="">
    
  </div>
</div>

<!-- Textarea -->
<div class="control-group">
  <label class="control-label" for="description">Task Description</label>
  <div class="controls">                     
    <textarea id="description" name="description" required=""></textarea>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="due">Desired Due Date</label>
  <div class="controls">
    <input id="due" name="due" type="text" placeholder="" class="input-xlarge" required="">
    
  </div>
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

