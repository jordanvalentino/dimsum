<?php 
session_start();

$numOfAlternative = $_SESSION['alternative']['count']; 
?>

<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="css/custom.css" type="text/css">

<div class="container">
    <div class="col-md-14">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="heading">Alternative Names</h3>
            </div>
            <div class="panel-body some-space">
				<form method="POST" action="#">
					<?php
						for($i = 0; $i < $numOfAlternative; $i++)
						{
							$margin="top-5";
							if($i==0) $margin="";
							echo '<div class="row"><label class="control-label col-md-2 right top-10">Alternative #'. ($i+1) .'</label>';echo '<input type="text" class="form-control col-md-2 '.$margin. '" name="alt-'.$i.'" ';
							if(isset($_SESSION['alternative'][$i]['name'])) {
								echo 'value="'.$_SESSION['alternative'][$i]['name'].'"';
							}
							echo '></div>';
						}
					?>
					<br>
					<div class="row">
						<input type="submit" name="save" value="Save" class="btn btn-black bold col-md-1 offset-2">
					</div>
				</form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/jquery-1.11.1.js"></script>

<?php 
if(isset($_POST['save']))
{
	for($i = 0; $i < $numOfAlternative; $i++)
	{
		$_SESSION['alternative'][$i]['name'] = ucwords($_POST['alt-'.$i]);
	}

	echo "<script> window.location.href='page-value.php'; </script>";
}
?>