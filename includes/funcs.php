<?php
	//Per 100g
	$cals = 3.62;
	$protein = 0.267;
	$carbs = 0.58;
	$fat = 0.03;

	function showBatches($dbc){
		$query = "SELECT * FROM batch ORDER BY id DESC";
		@$result = $dbc->query($query);
	    @$count = $result->num_rows;

	    if($count == 0){
	    	echo 	"<a href=\"add.php\" class=\"list-group-item list-group-item-action text-center\">
                		Kunne ikke finde nogle batches.
                    </a>";
	    }else{
	    	while($batch = $result->fetch_array()){
	    		echo    "<a href=\"batch.php?id=".$batch['id']."\" class=\"list-group-item list-group-item-action\">
                			<b>".$batch['date']."</b><br>
                            ".$batch['milliliter']."ml supper<br>
                            ".$batch['gram']."g linser
                    	</a>";
	    	}
	    }

	}

	function addBatch($milliliter, $gram, $dbc){
		$error = false;
		if(!ctype_digit($milliliter) || !ctype_digit($gram)){
			echo	"<div class=\"alert alert-warning\" role=\"alert\">
						Kun tal er tilladt! 
					</div>";
			$error = true;
		}

		if(!$error){
			$date = date('d-m-Y');
			$time = date('G:i');
			$date_ = $date." kl. ".$time;
			$query = $dbc->prepare("INSERT INTO `batch` (`date`, `milliliter`, `gram`) VALUES (?, ?, ?)");
            $query->bind_param("sii", $date_, $milliliter, $gram);
            $query->execute();

            echo	"<div class=\"alert alert-success\" role=\"alert\">
						Batch tilføjet! 
					</div>";

			echo    "<script type=\"text/javascript\">setTimeout(function(){ window.location = \"index.php\"; },800);</script>";
		}
	}

	function nutri100($milliliter, $grams){
		$cals = 3.62;
		$protein = 0.267;
		$carbs = 0.58;
		$fat = 0.03;

		$calories = number_format((float)$grams * $cals / $milliliter * 100, 2, '.', '');
		$protein_ = number_format((float)$grams * $protein / $milliliter * 100, 2, '.', '');
		$carbs_ = number_format((float)$grams * $carbs / $milliliter * 100, 2, '.', '');
		$fats_ = number_format((float)$grams * $fat / $milliliter * 100, 2, '.', '');
		echo 	"<b>Kalorier:</b> ".$calories."<br>
               	<b>Protein:</b> ".$protein_."g<br>
                <b>Kulhydrater:</b> ".$carbs_."g<br>
				<b>Fedt:</b> ".$fats_."g<hr>";
	}

	function consume($batch_id, $milliliter, $dbc){
		$error = false;
		if(!ctype_digit($milliliter)){
			echo	"<div class=\"alert alert-warning\" role=\"alert\">
						Kun tal er tilladt! 
					</div>";
			$error = true;
		}

		if(!$error){
			$date = date('d-m-Y');
			$time = date('G:i');
			$date_ = $date." kl. ".$time;
			$query = $dbc->prepare("INSERT INTO `consumption` (`date`, `milliliter`, `batch_id`) VALUES (?, ?, ?)");
            $query->bind_param("sii", $date_, $milliliter, $batch_id);
            $query->execute();

            echo	"<div class=\"alert alert-success\" role=\"alert\">
						".$milliliter."ml er blivet tilføjet! 
					</div>";

			echo    "<script type=\"text/javascript\">setTimeout(function(){ window.location = \"batch.php?id=".$batch_id."\"; },800);</script>";
		}

	}
?>