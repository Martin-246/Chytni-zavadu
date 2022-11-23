<?php
include_once("db_setup.php");
include_once("db_user.php");

function get_my_requests($id, $state){
    $db = get_pdo();
    return $db->query("SELECT * FROM SERVICE_REQUEST WHERE worker_id=".$id." AND state=".$state.";");
}

function get_request_tickets($id){
    $db = get_pdo();
    return $db->query("SELECT * FROM TICKET WHERE id = (SELECT for_ticket FROM SERVICE_REQUEST WHERE worker_id=".$id.");");
}

function get_request_by_ticket($ticket_id){
    $pdo = get_pdo();

    $stmt = $pdo->prepare('SELECT * FROM SERVICE_REQUEST WHERE for_ticket = ?;');

    if( ! $stmt->execute([$ticket_id]))
        # execute FAILED!
        return null;
    
    return $stmt->fetch();
}

function state_update_0_1($request_id, $date, $price, $comment){
    $db = get_pdo();
    return $db->query("UPDATE SERVICE_REQUEST SET state=1, expected_date='".$date."', price=".$price.", comment_from_worker='".$comment."' WHERE id=".$request_id.";");
}

function state_update_1_2($request_id){
    $db = get_pdo();
    return $db->query("UPDATE SERVICE_REQUEST SET state=2, date_fixed=CURDATE() WHERE id=".$request_id.";");
}

function insert_request($worker_id, $ticket_id, $task)
{
    $pdo = get_pdo();
    
    $state = 0;
    $stmt = $pdo->prepare("INSERT INTO SERVICE_REQUEST (worker_id,for_ticket,description_from_manager,state) VALUES (:worker_id,:ticket_id,:task,:state)");

    $stmt->execute(["worker_id"=>$worker_id, "ticket_id" => $ticket_id , "task"=> $task , 'state'=>$state]);
}

function aaa($request_id){
    $db = get_pdo();
    return $db->query("DELETE FROM SERVICE_REQUEST WHERE id=".$request_id.";");
}

?>