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

// check action	
$action_ok = "no";
if ( isset( $_GET['action'] ) ) {	
    $action = $_GET['action'];	$action_ok = "yes";
}

if ( $action_ok != "yes" ) {
    $message = "No action. Nothing to do..... "; 
}

// check find_option	
$find_option_ok = "no";
if ( isset($_GET['find_option']) ) {
    $find_option = $_GET['find_option'];		
    $find_option_ok = "yes";
}
			
if ( $find_option_ok = "yes" ) {
    switch ( $action ) {
        
    case "list":
        switch ( $find_option ) {
							case "p_and_c":
            $c_query_condition_main = "parent='0' ORDER BY title";
            $c_query_condition = "parent<>'0' ORDER BY title";
            break;
        }
        break;
    }
} else { 
    //$find_option_ok = "yes"
    $message = "No find-option. Nothing to do..... "; 
}

if ( $action_ok == "yes" ) {
    	$db_result_main = db_query_list_items_1("notes_main", "id, title, notes", $c_query_condition_main);
    	$db_result = db_query_list_items_1("notes_main", "id, parent, title, notes", $c_query_condition);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Notes - Main</title>
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
html_menu("main");

if ( $action_ok == "no" ) { 
    echo $message;
    return;
} 
$z = 0;
echo "<div class='panel-group' id='accordion'>\n";
      
foreach ( $db_result_main as $tbl_row_main ) {
    $z += 1;   
    echo "<div class='panel panel-default'>\n";
    echo "<div class='panel-heading'>\n";
    echo "<span class='panel-title'>\n";
    echo "<a class='accordion-toggle' data-toggle='collapse' data-parent='#accordion' href='#collapse".$tbl_row_main["id"]."'>\n";
    echo substr($tbl_row_main["title"], 0, 50);	
    echo "</a>\n";
    echo "</span>";

    echo "</div>\n"; //heading
    echo "<div id='collapse".$tbl_row_main["id"]."' class='panel-collapse collapse'>\n";
    echo " <a href='notes_edit.php?action=display&amp;pa=".$tbl_row_main["id"]."' class='btn btn-default btn-xs'>Edit Main</a>";
    echo " <a href='notes_edit.php?action=new&amp;pa=".$tbl_row_main["id"]."' class='btn btn-default btn-xs'>New Sub</a>";
    echo "<div class='panel-body'>\n";
    
    	// sub - list
    	echo "<ul class='list-group'>\n";
    	
			foreach ( $db_result as $tbl_row ) {
        if ( $tbl_row["parent"] == $tbl_row_main["id"] ) {
            echo "<li class='list-group-item'><a href='notes_edit.php?action=display&amp;pa=".$tbl_row["id"]."'>".substr($tbl_row["title"], 0, 50)."</a>";
            // button add sub-item
            echo " <a href='notes_edit.php?action=new&amp;pa=".$tbl_row["id"]."' class='btn btn-default btn-xs pull-right'>New Sub</a>";
            echo"</li>\n";
            
            echo "<ul class='list-group'>\n";	
            foreach ( $db_result as $tbl_row_sub ) {
                if ( $tbl_row_sub["parent"] == $tbl_row["id"] ) {
                    echo "<li class='list-group-item'><a href='notes_edit.php?action=display&amp;pa=".$tbl_row_sub["id"]."'>".substr($tbl_row_sub["title"], 0, 50)."</a></li>\n";
                    $c_query_condition_sub_sub = "parent =".$tbl_row_sub["id"]." ORDER BY id";
                    $db_result_sub_sub = db_query_list_items_1("notes_main", "id, parent, title, notes", $c_query_condition_sub_sub);
                    if ( $db_result_sub_sub ) {						
                        foreach ( $db_result_sub_sub as $tbl_row_sub_sub ) {
                            echo "<li class='list-group-item'><a href='notes_edit.php?action=display&amp;pa=".$tbl_row_sub_sub["id"]."'>".substr($tbl_row_sub_sub["title"], 0, 50)."</a></li>\n";
                        }
                    }
                }
							 }
					echo "</ul>\n";
        }
    } //foreach			
    echo "</ul>\n"; // end sub-list  
    
    echo "</div>\n"; // panel-collapse collapse
    echo "</div>\n"; // panel-body
    echo "</div>\n"; // panel panel-default close
    
} //foreach

echo "</div>\n"; // accordeon close	
			
if ( $z == 0 ) { 
    echo " :: No match found...";
} else {
    echo "<p> :: found ".$z." items :: ";
}
echo "</div>";
?>
</body>
</html>