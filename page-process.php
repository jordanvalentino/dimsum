<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="css/custom.css" type="text/css">

<?php

require_once __DIR__ . '/vendor/autoload.php';
use Phpml\Math\Matrix;

require_once('function-ahp.php');

session_start();

$_SESSION['value']['crit'] = $_POST['crit'];
$_SESSION['value']['alt'] = $_POST['alt'];
$_SESSION['value']['subcrit'] = isset($_POST['subcrit']) ? $_POST['subcrit'] : null;

$code = explode('-', $_POST['hidden']);
$matrix = null;

if($code[0] == 'crit') {
    $matrix = new Matrix($_POST['crit']);
}
else if($code[0] == 'alt') {
    $crit = $code[1];
    $matrix = new Matrix($_POST['alt'][$crit]);
}
else if($code[0] == 'sub') {
    $crit = $code[1];
    $sub = $code[2];
    $matrix = new Matrix($_POST['subcrit'][$crit][$sub]);
}

echo '<body>';
echo '<div class="container mt-3 mb-3 py-3">';
echo '<div><button class="btn btn-danger mb-5">Back to Values</button></div>';

$EIGENVECTOR = ahp_process($matrix, $isDebug = TRUE);

echo '<div><button class="btn btn-danger mt-5">Back to Values</button></div>';
echo '</div>';
echo '</body>';

?>

<script type="text/javascript" src="js/jquery-1.11.1.js"></script>
<script>

$('.btn').on('click', function() {
    window.history.back();
});

</script>