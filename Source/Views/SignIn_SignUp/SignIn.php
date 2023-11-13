
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- logo header -->
    <link rel="shortcut icon" href="assets/images/logo.png" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <!-- css -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    <!-- icon -->
    <script src="https://kit.fontawesome.com/198f11ff77.js" crossorigin="anonymous"></script>
</head>

<body>
    <main>
        <div id="sign-in-board">
            <form class="display-flex-center" action="index.php?controller=Home&action=login" method="post">
                <h1 class="main-title">Sign in</h1>
                <div class="stick"></div>

                <!-- username -->
                <div class="input-box">
                    <input type="text"  name="username" id="username" class="form-input" placeholder=" " value="<?php echo $username;?>" required/>
                    <label class="input-label" for="username"><i class="fa-solid fa-user "></i> Username</label>
                </div>

                <!-- password -->
                <div class="input-box">
                    <input type="password"  name="password" id="password" class="form-input" placeholder=" " value="<?php echo $password;?>" required/>
                    <label class="input-label" for="password"><i class="fa-solid fa-key "></i> Password</label>
                </div>

                <!-- Show password -->
                <div class="show-password-check-box">
                    <input type="checkbox" id="show-password" name="show-password">
                    <label for="show-password">Show password <i class="fa-solid fa-eye icon-background"></i></label>
                </div>

                <!-- submit btn -->
                <input type="submit" id="sign_in" name="submit" class="btn sign-in-btn" value="Sign in">
                <br>

                <!-- sign up -->
                <footer>
                    <p class="footer-desc">If you don't have account, just sign up now !</p>
                    <a href="index.php?action=logup" class="btn second-btn" style="top: 12px;left: 25%;">Create account</a>

                    <!-- Message -->
                    <?php 
                        foreach($errorMessage as $e){
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.$e.'
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            </div>';
                        }
                    ?>
                </footer>
            </form>
        </div>

    </main>
    <script src="assets/scripts/SignIn.js"></script>
</body>

</html>
