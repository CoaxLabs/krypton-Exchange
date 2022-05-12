<?php

session_start();
include_once("config.php");

$crypto_err = "";

$crypto = $acro = $price = $cap = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

   
        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $folder = "img/".$filename;
    
        $sql= "INSERT INTO users (imagepath) VALUES (:uploadfile)";
        $req = $bdd->prepare($sql);
        $req->bindParam(':uploadfile',$filename,PDO::PARAM_STR);
        $req->execute();
            
        
        
        if (move_uploaded_file($tempname, $folder))  
        {
            $msg = "Image uploaded successfully";
        }
        else{
            $msg = "Failed to upload image";
    
        }
    

    if(empty(trim($_POST["crypto"])))
    {
        $crypto_err = "Enter name of currency";
    }
    else{
        $sql = "SELECT id_crypto FROM currencies WHERE name_crypto = :crypton";

        $req = $bdd->prepare($sql);
        $req->bindParam(":crypton",$req_crypton, PDO::PARAM_STR);
        $req_crypton = trim($_POST["crypto"]);
        $req->execute();

        if($req->rowCount() == 1){
            $crypto_err = "Currency already exist";
        }
        else{
            $crypto = $req_crypton;
        }
    }

    $price = trim($_POST["price"]);
    $acro = trim($_POST["acro"]);
    $cap = trim($_POST["market_cap"]);


    if(empty($crypto_err)){
        $sql = "INSERT INTO currencies (name_crypto, acronyme, price, capacity) VALUES (:name_crypto, :acronym, :price, :capacity)";

        $req = $bdd->prepare($sql);
        $req->bindParam(':name_crypto',$crypto, PDO::PARAM_STR);
        $req->bindParam(':acronym',$acro, PDO::PARAM_STR);
        $req->bindParam(':price',$price, PDO::PARAM_STR);
        $req->bindParam(':capacity',$cap, PDO::PARAM_STR);

        if($req->execute()){
            header("Location:market_logged.php");
        }
        else{
            echo "<span>Oops! Something went wrong. Please try again later.</span>";
        }
        unset($req);

    }

}


?>


<!DOCTYPE html>
<html lang="en">
	<head>
			<meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="style.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
			<title>ADD CURRENCIES</title>
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
                
                    if($_SESSION["admin"]==2){
                        echo "<a href='management.php' class='btn btn-primary active' aria-current='page'>Management</a>";
                    }

                ?>
            </nav>
        </div>
        <div id="divh2form">
            <div id="divh2">
                <h2 class="display-5">Add Currency</h2>
        </div>
            <div id="form">
                <div class="form-group">

                <form action="" method="post" enctype="multipart/form-data">         
                <div class="form-floating">
                    <input type="text" class="form-control <?php echo (!empty($crypto_err)) ? 'is-invalid' : ''; ?>" id="floatingInput"  name="crypto">
                    <label for="floatingPassword">Name of Cryptocurrency</label>
                    <span class="invalid-feedback"><?php echo $crypto_err; ?></span>
                </div>

                <div class="form-floating">
                    
                    <input type="texte" class="form-control" id="floatingPassword" name="acro">
                    <label for="floatingPassword">Acronym</label>
                </div> 

                <div class="form-floating">
                    
                    <input type="texte" class="form-control" id="floatingPassword" name="price">
                    <span class="input-group-text">EXAMPLE : 00.00 $</span>
                    <label for="floatingPassword">Market Price</label>
                </div> 
                
                <div class="form-floating mb-3">
                    <input type="texte" class="form-control" id="floatingInput" name="market_cap">
                    <label for="floatingInput">Market Capacity</label>
                    <span class="input-group-text">EXAMPLE : 00.00 B.</span>
                </div>
                <div class="form-floating" id="form-submit">
                    <input type="file" class="btn btn-primary" value="Upload File" name="uploadfile">
                </div>
                <div class="form-floating" id="form-submit">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <input type="reset" class="btn btn-secondary ml-2" value="Reset">
                </div>
                
                </form> 

            </div>  
        </div>       
	</body>
</html>


