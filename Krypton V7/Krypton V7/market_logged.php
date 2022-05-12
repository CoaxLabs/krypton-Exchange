<?php

session_start();

// if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
//     header("market.php");
//     exit();
// }

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

                <a href="home.php" class="btn btn-primary active" aria-current="page"><?php 
                
                if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){

                    echo "<b>Home</b>"; ?></a><?php
                }
                else{
                    echo htmlspecialchars($_SESSION["username"]); ?></a><?php
                   
                } ?>

                <a href="market_logged.php" class="btn btn-primary active" aria-current="page">Market</a>
                <a href="support.php" class="btn btn-primary active" aria-current="page">Support</a>
                
                <?php
                    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
                ?>
                <a href="login.php" class="btn btn-primary active" aria-current="page"><b>Sign in</b></a> 
                <?php
                    }
                    else{

                ?>
                <a href="logout.php" class="btn btn-primary active" aria-current="page">Log out</a>
                <?php
                    if(($_SESSION["admin"])>1){?>
                        <a href='management.php' class='btn btn-primary active' aria-current='page'>Management</a>
                        <a href='add_crypto.php' class='btn btn-primary active' aria-current='page'>ADD CURRENCY</a><?php
                        }
                    } 
           
                ?>
            </nav>  
            
        </div>
        
                <div id="divh4">
                <h2 class="display-5"><span class="spanMana">Market Place</span>            
                </div>

                
                <div class="form-groupb">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th class="tabmarket" scope="col" colspan="3">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col" colspan="2">Market Cap.</th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                    

                        <?php                           
                                $req = $bdd->query('SELECT * FROM currencies');

                        while($row = $req->fetch())
                        {

                                    $idc = $row["id_crypto"];
                                    $namec = $row["name_crypto"];
                                    $acroc = $row["acronyme"];
                                    $pricec = $row["price"];
                                    $capacityc = $row["capacity"];
                        ?>

                                <tr>
                                <!-- <th scope="row"><?php //echo $idc; ?></th> -->
                                <td><?php echo $idc; ?></td>
                                <td><b><?php echo $namec; ?></b></td>
                                <td><a href="#" class="btn btn-primary"><?php echo $acroc ?></a></td>
                                <td><img src="img/<?php echo $namec?>.png" alt="<?php echo $namec; ?>"></td>
                                <td><?php echo $pricec; ?></td>
                                <td><?php echo $capacityc; ?></td>
                        <?php
                        if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
                        }
                        else{
                            if(($_SESSION["admin"])>1){

                        ?>
                                <td class="btncrypto"><a href="up_crypto.php?id=<?php echo $idc ?>" class='btn btn-primary active' aria-current='page'>Update</a></td>
                                <td class="btncrypto"><a href="#" class='btn btn-primary active' aria-current='page'>Delete</a></td>                 
                            
                        <?php
                            }                        
                        }
                        }                               
                        ?>
                                </tr>     
                    </tbody>
                    <caption><a href="#">More about us.</a></caption>
                </table>
                </div>
                <h2>View Details</h2>
                <div id="viewdiv">
                <figure class="viewfigure">
                    <!-- TradingView Widget BEGIN -->
                    <div class="tradingview-widget-container">
                    <div id="tradingview_e3165"></div>
                    <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/symbols/BTCUSD/?exchange=BITSTAMP" rel="noopener" target="_blank"><span class="blue-text">BTCUSD Chart</span></a> by TradingView</div>
                    <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                    <script type="text/javascript">
                    new TradingView.widget(
                    {
                    "width": 780,
                    "height": 410,
                    "symbol": "BITSTAMP:BTCUSD",
                    "interval": "D",
                    "timezone": "Etc/UTC",
                    "theme": "light",
                    "style": "0",
                    "locale": "en",
                    "toolbar_bg": "#f1f3f6",
                    "enable_publishing": false,
                    "allow_symbol_change": true,
                    "container_id": "tradingview_e3165"
                    }
                    );
                    </script>
                    </div>
                    <!-- TradingView Widget END -->
                </figure>
                <figure class="viewfigure">
                    <!-- TradingView Widget BEGIN -->
                    <div class="tradingview-widget-container">
                    <div id="tradingview_3fcfe"></div>
                    <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/symbols/LTCUSD/?exchange=BITFINEX" rel="noopener" target="_blank"><span class="blue-text">LTCUSD Chart</span></a> by TradingView</div>
                    <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                    <script type="text/javascript">
                    new TradingView.widget(
                    {
                    "width": 780,
                    "height": 410,
                    "symbol": "BITFINEX:LTCUSD",
                    "interval": "D",
                    "timezone": "Etc/UTC",
                    "theme": "light",
                    "style": "0",
                    "locale": "en",
                    "toolbar_bg": "#f1f3f6",
                    "enable_publishing": false,
                    "allow_symbol_change": true,
                    "container_id": "tradingview_3fcfe"
                    }
                    );
                    </script>
                    </div>
                    <!-- TradingView Widget END -->
                </figure>
                </div> 
                <div id="div_pformb">
                   <h5 class="display-5">For any deposit over $ 500, take advantage of free transaction fees</h5><br>
                </div>
                               
                <div>
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="img/bitbit.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title"><b>BITCOIN</b></h4>
                            <p class="card-text">1 USD = 0.000035 BTC<br>
                                                 1 EUR = 0.000037 BTC <br>
                                                 1 RUB = 0.00000051 BTC <br>
                                                 1 JPY = 0.00000027 BTC <br>
                                                 1 USDT = 0.000035 BTC <br>
                                                 1 BUSD = 0.000035 BTC</p>
                            <div class="containerb">
                                <a href="#" class="btn btn-primary">Buy</a>
                                <a href="#" class="btn btn-primary">Sell</a>
                            </div>
                           
                        </div>
                    </div>
                </div>
                

	</body>
</html>






