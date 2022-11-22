<?php
include_once("./data_layer/db_user.php");
include_once("./data_layer/db_tickets.php");
include_once("./data_layer/db_request.php");
include_once("./bussiness_layer/get_ticket.php");

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
    
    while($ticket_row = $tickets_table->fetch())
    {
        $ticket = get_ticket_data($ticket_row);

        // if($ticket[4] == 'Zaevidovaný') // status = 0
        //     $html = $html . "<tr style='background-color: #e64747;'>\n";
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
        <tr>
        <form id='form$counter' method='post' action='' enctype='multipart/form-data'>
            <td colspan='1'>Worker</td>
            <td colspan='1'>
            <select name='worker'>
            <optgroup label = 'Janitors'>
            <option value=0>Walter White</option>
            <option value=1>Gustavo Fring</option>
            </optrgroup>
            <optgroup label = 'Metalworking Brno-jih division'>
            <option value=0>Karel Kralovec</option>
            <option value=1>Leonardo Heisenberg</option>
            </optgroup>
            <option value=2>Yuri Khovanskiy</option>
            </select>
            </td>
            <td colspan='1'>Task</td>
            <td colspan='1'><input type='text' id='task' name='task'></td>
            <td colspan='1'><input style='width:60%;;' type='submit' name='contains_ticket_id' value='Send_$ticket[0]'></td>
        </form>
        </tr>
        </table>
        </td>
        </tr>
        ";

    $counter++;
    }

    return $html;
}

?>