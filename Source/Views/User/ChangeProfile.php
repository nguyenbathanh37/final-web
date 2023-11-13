<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- logo header -->
    <link rel="shortcut icon" href="assets/images/logo.png" />
    <!-- css -->
    <link rel="stylesheet" href="assets/css/style_home.css">
    <link rel="stylesheet" href="assets/css/style_common.css">
    <link rel="stylesheet" href="assets/css/style_form_video.css">
    <link rel="stylesheet" href="assets/css/style_setting_profile.css">
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.1.js"
        integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

    <!-- icon -->
    <script src="https://kit.fontawesome.com/198f11ff77.js" crossorigin="anonymous"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    


</head>

<body>
    <!-- navbar -->
    <div class="navbar-main">
        <!-- menu -->
        <div class="navbar-main-menu "><i class="fa-solid fa-bars"></i></div>
        <!-- logo -->
        <a href="index.php" class="navbar-main-logo"><img src="assets/images/logo.png" alt=""></a>
        <!-- search -->
        <div class="search-box">
            <!-- search input -->
            <form>
                <input type="text" name="search-input" id="search" placeholder="Search..." value="<?php (isset($search_input))?$search_input:'';?>">
                <!-- search button - looking event-->
                <button type="button" id="submitSearch">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
        <!-- change theme -->
        <div class="change-theme-btn">
            <i class="light-theme fa-solid fa-lightbulb d-none"> light</i>
            <i class="dark-theme fa-solid fa-moon"> dark</i>
        </div>

        <!-- log in -->
        <a href="index.php?controller=Home&action=logout" class="log-in-btn button-57"><span class="text">Log out</span><span>Exist Account
            </span></a>
    </div>
    <!-- body -->
    <!-- navbar-main slider -->
    <div class="navbar-main-slider">
        <!-- main slider -->
        <div class="nav-title">
            Si-zu-ka
        </div>
        <div class="stick"></div>
        <!-- MAIN's elements -->
        <!-- home -->
        <a href="index.php" class="nav-items ">
            <i class="fa-solid fa-house"></i>
            <div class="nav-items-title">Home</div>
        </a>
        <!-- trending -->
        <a href="#" class="nav-items">
            <i class="fa-solid fa-fire-flame-curved"></i>
            <div class="nav-items-title">Trending</div>
        </a>
        <!-- libary -->
        <a href="#" class="nav-items ">
            <i class="fa-solid fa-photo-film"></i>
            <div class="nav-items-title">Libary</div>
        </a>
        <!-- subcribed -->
        <a href="index.php?controller=User&action=subscribed" class="nav-items">
            <i class="fa-solid fa-circle-nodes"></i>
            <div class="nav-items-title">Following Channels</div>
        </a>
        <!-- history -->
        <a href="index.php?controller=User&action=history" class="nav-items">
            <i class="fa-solid fa-clock-rotate-left"></i>
            <div class="nav-items-title">History</div>
        </a>
        <!-- like videos -->
        <a href="index.php?controller=User&action=liked" class="nav-items">
            <i class="fa-solid fa-thumbs-up"></i>
            <div class="nav-items-title">Favorite videos</div>
        </a>
        <!-- My list -->
        <a href="index.php?controller=User&action=mylist" class="nav-items">
            <i class="fa-solid fa-video"></i>
            <div class="nav-items-title">My list</div>
        </a>

        <!-- MANAGER -->
        <div class="nav-title">
            Manager
        </div>
        <div class="stick"></div>
        <!-- MANAGER's elements -->
        <!-- profile -->
        <a href="index.php?controller=User" class="nav-items">
            <i class="fa-solid fa-address-card"></i>
            <div class="nav-items-title">Profile</div>
        </a>
        <!-- uploads -->
        
        <a href="index.php?controller=User&action=upload" class="nav-items">
            <i class="fa-solid fa-upload"> </i>
            <div class="nav-items-title">Uploads</div>
        </a>
    </div>
   <!-- setting profile -->
    <div class="setting-profile">
        <h3 class="setting-profile-title">Setting Profile</h3>
        <form action="index.php?controller=User&action=changeProfile" method="post">
            <div class="avt-box">
                <!-- upload avt -->
                <h3 class="upload-avt-title">Set Avatar.</h3>
                <input type="file" name="avt-img-src" id="avt-img-src" accept=" image/*" style="display: none;">
                <button class="button-6" id="avt-upload-button">Choose file to upload <i class="fa-solid fa-wrench icon" ></i> </button>
                <!-- avt uploaded -->
                <div class="avt-show" style="margin: 12px 0;">
                    <img style="border-radius: 50%; height: 100px; width: 100px; object-fit: cover;" src="<?php echo $avt ?>" alt="avt" id="sample-img">
                </div>
            </div>

            <!-- fullName -->
            <div class="input-box">
                <input type="text" name="full_name" id="full_name" class="form-input" placeholder=" " required />
                <label class="input-label" for="full_name"><i class="fa-solid fa-file-signature"></i> Full name</label>
            </div>

            <!-- email -->
            <div class="input-box">
                <input type="email" name="email" id="email" class="form-input" placeholder=" " required />
                <label class="input-label" for="email"><i class="fa-solid fa-envelope"></i> Email</label>

            </div>

             <!-- submit btn -->
             <input type="submit" name="set-profile-submit" id="set-profile-submit" class="btn-main" value="submit">
                
        </form>
        

    </div>
    </div>



    <script>
        const navbarMenu = document.querySelector('.navbar-main-menu');
        const navbarSlider = document.querySelector('.navbar-main-slider');
        const navbarItems = document.querySelectorAll('.nav-items');

        // show and hide the navbar slider
        navbarMenu.addEventListener('click', function () {
            navbarSlider.classList.toggle('open')
        })
        //active the items in navbar slider
        navbarItems.forEach(items => {
            items.addEventListener('click', function () {
                console.log('chose')
                navbarItems.forEach(item => {
                    item.classList.remove('active')
                })
                items.classList.add('active')

            })
        }
        )

        //show password
        const password = document.querySelector("input[name=password]");
        const confirm_password = document.querySelector("input[name=confirm_password]");
        const show_password = document.getElementById("show-password");
        // show pass - error
        $(show_password).change(function () {
            if (password.type === "password") {
                password.type = "text";
                confirm_password.type = "text";
            } else {
                password.type = "password";
                confirm_password.type = "password";
            }
        })
        // upload avt
        $('#avt-upload-button').click(function () {
            // hide the upload btn
            $('#sample-img').css('display', 'none')
            if ($('#avt-img')) {
                $('#avt-img').remove()
            }
            $(this).parents().find('#avt-img-src').click();
        });

        document.getElementById('avt-img-src').onchange = e => {
            const file = e.target.files[0];
            //src of img file
            const url = URL.createObjectURL(file);
            //create img
            const thumbnailImg = ` 
                <img src="${url}" alt="avt" id="avt-img" style="width: 360px; height:360px">
            `
            $('.avt-show').append(thumbnailImg);
        };

    </script>
</body>

</html>