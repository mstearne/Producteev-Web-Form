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

<link rel="stylesheet" href="css/bootstrapValidator.css"/>
<script type="text/javascript" src="js/bootstrapValidator.js"></script>


<form class="form-horizontal" id="create-task-form" action="addTask.php" method="post">
<fieldset>

<!-- Form Name -->
<legend>Create Task</legend>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="project">Select Client</label>
  <div class="col-md-8">
    <select id="project" name="project" class="form-control">
    <?
/// need to call multiple times because only 50 at a time are returned

if(file_exists("tmp/projects.txt")&&(time()-filemtime("tmp/projects.txt") < 23 * 3600)){


	print file_get_contents("tmp/projects.txt");

}else{

unlink("tmp/projects.txt");
ob_start();
?>
			<option></option>
<?
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
<div class="form-group">
  <label class="col-md-4 control-label" for="labelid">Select Task Type</label>
  <div class="col-md-8">
    <select id="labelid" name="labelid" class="form-control" required="required">
    <?
/// need to call multiple times because only 50 at a time are returned

if(file_exists("tmp/tasks.txt")&&(time()-filemtime("tmp/tasks.txt") < 22 * 3600)){

	print file_get_contents("tmp/tasks.txt");

}else{

unlink("tmp/tasks.txt");

ob_start();

?>
			<option></option>
<?


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
<div class="form-group">
  <label class="col-md-4 control-label" for="taskname">Task Name</label>  
  <div class="col-md-8">
  <input id="taskname" name="taskname" placeholder="" class="form-control input-md" required="required" type="text">
    
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="description">Task Description</label>
  <div class="col-md-8">                     
    <textarea class="form-control" id="description" name="description" style="width:100%;height:100px"></textarea>
  </div>
</div>

  
  <style type='text/css'>
.date-form { margin: 10px; }
label.control-label i { cursor: pointer; }
  </style>
  

<script src="js/moment.min.js"></script>
<script src="js/bootstrap-datetimepicker.min.js"></script>

        <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker(
                {
	                pickTime: false;
                });
            });
        </script>
        

            <div class="form-group">
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" name="duedate"/>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        


<div class="form-group">
  <label class="col-md-4 control-label" for="date-picker">Desired Completion Date</label>  
  <div class="col-md-8" id='datetimepicker1'>
<input type='text' class="form-control" name="duedate"/>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    
  <input id="date-picker" type="text" class="date-picker form-control input-md" name="duedate"/><label for="date-picker" class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i></label>
    
  </div>
</div>



<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submittask"></label>
  <div class="col-md-4">
    <button id="submittask" name="submittask" class="btn btn-primary">Create Task</button>
  </div>
</div>

</fieldset>
</form>


	                        
                        </p>
                    </section>








<script>
$(document).ready(function() {


    $('#date-picker')
        .datetimepicker({
            pickTime: false
        })
        .on('dp.change dp.show', function(e) {
            $('#feedbackIconForm')
                .data('bootstrapValidator')
                .updateStatus('dob', 'NOT_VALIDATED', null)
                .validateField('dob');
        });
        
        

    $('#create-task-form').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            taskname: {
                message: 'The Task Name is not valid',
                validators: {
                    notEmpty: {
                        message: 'The Task Name is required and cannot be empty'
                    },
                    stringLength: {
                        min: 10,
                        max: 65,
                        message: 'The Task Name must be more than 10 and less than 65 characters long'
                    }
                }
            },
            description: {
                message: 'The Task Descrption is not valid',
                validators: {
                    notEmpty: {
                        message: 'The Task Descrption is required and cannot be empty'
                    }
                }
            },
            project: {
                message: 'Please select a client',
                validators: {
                    notEmpty: {
                        message: 'Please select a client'
                    }
                }
            },
            labelid: {
                message: 'Please select a task',
                validators: {
                    notEmpty: {
                        message: 'Please select a task'
                    }
                }
            }
        }
    });
}); 

</script>


 










	
	
<?	
}  /// End Producteev Session Check

include_once("footer.php");
?>

