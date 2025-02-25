<?php
    $headerFile = file_get_contents("./pages/header.html", FILE_USE_INCLUDE_PATH);
    $footerFile = file_get_contents("./pages/footer.html", FILE_USE_INCLUDE_PATH);
?>
<!DOCTYPE html>
<html  lang="en">
    <head>
        <meta name="description" content="
            The In a Nutshell Team (🦖➕☄️=☠️) is a group of university students that are passionate
            about making online experiences simpler and accessible to everyone.
            Combining our unique perspectives and passions,
            we are a diverse team that seeks to create unique
            and engaging experiences through our different skill sets.
            We’re just students who want to make the process of being a student easier for the next generation;
            we hope we’ve succeeded.">
        <title>Ethics<?php
            echo $headerFile; ?>
        <h1 class="title">About Us</h1>
        <div class="AboutBox">
            <div class="AboutMessage">
                <h4>
                    The In a Nutshell Team (🦖➕☄️=☠️) is a group of university students that are passionate
                    about making online experiences simpler and accessible to everyone.
                    Combining our unique perspectives and passions,
                    we are a diverse team that seeks to create unique
                    and engaging experiences through our different skill sets.
                </h4>
                <h4>
                    We’re just students who want to make the process of being a student easier for the next generation;
                    we hope we’ve succeeded.
                </h4>
                <h4>
                    This page is open source and is available on
                    <a href="https://github.com/Kai-Barry/nutshell">
                        github
                    </a>.
                </h4>
                <div class="image">
                    <img id="nav-logo-1" src="/images/Logo 01- 600 x 600 px.png" alt="Navigation logo">
                </div>
            </div>
        </div>
        <?php echo $footerFile;?>
    </body>
</html>
