<?php

/** 
* index
*
* PHP version 5
*
* @category Site
* @package  Notes
* @author   Joerg Sorge <joergsorge@googel.com>
* @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
* @link     http://www.kom-in.de
*/

require "../../scripts_notes/notes_lib_common.inc.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="xpilger" >

    <title>Notes: Index</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

  </head>

  <body>

<div class="container">
    <?php 
        html_menu("index");
    ?>

    <div class='page-header well'>
        <h1>Notes <small>A simple Notes-List... </small></h1>
        
    </div>

</div> <!-- /container -->

</body>
</html>