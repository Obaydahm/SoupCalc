<?php
    require("includes/config.php");
    require("includes/funcs.php");

    $batchPrep = $dbc->prepare("SELECT * FROM `batch` WHERE `id` = ?");
    $batchPrep->bind_param("i", $_GET['id']);
    $batchPrep->execute();
    $batchPrepResult = $batchPrep->get_result();
    if($batchPrepResult->num_rows == 1) $batch = $batchPrepResult->fetch_array();
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-6jHF7Z3XI3fF4XZixAuSu0gGKrXwoX/w3uFPxC56OtjChio7wtTGJWRW53Nhx6Ev" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/custom.css">

        <title>Batch</title>
    </head>
    <body ontouchstart>

        <div class="container-fluid h-100">
            <div class="row justify-content-center">
                
                <div class="col-md-4">
                    <div class="box">
                        <h5>Batch</h5>
                        <a href="index.php" role="button" class="btn btn-primary w-100">Tilbage</a>
                    <?php
                        if($batchPrepResult->num_rows != 1){
                            echo    "<div class=\"list-group\" style=\"padding-top: 10px;\">
                                        <a class=\"list-group-item list-group-item-action text-center\">
                                            Batch findes ikke.
                                        </a>
                                    </div>";
                        }else{
                    ?>
                        <a href="consume.php?id=<?php echo $_GET['id']; ?>" role="button" class="btn btn-primary w-100" style="margin-top: 5px;">Indtag</a>
                        <hr>

                        <div style="font-size: 14px;">
                            <b>Dato:</b> <?php echo $batch['date']; ?><br>
                            <b>Suppe lavet:</b> <?php echo $batch['milliliter']; ?>ml<br>
                            <b>Linser brugt:</b> <?php echo $batch['gram']; ?>g
                            <hr>

                            <b>Per 100ml suppe:</b><br>
                            <?php nutri100($batch['milliliter'], $batch['gram']);?>
                        </div>

                        <h6 class="text-center">Indtaget</h3>

                        <div class="list-group">

                            <?php
                                $conQuery = $dbc->prepare("SELECT * FROM consumption WHERE batch_id = ? ORDER BY id DESC");
                                $conQuery->bind_param("i", $_GET['id']);
                                $conQuery->execute();
                                $conQueryResult = $conQuery->get_result();
                                @$conCount = $conQueryResult->num_rows;

                                if($conCount == 0){
                                    echo    "<a href=\"consume.php?id=".$_GET['id']."\" class=\"list-group-item list-group-item-action text-center\">
                                                Der er ikke blevet indtaget noget endnu.
                                            </a>";
                                }else{
                                    while($con = $conQueryResult->fetch_array()){
                                        echo    "<a class=\"list-group-item list-group-item-action\">
                                                    ".$con['date']."<br>
                                                    ".$con['milliliter']."ml suppe<br>
                                                    <b>Kalorier:</b> ".number_format((float)$batch['gram'] * $cals / $batch['milliliter'] * $con['milliliter'], 2, '.', '')."<br>
                                                    <b>Protein:</b> ".number_format((float)$batch['gram'] * $protein / $batch['milliliter'] * $con['milliliter'], 2, '.', '')."g<br>
                                                    <b>Kulhydrater:</b> ".number_format((float)$batch['gram'] * $carbs / $batch['milliliter'] * $con['milliliter'], 2, '.', '')."g<br>
                                                    <b>Fedt:</b> ".number_format((float)$batch['gram'] * $fat / $batch['milliliter'] * $con['milliliter'], 2, '.', '')."g
                                                </a>";
                                    }

                                    $conSum = $dbc->prepare("SELECT sum(milliliter) FROM `consumption` WHERE `batch_id` = ?");
                                    $conSum->bind_param("i", $_GET['id']);
                                    $conSum->execute();
                                    $conSumResult = $conSum->get_result();
                                    if($conSumResult->num_rows == 1) $conSumFetch = $conSumResult->fetch_array();
                                
                            ?>

                            <a class="list-group-item list-group-item-action list-group-item-primary">
                                <b>Samlet indtag</b><br>
                                <?php echo $conSumFetch[0]; ?>ml suppe<br>
                                <b>Kalorier:</b> <?php echo number_format((float)$batch['gram'] * $cals / $batch['milliliter'] * $conSumFetch[0], 2, '.', '');?><br>
                                <b>Protein:</b> <?php echo number_format((float)$batch['gram'] * $protein / $batch['milliliter'] * $conSumFetch[0], 2, '.', '');?>g<br>
                                <b>Kulhydrater:</b> <?php echo number_format((float)$batch['gram'] * $carbs / $batch['milliliter'] * $conSumFetch[0], 2, '.', '');?>g<br>
                                <b>Fedt:</b> <?php echo number_format((float)$batch['gram'] * $fat / $batch['milliliter'] * $conSumFetch[0], 2, '.', '');?>g
                            </a>
                        <?php } ?>

                        </div>
                    <?php } ?>
                    </div>
                </div>

            </div>
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </body>
</html>