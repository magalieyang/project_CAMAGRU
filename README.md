# project_CAMAGRU
- web site project -

Autor: Magalie Yang

42's school Web project : "CAMAGRU"

A website about sharing photos (with pc or phone camera or uploading pictures).
Creating an account for each user, using avatar, email register...etc.
Can add a commentary or thumb-up for each users photo.
Can custom picture with stamps/frames

--------------------------------------------------------------------
How to Use ?

 >> FIRST STEP : CONFIG MAMPSTACK <<
 
- config on "apache2" the file "conf/bitnami/bitnami-apps-prefix.conf" by adding those 2 lines :
  Include "@/apps/camagru/conf/httpd-prefix.conf"
  Include "@/apps/phpmyadmin/conf/httpd-prefix.conf"
  
  >> SECOND STEP : SERVER <<

- Start with the Bitnami Mamp Stack's Manager "Apache web server" and "MySQL database"
- Be sure Apache Web Server is on the port 8081 and MySQL on the port 8080
- In a new browser, go at this followed url : "http://localhost:8081/camagru/src/config/install.php"
- You can now allowed to visite the Camagru website, also you can create a new user or use the default one (ID: admin, password: 0000Abcd)
