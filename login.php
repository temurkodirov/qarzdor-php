<?php
session_start();
// check auth
if(isset($_SESSION['user']['id'])){

    header('Location: index.php');
 
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>Login</title>
</head>

<body>
<style> 
    *{
  
        box-sizing: border-box;
    }
    body{
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        }
        h2{
            text-align: center;
            margin-bottom: 40px;
        }
        form{
            width:500px;
            border:2px solid #ccc;
            padding:30px;
            background:#fff;
            border-radius:15px;
        }
        input{
            display:block;
            border: 2px solid #ccc;
            width:95%;
            padding: 10px;
            margin: 10px auto;
            border-radius: 5px;
        }
        label{
            color:#888;
            font-size:18px;
            padding:10px;
        }
        button{
            float:right;
            background:#555;
            padding:10px 15px;
            color:#fff;
            border-radius: 5px;
            margin-right: 10px;
            border:none;
        }
        button:hover{
            opacity: .7;
        }
        .logerror{
            background: #F2DEDE;
            color: #A94442;
            padding: 10px;
            width: 95%;
            border-radius: 5px;
            margin:20px auto;
        } 
      

</style>


    
        <form action="vendor/checklogin.php" method="post">
            <h2>Login</h2>

            <?php if (isset($_SESSION['error'])): ?>
                <p class="logerror"><?= $_SESSION['error'] ?></p>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <label for="login">Login</label>
            <input type="text" name="login" placeholder="Login"  autocomplete="off">
            <label for="password">Password</label>
            <input type="text" name="password" id="inppas" placeholder="Password" autocomplete="off">
          
            <div class="loginbtn">
            <button id="btnlogin" type="submit" name="loginpassword">Sign in</button>
        </form>

</body>

<script>
	let inp = document.getElementById('inppas');
	let btn = document.getElementById('btnlogin');


	if (inp.value.length == 0) {
		// btn.disabled = true;
		btn.style.setProperty('float', 'right');
		btn.style.background = 'red';
		checkValue();
	}

	inp.addEventListener('input', () => {
		btn.style.setProperty('float', 'right');
		checkValue();
	});

	function checkValue()
	{
		if (inp.value == '') {
			// btn.disabled = true;
			btn.style.background = '#ff3333';
			btn.addEventListener('mouseover', move);
		} else {
			// btn.disabled = false;
			btn.style.background = '#555';
			btn.removeEventListener('mouseover', move);
		}
	}

	function move()
	{
		let pare = getComputedStyle(btn).getPropertyValue('float');
		if (pare == 'right') btn.style.setProperty('float', 'left'), btn.style.setProperty('margin-left', '44%');
		else btn.style.setProperty('float', 'right');
        
	}
</script>
</html>