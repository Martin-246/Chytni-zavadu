<?php
    include_once('db_setup.php');

    /***
     * Get the first user wth given email from database
     * @return dict representing user with given email
     */
    function get_user_by_email($email)
    {
        $pdo = get_pdo();

        $stmt = $pdo->prepare('SELECT * FROM PERSON WHERE email = ?;');

        if( ! $stmt->execute([$email]))
            # execute FAILED!
            return null;
        
        return $stmt->fetch();
    }

    /***
     * Insert user with given attrbutes to database
     */
    function insert_user($f_name, $l_name, $email, $pw_hash,$role)
    {
        $pdo = get_pdo();

        $stmt = $pdo->prepare('INSERT INTO PERSON (first_name,last_name,PW_HASH,email,role) VALUES (:f_name,:l_name,:PW_HASH,:email,:role)');

        $stmt->execute(["f_name"=>$f_name, "l_name" => $l_name , "PW_HASH"=> $pw_hash , "email" => $email, 'role'=>$role]);
    }

    /***
     * Get all rows from the PERSON table
     * @return PDOStatement object
     */
    function get_all_users()
    {
        $pdo = get_pdo();

        $stmt = $pdo->query('SELECT id,first_name,last_name,email,phone,role FROM PERSON;');
 
        return $stmt;
    }

    function remove_user($id)
    {
        $pdo = get_pdo();

        $stmt = $pdo->prepare('DELETE FROM PERSON WHERE id = ?;');

        $stmt->execute([$id]);
    }


?>