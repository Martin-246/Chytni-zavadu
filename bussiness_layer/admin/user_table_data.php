<?php
    include_once('./data_layer/db_user.php');

    function get_user_table_rows()
    {
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
            $html_row .= '<td> '.$row['role']." </td>\n";
            $html_row .= '<td> <a href="../../bussiness_layer/admin/remove_user.php"> Odstrániť </a> </td>' . "\n";

            $html_row .= "<tr>\n";

            $html .= $html_row;
        }

        return $html;
    }

?>