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

        <title>Tilføj batch</title>
    </head>
    <body ontouchstart>

        <div class="container-fluid h-100">
            <div class="row justify-content-center">
                
                <div class="col-md-4">
                    <div class="box">
                		<h5>Tilføj batch</h5>
                        <a href="index.php" role="button" class="btn btn-primary w-100">Tilbage</a><hr>
                        <?php if(@$_POST['submit']){ addBatch($_POST['milliliter'], $_POST['gram'], $dbc); } ?>
                        <form action="" method="post">
                        	<label>Hvor mange milliliter blev der lavet?</label>
                        	<input class="form-control" type="text" name="milliliter" placeholder="fx. 1500"><br>

                        	<label>Hvor mange gram linser blev der brugt?</label>
                        	<input class="form-control" type="text" name="gram" placeholder="fx. 300"><br>

                        	<input type="submit" class="btn btn-primary w-100" name="submit" value="Tilføj batch">

                        </form>

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