<?php 
session_start();

$numOfCriteria = $_SESSION['criteria']['count'];
$numOfSubcriteria = []; 
for($i = 0; $i < $numOfCriteria; $i++)
{
	$numsub = $_SESSION['criteria'][$i]['subcriteria']['count'];
	$numOfSubcriteria[$i] = $numsub;
}
?>

<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="css/custom.css" type="text/css">

<div class="container">
    <div class="col-md-14">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="heading">Subcriteria Names</h3>
            </div>
            <div class="panel-body some-space">
				<form method="POST" action="#">
					<?php

						for($i = 0; $i < $numOfCriteria; $i++)
						{
							for($j = 0; $j < $numOfSubcriteria[$i]; $j++)
							{
								echo '<div class="row"><label class="control-label col-md-2 right top-10">Subcriteria #'.($i+1).'.'.($j+1) .'</label>';
								echo '<input type="text" class="form-control col-md-2 top-5" name="sub-'.$i.'-'.$j.'" ';
								if(isset($_SESSION['criteria'][$i]['subcriteria'][$j]['name'])) {
									echo 'value="'.$_SESSION['criteria'][$i]['subcriteria'][$j]['name'].'"';
								}
								echo '></div>';
							}
							if($numOfSubcriteria[$i] > 0) echo '<hr>';
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
	for($i = 0; $i < $numOfCriteria; $i++)
	{
		for($j=0;$j<$numOfSubcriteria[$i];$j++)
		{
			$_SESSION['criteria'][$i]['subcriteria'][$j]['name'] = ucwords($_POST['sub-'.$i.'-'.$j]);
		}
	}

	echo "<script> window.location.href='page-alternative.php'; </script>";
}
?>