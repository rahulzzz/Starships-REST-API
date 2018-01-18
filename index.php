<?php
	// Redirect to index page to page 1, when website is opened it directly opens page 1
	if($_SERVER['QUERY_STRING'] == ''){
		header('Location: index.php?page=1'); 
	}
	
	$currentPage = $_GET['page'];
	
	// Read the data from the API and save the values.
	$url = "http://swapi.co/api/starships/";
	$data = json_decode(file_get_contents($url), true);
	$results = $data['results'];

	for($i=0; $i<sizeof($results);$i++) {
		$name[$i] = $data['results'][$i]['name'];
		$length[$i] = $data['results'][$i]['length'];
		$crew[$i] = $data['results'][$i]['crew'];
		$passengers[$i] = $data['results'][$i]['passengers'];
		$images[$i]= strtolower(preg_replace("/\s+/","-",$name[$i]));
	}

?>

<html lang="en">
<head>
	<link href="css/style.css" rel="stylesheet"/>
	<link href="css/bootstrap.min.css" rel="stylesheet"/>
	<script src="js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<script src="js/info.js"></script>
	<title>Bootstrap Example</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>

<div class="container text-center" id="header">
	<img src="img/header.jpg" id="headerImage">	
	<h4 id="starships">Starships</h4>
</div>

<div class="container text-center" id="pagination">    
	<div class="row">
		<ul class="pagination" >
			<?php				
				if($currentPage > 1){
					echo "<li><a href = 'index.php?page=".($currentPage-1)."' id='previous'>&laquo;</a></li>";
				}
				$totalPages = sizeof($results)/2;				
				for($i=1; $i<=$totalPages;$i++) {
					echo "<li><a href='index.php?page=".$i."'>$i</a></li>";
				}
				if($currentPage < $totalPages){
					echo "<li><a href = 'index.php?page=".($currentPage+1)."' id='next'>&raquo;</a></li>";
				}
			?>
		</ul> 
	</div>
</div>

<div class="container text-center" id="content">
	<?php
		// Display 2 items per page
		if(isset($_GET['page'])) {
			$pageNo = $_GET['page'];
			$item1 = $pageNo*2-2;
			$item2 = $pageNo*2-1;
			$length = sizeof($name)-1;
			
			if($item1 <= $length-1){
				echo '<div class="row text-left">';
					echo '<div class="col-sm-3">';
						echo "<h4>$name[$item1]\n</h4>";
						echo "<p><b>Length: </b>$length[$item1]\n</p>";
						echo "<p><b>Crew: </b>$crew[$item1]\n</p>";		
						echo "<p><b>Pasengers: </b>$passengers[$item1]\n</p>";
						echo "<button class='btn btn-default btn-sm' data-toggle='modal' data-target='#myModal' id='moreInfo{$item1}'>More Info >></button>";
					echo '</div>';
					echo '<div class="col-sm-3">';
						echo "<div class='col-sm-4'><img src='img/starships/$images[$item1].png' ></div>";
					echo '</div>';
				echo '</div>';
			}
			echo '<br>';
			echo '<hr width="50%">';
			if($item2 <= $length){
				echo '<div class="row text-left">';
					echo '<div class="col-sm-3">';
						echo "<h4>$name[$item2]\n</h4>";
						echo "<p><b>Length: </b>$length[$item2]\n</p>";
						echo "<p><b>Crew: </b>$crew[$item2]\n</p>";		
						echo "<p><b>Pasengers: </b>$passengers[$item2]\n</p>";
						echo "<button class='btn btn-default btn-sm' data-toggle='modal' data-target='#myModal' id='moreInfo{$item2}'>More Info >></button>";
					echo '</div>';
					echo '<div class="col-sm-3">';
						echo "<div class='col-sm-4'><img src='img/starships/$images[$item2].png' ></div>";
					echo '</div>';
				echo '</div>';
			}
		
		}
		
		// Modal for More Info button
		echo "<div class='modal fade' id='myModal' role='dialog'>";
			echo "<div class='modal-dialog modal-lg'>";
				echo "<div class='modal-content'>";
					echo "	<div class='modal-header'  id='dialog'>";
						echo "<button type='button' class='close' data-dismiss='modal'>&times;</button>";
						echo "<h4 class='modal-title' id='modalTitle'></h4>";
					echo "</div>";
					echo "<div class='modal-body'>";
						
						echo "<p><b>Manufacturer</b>: <span id='manufacturer' class='modalDialog'></span></p>";
						echo "<p><b>Starship Class</b>: <span id='starshipClass' class='modalDialog'></span></p>";
						echo "<p><b>Hyperdrive Rating</b>: <span id='hyperdriveRating' class='modalDialog'></span></p>";
						echo "<p><b>Cargo Capacity</b>: <span id='cargoCapacity' class='modalDialog'></span></p>";
						echo "<p><b>Cost in Credits</b>: <span id='costInCredits' class='modalDialog'></span></p>";
						echo "<p><b>Max Atmosphering Speed</b>: <span id='maxAtmospheringSpeed' class='modalDialog'></span></p>";
						echo "<p><b>MGLT</b>: <span id='MGLT' class='modalDialog'></span></p>";
									 
					echo "</div>";
					echo "<div class='modal-footer'>";
						echo "<button type='button' class='btn btn-success' data-dismiss='modal'>Ok</button>";
					echo "</div>";
				echo "</div>";
			echo "</div>";
		echo "</div>";
	?>
</div>

</body>
</html>
