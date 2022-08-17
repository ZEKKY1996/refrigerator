<?php

class Session{
    public function __construct(){

    }
    public function setSessionTime($link,$id,$sessionTime){
        $sql = <<<EOT
        UPDATE users
        SET status = "login",
            sessionTime = "$sessionTime"
        WHERE id = "$id"
        EOT;
        $result = mysqli_query($link ,$sql);
        if(!$result){
            error_log('Error: fail to get user pass').PHP_EOL;
            echo 'Debugging error:'.mysqli_error($link).PHP_EOL;
        }
    }
}
