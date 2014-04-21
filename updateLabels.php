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
                        <h1>Match Labels and Projects</h1>
                    </header>
                    <section>


                        <p>
	                        
	                        

<form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Match Projects With Labels</legend>




<!-- Select Basic -->
<div class="control-group">
<<<<<<< HEAD
  <label class="control-label" for="label">Select Label</label>
  <div class="controls">
    <select id="label" name="label" class="input-xlarge">
=======
  <label class="control-label" for="label">Move items with this label:</label>
  <div class="controls">
    <select id="labels" name="labels" class="input-xlarge">
>>>>>>> FETCH_HEAD
    <?
/// need to call multiple times because only 50 at a time are returned

for($j=1;$j<12;$j++){

$labels=makeAPICall("https://www.producteev.com/api/networks/".$producteevNetworkID."/labels?page=$j");
$labelsObj=json_decode($labels['content']);
//print_r($labelsObj);


    $labelsArray=$labelsObj->labels;
    for($i=0;$i<count($labelsArray);$i++){
	    
<<<<<<< HEAD
	    if(substr($labelsArray[$i]->id, 0,3)=="519"){
=======
//	    if(substr($labelsArray[$i]->id, 0,3)=="519"){
>>>>>>> FETCH_HEAD
	    ?>
	    
	  <option value="<?=$labelsArray[$i]->id?>"><?=$labelsArray[$i]->title?></option>  
	    <?
<<<<<<< HEAD
	    }
=======
//	    }
>>>>>>> FETCH_HEAD
    }

}    
    ?>
    
    </select>
  </div>
</div>

<!-- Select Basic -->
<div class="control-group">
<<<<<<< HEAD
  <label class="control-label" for="project">Select Project</label>
  <div class="controls">
    <select id="project" name="project" class="input-xlarge">
=======
  <label class="control-label" for="project">to this project:</label>
  <div class="controls">
    <select id="projects" name="projects" class="input-xlarge">
>>>>>>> FETCH_HEAD
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


<!-- Button -->
<div class="control-group">
  <label class="control-label" for="submittask"></label>
  <div class="controls">
    <button id="submittask" name="submittask" class="btn btn-primary">Update Tasks</button>
  </div>
</div>


</fieldset>
</form>

	                        
                        </p>
                    </section>

<<<<<<< HEAD


	
=======
                    <section>

<div id="taskList">


</div>

                    </section>
<script>

$("#labels").change(function() {

  $.ajax({ url: "getTasksFromLabel.php?labelid="+$("#labels").val(), context: document.body, success: function(data){
  $("#taskList").html("<h3>These tasks will be updated:</h3> "+data);
  }});
});



</script>	
	

>>>>>>> FETCH_HEAD
	
	
<?	
}  /// End Producteev Session Check

include_once("footer.php");
?>

