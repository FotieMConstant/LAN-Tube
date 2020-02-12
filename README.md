# LAN-Tube
LAN Tube is an Open Source Youtube like web app for your home network. 

![logo](https://user-images.githubusercontent.com/42372656/60809245-1dd79980-a182-11e9-9143-7e11995148be.png)

# Note: The Messaging Module for this web app is available here: <a href="https://github.com/FotieMConstant/LAN-Messaging">LAN-Messaging</a>


Technologies

- Bootstrap 4
- PHP 5
- HTML 5
- MySQL

LAN Tube is an Open Source Youtube like web app for your home network. You can upload, watch videos online and download. All this on your local server no need for internet connection.
Please feel free do use the souce code to any purpose and please any contribution to the project will be highly welcomed


	Home page:

![ScreenShot](https://github.com/FotieMConstant/LAN-Tube/blob/master/screenshots/home.JPG)
 
	Upload section:

![ScreenShot](https://github.com/FotieMConstant/LAN-Tube/blob/master/screenshots/upload%20video.JPG)

	LAN Share section:
![ScreenShot](https://github.com/FotieMConstant/LAN-Tube/blob/master/screenshots/share%20files.JPG)


	Search video:
![ScreenShot](https://github.com/FotieMConstant/LAN-Tube/blob/master/screenshots/searchvideo.JPG)

	Quick upload video:
![ScreenShot](https://github.com/FotieMConstant/LAN-Tube/blob/master/screenshots/direct%20upload.JPG)

	Streaming video:
![ScreenShot](https://github.com/FotieMConstant/LAN-Tube/blob/master/screenshots/viewing%20video.JPG)

LAN Tube is easy to install on your local server

How to install
- Extract the file on your local server folder. This is usually the 'www' OR 'htdocs' folder in your drive C:\
- Launch your local server. this can be any whether WAMP or XAMPP. Or any other
- Go to http://localhost/phpmyadmin
- Create database named 'lantube' on your local server.
- Import 'db.sql' from the databse folder.
	This will create a table named 'videos'. this table will collect 'id' of the video uploaded, the 'name' and the location of the file.
- Now all is almost done, just one thing left. We have to increase the maximum POST FILE SIZE and UPLOAD FILE SIZE. generally they are set by default to 8M and 2M for XAMPP respectively.
	
	- Look for the file 'php.ini' and increase the file size to the max you whish to have(E.g 2048MB). this file i generally found in 'C:\xampp\php' directory for XAMPP.
	- Once ther open the file and search for 'post_max_size' and 'upload_max_filesize'. You can now start editing.
	- Restart your server.
- Launch the website and enjoy!





How to connect LAN Tube from another device.

- Connect the server computer on the same network as the other devices.
- On the server machine open comand prompt and type 'ipconfig' to get the ip address of the server computer.
- The ip address is IPv4 Address. . . . . . . . . . . : XXX.XXX.X.XXX.
- Use this ip on the other devices and you are set to go...
  
  ENJOY!!!

	  Any thing you'll love to see in the next update? Mail : fotiemoghommahieconstant@gmail.com

