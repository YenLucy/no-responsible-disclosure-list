<!DOCTYPE html>
<html>
	<?php
		$ProjectVersionNumber = 2.0;
		include "MYSQL.php";

		$db = mysqli_connect($MYSQL_HOSTIP,$MYSQL_USER,$MYSQL_PASS,$MYSQL_DATABASE);
		if(!$db) {
		  	exit("Datenbank nicht erreichbar. Verbindungsfehler: ".mysqli_connect_error());
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
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
		<link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
		<link rel="manifest" href="images/site.webmanifest">
	</head>
	
	<body>
		<div class="projectWrapper">
			<div class="projectIntro">
				<h1>No Responsible Disclosure List Version <?= $ProjectVersionNumber ?></h1>
				<p class="introtext">
					In einer Liste werden hier sämtliche Organisationen und Unternehmen aufgezählt, welche sich auf eindringliche Art weigern, am Responsible Disclosure-Verfahren teilzunehmen. Diese Unternehmen antworten den Sicherheitsforscher*innen, indem sie sie bei den Strafverfolgungsbehörden anzeigen - ganz im Sinne von "Shoot the messenger". Um dem entgegen zu wirken, wurde diese Liste ins Leben gerufen, welche lediglich die verschiedenen Unternehmen und die bekannten Vorfälle dieser Art zusammenträgt. Bei Internationalen Einträgen bitte an den Namen ein Länderkürzel anhängen. Beispiel: "Impero Solutions Ltd. (USA)" Im deutschen Raum ist dies nicht notwendig.
					<br><br>
					<a class="add-link" href="#add-entry" rel="nofollow">Eintrag hinzufügen/Kontakt</a>
				</p>
			</div>

			<div class="table">
				<?php 
					$ergebnis = mysqli_query($db,"SELECT * FROM NoResponsibleDisclosure ORDER BY Name ASC"); 
					$ergebnis = mysqli_fetch_all($ergebnis);
					$count = 0;
					while($ergebnis[$count] !== null) {
						$inputname = $ergebnis[$count][1];
						$inputyear = $ergebnis[$count][2];
						$inputurl = $ergebnis[$count][3];
						$inputurlstring = parse_url($ergebnis[$count][3], PHP_URL_HOST);
						if($inputurlstring != false) {
							echo '<div class="element">';
							echo '<div class="name">'.$inputname.'</div>';
							echo '<div class="timeframeyear">'.$inputyear.'</div>';
							echo '<div class="proof"><a target="_blank" rel="nofollow" href="'.$inputurl.'">Newsartikel ('.$inputurlstring.')</a></div>';
							echo '</div>';
						}
						$count = $count + 1;
					}
				?>
			</div>
			<div class="table-insert" id="add-entry">
				<h2>Daten hinzufügen</h2>
				<form method="post">
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

				<?php
					if($_POST["organization"] != NULL && $_POST["year"] != NULL && $_POST["proof"] != NULL) {
						$proof = htmlspecialchars($_POST['proof'], ENT_QUOTES);
						$year = htmlspecialchars($_POST['year'], ENT_QUOTES);
						$name = htmlspecialchars($_POST['organization'], ENT_QUOTES);
						$query = "INSERT INTO db71866.NoResponsibleDisclosure (Name,TimeframeYear,Link) VALUES ('".$name."',".$year.",'".$proof."')";
						$check = mysqli_query($db,$query);
						if($check) {
							echo "<br>success<br>";
							echo "<a href='https://better-save-then-sorry.de/'>Reload Page</a>";
						}
						else { 
							echo "Error. Please contact Webmaster via E-Mail.";
						}
					}
				?>
			</div>

			<div class="contact">
				<h2>Änderungen an Einträgen, Verbesserungsvorschläge und Kontakt:</h2>
				<a href="mailto:contact@better-save-then-sorry.de">contact@better-save-then-sorry.de</a>
			</div>
		</div>
	</body>
</html>