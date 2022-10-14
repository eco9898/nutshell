<?php
	$headerFile = file_get_contents("./pages/header.html", FILE_USE_INCLUDE_PATH);
	$footerFile = file_get_contents("./pages/footer.html", FILE_USE_INCLUDE_PATH);

	$text = "Your translated text will appear here.";
	if(isset($_POST['SubmitButton'])){ //check if form was submitted
		$input = $_POST['inputText']; //get input text
		$command = escapeshellcmd('/var/www/html/summarise.sh "' . $input .  '" 2>&1 &');
		$output = shell_exec($command);
		if (strpos($output, "An error occured processing that") == false) {
			$text = $output;
		}
	}	
?>
<!DOCTYPE html>
<html>
	<head>
	<title>Summariser<?php
		echo $headerFile; ?>
	<div class="one">
		<div class="title">
			<div>
				<h1>Summariser</h1>
			</div>
			<div>
				<p>Need help understanding a paragraph you've found?</p>
			</div>
		</div>
		<form action = "" method = "post">
			<div class="summariser-result">
				<div class="translater-box">
					<textarea name="inputText" placeholder ="Enter any paragraph that you want summarised here..." autocomplete="off" autocapitalize="off" crows="1" spellcheck="false"></textarea>
				</div>
				<div class="translate-text-box">
					<p><?php echo $text;?></p>
				</div>
			</div>
			<div class="summarise-button-box">
				<button type="submit" name="SubmitButton" class="summarise-button">
					<p>Summarise!</p>
				</button>
			</div>
		</form>
	</div>
	<?php echo $footerFile;?>
</body>
</html>