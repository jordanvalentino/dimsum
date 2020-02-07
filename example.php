<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">

<?php

require_once __DIR__ . '/vendor/autoload.php';
use Phpml\Math\Matrix;

require_once('function-ahp.php');


// initiate first matrix
$criteria = new Matrix([
    [1,     3,      3,      2,      5,      7],
    [1/3,   1,      2,      2/3,    5/3,    7/3],
    [1/3,   1,      1,      2/3,    5/3,    7/3],
    [1/2,   3/2,    3/2,    1,      5/2,    7/2],
    [1/5,   3/5,    3/5,    2/5,    1,      7/5],
    [1/7,   3/7,    3/7,    2/7,    5/7,    1],
]);

$hargabeli = new Matrix([
    [1,     2,      3,      3],
    [0.5,   1,      3/2,    3/2],
    [1/3,   2/3,    1,      1],
    [1/3,  2/3,    1,      1],
]);

$hargajual = new Matrix([
    [1,     3,      7,      5],
    [1/3,   1,      7/3,    5/3],
    [1/7,   3/7,    1,      5/7],
    [1/5,   3/5,    1.4,    1],
]);

$sparepart = new Matrix([
    [1,     3,      5,      7],
    [1/3,   1,      5/3,    7/3],
    [1/5,   3/5,    1,      7/5],
    [1/7,   3/7,    5/7,    1],
]);

$bahanbakar = new Matrix([
    [1,     3,      5,      5],
    [1/3,   1,      5/3,    5/3],
    [1/5,   3/5,    1,      1],
    [1/5,   3/5,    1,      1],
]);

$model = new Matrix([
    [1,     3,      5,      5],
    [1/3,   1,      5/3,    5/3],
    [1/5,   3/5,    1,      1],
    [1/5,   3/5,    1,      1],
]);

$garansi = new Matrix([
    [1,     3,      5,      7],
    [1/3,   1,      5/3,    7/3],
    [1/5,   3/5,    1,      7/5],
    [1/7,   3/7,    5/7,      1],
]);

$matrix = new Matrix([
    [1,     1/2,    3],
    [2,     1,      4],
    [1/3,   1/4,    1]
]);

// USE THIS TO GET EIGEN VECTOR //
$EIGENVECTOR = ahp_process($matrix, $isDebug = TRUE);
// ---------------------------- //

?>