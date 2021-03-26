2021-03-23
Upgrading database to work with O-R-G 3.3.0

+ rewrite index.php in the new o-r-g way but keep the old way just in case

+ make sure head.php is fetching the correct $item. Add exceptions if necessary.

+ run add-url.php with command line to add url to the records
	change sql databese name, username, and password
	change $parent_id
		if $parent_id is set to 0, it will loop through all the records; otherwise it loops through all the descendants. 
	>php add-url.php
+ remove the parent record link under a child to avoid infinite loop for traverse()
	"Andrea Fraser is on our mind (2015-2016)" & "Introduction by Jamie Stevens"
	>DELETE FROM wires WHERE fromid = '356' AND toid = '240';

+ add a record named \_urgent under HOME

+ resolve the two side menu cases

	Gallery/The Word for World is Forest (2020)
	'1048', '1051', '1052', '1053', '1055', '1056', '1057', '1058', '1059', '1060', '1062'

	Gallery/+Raven Chacon Listen Collaborators Archive
	Raven Chacon: '1180', '1181', '1182', '1183'

	Update the column 'object' for media as well

+ run generate-redirects.php with command line to create a htaccess redirect file
	change sql databese name, username, and password
	>php generate-redirects.php 1>>path-to-log 2>&1
	copy-paste the content of the log file to .htaccess

+ run modify-links.php with command line to modify all the written links
	!! this file needs a closer look and a few changes specific to the website
	change sql databese name, username, and password
	change $fields_to_check if necessary
	change $pattern to look for the targeted urls (e.g. http://wattis.org/list?id=1, /list?id=1)
	change $pattern_wattis to look for the targeted absolute urls (e.g. http://wattis.org/list?id=1)
	>php modify-links.php

+ afterwards ...
	check the link to catalog in homapge of The Word for World is Forest.
	
* finally, if edge cases (like MEDIA --> media), then use mysqldump, 

	> mysqldump ... > this.sql

	then find and replace in .sql and reupload
	> mysql ... < this.sql
