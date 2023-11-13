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

        <!-- log out -->
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
        <a href="index.php" class="nav-items">
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

    <div class="contain-video">
            <!-- Content upload -->
            <div class="container_item col-9">
                <div class="row" style="margin-right: 5px;">
                    <div class="col-12 content_title m-3">
                        <h2 style="color: #B08D8D ;">Upload Video</h2>

                    </div>

                    <!-- ErrorMessage -->
                    <?php 
                        if(isset($errorMessage))
                            foreach($errorMessage as $e){
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.$e.'
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                            }
                        else{
                            foreach($successMessage as $e){
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">'.$e.'
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                            }
                        }
                    ?>

                    <!-- upload file -->
                    <div>
                        <div class="col-12 file">
                            <h5>Upload Video with FILE:</h5>
                            <form enctype='multipart/form-data' method="post" name="form_file" action="index.php?controller=User&action=uploadFile" class="needs-validation ml-3" onsubmit="return validate()" novalidate>
                                <div class="form-group">
                                    <label for="title_file">Title of the video:</label>
                                    <input type="text" class="form-control" id="title_file" placeholder="Enter title of the video" name="title_file" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="fileToUpload" id="fileToUpload" required accept="video/mp4,video/x-m4v,video/*">
                                        <label class="custom-file-label" for="fileToUpload" style=" width: 90%;">Choose file</label>
                                    </div>

                                </div>
                                <label for="playlist-video">Playlist</label>
                                <select name="playlist-select" id="playlist-select " class="bg-danger text-white">
                                    <?php
                                    foreach ($result as $value) {
                                    ?>
                                        <option value="<?php echo $value[0]; ?>"><?php echo $value[1]; ?></option>
                                    <?php } ?>
                                </select>
                                <p class="mb-2" id="nameFile"></p>
                                <H2>visibillity</H2>
                                <div class="form-group row">
                                    <div class="text-danger col-sm-2">Public</div>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" name="radiovis" type="radio" id="gridCheck1" value="public">
                                            <label class="form-check-label" for="radiovis">
                                                Anyone can discover and see this video
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="text-danger col-sm-2">Private</div>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" name="radiovis" type="radio" id="gridCheck2" value="private">
                                            <label class="form-check-label" for="radiovis">
                                                Only you can see this video
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <H2>Set the thumbails.</H2>
                                <div style="margin:1rem">
                                    <input type="file" name="imgthumbnails" id="thumbnails-img-src" accept=" image/*">
                                </div>
                                <button type="submit" name="submitFILE" class="btn btn-danger btn-sm">Upload with file</button>
                            </form>
                        </div>
                    </div>
                    <!-- upload url -->
                    <div style="margin-top:8rem">
                        <div class="col-12 url mb-5">
                            <h5>Upload Video with URL:</h5>
                            <form enctype='multipart/form-data' method="post" action="index.php?controller=User&action=uploadURL" class="needs-validation ml-3" novalidate>
                                <div class="form-group">
                                    <label for="title_url">Title of the video:</label>
                                    <input type="text" class="form-control" id="title_url" placeholder="Enter title of the video" name="title_url" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                                <div class="form-group">
                                    <label for="url">Add Video with URL:</label>
                                    <input type="url" class="form-control" id="url" placeholder="Enter URL of the video" name="url" pattern="https://.*" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                                <label for="playlist-video">Playlist</label>
                                <select name="playlist-select" id="playlist-select" class="bg-danger text-white">
                                    <?php
                                    foreach ($result as $value) {
                                    ?>
                                        <option value="<?php echo $value[0]; ?>"><?php echo $value[1]; ?></option>
                                    <?php } ?>
                                </select> <br />
                                <H2>visibillity</H2>
                                <div class="form-group row">
                                    <div class="text-danger col-sm-2">Public</div>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" name="radiovis" type="radio" id="gridCheck1" value="public">
                                            <label class="form-check-label" for="radiovis">
                                                Anyone can discover and see this video
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="text-danger col-sm-2">Private</div>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" name="radiovis" type="radio" id="gridCheck2" value="private">
                                            <label class="form-check-label" for="radiovis">
                                                Only you can see this video
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <H2>Set the thumbails.</H2>
                                <div style="margin:1rem">
                                    <input type="file" name="imgthumbnails" id="thumbnails-img-src1" accept=" image/*">
                                </div>
                                <button type="submit" name="submitURL" class="btn btn-danger btn-sm">Upload with URL</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        const navbarMenu = document.querySelector('.navbar-menu');
        const navbarSlider = document.querySelector('.navbar-slider');
        const navbarItems = document.querySelectorAll('.nav-items');
        const navbarItemsTITLE = document.querySelectorAll('a.nameItem');


        // show and hide the navbar slider
        navbarMenu.addEventListener('click', function() {
            navbarSlider.classList.toggle('open')

            navbarItemsTITLE.forEach(element => {
                element.classList.toggle('d-none')
            });
        })
        //active the items in navbar slider
        navbarItems.forEach(items => {
            items.addEventListener('click', function() {
                console.log('chose')
                navbarItems.forEach(item => {
                    item.classList.remove('active')
                })
                items.classList.add('active')

            })
        })

        $('#thumbnails-upload-button').click(function() {
            // hide the upload btn
            $('#sample-img').css('display','none')
            if($('#thumbnails-img')){
                $('#thumbnails-img').remove()
            }
            $(this).parents().find('#thumbnails-img-src').click();
        });
 
        document.getElementById('thumbnails-img-src').onchange = e => {
            const file = e.target.files[0];
            //src of img file
            const url = URL.createObjectURL(file);

            //create img
            const thumbnailImg = `<img src="${url}" alt="Thumbnails" id="thumbnails-img">`;
            $('.thumbnails').append(thumbnailImg);  
        };



        $('#thumbnails-upload-button1').click(function() {
            // hide the upload btn
            $('#sample-img1').css('display','none');
            if($('#thumbnails-img1')){
                $('#thumbnails-img1').remove();
            }
            $(this).parents().find('#thumbnails-img-src1').click();
        });

        document.getElementById('thumbnails-img-src1').onchange = e => {
            const file = e.target.files[0];
            //src of img file
            const url = URL.createObjectURL(file);

            //create img
            const thumbnailImg = `<img src="${url}" alt="Thumbnails" id="thumbnails-img1">`;
            $('.thumbnails1').append(thumbnailImg);  
        };

    </script>

</html>