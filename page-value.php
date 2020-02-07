<?php
session_start();

$numOfCriteria = $_SESSION['criteria']['count'];
$numOfAlternative = $_SESSION['alternative']['count'];

$criterias = [];
for($i = 0; $i < $numOfCriteria; $i++)
{
    $criterias[] = $_SESSION['criteria'][$i]['name'];
}

$alternatives = [];
for($i = 0; $i < $numOfAlternative; $i++)
{
    $alternatives[] = $_SESSION['alternative'][$i]['name'];
}

$subCriterias = []; 
for($i = 0; $i < $numOfCriteria; $i++)  
{
    $subCount = $_SESSION['criteria'][$i]['subcriteria']['count'];
    for($j = 0; $j < $subCount; $j++)
    {
        if($subCount > 0)
        {
            $subname = $_SESSION['criteria'][$i]['subcriteria'][$j]['name'];
            $subCriterias[$i][$j] = $subname;
        }
    }
}
?>

<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="css/custom.css" type="text/css">   

<div class="container">
    <div class="col-md-14">
        <div class="panel panel-default">
            <div class="panel-body some-space">
               <form id="formData">
                    <?php
                        echo '<h3>Criteria Value</h3>';
                        echo '<table>';
                        echo '<tr>';

                        for($i = 0; $i <= $numOfCriteria; $i++)
                        {
                            if($i == 0)
                            {
                                echo '<th><span></span></th>';
                                continue;
                            }
                            echo '<th>'.$criterias[$i-1].'</th>';
                        }
                        echo '</tr>';

                        for($i = 0; $i < $numOfCriteria; $i++)
                        {
                            $disabled = "";
                            $triangle = "tri-up";

                            echo '<tr>';
                            echo '<th>'.$criterias[$i].'</th>';
                            for($j = 0; $j < $numOfCriteria; $j++)
                            {
                                echo '<td>';

                                if($i > $j) $triangle = "tri-down";
                                else $triangle = "tri-up";

                                if($i == $j) {
                                    $readonly = "readonly"; 
                                    $triangle = "";
                                }
                                else $readonly = "";
                                
                                echo '<input style="width:75px;" type="number" name="crit['.$i.'][]" min=0 step=any '.$readonly.' class="crit '.$triangle.'" data-row='.$i.' data-col='.$j;
                                if(isset($_SESSION['value']['crit'])) {
                                    echo ' value='.$_SESSION['value']['crit'][$i][$j];
                                } else {
                                    echo ' value=1';
                                }
                                echo '>';
                            }
                            echo '</tr>';
                        }
                        echo '</table>';
                        echo '<button class="btn btn-dark mt-2 btn-preview" data-type="crit">Preview Process</button><br>';
                    ?>

                    <hr><hr>
                    
                    <?php
                    for($c = 0; $c < $numOfCriteria; $c++)
                    {
                        $numsub = $_SESSION['criteria'][$c]['subcriteria']['count'];
                        echo '<h4>Alternative value for criteria '.$criterias[$c].'</h4>';
                        echo '<table>';
                        echo '<tr>';
                        if($numsub == 0)
                        {
                            for($i = 0; $i <= $numOfAlternative; $i++)
                            {
                                if($i == 0)
                                {
                                    echo '<th><span></span></th>';
                                    continue;
                                }
                                echo '<th>'.$alternatives[$i-1].'</th>';
                            }
                            echo '</tr>';

                            for($i = 0; $i < $numOfAlternative; $i++)
                            {
                                $disabled = "";
                                $triangle = "tri-up";

                                echo '<tr>';
                                echo '<th>'.$alternatives[$i].'</th>';
                                for($j = 0; $j < $numOfAlternative; $j++)
                                {
                                    echo '<td>';

                                    if($i > $j) $triangle = "tri-down";
                                    else $triangle = "tri-up";

                                    if($i == $j) {
                                        $readonly = "readonly"; 
                                        $triangle = "";
                                    }
                                    else $readonly = "";

                                    echo '<input style="width:75px;" type="number" name="alt['.$c.']['.$i.'][]" min=0 step=any '.$readonly.' class="alt '.$triangle.'" data-crit='.$c.' data-row='.$i.' data-col='.$j;
                                    if(isset($_SESSION['value']['alt'])) {
                                        echo ' value='.$_SESSION['value']['alt'][$c][$i][$j];
                                    } else {
                                        echo ' value=1';
                                    }
                                    echo '>';
                                }
                                echo '</tr>';
                            }
                        }
                        else
                        {
                            $subnum=0;
                            for($i = 0; $i <= $numsub; $i++)
                            {
                                if($i == 0)
                                {
                                    echo '<th><span></span></th>';
                                    continue;
                                }
                                echo '<th>'.$_SESSION['criteria'][$c]['subcriteria'][$i-1]['name'].'</th>';
                            }
                            echo '</tr>';

                            for($i = 0; $i < $numsub; $i++)
                            {
                                $disabled = "";
                                $triangle = "tri-up";

                                echo '<tr>';
                                echo '<th>'.$_SESSION['criteria'][$c]['subcriteria'][$i]['name'].'</th>';
                                for($j = 0; $j < $numsub; $j++)
                                {
                                    echo '<td>';

                                    if($i > $j) $triangle = "tri-down";
                                    else $triangle = "tri-up";

                                    if($i == $j) {
                                        $readonly = "readonly"; 
                                        $triangle = "";
                                    }
                                    else $readonly = "";

                                    echo '<input style="width:75px;" type="number" name="alt['.$c.']['.$i.'][]" min=0 step=any '.$readonly.' class="alt '.$triangle.'" data-crit='.$c.' data-row='.$i.' data-col='.$j;
                                    if(isset($_SESSION['value']['alt'])) {
                                        echo ' value='.$_SESSION['value']['alt'][$c][$i][$j];
                                    } else {
                                        echo ' value=1';
                                    }
                                    echo '>';
                                }
                                echo '</tr>';
                            }
                        }
                        echo '</table>';
                        echo '<button class="btn btn-dark mt-2 btn-preview" data-type="alt" data-crit='.$c.'>Preview Process</button><br>';
                        echo '<br>';

                        for($sub = 0; $sub < $numsub; $sub++)
                        {
                            echo '<h4>Alternative value for subcriteria '.$subCriterias[$c][$sub].'</h4>';
                            echo '<table>';
                            echo '<tr>';
                            for($i = 0; $i <= $numOfAlternative; $i++)
                            {
                                if($i == 0)
                                {
                                    echo '<th><span></span></th>';
                                    continue;
                                }
                                echo '<th>'.$alternatives[$i-1].'</th>';
                            }
                            echo '</tr>';

                            for($i = 0; $i < $numOfAlternative; $i++)
                            {
                                $disabled = "";
                                $triangle = "tri-up";

                                echo '<tr>';
                                echo '<th>'.$alternatives[$i].'</th>';
                                for($j = 0; $j < $numOfAlternative; $j++)
                                {
                                    echo '<td>';

                                    if($i > $j) $triangle = "tri-down";
                                    else $triangle = "tri-up";

                                    if($i == $j) {
                                        $readonly = "readonly"; 
                                        $triangle = "";
                                    }
                                    else $readonly = "";

                                    echo '<input style="width:75px;" type="number" name="subcrit['.$c.']['.$sub.']['.$i.'][]" min=0 step=any '.$readonly.' class="subcrit '.$triangle.'" data-crit='.$c.' data-sub='.$subCriterias[$c][$sub].' data-row='.$i.' data-col='.$j;
                                    if(isset($_SESSION['value']['subcrit'])) {
                                        echo ' value='.$_SESSION['value']['subcrit'][$c][$sub][$i][$j];
                                    } else {
                                        echo ' value=1';
                                    }
                                    echo '>';
                                }
                                echo '</tr>';
                            }
                            echo '</table>';
                            echo '<button class="btn btn-dark mt-2 btn-preview" data-type="subcrit" data-crit='.$c.' data-sub='.$sub.'>Preview Process</button><br>';
                            echo '<br>';
                        }
                        echo '<hr><hr><br>';
                    }
                    ?>
                    <div class="row">
                        <input id="btnSubmit" type="button" name="save" value="Save" class="btn btn-black bold col-md-1 offset-5">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/jquery-1.11.1.js"></script>
