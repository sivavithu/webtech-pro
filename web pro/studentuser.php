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
     <div class='search'>
    <form action="" method="post">
        <input type="text" name="key">
         <input type="submit" name="search" value="search">
    </form>
  </div>

    <div class="maincontainer">
 
    <a href="logout.php"><button>Logout</button></a>
 

        <form action="" method="post">
            <div class="username">
                <label for="username">Username:</label>
                <input required type="text" id="username" name="username" value="">
            </div>
            <div class="contact">
                <label for="contact">Contact No:</label>
                <input required type="number" id="contact" name="contact" value="">
            </div>
            <div class="location">
                <label for="location">Location:</label>
                <select required id="location" name="location">
                    <option value="csl1">CSL1</option>
                    <option value="csl2">CSL2</option>
                    <option value="csl3">CSL3</option>
                    <option value="csl4">CSL4</option>
                </select>
            </div>
            <div class="type">
                <label for="type">Type:</label>
                <select required id="type" name="type">
                    <option value="equipment malfunction">Equipment Malfunction</option>
                    <option value="maintenance">Maintenance</option>
                </select>
            </div>
            <div class="datetime">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required>

                <label for="time">Time:</label>
                <input type="time" id="time" name="time" required>
            </div>
            <div class="issue">
                <label for="issue">Description of Issue:</label>
                <textarea id="issue" name="issue" rows="4" required></textarea>
            </div>
            <div class="serial">
                <label for="serial">Serial:</label>
                <input type="text" id="serial" name="serial">
            </div>
            <input type="submit" name="<?php name();?>" value="<?php name();?>">
        </form>
        
    </div>
     <?php
           include "connection.php";  
     if(!isset($_POST['search'])){
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
       

     
     
        <?php }
    } else if(isset($_POST['search'])){
        $keywords=$_POST['key'];
        $sql = "SELECT * FROM complaints WHERE issue LIKE '%$keywords%' or  username LIKE '%$keywords%' or  location LIKE '%$keywords%'
                 or  type LIKE '%$keywords%' or  status LIKE '%$keywords%' or  issue LIKE '%$keywords%'";
        $result = mysqli_query($con, $sql);

      if ($result) {
        
            while ($row = mysqli_fetch_assoc($result)) {?>
            
         <div class='history'>
            
            <p><strong>Location:</strong> <?php echo $row['location']; ?></p>
            <p><strong>Date:</strong> <?php echo $row['date']; ?></p>
            <p><strong>Status:</strong> <?php echo $row['status']; ?></p>
            <p><strong>issue:</strong> <?php echo $row['issue']; ?></p>
            <p><strong>serial:</strong> <?php echo $row['serial']; ?></p>
            <button onclick="button('updater',<?php echo $row['issue_id'];?>)">update</button>
            <button onclick="button('deleter',<?php echo $row['issue_id'];?>)">delete</button>
        </div>
               
            <?php }
        } else {
            echo "Error: " . mysqli_error($con);
        }
        
       
        mysqli_close($con);
    }
    ?>
   
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

if (isset($_POST['update'])) {
   

    $issue_id=$_SESSION['issue_id'];
    $updatedUsername = $_POST['username'];
    $updatedLocation = $_POST['location'];
    $updatedType = $_POST['type'];
    $updatedDate = $_POST['date'];
    $updatedTime = $_POST['time'];
    $updatedIssue = $_POST['issue'];
    $updatedSerial = $_POST['serial'];

    $updateQuery = "UPDATE complaints 
                    SET username = '$updatedUsername', 
                        location = '$updatedLocation', 
                        type = '$updatedType', 
                        date = '$updatedDate', 
                        time = '$updatedTime', 
                        issue = '$updatedIssue', 
                        serial = '$updatedSerial' 
                    WHERE issue_id = '$issue_id'";

    if (mysqli_query($con, $updateQuery)) {
        unset($_SESSION['issue_id']);
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
  </div>
</body>
</html>
