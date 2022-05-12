<?php 
    session_start();
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location:login.php");
        exit();
    }

?>


<!DOCTYPE html>
<html lang="en">
	<head>
			<meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="style.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
			<title>Home</title>
	</head>
	<body>
        <div class="containerb">
            <div id="divh1">
                <h1 class="display-3">Krypton Trading</h1>
            </div>
            <nav class="btn-group">   
                <a href="home.php" class="btn btn-primary active" aria-current="page"><?php echo htmlspecialchars($_SESSION["username"]); ?></a>
                <a href="market_logged.php" class="btn btn-primary active" aria-current="page">Market</a>
                <a href="support.php" class="btn btn-primary active" aria-current="page">Support</a> 
                <a href="logout.php" class="btn btn-primary active" aria-current="page">Log out</a>  
                <?php 
                
                    if($_SESSION["admin"]==1){
                        echo "<a href='management.php' class='btn btn-primary active' aria-current='page'>Management</a>";
                    }

                ?>
            </nav>
            </div>

            <form action="#">
                <div class="form-group">
                    <input type="text" class="form-control bg-transparent" placeholder=" To:">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control bg-transparent" placeholder=" Subject:">
                </div>
                <div class="form-group">
                    <textarea id="email-compose-editor" class="textarea_editor form-control bg-transparent" rows="15" placeholder="Enter text ..."></textarea>
                </div>
            </form>
           
           
        
          
    </body>
</html>