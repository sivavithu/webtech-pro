<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .emailerr{
            background-color:red;
        }
    </style>
</head>

<body>
    <div class="signupform">
        <form action="" method="post">
            <div class="username">
                <span>Username:</span><input required ="text" name="username">
                    
                                    
            </div>
            <div class="email">
                <span>Email:</span><input required type="text" name="email">
            </div>
            <div class="password">
                <span>Password:</span><input required type="password" name="password"><br>
            </div>
            <div class="submit">
                <input type="submit" name="addnewstudent" value="addstudent">
            </div>
        </form>
    </div>
    <?php
    include "connection.php";
    
    if (isset($_POST['addnewstudent'])) {
        if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
            $username= $_POST['username'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $sql="insert into users(user_name,email,password,role)values('$username','$email','$password','student')";
            mysqli_query($con,$sql);

           }
        }
    
    ?>
</body>

</html>