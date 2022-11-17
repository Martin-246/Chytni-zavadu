<?php
include_once("../data_layer/db_tickets.php");
include_once("../data_layer/db_user.php");
include_once("../bussiness_layer/get_ticket.php");

function request_ticket_rows(){
    $id;
    $html = "";
    
    if(isset($_SESSION["email"])){
        $id =  get_user_by_email($_SESSION["email"])["id"];
    } else{
        echo "fatal error";
        exit();
    }
    
    $tickets = get_request_tickets($id);
    
    while($row = $tickets->fetch())
    {
        $my_ticket = get_ticket_data($row);
        $html = $html . "\n<tr>\n";
        $_SESSION['ticket_to_remove'] = $my_ticket[0];
        for($i=0;$i<=count($my_ticket);$i++){
            if($i==2){
                $html = $html . "<td>". $my_ticket[$i]." : ". $my_ticket[$i+1] ."</td>\n";
                $i++;
            }else if($i == 8){
                $html = $html . '<td><img src="'. $my_ticket[$i] .'" alt="Chyba" </td>'."\n";
            }else if($i == count($my_ticket)){
                
                $html = $html . '<td><a href = "../bussiness_layer/remove_ticket.php">Vymazat</a></td>'."\n";
            }else {
                $html = $html . "<td>". $my_ticket[$i] ."</td>"."\n";
            }
        }
        $html = $html . "</tr>\n";
    }
    return $html;
}

?>