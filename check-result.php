<?php

require_once __DIR__ . '/vendor/autoload.php';
use Phpml\Math\Matrix;

require_once('function-ahp.php');



session_start();

$numOfCriteria = $_SESSION['criteria']['count'];
$numOfAlternative = $_SESSION['alternative']['count'];

// echo json_encode($_POST['crit']);

$response = '';
$matrix = [];

// CRITERIA //
$matrix = new Matrix($_POST['crit']);
$result = ahp_process($matrix);
if($result == null) $response .= 'Inter-Criteria;';


// ALTERNATIVE-CRITERIA //
for($i = 0; $i < $numOfCriteria; $i++)
{
    $matrix = new Matrix($_POST['alt'][$i]);
    $result = ahp_process($matrix);
    if($result == null) $response .= 'Criteria '.$_SESSION['criteria'][$i]['name'].';';
}

// ALTERNATIVE-SUBCRITERIA //
for($i = 0; $i < $numOfCriteria; $i++)
{
    if(!isset($_POST['subcrit'][$i])) continue;
    for($j = 0; $j < count($_POST['subcrit'][$i]); $j++)
    {
        $matrix = new Matrix($_POST['subcrit'][$i][$j]);
        $result = ahp_process($matrix);
        if($result == null) $response .= 'Subcriteria '.$_SESSION['criteria'][$i]['subcriteria'][$j]['name'].';';
    }
}


echo $response;

?>