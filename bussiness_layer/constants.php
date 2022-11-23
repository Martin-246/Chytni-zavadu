<?php
    define('ADMIN',1);
    define('MANAGER',2);
    define('WORKER',3);
    //global for states in which tickets exists
    $description_state = [0 => 'Zaevidovaný',1 => 'Pracujeme na tom',2 => 'Vyriešené'];
    //gloabl for roles of people
    $roles = [ 0 => '' , 1 => 'Administrátor' , 2 => 'Správca mesta', 3 => 'Technik'];
?>