<?php 
session_start();
if(!isset($_SESSION['user']['id'])){
    die('sessuid emty');
}
$uid= $_SESSION['user']['id'];
require_once '../db.php';
if(isset($_POST['input'])) {

    $input = htmlentities(trim($_POST['input']));

    $query = "SELECT * FROM debt WHERE name LIKE '%$input%' AND debt.iduser = '$uid' ";

    $result = mysqli_query($db, $query);

    if(mysqli_num_rows($result) > 0) { ?>
        
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <script type="text/javascript" src = "styles/jquery.js"></script>
    <title>Qarzdor</title>
</head>
<body>
                    <table class="table searchresult0">
                    <b>Tezkor qidiruv</b>                        
                        <thead class="xzx">
                            <tr>
                                <th>#</th>
                                <th>Ism Familiya</th>
                                <th>Izohlar</th>
                                <th>Aloqa</th>
                                <th>Manzilr</th>
                                <th>Miqdor</th>
                                <th>Sanalar</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            <?php
                                while($arow = mysqli_fetch_assoc($result)){      
                                    ?>
                        <tr>
                                <td data-label="#"><?= $arow['id']?></td>
                                <td data-label="Ism Familiya"><?= $arow['name']?></td>
                                <td data-label="Izohlar"><?= $arow['comment']?></td>
                                <td data-label="Aloqa"><?= $arow['contact']?></td>
                                <td data-label="Manzil"><?= $arow['adress']?></td>
                                <td data-label="Miqdor"><?= $arow['amount']?></td>
                                <td data-label="Sana"><?= $arow['gDate']?> <br> 
                                                    <?= $arow['rDate']?></td>
                                <td>
                                    <button onclick="editF(<?= $xcell['0']?>)">edit</a></button><br>
                                    <button onclick="deleteF(<?= $xcell['0']?>)">delete</button>
                                </td>
                        </tr>
                            

                            <?php }?>
                        </tbody>
                    </table>
        
        
        
        <?php
        }else {
        echo "<h6> no data found </h6>";
        }


}
?>
</body>
</html>