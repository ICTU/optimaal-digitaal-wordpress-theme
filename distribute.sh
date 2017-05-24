
# sh /shared-paul-files/Webs/git-repos/optimaal-digitaal-wordpress-theme/distribute.sh 

# clear the log file

> '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/debug.log'

# copy to temp dir
rsync -r -a --delete '/shared-paul-files/Webs/git-repos/optimaal-digitaal-wordpress-theme/' '/shared-paul-files/Webs/temp/'

# clean up temp dir
rm -rf '/shared-paul-files/Webs/temp/.codekit-cache/'
rm '/shared-paul-files/Webs/temp/config.codekit'
rm '/shared-paul-files/Webs/temp/config.codekit3'
rm '/shared-paul-files/Webs/temp/distribute.sh'

cd '/shared-paul-files/Webs/temp/'
find . -name ‘*.DS_Store’ -type f -delete
find . -name ‘*.map’ -type f -delete

# naar de dev server
rsync -r -a --delete '/shared-paul-files/Webs/temp/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/optimaal-digitaal/'
rsync -r -a --delete '/shared-paul-files/Webs/temp/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/optimaal-digitaal-design/'

# change the theme name
sed -i '.bak' 's/Theme Name: Optimaal Digitaal/Theme Name: Optimaal Digitaal Latest/g' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/optimaal-digitaal-design/style.css'


# naar de import server
rsync -r -a --delete '/shared-paul-files/Webs/temp/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/gc_live_import/wp-content/themes/optimaal-digitaal/'
rsync -r -a --delete '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/optimaal-digitaal-design/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/gc_live_import/wp-content/themes/optimaal-digitaal-design/'

# naar de folder voor de live server bij savvii
rsync -r -a --delete '/shared-paul-files/Webs/temp/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/live-(savvii)/wp-content/themes/optimaal-digitaal/'
rsync -r -a --delete '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/optimaal-digitaal-design/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/live-(savvii)/wp-content/themes/optimaal-digitaal-design/'

# naar de folder voor dutchlogic server
rsync -r -a --delete '/shared-paul-files/Webs/temp/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/live-dutchlogic/wp-content/themes/optimaal-digitaal/'
rsync -r -a --delete '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/optimaal-digitaal-design/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/live-dutchlogic/wp-content/themes/optimaal-digitaal-design/'

# naar sentia folders
rsync -r -a --delete '/shared-paul-files/Webs/temp/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/sentia/accept/www/wp-content/themes/optimaal-digitaal/'
rsync -r -a --delete '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/optimaal-digitaal-design/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/sentia/accept/www/wp-content/themes/optimaal-digitaal-design/'


rsync -r -a --delete '/shared-paul-files/Webs/temp/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/sentia/live/www/wp-content/themes/optimaal-digitaal/'
rsync -r -a --delete '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/optimaal-digitaal-design/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/sentia/live/www/wp-content/themes/optimaal-digitaal-design/'


# remove temp dir
rm -rf '/shared-paul-files/Webs/temp/'

