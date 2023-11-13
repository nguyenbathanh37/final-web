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
        <div id="sign-up-board">
            <form action="index.php?controller=Home&action=logup" method="post">
               <!-- left side -->
                <div class="left-side">
                    <h1 class="main-title">Sign up</h1>
                    <div class="stick"></div>

                    <!-- fullName -->
                    <div class="input-box">
                        <input type="text" name="fullname" id="fullname" class="form-input" placeholder=" " value="<?php echo $fullname?>" required/>
                        <label class="input-label" for="full_name"><i class="fa-solid fa-file-signature"></i> Full name</label>    
                    </div>

                    <!-- username -->
                    <div class="input-box">
                        <input type="text" name="username" id="username" class="form-input" placeholder=" " value="<?php echo $username?>" required/>
                        <label class="input-label" for="username"><i class="fa-solid fa-user icon-background"></i> Username</label>    
                    </div>

                    <!-- email -->
                    <div class="input-box">
                        <input type="email" name="email" id="email" class="form-input" placeholder=" " value="<?php echo $email?>" required/>
                        <label class="input-label" for="email"><i class="fa-solid fa-envelope"></i> Email</label>
    
                    </div>

                    <!-- password -->
                    <div class="input-box">
                        <input type="password"  name="password" id="password" class="form-input" placeholder=" " value="<?php echo $password?>" required/>
                        <label class="input-label" for="password"><i class="fa-solid fa-key"></i> Password</label>
                    </div>
                   
                    <!-- confirm password -->
                    <div class="input-box">
    
                        <input type="password" name="confirm_password" id="confirm_password" class="form-input" placeholder=" " value="<?php echo $confirm_password?>" required/>
                        <label class="input-label" for="confirm_password"><i class="fa-sharp fa-solid fa-lock"></i> Confirm password</label>    
                    </div>

                    <!-- Show password -->
                    <div class="show-password-check-box">
                        <input type="checkbox" id="show-password" name="show-password">
                        <label for="show-password">Show password <i class="fa-solid fa-eye icon-background"></i></label>
                    </div>
                </div>

               <!-- right side -->
                <div class="right-side">
                    <h2 class="right-side-title">Welcome !</h2>
                    <input type="submit" name="submit" id="sign_up" value="Create account" class="btn">
                    <p class="right-side-desc">Already have an account ? <a href="index.php?action=login" class="btn second-btn " style="margin-left: 12px">Log in.</a></p>
                    <div class="circles">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </form>
            
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
        </div>
    </main>
</body>
    <script src="assets/scripts/SignUp.js"></script>
</html>
