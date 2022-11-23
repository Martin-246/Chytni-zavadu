<?php

/***
 * Parsing $submit_value string for id extracting
 * @return id
 */
function get_ID_by_submitVALUE($submit_value)
{
    $pos = strpos($submit_value,"_",0);
    $id_char = substr($submit_value,$pos+1,strlen($submit_value));

    return intval($id_char);
}

/***
 * Needed actions to do request state transition from 0 to 1
 */
function worker_0_1()
{
    $req_id = get_ID_by_submitVALUE($_POST['contains_request_id_0_1']);

    $sql_date = date('Y-m-d', strtotime($_POST['expected_date']));
    $price = $_POST['price'];
    $comment = $_POST['comment'];
    
    state_update_0_1($req_id, $sql_date, $price, $comment);
}

/***
 * Needed actions to do request state transition from 1 to 2
 */
function worker_1_2()
{
    $req_id = get_ID_by_submitVALUE($_POST['contains_request_id_1_2']);

    state_update_1_2($req_id);
}
?>