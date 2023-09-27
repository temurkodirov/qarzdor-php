<?php 



    $num=1234567;
    $flt='.';
    $thousands_seperator=' ';
    echo(number_format($num,0,$flt,$thousands_seperator)) ;
    


?>  

<div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="index.php" class="nav-item nav-link 


                    <?php  if ($page === 'home')  {echo "active";} ?>
                  

                >Bosh sahifa</a>
                <a href="about.php" class="nav-item nav-link
                    <?php if ($page === 'about') {echo "active";} ?>
                ">Haqimizda</a>
                <a href="service.php" class="nav-item nav-link
                    <?php if ($page === 'service') {echo "active";} ?>
                ">Xizmatlar</a>
                <a href="products.php" class="nav-item nav-link 
                    <?php if ($page === 'products') {echo "active";} ?>
                ">Mahsulotlar</a>
                
                <a href="contact.php" class="nav-item nav-link
                <?php if ($page === 'contact') {echo "active";} ?>
                
                ">Aloqa</a>
            </div>