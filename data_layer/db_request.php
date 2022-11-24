<?php
include_once("db_setup.php");
include_once("db_user.php");

/***
 * Getting requests depending on $state of $id worker
 * @return PDOStatement object
 */
function get_my_requests_by_state($id, $state){
    $db = get_pdo();
    return $db->query("SELECT * FROM SERVICE_REQUEST WHERE worker_id=".$id." AND state=".$state.";");
}

function get_my_requests($id){
    $db = get_pdo();
    return $db->query("SELECT * FROM SERVICE_REQUEST WHERE worker_id=".$id.";");
}

/***
 * Getting all tickets attached to requests of $id worker
 * @return PDOStatement object
 */
function get_request_tickets($id){
    $db = get_pdo();
    return $db->query("SELECT * FROM TICKET WHERE id = (SELECT for_ticket FROM SERVICE_REQUEST WHERE worker_id=".$id.");");
}

/***
 * Getting request by $ticket_id ticket
 * @return request dictionary
 */
function get_request_by_ticket($ticket_id){
    $pdo = get_pdo();

    $stmt = $pdo->prepare('SELECT * FROM SERVICE_REQUEST WHERE for_ticket = ?;');

    if( ! $stmt->execute([$ticket_id]))
        # execute FAILED!
        return null;
    
    return $stmt->fetch();
}

/***
 * Make $request_id request transition from 0 to 1 state. Filling in request with entered data
 * @return PDOStatement object
 */
function state_update_0_1($request_id, $date, $price, $comment){
    $db = get_pdo();
    return $db->query("UPDATE SERVICE_REQUEST SET state=1, expected_date='".$date."', price=".$price.", comment_from_worker='".$comment."' WHERE id=".$request_id.";");
}

/***
 * Make $request_id request transition from 1 to 2 state
 * @return PDOStatement object
 */
function state_update_1_2($request_id){
    $db = get_pdo();
    return $db->query("UPDATE SERVICE_REQUEST SET state=2, date_fixed=CURDATE() WHERE id=".$request_id.";");
}

/***
 * Inserting a new request
 */
function insert_request($worker_id, $ticket_id, $task)
{
    $pdo = get_pdo();
    
    $state = 0;
    $stmt = $pdo->prepare("INSERT INTO SERVICE_REQUEST (worker_id,for_ticket,description_from_manager,state) VALUES (:worker_id,:ticket_id,:task,:state)");

    $stmt->execute(["worker_id"=>$worker_id, "ticket_id" => $ticket_id , "task"=> $task , 'state'=>$state]);
}

?>