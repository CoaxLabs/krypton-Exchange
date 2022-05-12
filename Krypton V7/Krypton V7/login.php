<?php 

session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("Location:home.php");
    exit();
}

require_once("config.php");

$username = $password = "";
$username_err = $password_err = $login_err = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(empty(trim($_POST["username"]))){ 
        $username_err = "Please enter a username";
    }
    else{
        $username = trim($_POST["username"]);
    }

    if(empty(trim($_POST["password"]))){ 
        $password_err = "Please enter a password";
    }
    else{
        $password = trim($_POST["password"]);
    }

    if(empty($username_err) && empty($password_err)){
        
        $sql = "SELECT id, username, password, admin FROM users WHERE username = :username AND password = :password";

        if($req = $bdd->prepare($sql)){

            $req->bindParam(':username', $req_username, PDO::PARAM_STR);
            $req->bindParam(':password', $req_password, PDO::PARAM_STR);

            $req_username = trim($_POST["username"]);
            $req_password = trim(sha1($_POST["password"]));

            if($req->execute()){

                if($req->rowCount() == 1){

                    if($row = $req->fetch()){

                        $id = $row["id"];
                        $username = $row["username"];
                        $password_ver = $row["password"];
                        $admin = $row["admin"];

                        

                            $req2 = $bdd->prepare('SELECT admin FROM users WHERE username=:username');
                            $req2->bindParam(':username',$username, PDO::PARAM_STR);
                            $req2->execute();
                            $row2 = $req2->fetch();

                            $_SESSION['admin'] = $row2[0];
                            $_SESSION['username'] = $username;
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;

                            $req->closeCursor();
                            header('Location:home.php');
                            exit();
                        
                     

                           
                    }
                    else{
                            $login_err = "Invalid name or password.";
                    }

                    

                }else{
                    $login_err = "Invalid name or password. ";
                }

            }else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            unset($req);

        }



    }

    unset($bdd);


}

?>





<!DOCTYPE html>
<html lang="en">
	<head>
			<meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="style.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
			<title>Sign In</title>
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
                <a href="register.php" class="btn btn-primary active" aria-current="page"><b>Sign up</b></a>               
            </nav>
        </div>
        <div id="divh2form">
            <div id="divh2">
                <h2 class="display-5">Sign in to Krypton</h2>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

            </div>
        <div id="form">
            <div class="form-group">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-floating">
                    <input type="text" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" id="floatingInput" placeholder="Username" name="username">
                    <label for="floatingPassword">Username</label>
                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" id="floatingPassword" placeholder="Password" name="password">
                    <label for="floatingPassword">Password</label>
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                </div>
                <div id="submitlogin">
                    <div class="form-floating">
                        <input type="submit" class="btn btn-primary" value="Login">
                    </div>
                    <p id="p-formb">Don't have an account? <a href="register.php">Sign up now</a>.</p>
                </div>
                </form>
            </div>  
        </div>       
	</body>
</html>    