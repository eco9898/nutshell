# In A Nutshell Web application

## About

![inanutshelllogo](https://user-images.githubusercontent.com/88063818/196578827-fdbd4475-dd75-42d3-b4cd-18727f7f4a18.png)
In a Nutshell is a website that is powered by openAI's GPT 3 to create articles for children. Search for a topic on the home page, or find an article from the list of already generated articles. The website will generate an article for anything that it deems appropriate for children and a valid article topic. Each article consists of 5 sections, each with a picture scrapped from the internet. There is also an option to summarise text into a more easy to read version.

## Features

- Generate easy to understand articles
- Summarise paragraphs for kids
- Restrict access to content not kid appropriate
- Browse content other kids have looked up

## Screenshots

![main_page](https://i.imgur.com/KoGpxol.png)
![flagged page](https://user-images.githubusercontent.com/88063818/196042984-d651d11e-5a45-404c-9672-27b3df030ebc.PNG)

## Installation

The site is hosted at https://www.inanutshell.info or https://deco3801-dinosandcometsequaldeath.uqcloud.net however, you can follow these instructions to setup your own version of the site and tinker around with how it works.

### Prerequisites

- Python 3.10 (Other versions can be used if all requirements are met)
- Nginx or apache2
- PHP7.x (preferably 7.4)

### Notes

This installation assumes a Linux host machine and installation to the /var/www/html folder.
Windows support will require batch files instead of shell scripts and folder structures to be update.
If installing to a different directory please find and replace all for "/var/www/html".
The updateSite.sh script also assumes the php user is set to the default 'www-data'.

### Setup site files

The first step is to setup your webserver so it is capable of serving a php page.
Once this is done the site can be installed.
The following commands will perform most of the setup required and must be run as admin e.g. sudo, doas:
```
sudo wget https://github.com/Kai-Barry/nutshell/archive/refs/heads/main.zip
sudo unzip main.zip
sudo rm main.zip
sudo chmod +x nutshell-main/updateSite.sh
sudo nutshell-main/updateSite.sh
sudo -H -u www-data pip3 install --upgrade -r other/requirements.txt
```

Once this is done you will need to update genPage.sh to include you openai key/s.

### Setup web server config

skip this stage if using apache2, a .htaccess file has been provided for you
Once this is complete the nginx  site-config file needs to be updated to include the requirements specified in: other/setup.txt.
In Nginx this is done by adding the following to the site's config in the server class:
```
autoindex off;

error_page 404 = /OhNoPage.php;
error_page 403 = /OhNoPage.php;

location ~ \.(sh|py|old|html|json|md)$ {
    return 404;
}

location ~ old/* {
    return 404;
}

location ~ stats/* {
    return 404;
}

location ~ testing* {
    return 404;
}
```
This will prevent the site from displaying a list of files when navigating to a directory, prevent users from accesssing sensitive files, and activate the site's 404 error page.

After this has been edited the webserver will need to be restart e.g. `sudo systemctl restart nginx`

### Setup automated tasks

In other/setup.txt is also the commands needed to create a crontab to log daily access to the site's pages.
This will be repeated below:
open crontab set up with
`sudo crontab -e`
Then add the following line to the bottom:
`50 23 * * * cd /var/www/html && php stats/compareDictionary.php`
or
`50 23 * * * su -l www-data -s /bin/bash -c "cd /var/www/html/ && php -f stats/compareDictionary.php"`

Each day, just before midnight, this will log the sites that were accessed that day and the ones newly created that day.

### Final changes

Finally, the sitemap files will need to be updated to reflect your actual domain, if needed/used.
