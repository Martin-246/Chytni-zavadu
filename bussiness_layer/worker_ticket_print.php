<?php
include_once("./data_layer/db_user.php");
include_once("./data_layer/db_tickets.php");
include_once("./data_layer/db_request.php");
include_once("./bussiness_layer/get_ticket.php");

// $html = $html . "<td>". $ticket[6] ."</td>"."\n"; //time_created
// $html = $html . "<td>". $ticket[7] ."</td>"."\n"; //time_modified
// $html = $html . '<td><img src="'. $ticket[8] .'" alt="Chyba" </td>'."\n"; //photo

function request_ticket_rows(){
    $id;
    $html = "";
    $counter = 0;
    
    if(isset($_SESSION["email"])){
        $id =  get_user_by_email($_SESSION["email"])["id"];
    } else{
        echo "fatal error";
        exit();
    }
    
    $requests_table = get_my_requests($id); //get_requests -> get_ticket_by_request
    
    while($row_request = $requests_table->fetch())
    {
        $row_ticket = (get_ticket($row_request['for_ticket']))->fetch();
        $ticket = get_ticket_data($row_ticket);

        //TICKET
        // $html = $html . "<td>". $ticket[1] ."</td>"."\n"; //category + 
        // $html = $html . "<td>". $ticket[2]." : ". $ticket[3] ."</td>\n"; // lng:lat +
        // $html = $html . "<td>". $ticket[6] ."</td>"."\n"; //time_created -+
        // $html = $html . "<td>". $ticket[7] ."</td>"."\n"; //time_modified -+
        // $html = $html . '<td><img src="'. $ticket[8] .'" alt="Chyba" </td>'."\n"; //photo +

        //REQUEST
        // $row_request['id'] +
        // $row_request['for_ticket'] +
        // $row_request['state']
        // $row_request['expected_date']
        // $row_request['price']
        // $row_request['time_spent']
        // $row_request['comment_from_worker']

        $html = $html . "<tr>\n";
        $html = $html . "<td>". $row_request['id'] ."</td>"."\n"; //request id
        $html = $html . "<td>". $ticket[1] ."</td>"."\n"; //category
        $html = $html . "<td>". $ticket[2]." : ". $ticket[3] ."</td>\n"; // lng:lat
        $html = $html . "<td>". $row_request['expected_date'] ."</td>"."\n"; //expected_date
        $html = $html . "<td>". $row_request['state'] ."</td>"."\n"; //request_state
        $html = $html . "<td><a id=\"Link\" onclick=\"Expand(". $counter .");\" href=\"#\">Expand</a></td>"."\n";
        $html = $html . "</tr>\n";
        $html = $html . 
        "
        <tr id=\"RowNested". $counter ."\" style=\"display:none\">
        <td colspan='6'>
        <table>
        <tr>
            <td colspan='3'; style='text-align:right'>Edited (by mngr): $ticket[7]</td>
        </tr>
        <tr>
            <th colspan='3'>Ticket</th>
        </tr>
        <tr>
            <td>Ticket ID</td>
            <td>".$row_request['for_ticket']."</td>
            <td rowspan='4'><img src='$ticket[8]' alt=\"Chyba\"</td>
        </tr>
        <tr>
            <td>Category</td>
            <td>$ticket[1]</td>
        </tr>
        <tr>
            <td>Position</td>
            <td>$ticket[2] : $ticket[3]</td>
        </tr>
        <tr>
            <td>Location</td>
            <td>Brno-Stred</td>
        </tr>
        <tr>
            <th colspan='3'>Service</th>
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