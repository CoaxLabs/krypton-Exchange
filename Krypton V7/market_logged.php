<?php

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("market.php");
    exit();
}

include_once("config.php");




?>


<!DOCTYPE html>
<html lang="en">
	<head>
			<meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://www.kraken.com/bundles/133f1b81d7e9ec762f16.min.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
            <link rel="stylesheet" href="style.css">
            <title>Market</title>
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
        <div id="divh2formb">
                <div id="divh4">
                <h2 class="display-5"><span class="spanMana">Market Place</span>
            
                <?php
                if($_SESSION["admin"]>1){
                        echo "<a href='php_crypto/add_crypto.php' class='btn btn-primary active' aria-current='page'>Add Currencie</a>";
                    }

                ?>

                </div>

                
                <div class="form-groupb">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col" colspan="2">Name</th>
                        <th scope="col">Acronym</th>
                        <th scope="col">Price</th>
                        <th scope="col">Market Cap.</th>
                        </tr>
                    </thead>
                    <tbody>
                    

                        <?php
                            
                            if(isset($_SESSION["username"]))
                            {
                                $req = $bdd->query('SELECT * FROM currencies');

                                while($row = $req->fetch())
                                {

                                    $idc = $row["id_crypto"];
                                    $namec = $row["name_crypto"];
                                    $acroc = $row["initiale"];
                                    $pricec = $row["price"];
                                    $capacityc = $row["capacity"];
                        ?>

                                <tr>
                                <th scope="row"><?php echo $idc ?></th>
                                <td><b><?php echo $namec ?></b></td>
                                <td><a href="#" class="tab_crypto"><?php echo $acroc ?></a></td>
                                <td><img src="img/<?php echo $namec?>.png" alt="<?php echo $namec ?>"></td>
                                <td><?php echo $pricec ?></td>
                                <td><?php echo $capacityc ?></td>
                                <td><a href="php_crypto/up_crypto.php?id=<?php echo $idc ?>" class='btn btn-primary active' aria-current='page' id="btnupdate">Update</a></td>
                                </tr>
                                        
                        <?php
                                }

                            }
                        ?>

                        <!-- <tr>
                        <th scope="row">2</th>
                        <td><b>Etherum</b></td>
                        <td><a href="#" class="tab_crypto">ETH</a></td>
                        <td><img src="img/etherum.png" alt="etherum"></td>
                        <td>2654.65 $</td>
                        <td>210 B.</td>
                        </tr>
                        <tr>
                        <th scope="row">3</th>
                        <td><b>Aave</b></td>
                        <td><a href="#" class="tab_crypto">AAVE</a></td>
                        <td><img src="img/aave.png" alt="aave"></td>
                        <td>479.53 $</td>
                        <td>15 M.</td>
                        </tr> -->
                    
                    </tbody>
                    <caption><a href="#">More about us.</a></caption>
                </table>
                </div>
                <div id="div_pformb">
                   <br><h5 class="display-5">For any deposit over $ 500, take advantage of free transaction fees</h5><br>
                   <div class="form-groupb">
                   <a href="home.php" class="btn btn-primary active" id="btn_reg_mark"> Check Balance.</a><br></div>
                </div> 
            </div> 

                </div>
            </div>   
        </div>       
	</body>
</html>






