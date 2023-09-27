<?php
session_start();

// check auth
if(!isset($_SESSION['user']['id'])){
    header('Location: login.php');
}
$uid= $_SESSION['user']['id'];

require_once 'db.php';

if (isset($_GET['page'])) {
    $page = (int) $_GET['page'];
} else {
    $page = 1;
} 


$limit = 5000;
$offset = ($page-1) * $limit;
$baza = mysqli_query($db, "SELECT COUNT(*)  AS ct FROM debt WHERE debt.iduser=$uid");
$count_all = mysqli_fetch_assoc($baza)['ct'];
$total_pages = ceil($count_all / $limit);

$flt='.';
$thousands_seperator=' ';

$xrow = mysqli_query($db, "SELECT * FROM debt WHERE debt.iduser=$uid ORDER BY id DESC LIMIT $offset, $limit");
$xrow = mysqli_fetch_all($xrow);

$xrowCountAllSum = mysqli_fetch_assoc(mysqli_query($db, "SELECT  SUM(debt.amount)  AS countAllSum FROM debt WHERE debt.iduser=$uid" ))['countAllSum'] ;
$xammassi=number_format($xrowCountAllSum,0,$flt,$thousands_seperator);

// sms juntaishga funksiya
// function sms(int $number = 0, string $text = '')
// {
//     if ($number !== 0 && $text !== '') {
//         // saytdan olingan kod
//     }
//     return null;
// }

$webpage = 'index';

?>

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
    
    <div class="container-fluid">
    <?php include ("components/navbar.php"); ?>

    <div class="pagename">  <b>Barcha qarzlar: <?= $xammassi ?></b> 
    <a href="vendor/logout.php">Log out</a>
    
        </div>

      



            <ul class="live-qidiruv" >
                    <li>
                        <input class="tezkorqidiruv" 
                        type="search"  placeholder="Izlash" autocomplete="off" id="live_search">
                    </li>
            </ul>
        


    <div id="searchresult" class="searchresult"></div>
    <div class="kurwa"><div class="kurwa"></div></div>
    <table class="table ">
    <form action="vendor/create.php" method="POST">
    <thead>
        <tr>
            <th>#</th>
            <th>Ism Familiya</th>
            <th>Izohlar</th>
            <th>Aloqa</th>
            <th>Manzil</th>
            <th>Miqdor</th>
            <th>Sanalar</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <tr>
            <td data-label="#"></td>
            <td data-label="Ism Familiya"><input class="tbInput"  type="text" name="name" required></td>
            <td data-label="Izohlar"><input  class="tbInput" type="text" name="comment"></td>
            <td data-label="Aloqa"><input class="tbInput"  oninput="kichik(this)" id="telnum" type="number" name="contact"></td>
            <td data-label="Manzil"><input  class="tbInput" type="text" name="adress"></td>
            <td data-label="Miqdor"><input  class="tbInput" oninput="checkamount(this)" id="qarzbor" type="number" name="amount"></td>
            <td data-label="Sana"><input class="tbInput" type="date" name="gDate"> <br>
                                <input  class="tbInput" type="date" name="rDate"></td>
            <td><button type="submit" id="addbtn" name="add">add</button></td>
        </tr>
        </form>
        <script>
            function kichik(e){
                if(e.value.length>9){
                    addbtn.disabled=true;
                    telnum.style.color = "red";
                }else{
                    addbtn.disabled=false;
                    telnum.style.color = "black";
                }
            }
            function checkamount(a){
                if(a.value.length>9){
                    addbtn.disabled=true;
                    qarzbor.style.color = "red";
                }else{
                    addbtn.disabled=false;
                    qarzbor.style.color = "black";
                }
            }

        </script>
        <?php
           
        foreach($xrow as $xcell){
            $num=$xcell['5'];
            $xcell['5']=number_format($num,0,$flt,$thousands_seperator); 
            $xcell['6']=strtotime($xcell['6']);
            $xcell['6']=date('d-m-Y',$xcell['6']);       
            $xcell['7']=strtotime($xcell['7']);
            $xcell['7']=date('d-m-Y',$xcell['7']);       
        ?>
      <tr>
            <td data-label="#"><?= $xcell['0']?></td>
            <td data-label="Ism Familiya"><?= $xcell['1']?></td>
            <td data-label="Izohlar"><?= $xcell['2']?></td>
            <td data-label="Aloqa"><?= $xcell['3']?></td>
            <td data-label="Manzil"><?= $xcell['4']?></td>
            <td data-label="Miqdor"><?= $xcell['5']?></td>
            <td data-label="Sana"><?= $xcell['6']?> <br> 
                                  <?= $xcell['7']?></td>
            <td>
                <button onclick="editF(<?= $xcell['0']?>)">edit</a></button><br>
                <button onclick="deleteF(<?= $xcell['0']?>)">delete</button><br>
            </td>

        </tr>
           

        <?php }?>
    </tbody>
</table>
        
        <?php if($total_pages > 1): ?>
            <div class="pagination">
                <?php for ($i = 1; $i < $total_pages +1; $i++): ?>
                     <a href="?page=<?= $i ?>" <?php if($page == $i) echo "class='active'"; ?>><?= $i ?></a>
                <?php endfor; ?>
            </div>
        <?php endif; ?>


  <!-- alerts -->
<div id="deleteWindow" class="delete-window">
    <button class="dw-close-btn"  onclick="closef()">&times</button>
    <p>O'chirishni hohlaysizmi? </p>
    <div class="insidedw"> 
    <button onclick="closef()">cancel</button>
    <a id="linkdelete" href="#"><button>delete</button> </a></div>
</div>

<div id="editWindow" class="edit-window">
        <form action="vendor/update.php" method="POST" class="aaaa"> 

            <input type="hidden" id="id" name="id" value="">

            <label for="name">Ism familiya</label> 
            <input type="text" id="name" name="name" value="name"> <br>
                <label for="comment">Izohlar</label>
            <input type="text" id="comment" name="comment" value="comment"><br>
                <label for="contact">Aloqa</label>
            <input  type="number" id="contact" name="contact" value="contact"><br>
                <label for="adress">Manzil</label>
            <input type="text" id="adress" name="adress" value="adress"><br>
                <label for="amount">Miqdor</label>
            <input type="number" id="amount" name="amount" value="amount"><br>
                <label for="gDate">Sana</label>
            <input type="date" id="gDate" name="gDate" value="gDate"> <br>
            <input type="date" id="rDate" name="rDate" value="rDate"> <br>

            <div class="div-edit-btn">
                <button onclick="closeef()">ortga</button>
                <button type="submit">saqlash</button>
            </div> 
        </form>  


</div>    
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="vendor/modal.js"></script>

    <script type="text/javascript"> 
        $(document).ready(function(){
            $("#live_search").keyup(function(){
                var input = $(this).val();
                // alert(input);

                if(input != ""){
                    $.ajax({
                        url:"vendor/livesearch.php",
                        method:"POST",
                        data:{input:input},

                        success:function(data){
                            $("#searchresult").html(data);
                            $("#searchresult").css("display","block");
                        }
                    });
                }else{
                    $("#searchresult").css("display","none");
                } 
            });
        });
    </script>
</html>
?> 