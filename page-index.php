<?php 
session_start();
?>

<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="css/custom.css" type="text/css">

<div class="container">
    <div class="col-md-14">
        <div class="panel panel-default">
            <div class="panel-heading">
				<h3 class="heading">Number of Criteria and Alternative</h3>
            </div>
            <div class="panel-body some-space">
				<form method="POST" action="#">
					<div class="row">
						<label class="col-md-2 control-label right top-5">Number of Criteria</label>
						<div class="col-md-2"><input id="inp-crit" type="number" class="form-control" name="numOfCriteria" min=2 max=6 
						<?php 
							if(isset($_SESSION['criteria']['count'])) {
								echo 'value='.$_SESSION['criteria']['count'];
							}
						?>
						></div>
					</div>
					<div class="row top-10">
						<label class="col-md-2 control-label right top-5">Number of Alternative</label>
						<div class="col-md-2"><input id="inp-alt" type="number" class="form-control" name="numOfAlternative" min=2 max=6 
						<?php 
							if(isset($_SESSION['criteria']['count'])) {
								echo 'value='.$_SESSION['alternative']['count'];
							}
						?>
						></div>
					</div>
					<div class="row top-10">
						<label class="col-md-2 control-label right top-5"></label>
						<div class="col-md-2"><input type="submit" name="save" value="Save" class="btn btn-black bold"></div>
					</div>
				</form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/jquery-1.11.1.js"></script>
<script>

$(document).ready(function() {
	if("<?php echo isset($_SESSION['criteria']['count']) ?>" == 0) {
		$('#inp-crit').val(2);
		$('#inp-alt').val(2);
	}
});

$('input[type="number"]').on('focusout', function() {
	
	var val = parseInt($(this).val());
	var max = parseInt($(this).attr('max'));
	var min = parseInt($(this).attr('min'));
	
	if(val > max) $(this).val(max);
	else if(val < min) $(this).val(min);
	else if($(this).val() == "") $(this).val(min);
});

</script>

<?php
if(isset($_POST['save']))
{
	$_SESSION['criteria']['count'] = $_POST['numOfCriteria'];
	$_SESSION['alternative']['count'] = $_POST['numOfAlternative'];

	echo "<script> window.location.href='page-criteria.php'; </script>";
}
?>