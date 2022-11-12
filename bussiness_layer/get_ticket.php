<?php

include_once("../data_layer/db_tickets.php");

function get_ticket_data($row){
    $ticket[0] = $row["id"];
    $ticket[1] = get_ticket_category($row["category"]);
    $ticket[2] = $row["lng"];
    $ticket[3] = $row["lat"];
    $ticket[4] = $row["state_from_manager"];
    if (isset($row["msg_from_manager"])){
        $ticket[5] = $row["msg_from_manager"];
    }else {
        $ticket[5] = "";
    }
    $ticket[6] = $row["time_created"];
    if (isset($row["time_modified"])){
        $ticket[7] = $row["time_modified"];
    }else {
        $ticket[7] = "";
    }
    if (isset($row["photo"])){
        $ticket[8] = $row["photo"];
    }else {
        $ticket[8] = "../img/placeholder-image.png";
    }
    return $ticket;
}

function print_all_tickets_table_row(){
    $tickets = get_all_tickets(); 
            while($row = $tickets->fetch()){
                $ticket = get_ticket_data($row);
                echo "<tr>";
                for($i=0;$i<count($ticket);$i++){
                    if($i==2){
                        echo "<td>". $ticket[$i]." : ". $ticket[$i+1] ."</td>";
                        $i++;
                    }else if($i == 8){
                        echo '<td><img src="'. $ticket[$i] .'" alt="Chyba" </td>';
                    }else {
                        echo "<td>". $ticket[$i] ."</td>";
                    }
                }
                echo "</tr>";
            }
}
?>