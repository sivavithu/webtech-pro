<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            display: flex;
            justify-content: center;
        }
        .computer{
            margin:10px;
        }
        .computer img{
            height:50px;
            width: 50px;
        }
    </style>
</head>
<body>
    <?php 
      function printcomp(){
    ?>
    <div class="computer" >
        <img src="./images/computer.png" alt="computer">
  </div>
  <?php } 
  
  for($i=0;$i<6;$i++){
    for($j=0;$j<10;$j++){
      printcomp();
    }
    echo "<br>";
  }
  
  
  ?>
</body>
</html>