<?php
include_once("db_setup.php");
include_once("db_user.php");

function get_my_requests($id){
    $db = get_pdo();
    return $db->query("SELECT * FROM SERVICE_REQUEST WHERE worker_id=".$id.";");
}

function get_request_tickets($id){
    $db = get_pdo();
    return $db->query("SELECT * FROM TICKET WHERE id = (SELECT for_ticket FROM SERVICE_REQUEST WHERE worker_id=".$id.");");
}

function get_request_by_ticket($ticket_id){
    $db = get_pdo();
    return $db->query("SELECT * FROM SERVICE_REQUEST WHERE for_ticket=".$ticket_id.";");
}

?>