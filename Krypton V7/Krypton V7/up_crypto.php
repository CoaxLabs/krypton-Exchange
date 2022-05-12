<?php

session_start();

include_once("config.php");

$crypto_err = "";

$sql = "SELECT * FROM currencies WHERE id_crypto='" . $_GET['id'] . "'";

$req = $bdd->query($sql);

while($row = $req->fetch())
{
    $namec = $row['name_crypto'];
    $acroc = $row['acronyme'];
    $pricec = $row['price'];
    $capacityc = $row['capacity'];

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

                <form action="add_crypto.php" method="post">         
                <div class="form-floating">
                    <input type="text" class="form-control <?php echo (!empty($crypto_err)) ? 'is-invalid' : ''; ?>" id="floatingInput"  value="<?php echo $namec; ?>" name="crypto">
                    <label for="floatingPassword">Name of Cryptocurrency</label>
                    <span class="invalid-feedback"><?php echo $crypto_err; ?></span>
                </div>

                <div class="form-floating">
                    
                    <input type="texte" class="form-control" id="floatingPassword" name="acro"  value="<?php echo $acroc; ?>">
                    <label for="floatingPassword">Acronym</label>
                </div> 

                <div class="form-floating">
                    
                    <input type="texte" class="form-control" id="floatingPassword" name="price"  value="<?php echo $pricec; ?>">
                    <span class="input-group-text">EXAMPLE : 00.00 $</span>
                    <label for="floatingPassword">Market Price</label>
                </div> 
                
                <div class="form-floating mb-3">
                    <input type="texte" class="form-control" id="floatingInput" name="market_cap"  value="<?php echo $capacityc; ?>">
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