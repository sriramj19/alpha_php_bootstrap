<!doctype html>

<html lang="en">
<?php
    $flag=0;
    $email_available=0;
    if(isset($_POST['submit'])){
        $str=file_get_contents("data/data.json");
        $jsonIterator = new RecursiveIteratorIterator(
        new RecursiveArrayIterator(json_decode($str, TRUE)),
        RecursiveIteratorIterator::SELF_FIRST);
        foreach($jsonIterator as $key => $val ){
            if(!is_array($val)){
                $email = (isset($_POST['email']) ? $_POST['email'] : null);
                $password = (isset($_POST['password']) ? $_POST['password'] : null);
                if($flag==1){
                    if($key=="password"){
                        if($val==$password){
                            if(!isset($_SESSION)){
                                session_start();
                            $_SESSION['email']=$email;
                            echo "<script type='text/javascript'>document.title='Welcome';</script>";
                            }
                            
                        }
                        else echo "<script type='text/javascript'>alert('Wrong Password, ensure caps lock is not turned on');</script>";
                    $flag=0;
                    }
                }
                if($key=="email"){
                    if($val==$email){
                        $flag=1;
                        $email_available=1;
                    }
                }

            }
        }
        if(!$email_available){
            echo "<script type='text/javascript'>alert('Check your email address')</script>";
        }   
    }

?>

    <head>
        <title name>Login</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>

    <body>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <div class="container">
            <div class="row">
                <div class="col-xs-offset-2 col-xs-8 col-sm-offset-4 col-sm-4 my-bar panel-default"> 
                    <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"> 
                        <div class="my-form"> 
                            <div class="form-group">
                                <label for="email">Email Address:</label> 
                                <input type="email" class="form-control" name="email" id="email"> 
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label> 
                                <input type="password" class="form-control" name="password" id="password"> 
                            </div>
                                <button name="submit" id="submit" class="btn btn-default">Submit
                                </button>
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>