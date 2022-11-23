<?php
    include_once('./data_layer/db_user.php');
    include_once('./bussiness_layer/constants.php');

    function foo($id)
    {
        echo "-> ".$id."\n";
    }

    function get_user_table_rows()
    {
        global $roles;

        $html = "";

        $stmt = get_all_users();

        while( $row = $stmt->fetch() )
        {
            $html_row = '<tr>';

            $html_row .= '<td> '.$row['id']." </td>\n";
            $html_row .= '<td> '.$row['first_name']." </td>\n";
            $html_row .= '<td> '.$row['last_name']." </td>\n";
            $html_row .= '<td> '.$row['email']." </td>\n";
            $html_row .= '<td> '.$row['phone']." </td>\n";
            $html_row .= '<td> '.$roles[ $row['role'] ]." </td>\n";

            // button that removes the user. P.S. Admin cannot be removed
            if($row['role'] != ADMIN)
            {
                if(user_has_tickets($row['id']))
                    // User has active tickets. Cannot remove
                    $html_row .= '<td> Má aktívne tikety </td>'."\n";
                else if(user_has_service_requests($row['id']))
                    // User has active service requests. Cannot remove
                    $html_row .= '<td> Má service requesty </td>'."\n";
                else
                    // Generate delete button
                    $html_row .= '<td> <button onclick="handle_remove_button('. $row['id'] .')"> Odstrániť </button> </td>' . "\n";
            }
            else
                $html_row .= "<td> </td>\n";

            $html_row .= "<tr>\n";

            $html .= $html_row;
        }

        return $html;
    }

?>
