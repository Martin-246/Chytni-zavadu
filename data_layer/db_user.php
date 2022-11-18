<?php
    include_once('db_setup.php');

    function get_user_by_email($email)
    {
        $pdo = get_pdo();

        $stmt = $pdo->prepare('SELECT * FROM PERSON WHERE email = ?;');

        if( ! $stmt->execute([$email]))
            # execute FAILED!
            return null;
        
        return $stmt->fetch();
    }

    function insert_user($f_name, $l_name, $email, $pw_hash,$role)
    {
        $pdo = get_pdo();

        $stmt = $pdo->prepare('INSERT INTO PERSON (first_name,last_name,PW_HASH,email,role) VALUES (:f_name,:l_name,:PW_HASH,:email,:role)');

        $stmt->execute(["f_name"=>$f_name, "l_name" => $l_name , "PW_HASH"=> $pw_hash , "email" => $email, 'role'=>$role]);
    }
?>