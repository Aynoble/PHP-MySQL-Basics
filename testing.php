<?php

$conn = mysqli_connect('localhost', 'Aynoble', 'CAbiNET17!', 'pizzas');

if(!$conn){
    echo 'Connection Error:'.' '. mysqli_connect_error();
}

$email=$pizzaType=$ingredients="";
$errors = array('email'=>"", 'pizzaType'=>"", 'ingredients'=>'');

  if(isset($_POST['submit'])) {
    
      
  // email error conditions...
      if(empty($_POST['email'])) {
        $errors['email'] = 'Please enter an email <br>';
      }elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $errors['email'] ='Must be a valid email address<br>';
      }else{
         $email = $_POST['email'];
      }
  // pizza error conditions...
      if(empty($_POST['pizzaType'])) {
        $errors['pizzaType'] = "Please add a pizza type<br>";
      }elseif(!preg_match('/^[a-zA-Z\s]+$/', $_POST['pizzaType'])) {
        $errors['pizzaType'] = "Please Ommit all special characters and numbers<br>";  
      }else{
        $pizzaType = $_POST['pizzaType'];
      }
  // ingredients error conditions...     
      if (empty($_POST['ingredients'])){
        $errors['ingredients'] = "Please add some ingredients";
      }elseif(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $_POST['ingredients'])){
        $errors['ingredients'] = "Please use a comma to seperate ingredients";
      }else{
        $ingredients = $_POST['ingredients'];
        
      if(array_filter($errors)){
      
      }else{
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pizzaType = mysqli_real_escape_string($conn, $_POST['pizzaType']);
        $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

        $sql = "INSERT INTO mypizzas(email, pizzaType, ingredients) VALUES('$email', '$pizzaType', '$ingredients')";

        if(mysqli_query($conn, $sql)){
          header('Location: index.php');
        }else{
          echo 'query error:' . mysqli_error($conn);
        }
      }
  }

  }

  
?>

<!Doctype html>
<html>
    <head>
        <title>Loop</title>
        <style>
          .body {
            position: relative;
            display: flex;
            flex-direction: column;
        
          }
          .loop {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 1px solid lightgray;
            padding: 20px;
            align-items: center;
            place-items: center;
            width: 500px;
            height: max-content;
          }
          .loop > form {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
          }
          .loop > form > input {
            margin-bottom: 20px;
            width: 350px;
            border: 1px solid lightgray !important;
            height: 25px;
            outline-width: 0;
            padding: 5px;
          }
          .loop > form > button {
              border: 1px solid lightgray !important;
              outline-width: 0;
              width: 100px;
              padding: 8px;
          }
          .loop > form > button:hover {
            background-color: darkgray;
          }
          .errors {
            color: red;
            /* display: none; */
          }
          .correct {
            color: green;
            /* display: none; */
          }
        </style>
    </head>
    <body>
        <div class='loop'>
          <center><h3>Simple Form</h3></center>
          <!-- Another alternative for the action="testing.php" is to use action="<?php echo $_SERVER['PHP_SELF'];?>", that's a super global constant that automatically generates the name of the page for you! -->
          <form action="testing.php" method="POST">

            <input type="text" name="email" value= "<?php echo htmlspecialchars($email)?>" placeholder="Email"/>
            <div class="errors"><?php echo $errors['email'];?></div>

            <input type="text" name="pizzaType" value="<?php echo htmlspecialchars($pizzaType)?>" placeholder="pizzaType"/>
            <div class="errors"><?php echo $errors['pizzaType']; ?></div>

            <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients)?>" placeholder="ingredients (should be seperated with a comma)"/>
            <div class="errors"><?php echo $errors['ingredients'];?></div>
            
            <button type="submit" value="submit" name="submit">submit</button>
          
          </form>

          
        <div>
    </body>
</html