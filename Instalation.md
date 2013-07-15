CCWS - Corpus Collection Web Site
=========

How to install the website:)

If you install the website using a normal webserver or on your local machine, in order that the recording to work please check if the files `audio/save_file.php` and `audio/temp/save_file.php` have read and write permissions.

In the file `function/configDB.php` you need to write your username, host and password to your SQl server where you imported the database situated in the `db` folder.

Inside the files `step_one_1.php, step_one_2.php, step_one_3.php, step_one_4.php, step_one_5.php, step_two.php` you need to change the links to the `save_file.php` insde the `record()` and ` stop()` functions to your own webserver path or your localhost path.

EX. 

my own local machine path was `htdoc/web_site/audio` and in the record function is `http://localhost/web_site/audio/...`. When you add it on your webserver the path has to be `http://path_to_your_web_server/name_of_the_web_site/audio/`

HELP.

If for any reason you need help please use contact page on my [website](http://gabrielulici.github.io/contact.html) to contact me.



