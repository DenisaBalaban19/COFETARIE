<?php
include("Config.php");
if(isset($_SESSION['Mail'])){
    header("Location: home.html");
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Mail = $_POST['Mail'];
    $password = $_POST['password'];
    if(empty($Mail) || empty($password)){
        echo "Nu lasa campuri goale";
    }else{
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "COFETARIE";
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $query = "SELECT * FROM clients WHERE Mail = '$Mail' LIMIT 1";
         $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  
        $count = mysqli_num_rows($result);
  
  // If result matched $myusername and $mypassword, table row must be 1 row
    
  if($count == 1) {
     $_SESSION['login_user'] = $Mail;
        $_SESSION['login_user'] = $password;
     header("location: home.html");
  }else {
     $error = "Your Login Name or Password is invalid";
     echo "Email/parola incorecta";
  }
}
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
   
</head>
<body>

<form action="" method="post">
    <label for="Mail">Email:</label>
    <input name="Mail" type="text" name="Mail" id="Mail" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>
    <br>
    <input type="submit" name="submit" value="Login">
</form>

</body>
</html>