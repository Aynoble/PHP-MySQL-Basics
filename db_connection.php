<?php

    $conn = mysqli_connect('localhost', 'Aynoble', 'CAbiNET17!', 'pizzas');

        if(!$conn){
            echo 'Connection Error:'.' '. mysqli_connect_error();
        }

?>