<?php
    chdir('../..'); // root

    include_once('./bussiness_layer/admin/check_admin.php');
    enforce_admin();

    include_once('./data_layer/db_user.php');
    include_once('./bussiness_layer/admin/user_table_data.php');

    if(session_id() == "")
        session_start();

    echo "
    <tr>
        <th>ID</th>
        <th>Krstné meno</th>
        <th>Priezvisko</th> 
        <th>email</th>
        <th>telefón</th> 
        <th>rola</th>
        <th>zmazať</th>
    </tr>
    ";

    echo get_user_table_rows();
?>