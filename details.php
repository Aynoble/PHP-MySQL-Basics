<?php

include('db_connection.php');

if(isset($_POST['delete'])){
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    $sql = "DELETE FROM mypizzas WHERE Id = $id_to_delete";

    if(mysqli_query($conn, $sql)){
        header('Location: index.php');
    }else{
        echo "query error:" . ' ' .mysqli_error($conn);
    }
}


if(isset($_GET['id'])) {
    $Id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM mypizzas WHERE Id = $Id";
    $result = mysqli_query($conn, $sql);
    $myPizzas = mysqli_fetch_assoc($result);
    // print_r($myPizzas);
    mysqli_free_result($result);
    mysqli_close($conn);
    
}


?>

<!Doctype html>
<html>
    <head>
        <title>Details</title>
    </head>
    <body>
        <?php if($myPizzas):?>
        <h3><?php echo $myPizzas['Email'];?></h3>
        <h4><?php echo $myPizzas['pizzaType'];?></h4>
        <h5><?php echo $myPizzas['Ingredients'];?></h5>
        <h6><?php echo $myPizzas['createdAt'];?></h6>
        <form action="details.php" method="POST">
            <input type="hidden" name="id_to_delete" value="<?php echo $myPizzas['Id']?>">
            <input name="delete" type="submit" value="Delete">
        </form>
        <?php else:?>
        <h3>No Pizza Exist!</h3>
        <?php endif;?>
        <button><a href="index.php">Back to ordered pizzas</a></button>
        
    </body>
</html>