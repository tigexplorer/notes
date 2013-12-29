<?php

/** 
* library for common functions 
*
* PHP version 5
*
* @category Site
* @package  Notes
* @author   Joerg Sorge <joergsorge@googel.com>
* @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
* @link     http://joergsorge.de
*/

function search_forbidden_strings( $my_string ) {
    $string_ok = "yes"; 
    if(strpos($my_string,"Select")!==false){ $string_ok = "no";}
    if(strpos($my_string,"Update")!==false){ $string_ok = "no";}
    if(strpos($my_string,"Union")!==false){ $string_ok = "no";}
    if(strpos($my_string,"exec")!==false){ $string_ok = "no";}
	return $string_ok;	
}
	
function html_menu( $current_item ) {
    echo "<ul class='nav nav-pills'>\n";
    echo "<li><a href='index.php'>Home</a></li>\n";
    if ( $current_item == "main") {
        echo "<li class='active'><a href='notes_main_list.php?action=list&find_option=p_and_c'>Main</a></li>\n";
    } else {
        echo "<li><a href='notes_main_list.php?action=list&find_option=p_and_c'>Main</a></li>\n";
    }
    if ( $current_item == "all" ) {		
	       echo "<li class='active'><a href='notes_find_list.php?action=list&find_option=all'>All</a></li>\n";
    } else {
        echo "<li><a href='notes_find_list.php?action=list&find_option=all'>All</a></li>\n";
    }
    if ( $current_item == "find" ) {		
	       echo "<li class='active'><a href='notes_find.php'>Find</a></li>\n";
    } else {
        echo "<li><a href='notes_find.php'>Find</a></li>\n";
    }
    echo "</ul>\n";
}

	
?>
