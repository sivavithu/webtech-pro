<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 0;
        }

        .maincontainer {
            border: 1px solid black;
            width: 400px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .history {
            border: 1px solid black;
            width: 400px;
            padding: 8px;
            margin: 20px;
            text-align: left;
        }
    </style>
    <script>
if(window.history.replaceState){
    window.history.replaceState(null,null,window.location.href);}


    function button(str,issue_id){
        let form=document.createElement('form');
        form.action="";
        form.method="post"
        let input=document.createElement("input");
        input.type="hidden";
        input.name=str;
        input.value=issue_id;

        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
    }
 
 

</script>
</head>
<body>
    <?php
   
    session_start();
   

    include "connection.php"; 
    if(isset($_SESSION['user_id'])&& isset($_SESSION['role'])&& $_SESSION['role']=='student'){
        $user=$_SESSION['user_id'];

        function name(){
            if(isset($_POST['updater'])){
                $_SESSION['issue_id'] = $_POST['updater'];
                echo "update";
            }else{
                echo "submit";
            }
        }
    if(isset($_POST['deleter'])){
        $issue_id=$_POST['deleter'];
        $query="delete from complaints where issue_id='$issue_id'";
        
        if (mysqli_query($con, $query)) {
            echo "Complaint submitted successfully!";
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
   

?>

     <h1>Hello student</h1>
    

    <div class="maincontainer">
 
    <a href="logout.php"><button>Logout</button></a>
  <div class='search'>
    <form action="search.php" method="post">
        <input type="text" name="data">
         <input type="submit" name="search" value="search">
    </form>
  </div>

       
     <?php
           include "connection.php";  
     
      $sql="select * from complaints where user_id=$user";
          $result=mysqli_query($con, $sql);
      if ($result) {
        echo "Complaint submitted successfully!";
    } else {
        echo "Error: " . mysqli_error($con);
    }

     while($row=mysqli_fetch_assoc($result)){?>

         <div class='history'>
            
                <p><strong>Location:</strong> <?php echo $row['location']; ?></p>
                <p><strong>Date:</strong> <?php echo $row['date']; ?></p>
                <p><strong>Status:</strong> <?php echo $row['status']; ?></p>
                <p><strong>issue:</strong> <?php echo $row['issue']; ?></p>
                <p><strong>serial:</strong> <?php echo $row['serial']; ?></p>
                <button onclick="button('updater',<?php echo $row['issue_id'];?>)">update</button>
                <button onclick="button('deleter',<?php echo $row['issue_id'];?>)">delete</button>
            </div>
         </div>

     
     
     <?php }?>
   
    <?php
     
     include "connection.php";  


     if (isset($_POST['submit'])) {
         $username = $_POST['username'];
         $contact = $_POST['contact'];
         $location = $_POST['location'];
         $type = $_POST['type'];
         $date = $_POST['date'];
         $time = $_POST['time'];
         $issue = $_POST['issue'];
         $serial = $_POST['serial'];
    
     
         $query = "INSERT INTO complaints (user_id,username,contact,location,type,date,time, issue,serial,status)
                   VALUES ('$user','$username','$contact', '$location', '$type', '$date', '$time', '$issue', '$serial','unresolved')";
     
         if (mysqli_query($con, $query)) {
            echo "<script>window.location.href='studentuser.php';</script>";
         } else {
             echo "Error: " . mysqli_error($con);
         }
        
}



}
    else{
      header("location:Login.php");
     exit;
}

    ?>

</body>
</html>
