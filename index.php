<!DOCTYPE html>
<html>
	<?php
		$ProjectVersionNumber = 0.1;
		include "db.php";
		include "cardinal-questgen.php";

		$db = mysqli_connect($MYSQL_HOSTIP,$MYSQL_USER,$MYSQL_PASS,$MYSQL_DATABASE);
		if(!$db) {
		  	exit("Verbindungsfehler: ".mysqli_connect_error());
		}
	?>
	<head>
		<title>
			No Responsible Disclosure List Version <?= $ProjectVersionNumber ?>
		</title>

		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Ubuntu&display=swap" rel="stylesheet">

		<link rel="stylesheet" type="text/css" href="CSS/styles.css">

		<meta charset="UTF-8">
		<meta name="description" content="List of companies which disagree to Responsible Disclosure.">
		<meta name="keywords" content="IT, Responsible, Disclosure, Security, Researcher, legal, organizations">
		<meta name="Author" content="YenLucy">
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	</head>
	
	<body>
		<div class="projectWrapper">
			<div class="projectIntro">
				<h1>No Responsible Disclosure List Version <?= $ProjectVersionNumber ?></h1>
				<p class="introtext">In einer Liste werden hier sämtliche Organisationen und Unternehmen aufgezählt, welche sich auf eindringliche Art weigern, am Responsible Disclosure-Verfahren teilzunehmen. Diese Unternehmen antworten den Sicherheitsforscher*innen, indem sie sie bei den Strafverfolgungsbehörden anzeigen - ganz im Sinne von "Shoot the messenger". Um dem entgegen zu wirken, wurde diese Liste ins Leben gerufen, welche lediglich die verschiedenen Unternehmen und die bekannten Vorfälle dieser Art zusammenträgt.</p>
			</div>
			<div class="table">
				<?php 
					$ergebnis = mysqli_query($db,"SELECT * FROM NoResponsibleDisclosure ORDER BY Name ASC"); 
					$ergebnis = mysqli_fetch_all($ergebnis);
					$count = 0;
					while($ergebnis[$count] !== null) {
						echo '<div class="element">';
						echo '<div class="name">'.$ergebnis[$count][1].'</div>';
						echo '<div class="timeframeyear">'.$ergebnis[$count][2].'</div>';
						echo '<div class="proof">'.$ergebnis[$count][3].'</div>';
						echo '</div>';
						$count = $count + 1;
					}
				?>
			</div>
			<div class="table-insert">
				<h2>Daten hinzufügen</h2>
				<form>
					<div class="table-insert-name">
						<h3>Name der Organisation/Firma:</h3>
						<input type="text" name="organization">
					</div>
					<div class="table-insert-year">
						<h3>Jahr des Zwischenfalls:</h3>
						<input type="number" name="year">
					</div>
					<div class="table-insert-proof">
						<h3>Link als Beweis (News oder ähnliches):</h3>
						<input type="text" name="proof">
					</div>
					<input type="submit" class="table-insert-submit">
				</form>
			</div>
		</div>
		<div class="contact">
			<a href="mailto:contact@better-save-then-sorry.de">contact@better-save-then-sorry.de</a>
		</div>
	</body>
</html>