cd /var/www/html
#backup current site
mkdir old2
mv * old2 #this will throw an error about moving old2 to itself
mv old2 old
#keep a max of 10 backups
sudo rm -r old/old/old/old/old/old/old/old/old/old/old/
#download new site
wget https://github.com/eco9898/nutshell/archive/refs/heads/main.zip
unzip main.zip
rm main.zip
#install new site
mv nutshell-main/* .
rm -r nutshell-main
#restore key files
mv old/genPage.sh .
mv old/summarise.sh .
#restore generated content and logs
mv old/pages/*.data pages/
mv old/stats/*.json ./stats/
#update permissions
chmod +x updateSite.sh
chmod +x genPage.sh
chmod -R g+w .
sudo chgrp -R www-data .
#ensure requirements are up to date for www-data user's python space
#this can be toggled on if needed
#sudo -H -u www-data pip3 install --upgrade -r other/requirements.txt
#Transfer ownership to www-data
sudo chown -R www-data .