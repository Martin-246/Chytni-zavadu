<?php

include_once("db_setup.php");
include_once("db_user.php");

function get_ticket($id){
    $db = get_pdo();
    return $db->query("SELECT * FROM TICKET WHERE id=".$id.";");
}

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

function get_tickets_by_state($state){
    $db = get_pdo();
    return $db->query("SELECT * FROM TICKET WHERE state_from_manager=".$state.";");
}

function upload_new_ticket($category,$lng,$lat,$file,$author){
    $db = get_pdo();
    $user = get_user_by_email($author);
    $stmt =$db->query("INSERT INTO TICKET (category, photo, lng, lat, state_from_manager, time_created, time_modified, submitted_by) VALUES ('".$category."', '".$file."', '".$lng."', '".$lat."', '0', NOW(), NOW(), '".$user["id"]."' );");
}

function get_my_tickets($id){
    $db = get_pdo();
    return $db->query("SELECT * FROM TICKET WHERE submitted_by=".$id.";");
}

function remove_ticket($id){
    $db = get_pdo();
    $stmt = $db->query("SELECT photo FROM TICKET WHERE id='".$id."';");
    $img_path = $stmt->fetch()["photo"];
    if ($img_path != "../img/placeholder-image.png"){
        unlink($img_path);
    }
    $db->query("DELETE FROM TICKET WHERE id='".$id."';");
}
?>