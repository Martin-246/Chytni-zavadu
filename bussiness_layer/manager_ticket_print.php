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
        $html = $html . '<td><button>Service</button></td>'."\n";
        $html = $html . "</tr>\n";
    }

    return $html;
}

?>