<?php
// Request finishing (1 -> 2 state).
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

state_update_1_2($req_id);

echo "STATE 1 -> 2";
header("refresh:3; ../present_layer/worker_requests.php");
}
else
{
    echo "ERROR!";
    header("refresh:3; ../worker.php");
}
?>