<script>
$('.crit').on('input propertychange paste', function(){
    var row = $(this).data('row');
    var col = $(this).data('col');

    if($(this).val() != (null || ""))
    {
        var perValue = 0;
        if($(this).val() != 0) perValue = 1/$(this).val();
        var target = $('.crit[data-row='+col+'][data-col='+row+']').val(perValue);
    }
});

$('.alt').on('input propertychange paste', function(){
    var crit = $(this).data('crit');
    var row = $(this).data('row');
    var col = $(this).data('col');

    if($(this).val() != (null || ""))
    {
        var perValue = 0;
        if($(this).val() != 0) perValue = 1/$(this).val();
        var target = $('.alt[data-crit='+crit+'][data-row='+col+'][data-col='+row+']').val(perValue);
    }
});

$('.subcrit').on('input propertychange paste', function(){
    var crit = $(this).data('crit');
    var row = $(this).data('row');
    var col = $(this).data('col');
    var sub = $(this).data('sub');
    
    if($(this).val() != (null || ""))
    {
        var perValue = 0;
        if($(this).val() != 0) perValue = 1/$(this).val();
        var target = $('.subcrit[data-crit='+crit+'][data-sub='+sub+'][data-row='+col+'][data-col='+row+']').val(perValue);
    }
});

$('#btnSubmit').on('click', function()
{
    var formData = new FormData($('#formData')[0]);

    $.ajax({
        url: "check-result.php",
        type: "POST",
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        enctype: "multipart/form-data",
        processData: false,
        success: function(response){

            if(response == "")
            {
                $('#formData').attr('method', 'post');
                $('#formData').attr('action', 'page-result.php');
                $('#formData').submit();
            }
            else {
                var incons = response.split(';');
                incons.pop();
                var error = 'Inconsistent value for:\n';
                for(var i = 0; i < incons.length; i++)
                {
                    error += (i+1)+'. '+incons[i]+'\n';
                }
                alert(error);
            }
        }
    });
});

$('.btn-preview').on('click', function() {

    var type = $(this).data('type');

    if(type == 'crit') {
        $('#formData').prepend('<input type="hidden" name="hidden" value="crit">');
    }
    else if(type == 'alt') {
        $('#formData').prepend('<input type="hidden" name="hidden" value="alt-'+$(this).data('crit')+'">');
    }
    else if(type == 'subcrit') {
        $('#formData').prepend('<input type="hidden" name="hidden" value="sub-'+$(this).data('crit')+'-'+$(this).data('sub')+'">');
    }

    $('#formData').attr('method', 'post');
    $('#formData').attr('action', 'page-process.php');
    $('#formData').submit();
});
</script>