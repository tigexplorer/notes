<?php

/** 
* find notes
*
* PHP version 5
*
* @category Site
* @package  Notes
* @author   Joerg Sorge <joergsorge@googel.com>
* @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
* @link     http://www.joergsorge.de
*/

require "../../scripts_notes/notes_lib_common.inc.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Notes-Edit</title>
	<meta http-equiv="language" content="de">
	<meta name="robots" content="noindex,nofollow">
	<script src="https://code.jquery.com/jquery-1.10.1.min.js"></script>
	<!-- Bootstrap core CSS -->
 <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
 <link href="style/notes_style.css" rel="stylesheet">
 <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<?php
echo "<div class='container'>";
html_menu("find");
echo "<form class='form-horizontal' role='form' action='notes_find_list.php' method='POST'>";
echo "<input type='hidden' name='action' value='find'>";
echo "<div class='form-group'>";
echo "<input type='text' class='form-control text1' name='form_mn_title' value=''>";
echo "<input type='text' class='form-control text1' name='form_mn_txt' value=''>";
echo "<input type='text' class='form-control text1' name='form_mn_urls' value=''>";
echo "<div class='col-lg-offset-2 col-lg-10'>";
echo "<button type='submit' class='btn btn-default'>Find</button>";
?>
</body>
</html>
