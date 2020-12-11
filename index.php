<?php
    include('db_connection.php');

    $sql = 'SELECT email, pizzaType, ingredients, Id FROM mypizzas ORDER BY createdAt';

    $result = mysqli_query($conn, $sql);

    $myPizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

   // print_r($myPizzas);

    mysqli_free_result($result);
    mysqli_close($conn);

?>

<Doctype html>
<html>
    <head>
        <title>Datebase Display!</title>
    </head>
    <body>
        <?php foreach($myPizzas as $pizzas): ?>
        <h3><?php echo htmlspecialchars($pizzas['email']);?></h3>
        <h3><?php echo htmlspecialchars($pizzas['pizzaType']);?></h3>
        <?php foreach(explode(',', $pizzas['ingredients']) as $ing):?>
        <ul>
            <li><?php echo htmlspecialchars($ing);?></li>
        </ul>
        <?php endforeach;?>
        <a href='details.php?id=<?php echo $pizzas['Id'];?>'><button>More Info</button></a>
        <?php endforeach;?>

        <button><a href="testing.php">Add a pizza</a></button>
    </body>
</html>