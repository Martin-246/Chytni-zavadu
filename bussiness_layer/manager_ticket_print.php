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
 * Getting first and last name of $id from certain $array
 * @return html code
 */
function get_name_by_id($array, $id) {
    for ($i = 0; $i < sizeof($array); $i++) 
    {
        if($array[$i][0] == $id)
            return $array[$i][1] . " " . $array[$i][2];
    }
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
    
    $tickets_table = get_tickets_by_state_manager($state);

    $workers = get_workers_array();
    $worker_select_html = worker_select_htmlgenerator($workers);

    while($ticket_row = $tickets_table->fetch())
    {
        $ticket = get_ticket_data($ticket_row);
        
        $assigned = false;
        if($row_request = get_request_by_ticket($ticket[0]))
        {
            $assigned = true;
            $req_state = $row_request['state'];
        }

        $html = $html . "<td>". $ticket[0] ."</td>"."\n"; //id
        $html = $html . "<td>". $ticket[1] ."</td>"."\n"; //category
        $html = $html . "<td>". $ticket[2]." : ". $ticket[3] ."</td>\n"; // lng:lat
        //status
        if($ticket[4] == 'Zaevidovaný')
        {
            $html = $html . "
            <td class='redText'>
            <form method='post' action='' enctype='multipart/form-data'>
            <select onchange='this.className=this.options[this.selectedIndex].className; this.form.submit()' class='redText' style='width:auto;border:0px;' id='status' name='status'>
            <option class='redText' value=0_$ticket[0] selected='selected'>Zaevidovaný</option>
            <option class='yellowText' value=1_$ticket[0]>Pracujeme na tom</option>
            <option class='greenText' value=2_$ticket[0]>Vyriešené</option>
            </select>
            </form>
            </td>"."\n";
        }
        if($ticket[4] == 'Pracujeme na tom') 
        {
            $html = $html . "
            <td class='yellowText'>
            <form method='post' action='' enctype='multipart/form-data'>
            <select onchange='this.className=this.options[this.selectedIndex].className; this.form.submit()' class='yellowText' style='width:auto;border:0px;' id='status' name='status'>
            <option class='redText' value=0_$ticket[0]>Zaevidovaný</option>
            <option class='yellowText' value=1_$ticket[0] selected='selected'>Pracujeme na tom</option>
            <option class='greenText' value=2_$ticket[0]>Vyriešené</option>
            </select>
            </form>
            </td>"."\n";
        }
        if($ticket[4] == 'Vyriešené') 
        {
            $html = $html . "
            <td class='greenText'>
            <form method='post' action='' enctype='multipart/form-data'>
            <select onchange='this.className=this.options[this.selectedIndex].className; this.form.submit()' class='greenText' style='width:auto;border:0px;' id='status' name='status'>
            <option class='redText' value=0_$ticket[0]>Zaevidovaný</option>
            <option class='yellowText' value=1_$ticket[0]>Pracujeme na tom</option>
            <option class='greenText' value=2_$ticket[0] selected='selected'>Vyriešené</option>
            </select>
            </form>
            </td>"."\n";
        }
        //Req
        if(!$assigned)
            $html = $html . "<td style='background-color:#e64747'>—</td>"."\n";
        else if($req_state == 0)
            $html = $html . "<td style='background-color:#c3c000'>0</td>"."\n";
        else if($req_state == 1)
            $html = $html . "<td style='background-color:#e6e22e'>1</td>"."\n";
        else if($req_state == 2)
            $html = $html . "<td style='background-color:#5cb935'>2</td>"."\n"; 
        $html = $html . "<td>". $ticket[5] ."</td>"."\n"; //message
        $html = $html . "<td>". $ticket[7] ."</td>"."\n"; //time_modified
        $html = $html . "<td>". $ticket[6] ."</td>"."\n"; //time_created
        $html = $html . '<td><img src="'. $ticket[8] .'" alt="Chyba" </td>'."\n"; //photo
        $html = $html . "<td><a id=\"Link\" onclick=\"Expand($counter);\" href=\"#\">Menu</a></td>"."\n";
        $html = $html . "</tr>\n";
        $html = $html . 
        "
        <tr class=\"RowNested$counter\" style=\"display:none\">
        <td colspan='10' class='intd'>
        <table class='nested'>
        <colgroup>
        <col width='7%'>
        <col width='17%'>
        <col width='7%'>
        <col width='60.85%'>
        <col width='8.15%'>
        </colgroup>
        <tr class='nestedfirst'>
        <form id='form_comment$counter' method='post' action='' enctype='multipart/form-data'>
            <td colspan='1'>Message:</td>
            <td colspan='3'><input type='text' id='comment' name='comment' value='".$ticket[5]."'></td>
            <td colspan='1'><input style='width:60%;' type='submit' onclick='clicked(event)' name='contains_ticket_id_comment' value='Send_$ticket[0]'></td>
        </form>
        </tr>
        <tr>
            <th colspan='5'>Service</th>
        </tr>
        </table>
        </td>
        </tr>
        ";
        if(!$assigned)
        {
            $html = $html .
            "
            <tr class=\"RowNested$counter\" style=\"display:none\">
            <td colspan='10' class='intd'>
            <table class='nested'>
            <colgroup>
            <col width='7%'>
            <col width='17%'>
            <col width='7%'>
            <col width='60.85%'>
            <col width='8.15%'>
            </colgroup>
            <tr class='nestedlast'>
            <form id='form$counter' method='post' action='' enctype='multipart/form-data'>
                <td colspan='1'>Worker:</td>
                <td colspan='1'>
                $worker_select_html
                </td>
                <td colspan='1'>Task:</td>
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
            $html = $html .
            "
            <tr class=\"RowNested$counter\" style=\"display:none\">
            <td colspan='10' class='intd'>
            <table class='nested'>
            <colgroup>
            <col width='7%'>
            <col width='17%'>
            <col width='7%'>
            <col width='60.85%'>
            <col width='8.15%'>
            </colgroup>
            <tr class='service'>
                <td colspan='1' style='text-align:center;'>Worker:</td>
                <td colspan='1'>".get_name_by_id($workers, $row_request['worker_id'])."</td>
                <td colspan='1' style='text-align:center;'>Task:</td>
                <td colspan='1'>".$row_request['description_from_manager']."</td>
                <td colspan='1'></td>
            </tr>
            </table>
            </td>
            </tr>
            ";

            if($req_state == 1)
            {
                $html = $html .
                "
                <tr class=\"RowNested$counter\" style=\"display:none\">
                <td colspan='10' class='intd'>
                <table class='nested'>
                <colgroup>
                <col width='25%'>
                <col width='25%'>
                <col width='25%'>
                <col width='25%'>
                </colgroup>
                <tr class='intr'>
                    <td colspan='1' style='font-weight: bold;'>Expected date:</td>
                    <td colspan='1'>".$row_request['expected_date']."</td>
                    <td colspan='1' style='font-weight: bold;'>Price:</td>
                    <td colspan='1'>".$row_request['price']."</td>
                </tr>
                <tr class='intr'>
                    <td colspan='1' style='font-weight: bold; padding-bottom:12px; border-bottom: 1px solid #000000;'>Comment:</td>
                    <td colspan='3' style='text-align:left; padding-bottom:12px; border-bottom: 1px solid #000000;'>".$row_request['comment_from_worker']."</td>
                </tr>
                </table>
                </td>
                </tr>
                ";
            }
            if($req_state == 2)
            {
                $html = $html .
                "
                <tr class=\"RowNested$counter\" style=\"display:none\">
                <td colspan='10' class='intd'>
                <table class='nested'>
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
                    <td colspan='1' style='font-weight: bold;'>Expected date</td>
                    <td colspan='2'>".$row_request['expected_date']."</td>
                    <td colspan='1' style='font-weight: bold;'>Fixed date</td>
                    <td colspan='1'>".$row_request['date_fixed']."</td>
                    <td colspan='1' style='font-weight: bold;'>Price</td>
                    <td colspan='1'>".$row_request['price']."</td>
                </tr>
                <tr class='intr'>
                    <td colspan='2' style='font-weight: bold; padding-bottom:12px; border-bottom: 1px solid #000000;'>Comment</td>
                    <td colspan='5' style='text-align:left; padding-bottom:12px; border-bottom: 1px solid #000000;'>".$row_request['comment_from_worker']."</td>
                </tr>
                </table>
                </td>
                </tr>
                ";
            }
        }

        $counter++;
    }

    return $html;
}

?>