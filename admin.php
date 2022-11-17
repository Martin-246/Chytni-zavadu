<?php
    include('./bussiness_layer/admin/check_admin.php');

    if( ! is_admin() ) 
        header('Location: ./index.php');
?>

SI ADMIN!

<form action="./present_layer/authentication/logout.php" class="inline">
        <button>Odhlásiť</button>
</form>
