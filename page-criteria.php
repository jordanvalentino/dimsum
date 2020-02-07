<?php 
session_start();

$numOfCriteria = $_SESSION['criteria']['count'];
?>
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="css/custom.css" type="text/css">

<div class="container">
    <div class="col-md-14">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="heading">Criteria Names</h3>
            </div>
            <div class="panel-body some-space">
				<form id="formData">
					<?php
						for($i = 0; $i < $numOfCriteria; $i++)
						{
							echo '<div class="row">';
							
							// label for criteria name
							echo '<label class="control-label col-md-2 right mb-3">Criteria #'. ($i+1) .'</label>';
							// input for criteria name
							echo '<input type="text" class="form-control col-md-2 mb-2 mr-2" name="crit-'.$i.'" ';
								if(isset($_SESSION['criteria'][$i]['name'])) {
									echo 'value="'.$_SESSION['criteria'][$i]['name']. '"';
								}
							echo ' >';

							// button for adding subcriteria
							echo '<button name="btn-'.$i.'" id="btn-'.$i.'" class="btn col-md-2 mb-2" data-idx='.$i.'>Add Sub-Criteria</button>';

							// label for number of subcriteria
							echo '<label id="number-'.$i.'" class="control-label col-md-1 right number mb-3 ';
								if(isset($_SESSION['criteria'][$i]['subcriteria'])) {
									echo ($_SESSION['criteria'][$i]['subcriteria']['count'] == 0)? 'hide' : '';
								} else { 
									echo 'hide';
								}
							echo '">Number</label>';
							// input for number of subcriteria
							echo '<input id="numsub-'.$i.'" type="number"= class="form-control col-md-1 numsub mb-2 ';
								if(isset($_SESSION['criteria'][$i]['subcriteria'])) {
									echo ($_SESSION['criteria'][$i]['subcriteria']['count'] == 0)? 'hide' : '';
								} else {
									echo 'hide';
								}
							echo '" name="numsub-'.$i.'" min=2 max=3 ';
								if(isset($_SESSION['criteria'][$i]['subcriteria'])) {
									echo ($_SESSION['criteria'][$i]['subcriteria']['count'] == 0)? '' : 'value="'.$_SESSION['criteria'][$i]['subcriteria']['count'].'"';
								}
							echo ' >';

							echo '</div>';
						}
					?>
					<div id="sub-criteria"></div>
					<div class="row top-10">
						<input id="btn-submit" type="button" name="save" value="Save" class="btn btn-black bold col-md-1 offset-2">
						<input type="hidden" name="save" value="true"/>
					</div>
				</form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/jquery-1.11.1.js"></script>
<script>

$(document).ready(function() {

	var numOfCriteria = "<?php echo $numOfCriteria; ?>";

	for(var i = 0; i < numOfCriteria; i++) {

		$('#btn-' + i).click( show( i ) );
	}
});

function show( i ) {

	return function() {
		$('#number-' + i).toggleClass('hide');
		$('#numsub-' + i).toggleClass('hide');

		if($('#numsub-' + i).hasClass("hide"))
		{
			$('#numsub-' + i).val(0);
		}
		else 
		{
			$('#numsub-' + i).val($('#numsub-' + i).attr('min'));
		}

		event.preventDefault();
	}
}

$('#btn-submit').on('click', function() {

	if($('input[type="number"]').hasClass('hide'))
	{
		$('input[type="number"]').removeClass('hide');
		$('label').removeClass('hide');
	}

	$('#formData').attr('method', 'post');
	$('#formData').attr('action', '#');
	$('#formData').submit();
});

</script>

<?php
if(isset($_POST['save']))
{
	$isSub = FALSE;
	for($i = 0; $i < $numOfCriteria; $i++)
	{
		$_SESSION['criteria'][$i]['name'] = ucwords($_POST['crit-'.$i]);
		$_SESSION['criteria'][$i]['subcriteria']['count'] = $_POST['numsub-'.$i];

		if($_POST['numsub-'.$i] > 0) $isSub = TRUE;
	}

	if($isSub)
		echo "<script> window.location.href='page-subcriteria.php'; </script>";
	else
		echo "<script> window.location.href='page-alternative.php'; </script>";
}
?>