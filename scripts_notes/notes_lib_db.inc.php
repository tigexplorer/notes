<?php

/** 
* library for db functions 
*
* PHP version 5
*
* @category Site
* @package  Notes
* @author   Joerg Sorge <joergsorge@googel.com>
* @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
* @link     http://joergsorge.de
*/

require "notes_db_conf.inc.php";

function db_query_list_items_1( $table, $fields, $condition ){
    $db = db_connect_pdo();
    if ( substr($condition, 0, 7) == "NOWHERE" ) {
        // condition enthaelt z.B. ORDER BY
        $stmt = $db->query('SELECT '.$fields.' FROM '.$table.' '.substr($condition,7));
    }else{
        $stmt = $db->query('SELECT '.$fields.' FROM '.$table.' WHERE '.$condition);
    }
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function db_query_display_item_1( $table, $condition ){
    $db = db_connect_pdo();
    $stmt = $db->query('SELECT * FROM '.$table.' WHERE '.$condition);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function db_query_update_item_1( $table, $fields, $value1, $value2, $value3, $id ){
    // item aktualisieren
    $db = db_connect_pdo();
    $stmt = $db->prepare("UPDATE ".$table." SET ".$fields." WHERE id=?");
    $stmt->execute(array($value1, $value2, $value3, $id));

}

function db_query_add_item_1( $table, $fields, $value1, $value2, $value3, $value4 ) {
    // row zufuegen
    $db = db_connect_pdo();
    $stmt = $db->prepare("INSERT INTO ".$table."(".$fields.") VALUES(:value1,:value2,:value3,:value4)");
    $stmt->execute(array(':value1' => $value1, ':value2' => $value2, ':value3' => $value3, ':value4' => $value4));
    $insertId = $db->lastInsertId();
    return $insertId;
}

function db_query_delete_item_1( $table, $id ){
    $db = db_connect_pdo();
    $stmt = $db->prepare("DELETE FROM ".$table." WHERE id=:id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}
?>
