<?php
$page = strtolower($_GET["page"]);
if (!file_exists("/var/www/html/pages/" . $page  . ".data")) {
		echo "error: /var/www/html/pages/" . $page  . ".data";
		header('Location: https://deco3801-dinosandcometsequaldeath.uqcloud.net/genPage.php?page=' . $page);
		exit();
}
$headerFile = file_get_contents("./pages/header.html", FILE_USE_INCLUDE_PATH);
$footerFile = file_get_contents("./pages/footer.html", FILE_USE_INCLUDE_PATH);
$file = file_get_contents("./pages/" . $page  . ".data", FILE_USE_INCLUDE_PATH);
//echo "page file: " . $page . "\n";
//echo "<file: " . $file . "\nfile>\n";
$data = explode("\======/", $file);
foreach ($data as &$value) {
		$value = preg_split("/\r\n|\n|\r/", $value);
		$i = 0;
		foreach ($value as &$line) {
				if ($line[0] == '#') {
						unset($value[$i]);
				}
				else if (substr($line, 0, 3) == '***') {
						$value[$i] =substr($value[$i], 3);
				}
				$i++;
		}
		$value = array_filter(array_values($value));
}
unset($value);
$title = $data[0][0];
$header = $data[0][1];
$body = $data[1];
$images = $data[2];
/*$j = 0;
foreach ($data as &$value) {
		//echo $value;
		$k = $j; //the second array starts at 1??
		foreach ($value as &$ste) {
				echo "[" . $j . "][" . $k . "]: " . $ste;
				$k++;
		}
		$j++;
}
unset($value);
foreach ($body as &$value) {
		echo $value;
}
unset($value);*/
//echo "title: " . $title;

//echo "\n starting";
//Seperate body into paragraph and topics
$paras = [];
$breakpoint = 0;
$para = "";
for ($x = 0; $x <= 5; $x++) {
		//echo "\n\nnew paragraph";
		$count = 0;
		foreach ($body as &$line) {
			$count = $count + 1;
			//echo $count . "." . $breakpoint;
			//echo $line . "\n";
			if ($count <= $breakpoint) {
				//echo "\ncontinue";
				continue;
			}
			else if ($line === "\=====/") {
				$breakpoint = $count;
				//echo "\nbreak";
				break;
			}
			$para = $para . $line . "\n";
		}
		unset($line);
		$paras[] = $para;
		unset($para);
		//echo "\nlooped";
}

$headings = [];
$i = 0;
//Isolate headings
foreach ($paras as $para) {
    $headings[$i] = explode("\n",$para)[0];
    $i++;
}

//Isolate paras
$paragraphs = [];
$i = 0;
//Isolate headings
foreach ($paras as $para) {
    $paragraphs[$i] = explode("\n",$para)[1];
    $i++;
}


$files = json_decode(file_get_contents('stats/dict.json'), true);
$files["pages/" . $page  . ".data"] += 1;
file_put_contents("stats/dict.json",json_encode($files));
?>
<!DOCTYPE html>
<html>
    <head>
    <!--insert header code here-->
	    <title><?php
                echo $title;
		        echo $headerFile; ?>
        <div class="jumptomenu">
            <div class="jumpto">
                <div class="sub1">
                    <a href="#Sub1" id="subOne"><?php echo $headings[2];?></a>
                </div>
                <div class="sub2">
                    <a href="#Sub2" id="subTwo"><?php echo $headings[3];?></a>
                </div>
                <div class="sub3">
                    <a href="#Sub3" id="subThree"><?php echo $headings[4];?></a>
                </div>
                <div class="sub4">
                    <a href="#Sub4" id="subFour"><?php echo $headings[5];?></a>
                </div>
            </div>
        </div>
        <center class="textPlus">
            <div class="article">
                <div class="articleContainer">
                    <h1><?php echo $header;?></h1>
                    <img style="float:right" src='<?php echo $images[1]?>'>
                    <p><?php echo $paragraphs[1];?></p>
                </div>
                <br>
                <hr>
                <br>
                <div class="articleContainer">
                    <h3 style="float:right" id="Sub1"><?php echo $headings[2];?></h3>
                    <img src="<?php echo $images[2]?>">
                    <p style="float:right"><?php echo $paragraphs[2];?></p>
                </div>
                <br>
                <hr>
                <br>
                <div class="articleContainer">
                    <h3 id="Sub2"><?php echo $headings[3];?></h3>
                    <img style="float:right" src="<?php echo $images[3]?>">
                    <p><?php echo $paragraphs[3];?></p>
                </div>
                <br>
                <hr>
                <br>
                <div class="articleContainer">
                    <h3 style="float:right" id="Sub3"><?php echo $headings[4];?></h3>
                    <img src="<?php echo $images[4]?>">
                    <p style="float:right"><?php echo $paragraphs[4];?></p>
                </div>
                <br>
                <hr>
                <br>
                <div class="articleContainer">
                    <h3 id="Sub4"><?php echo $headings[5];?></h3>
                    <img style="float:right" src="<?php echo $images[5]?>">
                    <p><?php echo $paragraphs[5];?></p>
                </div>
            </div>
            <div class="wantMore">
                <h2>Want More?</h2>
                <div class="moreArt">
                    <?php
                    
                    $files = glob('pages/*.data');
                    $target = count($files);
                    if ($target > 7) {
                        $target = 7;
                    }
                    $display = [];
                    if ($target < 7) {
                        $display = range(0, $target - 1);
                    }
                    while (count($display) < $target) {
                        $file = array_rand($files);
                        if (!in_array($file, $display)) {
                            $display[] = $file;
                        }
                    }

                    foreach ($display as &$subject) {
                        $fileData = file_get_contents($files[$subject], FILE_USE_INCLUDE_PATH);
                        $fileName = substr($files[$subject], 6, strlen($files[$subject])-strlen("pages/.data"));
                        $fileTitle = preg_split("/\r\n|\n|\r/", $fileData)[2];
                        $image = explode("\n", explode("\======/", $fileData)[2])[1];

                        echo '
                        <a href="Article.php?page=' . $fileName . '">
                            <center class="relate">
                                <img src="' . $image . '">
                                <h2>' . $fileTitle . '</h2>
                            </center>
                        </a>';
                    }
                    ?>      
                </div>
            </div>
        </center>
        <!--insert body code here-->
        <?php echo $footerFile;?>
    </body>
</html>
