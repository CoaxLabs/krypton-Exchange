<?php
session_start();

include_once("config.php");
include_once("function.php");

$username= $password= $email="";
$username_err = $password_err = $email_err = "";

$test = $_GET['id'] ;
echo $test;

$sql = "SELECT * FROM users WHERE id ='" . $test . "'";

$req = $bdd->query($sql);


while($row = $req->fetch())
{
    $username = $row['username'];
    $password = "";
    $email = $row['email'];
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

    verifyName($_POST['username']);

    validateEmail($_POST['email']);
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
			<meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="style.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
			<title>Sign Up</title>
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
        <div id="divh2form">
            <div id="divh2">
                <h2 class="display-5">Update user</h2>
        </div>
            <div id="form">
                <div class="form-group">

                <form action="update.php" method="post" enctype="multipart/form-data">       
                <div class="form-floating">
                    <input type="text" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" id="floatingInput"  name="username">
                    <label for="floatingPassword">Username</label>
                    <span class="invalid-feedback"><?php echo $verify; ?></span>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" id="floatingPassword" name="password">
                    <label for="floatingPassword">Password</label>
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                </div>
                
                <div class="form-floating mb-3">
                    <input type="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>" id="floatingInput" name="email">
                    <label for="floatingInput">Email address</label>
                    <span class="invalid-feedback"><?php echo $email_err; ?></span>
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