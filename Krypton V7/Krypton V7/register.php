<?php 
// fichier de connexion à la db
require_once("config.php");

// déclaration des variables (vides)
$username = $password = $confirm_password = $email = "";
$username_err = $password_err = $confirm_password_err = $email_err = "";

// lors du click sur "submit" 
if($_SERVER["REQUEST_METHOD"] == "POST")
{
        // On vérifie le champ username
        // si il est vide
        if(empty(trim($_POST["username"])))
        {
            // Erreur
            $username_err = "Please enter a username";
        }
        else
        {
            // sinon on prepare une requete SELECT pour la table users qui va sélectionner les id des users
            $sql = "SELECT id FROM users WHERE username = :username";

            if($req = $bdd->prepare($sql))
            {
                // on lie, en paramètre, les variables à la requête p réparée
                $req->bindParam(":username",$req_username, PDO::PARAM_STR);
                // on fait correspondre la valeur du champ username avec la variable 
                // qui sera inscrite dans la db
                $req_username = trim($_POST["username"]);

                // On tente d'executer la requête
                if($req->execute())
                {
                    // On regarde chaque ligne de la colonne username de la table users.
                    // Si le username existe déja
                    if($req->rowCount() == 1)
                    {
                        // Erreur
                        $username_err = "This username is already taken.";
                    }
                    else
                    {
                        // Sinon on assigne le username à sa variable
                        $username = trim($_POST["username"]);
                    }
                }
                else
                {
                    echo "ERROR: Something went wrong. Please try again later.";
                }

                // On ferme la requete
                unset($req);
            }
        }

        // On vérifie le password 
        // Si il est vide
        if(empty($_POST["password"]))
        {
            // Erreur
            $password_err = "Please enter a password.";
        }
        // Sinon si il fait moins de 6 caractères
        else if(strlen(trim($_POST["password"]))< 6)
        {
            $password_err = "Password must have atleast 6 characters.";    
        }
        else
        {
            // Sinon on assigne le password à sa variable
            $password = trim($_POST["password"]);
        }


        // On vérifie que les mots de passes correspondent
        // Si le confirm_password est vide
        if(empty($_POST["confirm_password"]))
        {
            // Erreur
            $confirm_password_err = "Please confirm your password.";
        }
        else
        {
            // Sinon on assigne le confirm_password à sa variable
            $confirm_password = trim($_POST["confirm_password"]);

            // Si aucune erreur dans le password et si le password et le confirm_password
            // ne correspondent pas
            if(!empty($password) && ($password !== $confirm_password))
            {   
                //Erreur
                $confirm_password_err = "Password did not match."; 
            }
        }        

        // Si email est vide
        if(empty($_POST["email"]))
            {   
                // Erreur
                $email_err = "Please enter an email.";
            }
               
        else 
            { 
                //Sinon si l'adresse email est valide
                if(validateEmail(trim($_POST["email"])))
                {
                    // On assigne
                    $email = trim($_POST["email"]);
                }
                else
                {   
                    // Erreur
                    $email_err = "Please enter a valid email.";
                }
            }
    

    // On vérifie les valeurs avant de les insérer dans la db, si aucune erreur
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err))
    {
        // Req d'insertion des donénes dans la db
        $sql = "INSERT INTO users (username,password,email) VALUES (:username, :password, :email)";

        if($req = $bdd->prepare($sql))
        {
            // on lie, en paramètre, les variables à la requête préparée
            $req->bindParam(':username',$req_username, PDO::PARAM_STR);
            $req->bindParam(':password',$req_password, PDO::PARAM_STR);
            $req->bindParam(':email',$req_email, PDO::PARAM_STR);
            // on fait correspondre la valeur du champ username avec la variable 
            // qui sera inscrite dans la db
            $req_username = $username;
            $req_password = sha1($password);
            $req_email = $email;

            // On tente d'executer la requete finale 
            if($req->execute())
            {
                header("Location:login.php");
            }
            else
            {
                echo "<span>Oops! Something went wrong. Please try again later.</span>";
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
			<title>Sign Up</title>
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
                <a href="login.php" class="btn btn-primary active" aria-current="page"><b>Sign in</b></a>               
            </nav>
        </div>
        <div id="divh2form">
            <div id="divh2">
                <h2 class="display-5">Sign up to Krypton</h2>
        </div>
            <div id="form">
                <div class="form-group">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">         
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
                <div class="form-floating">
                    <input type="password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>" id="floatingPassword" placeholder="Password" name="confirm_password">
                    <label for="floatingPassword">Confirm Password</label>
                    <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                </div>
                    <div class="form-floating mb-3">
                    <input type="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>" id="floatingInput" placeholder="name@example.com" name="email">
                    <label for="floatingInput">Email address</label>
                    <span class="invalid-feedback"><?php echo $email_err; ?></span>
                    </div>
                <div class="form-floating" id="form-submit">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <input type="reset" class="btn btn-secondary ml-2" value="Reset">
                </div>
                <p class="form-floating" id="p-form">Already have an account? <a href="login.php">Login here</a>.</p>
                </form> 
            </div>  
        </div>       
	</body>
</html>    

<?php 
     function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
     }
?>