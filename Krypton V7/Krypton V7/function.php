<?php

    function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }


    function verifyName($name){
     if(empty(trim($name)))
        {
            $username_err = "Please enter a username";
        }
        else
        {
            $sql = "SELECT id FROM users WHERE username = :username";
            global $bdd;

            if($req = $bdd->prepare($sql))            {  
                $req_username = trim($name);
                $req->bindParam(":username",$req_username, PDO::PARAM_STR);
              
                // $req_username = trim($name);

                if($req->execute())
                {
                  if($req->rowCount() == 1)
                    {
                        $username_err = "This username is already taken.";
                    }
                    else
                    {
                        $username = trim($name);
                    }
                }
                else
                {
                    echo "ERROR: Something went wrong. Please try again later.";
                }
               unset($req);
            }
        }
    }

    function uploadImg($pathInput,$pathSubmit,$pathFolder){

        if(isset($_POST["$pathSubmit"])){
            $filename = $_FILES["$pathInput"]["name"];
            $tempname = $_FILES["$pathInput"]["tmp_name"];
            $folder = ".$pathFolder./.$filename";
        
            if (move_uploaded_file($tempname, $folder))  
            {
                $msg = "Image uploaded successfully";
            //    echo $filename;
            //    echo $tempname;
            }
            else{
                $msg = "Failed to upload image";
        
            }
        }
    }






?>