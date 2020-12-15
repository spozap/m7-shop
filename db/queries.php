<?php
    
    function verifyUser($user,$password){
        $connection = getConnection();

        if(!$connection){
            return false;
        }

        $user = $connection->prepare("SELECT * FROM Customer WHERE username=? and password=?");
        $user->bind_param("ss",$user,$password);
        $user->execute();
        
        if ($user->affected_rows === 0){
            echo "No hay ningun usuario con ese usuario y contraseña.";
        }

        $connection->close();
    }

?>