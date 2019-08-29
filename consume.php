<?php
    require("includes/config.php");
    require("includes/funcs.php");
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

        <title>Indtag</title>
    </head>
    <body ontouchstart>

        <div class="container-fluid h-100">
            <div class="row justify-content-center">
                
                <div class="col-md-4">
                    <div class="box">
                        <h5>Indtag</h5>
                        <a href="batch.php?id=<?php echo $_GET['id'];?>" role="button" class="btn btn-primary w-100">Tilbage</a><hr>
                        <?php if(@$_POST['submit']) consume($_GET['id'], @$_POST['milliliter'], $dbc);?>
                        <form action="" method="post">
                            <label>Hvor mange milliliter?</label>
                            
                            <div class="input-group mb-3">
                                <input id="milliliter" name="milliliter" type="text" class="form-control" placeholder="fx. 350" aria-label="milliliter consumed" aria-describedby="btn-175">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary" type="button" id="btn-175" onclick="consume175()">175ml</button>
                                </div>
                            </div>

                            <input type="submit" class="btn btn-primary w-100" name="submit" value="Indtag">
                        </form>                       

                        <!--<hr><div class="list-group">
                            <a class="list-group-item list-group-item-action">
                                <center style="font-weight: bold;">Næringsindhold pr. 175ml</center>
                                <b>Kalorier:</b> 125<br>
                                <b>Protein:</b> 24g<br>
                                <b>Kulhydrater:</b> 17g<br>
                                <b>Fedt:</b> 8g
                            </a>
                        </div>-->

                    </div>
                </div>

            </div>
        </div>

        <!-- Optional JavaScript -->
        <script>
        function consume175() {
          document.getElementById('milliliter').value = 175;
        }
        </script>
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </body>
</html>