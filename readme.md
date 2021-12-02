2021-03-23
Upgrading database to work with O-R-G 3.3.0

+ rewrite index.php in the new o-r-g way but keep the old way just in case

+ make sure head.php is fetching the correct $item. Add exceptions if necessary.

+ run add-url.php with command line to add url to the records
	change sql database name, username, and password
	change $parent_id
		if $parent_id is set to 0, it will loop through all the records; otherwise it loops through all the descendants. 

	> php add-url.php

+ remove the parent record link under a child to avoid infinite loop for traverse()
	"Andrea Fraser is on our mind (2015-2016)" & "Introduction by Jamie Stevens"

    > UPDATE wires SET active=0 WHERE fromid=356 AND toid=240;
 
+ add a record named \_urgent under HOME

+ resolve the two side menu cases

	Gallery/The Word for World is Forest (2020)
	'1048', '1051', '1052', '1053', '1055', '1056', '1057', '1058', '1059', '1060', '1062'

	Gallery/+Raven Chacon Listen Collaborators Archive
	Raven Chacon: '1180', '1181', '1182', '1183'

	Update the column 'object' for media as well

+ run generate-redirects.php with command line to create a htaccess redirect file
	change sql databese name, username, and password
	copy-paste the content of the log file to .htaccess

	> php generate-redirects.php 1>>path-to-log 2>&1

+ run modify-links.php with command line to modify all the written links
	!! this file needs a closer look and a few changes specific to the website
	change sql database name, username, and password
	change $fields_to_check if necessary
	change $pattern to look for the targeted urls (e.g. http://wattis.org/list?id=1, /list?id=1)
	change $pattern_wattis to look for the targeted absolute urls (e.g. http://wattis.org/list?id=1)
	
    > php modify-links.php

+ afterwards ...
	check the link to catalog in hompage of The Word for World is Forest.
	
* finally, if edge cases (like MEDIA --> media), then use mysqldump, 
	then find and replace in .sql and reupload

	> mysqldump ... > this.sql
	> mysql ... < this.sql

+ fix encoding in /calendar and /program
  nano find/replace in dump.sql

    â€“ --> –
    Ã± --> ñ
    Ã© --> é
    Ã­ --> í
    Ã³ --> ó
    Ã¡ --> á
    â€œ --> “
    â€™ --> ‘
    â€ --> ”
    Há»“ng-Ã‚n TrÆ°Æ¡ng --> Hồng-Ân Trương
    ØµØ±Ø®Ø© Ø´Ù…Ø³ÙŠØ© --> صرخة شمسية

--

2021-07-22
Adding records added since DB freeze

+ backup wattis_local.sql (.local)

+ export wattis_live.sql (.org)

+ new db wattis_live (.local) using wattis_live.sql

+ repeat on wattis_live (.local)

	> php add-url.php
    > php modify-links.php

+ dump wattis_live > wattis_live_clean.sql

  fix MEDIA --> media (nano find/replace)
  fix encodings (nano find/replace)    

+ tar MEDIA (.org) and scp (.local)
  reconcile media and media-
