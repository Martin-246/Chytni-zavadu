<?php
include_once("./data_layer/db_tickets.php");
include_once("./data_layer/db_user.php");
include_once("./bussiness_layer/constants.php");
/*Function which check and parse database row to array
Takes: fetched row of ticket from databes
Returns: array with ticket data*/
function get_ticket_data($row){
    global $description_state;
    $ticket[0] = $row["id"];
    $ticket[1] = get_ticket_category($row["category"]);
    $ticket[2] = $row["lng"];
    $ticket[3] = $row["lat"];
    $ticket[4] = $description_state[$row["state_from_manager"]];
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
//Depracted function which have no longer any use. But i was scared to remove it cuz who knows...
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
//function which makes html table of tickets of logged user
//Returns: string: html table
function my_ticket_rows(){
    global $description_state;
    $id = "";
    $html = "";
    //user must be logged in to perfom this action
    if(isset($_SESSION["email"])){
        $id =  get_user_by_email($_SESSION["email"])["id"];
    }else {
        echo "You have to be logged in to use 'My tickets' feature ...\nLOG: function: my_ticket_row";
        exit();
    }
    //get database view
    $my_tickets = get_my_tickets($id);
    //for every fetched row
    while($row = $my_tickets->fetch()){
        $my_ticket = get_ticket_data($row);
        $html = $html . "\n<tr>\n";
        for($i=0;$i<=count($my_ticket);$i++){
            if($i==2){
                $html = $html . "<td>". $my_ticket[$i]." : ". $my_ticket[$i+1] ."</td>\n";
                $i++;
            }else if($i == 8){
                $html = $html . '<td><img src="'. $my_ticket[$i] .'" alt="Chyba" </td>'."\n";
            }else if($i == count($my_ticket)){
                //if state is 0 then user have ability to remove ticket
                if ($my_ticket[4] == $description_state[0]){
                    $html = $html . '<td><button onclick="handle_remove_button('. $my_ticket[0] .')">Vymazať</button></td>'."\n";
                }
                
            }else {
                $html = $html . "<td>". $my_ticket[$i] ."</td>"."\n";
            }
        }
        $html = $html . "</tr>\n";
    }
    return $html;

}
//function which makes html table of all tickets
//Returns: string: html table
function all_ticket_rows(){
    $html = "";
    $my_tickets = get_all_tickets();
    while($row = $my_tickets->fetch()){
        $my_ticket = get_ticket_data($row);
        $html = $html . "\n<tr>\n";
        for($i=1;$i<count($my_ticket);$i++){
            if($i==2){
                $html = $html . "<td>". $my_ticket[$i]." : ". $my_ticket[$i+1] ."</td>\n";
                $i++;
            }else if($i == 8){
                $html = $html . '<td><img src="'. $my_ticket[$i] .'" alt="Chyba" </td>'."\n";
            }else {
                $html = $html . "<td>". $my_ticket[$i] ."</td>"."\n";
            }
        }
        $html = $html . "</tr>\n";
    }
    return $html;

}
//Function that parse all tickets data from database to JSON format
//Return: string: JSON format
function all_tickets_map_json(){
    $json = "[";
    $tickets = get_all_tickets();
    while($row = $tickets->fetch()){
        $ticket = get_ticket_data($row);
        $json = $json .'{"id":'.$ticket[0].',"category":"'.$ticket[1].'","lng":'.$ticket[2].', "lat":'.$ticket[3].'},'; //TODO
    }
    $json = rtrim($json,",");
    $json =$json . "]";
    return $json;
}
?>