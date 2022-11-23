<?php
include_once("./data_layer/db_user.php");
include_once("./data_layer/db_tickets.php");
include_once("./data_layer/db_request.php");
include_once("./bussiness_layer/get_ticket.php");

/***
 * Getting 2D array of workers with their attributes
 * @return 2D array
 */
function get_workers_array() {
    $table = get_users_by_role(3);
    $i = 0;
    while($row = $table->fetch())
    {
        $workers[$i][0] = $row['id'];
        $workers[$i][1] = $row['first_name'];
        $workers[$i][2] = $row['last_name'];
        $i++;
    }
    return $workers;
}
/***
 * Genereting the select of workers object from $array 
 * @return html code
 */
function worker_select_htmlgenerator($array) {
    $html = "";
    $html = $html . "
    <select id='worker' name='worker'>
    <option hidden disabled selected value></option>
    ";

    for ($i = 0; $i < sizeof($array); $i++) 
    {
        $html = $html . "<option value=".$array[$i][0].">".$array[$i][1]." ".$array[$i][2]."</option>";
    }

    $html = $html . "
    </select>
    ";

    return $html;
}

/***
 * Outputing ticket items depending on $state filter
 * @return html code
 */
function ticket_rows($state)
{
    $html = "";
    $counter = 0;
    
    if(isset($_SESSION["email"])){
        $id = get_user_by_email($_SESSION["email"])["id"];
    } else{
        echo "fatal error";
        exit();
    }
    
    $tickets_table = get_tickets_by_state($state);

    $workers = get_workers_array();
    $worker_select_html = worker_select_htmlgenerator($workers);

    while($ticket_row = $tickets_table->fetch())
    {
        $ticket = get_ticket_data($ticket_row);

        $html = $html . "<td>". $ticket[0] ."</td>"."\n"; //id
        $html = $html . "<td>". $ticket[1] ."</td>"."\n"; //category
        $html = $html . "<td>". $ticket[2]." : ". $ticket[3] ."</td>\n"; // lng:lat
        $html = $html . "<td>". $ticket[4] ."</td>"."\n"; //status
        $html = $html . "<td>". $ticket[5] ."</td>"."\n"; //message
        $html = $html . "<td>". $ticket[6] ."</td>"."\n"; //time_created
        //time_modified
        $html = $html . '<td><img src="'. $ticket[8] .'" alt="Chyba" </td>'."\n"; //photo
        $html = $html . "<td><a id=\"Link\" onclick=\"Expand($counter);\" href=\"#\">Service</a></td>"."\n";
        $html = $html . "</tr>\n";
        $html = $html . 
        "
        <tr class=\"RowNested$counter\" style=\"display:none\">
        <td colspan='8'>
        <table class='nested'>
        <colgroup>
        <col width='7%'>
        <col width='17%'>
        <col width='7%'>
        <col width='60.85%'>
        <col width='8.15%'>
        </colgroup>
        <tr>
            <th colspan='5'>Service</th>
        </tr>
        ";
        if($ticket[4] == "Zaevidovaný")
        {
            $html = $html .
            "
            <tr>
            <form id='form$counter' method='post' action='' enctype='multipart/form-data'>
                <td colspan='1'>Worker</td>
                <td colspan='1'>
                $worker_select_html
                </td>
                <td colspan='1'>Task</td>
                <td colspan='1'><input type='text' id='task' name='task'></td>
                <td colspan='1'><input style='width:60%;' type='submit' onclick='clicked_form(event,$counter)' name='contains_ticket_id' value='Send_$ticket[0]'></td>
            </form>
            </tr>

            </table>
            </td>
            </tr>
            ";
        }
        else
        {
            $row_request = get_request_by_ticket($ticket[0]);
            $html = $html .
            "
            <tr>
            <form id='form$counter' method='post' action='' enctype='multipart/form-data'>
                <td colspan='1'>Worker</td>
                <td colspan='1'>".$row_request['worker_id']."</td>
                <td colspan='1'>Task</td>
                <td colspan='1'>".$row_request['description_from_manager']."</td>
            </form>
            </tr>
    
            </table>
            </td>
            </tr>
            ";
        }

        $counter++;
    }

    return $html;
}

?>