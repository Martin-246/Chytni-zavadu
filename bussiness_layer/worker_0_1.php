<?php
// Expected_date & Price sending (0 -> 1 state).
session_start();
include_once("../data_layer/db_request.php");

function get_reqID_by_submitVALUE($submit_value)
{
    $pos = strpos($submit_value,"_",0);
    $id_char = substr($submit_value,$pos+1,strlen($submit_value));

    return intval($id_char);
}

if (isset($_POST['contains_request_id']))
{
$req_id = get_reqID_by_submitVALUE($_POST['contains_request_id']);
$sql_date = date('Y-m-d', strtotime($_POST['expected_date']));
$price = $_POST['price'];
$comment = $_POST['comment'];

state_update_0_1($req_id, $sql_date, $price, $comment);

echo "STATE 0 -> 1";
header("refresh:3; ../present_layer/worker_requests.php");
}
else
{
    echo "ERROR!";
    header("refresh:3; ../worker.php");
}
?>
