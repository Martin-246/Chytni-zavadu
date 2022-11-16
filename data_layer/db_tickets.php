<?php

include_once("db_setup.php");

function get_ticket_category($number){
    $db = get_pdo();
    $stmt = $db->query("SELECT *  FROM CATEGORY WHERE id=".$number.";");
    return $stmt->fetch()["description"];
}

function get_categories(){
    $db = get_pdo();
    return $db->query("SELECT *  FROM CATEGORY");
}

function get_all_tickets(){
    $db = get_pdo();
    return $db->query("SELECT * FROM TICKET");
}

function upload_new_ticket($category,$lng,$lat,$file){
    $db = get_pdo();
    $stmt =$db->query("INSERT INTO TICKET (category, photo, lng, lat, state_from_manager, time_created, time_modified) VALUES ('".$category."', '".$file."', '".$lng."', '".$lat."', '0', NOW(), NOW() );");
}
?>