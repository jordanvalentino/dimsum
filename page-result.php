<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="css/custom.css" type="text/css">

<?php

require_once __DIR__ . '/vendor/autoload.php';
use Phpml\Math\Matrix;

require_once('function-ahp.php');



session_start();
$_SESSION['current'] = 'pageresult';

$numOfCriteria = $_SESSION['criteria']['count'];
$numOfAlternative = $_SESSION['alternative']['count'];

$_SESSION['value']['crit'] = $_POST['crit'];
$_SESSION['value']['alt'] = $_POST['alt'];
$_SESSION['value']['subcrit'] = isset($_POST['subcrit']) ? $_POST['subcrit'] : null;



$AHP = [];

// CRITERIA //
$matrix = new Matrix($_POST['crit']);
$AHP['crit'] = ahp_process($matrix)->toArray();

// ALTERNATIVE-CRITERIA //
for($i = 0; $i < $numOfCriteria; $i++)
{
    $matrix = new Matrix($_POST['alt'][$i]);
    $AHP['crit'][$i]['altcrit'] = ahp_process($matrix)->toArray();
}

// ALTERNATIVE-SUBCRITERIA //
for($i = 0; $i < $numOfCriteria; $i++)
{
    if(!isset($_POST['subcrit'][$i])) continue;
    for($j = 0; $j < count($_POST['subcrit'][$i]); $j++)
    {
        $matrix = new Matrix($_POST['subcrit'][$i][$j]);
        $AHP['crit'][$i]['altcrit'][$j]['altsub'] = ahp_process($matrix)->toArray();
    }
}

echo '<div class="container">';

echo '<div><button class="btn btn-success mt-3">Start New</button></div>';

echo '<h3 class="heading">Result</h3>';

echo '<div class="mt-4">';
echo '<h5><i>Summary</i></h5>';
echo '<table border=1>';

for($i = 0; $i < count($AHP['crit']); $i++)
{
    if($i == 0) echo '<tr align=center><th colspan=3 height=45>AHP TABLE</th></tr>';
    echo '<tr><td colspan=3 height=10><span></span></td></tr>';

    echo '<tr align=center align=center>';
    echo '<th colspan=3 width=150 height=35><i>Criteria '.
            ucwords($_SESSION['criteria'][$i]['name']).
            ' ('.round($AHP['crit'][$i][0], 4).')</i></th>';
    echo '</tr>';

    for($j = 0; $j < count($AHP['crit'][$i]['altcrit']); $j++)
    {
        $isSub = isset($AHP['crit'][$i]['altcrit'][$j]['altsub']);
        if($isSub)
        {
            echo '<tr align=center>';
            echo '<td colspan=3 width=150 height=30><i>Sub-Criteria '.
                ucwords($_SESSION['criteria'][$i]['subcriteria'][$j]['name']).
                    ' ('.round($AHP['crit'][$i]['altcrit'][$j][0], 4).')</i></td>';
            echo '</tr>';
            
            for($k = 0; $k < count($AHP['crit'][$i]['altcrit'][$j]['altsub']); $k++)
            {
                echo '<tr align=center>';
                echo '<td width=150 height=25>Alternative</td>';
                echo '<td width=150 height=25>'.ucwords($_SESSION['alternative'][$k]['name']).'</td>';
                echo '<td width=150 height=25>'.round($AHP['crit'][$i]['altcrit'][$j]['altsub'][$k][0], 4).'</td>';
                echo '</tr>';
            }
        }
        else
        {
            echo '<tr align=center>';
            echo '<td width=150 height=25>Alternative</td>';
            echo '<td width=150 height=25>'.ucwords($_SESSION['alternative'][$j]['name']).'</td>';
            echo '<td width=150 height=25>'.round($AHP['crit'][$i]['altcrit'][$j][0], 4).'</td>';
            echo '</tr>';
        }
    }
}

echo '</table></div>';

echo '<div class="mt-5">';
echo '<h5><i>Calculation</i></h5>';

$results = [];
$bestResult = 0.0;
$bestAlternative = "";
for($i = 0; $i < count($_SESSION['alternative'])-1; $i++)
{
    $result = 0.0;
    echo 'Alternative <b>'.ucwords($_SESSION['alternative'][$i]['name']).'</b> : <br>';
    
    for($j = 0; $j < count($AHP['crit']); $j++)
    {
        if($j > 0) echo ' + ';
        for($k = 0; $k < count($AHP['crit'][$j]['altcrit']); $k++)
        {
            $isSub = isset($AHP['crit'][$j]['altcrit'][$k]['altsub']);
            if($isSub)
            {
                $result += $AHP['crit'][$j][0] * $AHP['crit'][$j]['altcrit'][$k][0] * $AHP['crit'][$j]['altcrit'][$k]['altsub'][$i][0];

                if($k > 0) echo ' + ';
                echo '( ';
                echo round($AHP['crit'][$j][0], 4).'*';
                echo round($AHP['crit'][$j]['altcrit'][$k][0], 4).'*';
                echo round($AHP['crit'][$j]['altcrit'][$k]['altsub'][$i][0], 4);
                echo ' )';
            }
            else 
            {
                $result += $AHP['crit'][$j][0] * $AHP['crit'][$j]['altcrit'][$i][0];

                if($k > 0) echo ' + ';
                echo '( ';
                echo round($AHP['crit'][$j][0], 4).'*';
                echo round($AHP['crit'][$j]['altcrit'][$i][0], 4);
                echo ' )';
                break;
            }
        }
    }

    echo ' = <b>'.round($result, 4).'</b>';
    $results[ucwords($_SESSION['alternative'][$i]['name'])] = $result;

    echo '<br><br>';
}
echo '</div>';

echo '<div class="mt-4">';
echo '<h5><i>Ranking</i></h5>';
arsort($results);
$i = 0;
foreach($results as $alt => $value)
{
    echo 'Alternative: '.$alt.' = '.round($value, 5).' - <i>rank #'.($i+1).'</i>';
    if($i == 0) echo ' <b>(BEST)</b>';
    echo '<br>';

    $i++;
}
echo '</div>';

echo '<div><button class="btn btn-success mt-4">Start New</button></div>';

echo '</div>';
?>

<script type='text/javascript' src='js/jquery-1.11.1.js'></script>
<script>


$('.btn').on('click', function() {
    window.location.href = 'index.php';
});

</script>