<?php

/** 
* list notes-search-results 
*
* PHP version 5
*
* @category Site
* @package  Notes
* @author   Joerg Sorge <joergsorge@googel.com>
* @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
* @link     http://www.joergsorge.de
*/

require "../../script/notes_lib_db.inc.php";
require "../../script/notes_lib_common.inc.php";

$action_ok = "no";

// check action	
if ( isset( $_GET['action'] ) ) {	
    $action = $_GET['action'];	$action_ok = "yes";
}
if ( isset( $_POST['action'] ) ) { 
    $action = $_POST['action'];	
    $action_ok = "yes";
}
if ( $action_ok != "yes" ) {
    $message = "No action. Nothing to do..... "; 
}
if ( isset( $_GET['find_limit_skip'] ) ) { 
    $find_limit_skip = $_GET['find_limit_skip'];
}

	
// check find_option
$find_option_ok = "no";
if ( isset( $_GET['find_option'] ) ) {
    $find_option = $_GET['find_option'];		
    $find_option_ok = "yes";
}
if ( isset( $_POST['find_option'] ) ) {
    $find_option = $_POST['find_option'];		
    $find_option_ok = "yes";
}
	
if ( isset( $_GET['find_option_1'] ) ) {	
    $find_option_1 = $_GET['find_option_1'];		
    $find_option_1_ok = "yes";
}
			
if ( $find_option_ok = "yes" ) {
    switch ( $action ) {
        
    case "find":
        if ( isset( $_POST['form_mn_title'] ) ) {
            if ( $_POST['form_mn_title'] !="") { 
                $c_field_message ="Titel";
                $c_field_desc = "title";
                $c_field_value = $_POST['form_mn_title']; 
            }
        }
        if ( isset( $_POST['form_mn_txt'] ) ) {
            if ( $_POST['form_mn_txt'] !="") { 
                $c_field_message ="Text";
                $c_field_desc = "notes";
                $c_field_value = $_POST['form_mn_txt']; 
            }
        }
        if ( isset( $_POST['form_mn_urls'] ) ) {
            if ( $_POST['form_mn_urls'] !="") { 
                $c_field_message ="Urls";
                $c_field_desc = "urls";
                $c_field_value = $_POST['form_mn_urls']; 
            }
        }
        $c_query_condition = $c_field_desc." LIKE '%".$c_field_value."%' ";
        $message_find_string = $c_field_message. " contains " .$c_field_value ;
        break;
						
    case "list":
        switch ( $find_option ) {
								
        case "all":
            $c_query_condition = "NOWHERE ORDER BY id";
            $message_find_string = "All Items";
            break;
        }
        break;
    }
} else { 
    //$find_option_ok = "yes"
    $message = "No find-option. Nothing to do....."; 
}

if ( $action_ok == "yes" ) {
    	$db_result = db_query_list_items_1("notes_main", "id, title", $c_query_condition);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Notes - Find-List</title>
	<meta http-equiv="language" content="de">
	<meta name="robots" content="noindex,nofollow">
	<link rel="shortcut icon" type="image/x-icon" href="../../favicon.ico">
	<script src="https://code.jquery.com/jquery-1.10.1.min.js"></script>
	<!-- Bootstrap core CSS, JS -->
 <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
 <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<?php
echo "<div class='container'>";
html_menu("all");

if ( $action_ok == "no" ) { 
    echo $message;
    return;
} 

echo "<ul class='list-group'>";
			
foreach ( $db_result as $tbl_row ) {
    $z += 1;
    echo "<li class='list-group-item'><a href='notes_edit.php?action=display&amp;pa=".$tbl_row["id"]."'>".substr($tbl_row["title"], 0, 50)."</a></li>";			
} //foreach
			
echo "</ul>";
			
if ( $z == 0 ) { 
    echo $message_find_string." :: No match found...";
} else {
    $zz = $z+1;	
    $x = $z / $find_limit;
    echo "<p>".$message_find_string." :: found: ".$z." ::: ";
}
echo "</div>";
?>
</body>
</html>