<?php
session_start();
session_unset();
?>

<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="css/custom.css" type="text/css">
<body>
	<div class="container">
        <div class="col-md-14">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="heading">Welcome!</h1>
					<h3>Start using our awesome AHP Method right away!</h3>
                </div>
                <div class="panel-body some-space">
                	<form method="POST" action="#">
						<input id="btn-submit" type="submit" name="new" value="GET STARTED" class="btn btn-black bold">
					</form>
                </div>
            </div>
        </div>
	</div>
</body>
<script type="text/javascript" src="js/jquery-1.11.1.js"></script>

<?php
if(isset($_POST['new'])) 
    echo "<script> window.location.href='page-index.php'; </script>";
?>