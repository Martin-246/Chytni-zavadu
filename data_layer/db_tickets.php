<?php

include_once("db_setup.php");

function get_ticket_category($number){
    $db = get_pdo();
    $stmt = $db->query("SELECT *  FROM CATEGORY WHERE id=".$number.";");
    return $stmt->fetch()["description"];
}

function get_all_tickets(){
    $db = get_pdo();
    return $db->query("SELECT * FROM TICKET");
}
?>