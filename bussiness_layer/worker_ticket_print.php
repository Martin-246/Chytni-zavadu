<?php
include_once("./data_layer/db_user.php");
include_once("./data_layer/db_tickets.php");
include_once("./data_layer/db_request.php");
include_once("./bussiness_layer/get_ticket.php");

/***
 * Outputing request items depending on $state filter
 * @return html code
 */
function request_ticket_rows($state)
{
    $html = "";
    $counter = 0;
    
    if(isset($_SESSION["email"])){
        $id =  get_user_by_email($_SESSION["email"])["id"];
    } else{
        echo "fatal error";
        exit();
    }
    
    if($state == 3)
        $requests_table = get_my_requests($id);
    else
        $requests_table = get_my_requests_by_state($id, $state);
    
    while($row_request = $requests_table->fetch())
    {
        $row_ticket = (get_ticket($row_request['for_ticket']))->fetch();
        $ticket = get_ticket_data($row_ticket);

        if($row_request['state'] == 0)
            $html = $html . "<tr style='background-color: #e64747;'>\n";
        else if($row_request['state'] == 1)
        $html = $html . "<tr style='background-color: #e6e22e;'>\n";
        else if($row_request['state'] == 2)
            $html = $html . "<tr style='background-color: #5cb935;'>\n";
        $html = $html . "<td>". $row_request['id'] ."</td>"."\n"; //request id
        $html = $html . "<td>". $ticket[1] ."</td>"."\n"; //category
        $html = $html . "<td id='address".$ticket[0]."'><script type='text/javascript'>get_address(".$ticket[0].",".$ticket[2].",".$ticket[3].");</script></td>\n"; //street
        if($row_request['state'] != 2)
            $html = $html . "<td>". $row_request['expected_date'] ."</td>"."\n"; //expected_date
        else
            $html = $html . "<td>". $row_request['date_fixed'] ."</td>"."\n"; //fixed_date
        $html = $html . "<td>". $row_request['state'] ."</td>"."\n"; //request_state
        $html = $html . "<td style='border:0px; background-color: #FFFFFFFF'><a id=\"Link\" onclick=\"Expand(".$counter.");\" href=\"#\">EX</a></td>"."\n";
        $html = $html . "</tr>\n";
        $html = $html . 
        "
        <tr class=\"RowNested$counter\" style=\"display:none\">
        <td colspan='6'>
        <table class='menu'>
        <colgroup>
        <col width='25%'>
        <col width='6.25%'>
        <col width='6.25%'>
        <col width='12.5%'>
        <col width='25%'>
        <col width='25%'>
        </colgroup>
        <tr class='intr'>
            <th colspan='6' class='inhdr'>Request</th>
        </tr>
        <tr class='intr'>
            <td class='indescr' colspan='1'>Ticket ID:</td>
            <td colspan='4'>".$row_request['for_ticket']."</td>
            <td rowspan='4' colspan='1'><img src='$ticket[8]' alt=\"Chyba\"</td>
        </tr>
        <tr class='intr'>
            <td class='indescr' colspan='1'>Category:</td>
            <td colspan='4'>$ticket[1]</td>
        </tr>
        <tr class='intr'>
            <td class='indescr' colspan='1'>Position:</td>
            <td colspan='4'>$ticket[2] : $ticket[3]</td>
        </tr>
        <tr class='intr'>
            <td class='indescr' colspan='1'>Location:</td>
            <td colspan='4' id='address".$ticket[0]."a'><script type='text/javascript'>get_address('".$ticket[0]."a',".$ticket[2].",".$ticket[3].");</script></td>
        </tr>
        <tr class='intr'>
            <td class='indescr' style='padding-top:15px;padding-bottom:10px;' colspan='1'>Assignment:</td>
            <td colspan='5' style='text-align:left; padding-left:1%; padding-top:15px;padding-bottom:10px;'>".$row_request['description_from_manager']."</td>
        </tr>
        </table>
        </td>
        </tr>
        ";

        if($row_request['state'] == 0) // state constant TODO
        {
            $html = $html .
            "
            <tr class=\"RowNested$counter\" style=\"display:none\">
            <td colspan='7'>
            <table class='menu'>
            <colgroup>
            <col width='25%'>
            <col width='25%'>
            <col width='25%'>
            <col width='25%'>
            </colgroup>
            <tr class='intr'>
                <th colspan='4' class='inhdr'>Service</th>
            </tr>
            <tr class='intr'>
                <form id='form$counter' method='post' action='' enctype='multipart/form-data'>
                <td class='indescr' colspan='1'>Expected date:</td>
                <td colspan='1'><input type='date' id='expected_date' name='expected_date'></td>
                <td class='indescr' colspan='1'>Price:</td>
                <td colspan='1'><input type='number' step='0.01' id='price' name='price'><br></td>
            </tr>
            <tr class='intr'>
                <td class='indescr' colspan='1'>Comment:</td>
                <td colspan='3'><input type='text' id='comment' name='comment'></td>
            </tr>
            <tr>
                <td colspan='4'><input type = 'submit' onclick='clicked_0_1(event,$counter)' name = 'contains_request_id_0_1' value='Send_".$row_request['id']."'></td>
            </form>
            </tr>
            </table>
            </td>
            </tr>
            ";
        }
        else if($row_request['state'] == 1)
        {
            $html = $html .
            "
            <tr class=\"RowNested$counter\" style=\"display:none\">
            <td colspan='7' class='menu'>
            <table>
            <colgroup>
            <col width='25%'>
            <col width='25%'>
            <col width='25%'>
            <col width='25%'>
            </colgroup>
            <tr class='intr'>
                <th colspan='4' class='inhdr'>Service</th>
            </tr>
            <tr class='intr'>
                <td class='indescr' colspan='1'>Expected date:</td>
                <td colspan='1'>".$row_request['expected_date']."</td>
                <td class='indescr' colspan='1'>Price:</td>
                <td colspan='1'>".$row_request['price']."</td>
            </tr>
            <tr class='intr'>
                <td class='indescr' colspan='1'>Comment:</td>
                <td colspan='3' style='text-align:left; padding-left:1%;'>".$row_request['comment_from_worker']."</td>
            </tr>
            <tr>
            <form id='form$counter' method='post' action='' enctype='multipart/form-data'>
                <td colspan='4'><input type='submit' onclick='clicked(event)' name='contains_request_id_1_2' value='FINISH REQUEST_".$row_request['id']."'></td>
            </form>
            </tr>
            </table>
            </td>
            </tr>
            ";
        }
        else if($row_request['state'] == 2)
        {
            $html = $html .
            "
            <tr class=\"RowNested$counter\" style=\"display:none\">
            <td colspan='7' class='menu'>
            <table>
            <colgroup>
            <col width='18.75%'>
            <col width='6.25%'>
            <col width='12.5%'>
            <col width='18.75%'>
            <col width='18.75%'>
            <col width='12.5%'>
            <col width='12.5%'>
            </colgroup>
            <tr class='intr'>
                <th colspan='7' class='inhdr'>Service</th>
            </tr>
            <tr class='intr'>
                <td class='indescr' colspan='1'>Expected date:</td>
                <td colspan='2'>".$row_request['expected_date']."</td>
                <td class='indescr' colspan='1'>Fixed date:</td>
                <td colspan='1'>".$row_request['date_fixed']."</td>
                <td class='indescr' colspan='1'>Price:</td>
                <td colspan='1'>".$row_request['price']."</td>
            </tr>
            <tr class='intr'>
                <td class='indescr' colspan='2'>Comment:</td>
                <td colspan='5' style='text-align:left; padding-left:1%;'>".$row_request['comment_from_worker']."</td>
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