<?php
        $page = strtolower(htmlspecialchars($_GET["page"]));
        if ( isset($_SERVER['HTTP_USER_AGENT'])
                && preg_match('/bot|crawl|slurp|spider|mediapartners/i', $_SERVER['HTTP_USER_AGENT'])) {
                header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
                include("OhNoPage.php");
                exit();
        }
        $command = escapeshellcmd('/var/www/html/genPage.sh "' . $page . '"');
        $output = shell_exec($command);
        echo $output;
        if (strpos($output, "Success") !== false || strpos($output, "Page exists") !== false) {
                $page = explode(": ", $output)[1];
                header('Location: /Article.php?page=' . $page);
        } else {
                header('Location: /OhNoPage.php');
        }
        exit();
