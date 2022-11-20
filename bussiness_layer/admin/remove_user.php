<?php
    /***
     * This file is called using AJAX in order to delete a user
     */

    chdir('../..'); // root
    
    include_once('./bussiness_layer/admin/check_admin.php');
    enforce_admin();

    include_once('./data_layer/db_user.php');

    if(isset($_POST['remove_user_id']))
    {
        remove_user($_POST['remove_user_id']);
    }

    
?>