<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
     session_start();
      echo $_SESSION['role'];

     if(isset($_SESSION['user_id'])&& isset($_SESSION['role'])&& $_SESSION['role']=='admin'){
       
?>

<h1>hello admin</h1>
    <a href="/logout.php"><button>logout</button></a>
    
    <?php }
    else{
        header("location:/login.php");
        exit;
    }
    
    ?>
    
</body>
</html>
