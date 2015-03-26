<?php
/** 
* edit notes
*
* PHP version 5
*
* @category Site
* @package  Notes
* @author   Joerg Sorge <joergsorge@googel.com>
* @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
* @link     http://www.joergsorge.de
*/

require "../../scripts_notes/notes_lib_db.inc.php";
require "../../scripts_notes/notes_lib_common.inc.php";
		
// check action	
if ( isset($_GET['action']) ) {	
    $action = $_GET['action'];		
    $action_ok = "yes";
}
			
if ( $action_ok == "yes" ) {		
    if ( isset($_GET['pa']) ) {	
        $id = $_GET['pa'];
    }
				
	// switch action 
	if ( $id !="" ) { 
		switch ( $action ):
			case "new":
				$form_input_type = "add"; //set form action
				$message = "Details new ";
				$c_query_condition = "id = ".$id;
				break;
            
			case "add":    
				$fields = "title, notes, urls, parent";
				$new_id = db_query_add_item_1("notes_main", $fields, trim($_GET["form_mn_title"]), trim($_GET["form_mn_txt"]), trim($_GET["form_mn_urls"]), $id);
				header( "Location: notes_edit.php?action=display&pa=".$new_id );
				break;
					         					         
			case "display":
				$form_input_type = "update"; //set form action
				$message = "Details display ";
				$c_query_condition = "id = ".$id;
				$tbl_row = db_query_display_item_1("notes_main", $c_query_condition);	
				// load childs
				$c_query_condition_child = "parent = ".$id;
				$tbl_row_child = db_query_display_item_1("notes_main", $c_query_condition_child);
				// load parent
				$c_query_condition_parent = "id = ".$tbl_row["parent"];
				$tbl_row_parent = db_query_display_item_1("notes_main", $c_query_condition_parent);
				break;
					    
			case "update":
				$fields = "title=?, notes=?, urls=?, parent=?";
				$value1 = $_GET["form_mn_title"];
				$value2 = trim($_GET["form_mn_txt"]);
				$value3 = trim($_GET["form_mn_urls"]);
				$value4 = $_GET["form_mn_p_id"];
				$query_condition = "id = ".$id;
				db_query_update_item_1("notes_main", $fields, $value1, $value2, $value3, $value4, $id);
				header("Location: notes_edit.php?action=display&pa=".$id);
				exit;
				break;
					       
			case "kill":
				db_query_delete_item_1("notes_main", $id);
				header("Location: notes_main_list.php?action=list&find_option=p_and_c");
				exit;
			endswitch;
	} else {
		$message = "No ID. Nothing to do..... "; 
	}
} else {
	$message = "No Command. Nothing to do..... "; 
}
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
html_menu("");

if ( $action_ok == "no" ) { 
    echo $message;
    return;
} 

echo "<form role='form' action=".$_SERVER['PHP_SELF'].">";
echo "<input type='hidden' name='action' value='".$form_input_type."'>";
echo "<input type='hidden' name='pa' value=".$id.">";

// If parent
if ( $tbl_row_parent ) {
    echo "<ul class='list-group'>";
    echo "<li class='list-group-item'><a href='notes_main_list.php?action=list&find_option=one_p_and_c&amp;pa=".$tbl_row_parent["id"]."'>".$tbl_row_parent["title"]."</a></li>";
    echo "</ul>";
    echo "<div class='form-group'>";
    echo "<input type='text' class='form-control text1' name='form_mn_p_id' value='".$tbl_row_parent["id"]."'>";
    echo "</div>";
} else {
	 echo "<input type='hidden' name='form_mn_p_id' value='0'>";
}

echo "<div class='form-group'>";
echo "<input type='text' class='form-control text1' name='form_mn_title' value='".$tbl_row["title"]."'>";
echo "<textarea class='form-control text1' name='form_mn_txt' rows='15'>".$tbl_row["notes"]."</textarea>";
echo "<textarea class='form-control text1' name='form_mn_urls' rows='5'>".$tbl_row["urls"]."</textarea>";
echo "<div class='col-lg-offset-2 col-lg-10'>";
echo "<button type='submit' class='btn btn-default'>Save</button>";
//<!-- Button trigger modal -->
// If no childs, we can delete
if ( !$tbl_row_child ) {
    echo "<button type='button' class='btn btn-default' data-toggle='modal' data-target='#myModal'>Delete</button>";
}
echo "</div>";
echo "</div>";
echo "</form>";
echo "</div>";

echo "<div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
  echo "<div class='modal-dialog'>";
    echo "<div class='modal-content'>";
      echo "<div class='modal-header'>";
        echo "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>";
        echo "<h4 class='modal-title'>Attention</h4>";
      echo "</div>";
      echo "<div class='modal-body'>";
        echo "<p>Will you  really delete this one?</p>";
      echo "</div>";
      echo "<div class='modal-footer'>";
        echo "<button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>";
        echo "<a class='btn btn-primary' href='notes_edit.php?action=kill&pa=".$id."'>Delete</a>";
      echo "</div>";
    echo "</div>"; //<!-- /.modal-content -->
  echo "</div>"; //<!-- /.modal-dialog --> 
echo "</div>";//<!-- /.modal -->
?>
</body>
</html>
