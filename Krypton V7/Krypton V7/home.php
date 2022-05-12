<?php 
    session_start();
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location:login.php");
        exit();
    }

    //include_once("config.php");

 

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
                
                    if($_SESSION["admin"]>1){
                        echo "<a href='management.php' class='btn btn-primary active' aria-current='page'>Management</a>";
                    }

                ?>
            </nav>
            
        </div>
                <h2 class="display-5">Hello <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome on Krypton.</h2>
                <h6 class="display-3">Account settings</h6>
                
                <div id="content">
                    <div class="modify">
                        <h3>Account statistics</h3>

                    </div>
                    <div class="modify">
                        <h3></h3>
                    </div>    
                </div>


        <?php

/*include_once("config.php");

if(isset($_POST["upload"])){
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "img/avatar/".$filename;

    $sql= "INSERT INTO users (imagepath) VALUES (:uploadfile)";
    $req = $bdd->prepare($sql);
    $req->bindParam(':uploadfile',$filename,PDO::PARAM_STR);
    if($req->execute()){
        echo "c'est ok";
    }
    
    if (move_uploaded_file($tempname, $folder))  
    {
        $msg = "Image uploaded successfully";
        echo $filename;
        echo $tempname;
    }
    else{
        $msg = "Failed to upload image";

    }
    }*/

        ?>

    </body>
</html>