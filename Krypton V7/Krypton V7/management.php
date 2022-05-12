<?php

session_start();

include_once("config.php");

?>

<!DOCTYPE html>
<html lang="en">
	<head>
			<meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="style.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
			<title>Management</title>
	</head>
	<body>
        <div class="containerb">
            <div id="divh1">
                <h1 class="display-3">Krypton Trading</h1>
            </div>
            <nav class="btn-group">   
                <a href="home.php" class="btn btn-primary active" aria-current="page">Home</a>
                <a href="market_logged.php" class="btn btn-primary active" aria-current="page">Market</a>
                <a href="support.php" class="btn btn-primary active" aria-current="page">Support</a>   
                <a href="logout.php" class="btn btn-primary active" aria-current="page">Logout</a>
                <?php 
                
                    if($_SESSION["admin"]>1){
                        echo "<a href='management.php' class='btn btn-primary active' aria-current='page'>Management</a>";
                    }

                ?>            
            </nav>
            
        </div>

       
        <div id="divh2formb">
                <div id="divh4">
                    <h2 class="display-5"><span class="spanMana">Management</span><br><br></h2>
                    <?php
                    
                    if($_SESSION["admin"]>1){
                        echo '<span id="spanAdmin">Admin : '.''.htmlspecialchars($_SESSION["username"]).'</span>';
                        
                    }
                    else{
                        echo '<span id="spanUser">User : '.''.htmlspecialchars($_SESSION["username"]).'</span>';
                    }
                    
                    ?>
                    

                    <script src="jquery.min.js"></script>
                    
                    <script>
                    
                        $(document).ready(function(){

                            var idt = $("#spanAdmin").attr("id");

                            if(idt == "spanAdmin") {
                                
                                $('h4').addClass("spanA");
                              
                            }
                            else {

                                $('h4').addClass("spanU");
                           
                            }
                            
                        })
                    
                    </script>

                </div>
                <div>
                    <!-- <p id="p-formb" class="lead"> -->
                    <b><?php 
                    
                    if($_SESSION["admin"]>1){
                        echo '<h3 class="display-2"><span id="divh3" >Access Granted<br>Site members infos</span></h3>';
                    }
                    else{
                        echo '<h3 class="display-2"><span id="divh2formb">Acces Denied</span><br>Contact <a href="support.php" class="btn btn-primary active">support</a> if you think it\'s a mistake</h3>';
                    }
                    
                    
                     ?></b></p>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Password</th>
                        <th scope="col">Email</th>
                        <th scope="col">Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 

                    if(isset($_SESSION["username"]))
                    {

                       if($_SESSION["admin"]>1)
                       {
                           $req = $bdd->query('SELECT * FROM users');

                           while($row = $req->fetch())
                           {

                            $id = $row["id"];
                            $username = $row["username"];
                            $password_ver = $row["password"];
                            $email = $row["email"];
                            $admin = $row["admin"];

                            echo '<tr class="tableau">
                                    <th scope="row">'.$id.'</th>
                                    <td><b>'.$username.'</b></td>
                                    <td>'.$password_ver.'</td>
                                    <td>'.$email.'</a></td>
                                    <td>'.$admin.'</td>
                                    <td><a href="update.php?id='.$id.'">Update</a></td>
                                  </tr>';
                        
                            }
                        unset($req);
                        unset($bdd);
                            
                        }
                        else
                        {
                            echo '<div class="alert alert-danger">You have no permission to see this content!</div>';
                            echo '<a href="home.php" class="btn btn-primary active" aria-current="page">Return to Home</a>';
                        }
                    }

                    ?>
                    
                    </tbody>
                </table>
                

                </div>
            </div>   
        </div>       
	</body>
</html>