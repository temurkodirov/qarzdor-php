<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <script type="text/javascript" src = "styles/jquery.js"></script>
    <title>Qarzdor -> Boshqa</title>
</head>
<body>
<div class="container-fluid">

<?php include ("components/navbar.php"); ?>


<div class="rowie">
    <form action="vendor/import.php" method="POST" enctype="multipart/form-data">
        <b>Umumiy ro'yhatga qo'shish</b> <br>
        <br>
        <input type="file" name="file"> 
        <button type="sumbit"  name="importSubmit" value="IMPORT">import</button>
    </form>
</div>  
    
    <hr> 
    <div class="rowie">
    <b>  Umumiy ro'yhatdan excelga o'tkazish</b> <br><br>
        <a href="vendor/export.php"><button>export</button></a>
    </div>    
    <hr>
    <div class="rowie">
    <b>To'lovi yaqinlarni excelga o'tkazish </b>
    <button name=""><a href="vendor/exportsoon.php">export</a></button> 
    </div>
    <hr>
    <div class="rowie">        
    <b>To'lovni kechiktirganlarni excelga o'tkazish</b>   
    <button><a href="vendor/exportPast.php">export</a></button>
    </div>












</div>   
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="vendor/modal.js"></script>


</html>