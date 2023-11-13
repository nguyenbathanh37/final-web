<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video</title>
   <!-- logo header -->
   <link rel="shortcut icon" href="assets/images/logo.png" />
    <!-- css -->
    <link rel="stylesheet" href="assets/css/style_home.css">
    <link rel="stylesheet" href="assets/css/style_common.css">
    <link rel="stylesheet" href="assets/css/style_video.css">
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.2.js" integrity="sha256-pkn2CUZmheSeyssYw3vMp1+xyub4m+e+QK4sQskvuo4=" crossorigin="anonymous"></script>
    <!-- icon -->
    <script src="https://kit.fontawesome.com/198f11ff77.js" crossorigin="anonymous"></script>
     <!-- loading page -->
     <link rel="stylesheet" href="css/Page-loading.css">
     <script src="assets/scripts/Page-loading.js"></script>
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
            <form action="index.php?controller=Home&action=search" method="get">
                <input type="text" name="search-input" placeholder="Search..." value="<?php (isset($search_input))?$search_input:'';?>">
                <!-- search button - looking event-->
                <button type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
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
        <a href="#" class="nav-items">
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
        <a href="index.php?controller=User&action=profile" class="nav-items">
            <i class="fa-solid fa-address-card"></i>
            <div class="nav-items-title">Profile</div>
        </a>
        <!-- uploads -->
        
        <a href="index.php?controller=User&action=upload" class="nav-items">
            <i class="fa-solid fa-upload"> </i>
            <div class="nav-items-title">Uploads</div>
        </a>
    </div>
    <!-- video display -->
    <div class="wrapper" id="wrapper" style="display: flex;">
        <div class="left-side">
            <div class="video-wrapper">
            <?php if(strpos($data[0]["link"], "https://www.youtube.com") !== false){?>
                <iframe width="100%" height="400" src="<?php echo $data[0]["link"]; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <?php }else{ ?>
                <video height="100%" width="100%" controls>
                    <source src="<?php echo $data[0]["link"]; ?>">
                </video>
            <?php }?>
            </div>
            <!-- title video -->
            <h3 class="video-title"><?php echo $data[0]["namevideo"]; ?></h3>
            <div class="video-contact">
                <h6 class="video-view"><?php echo $data[0]["view"]; ?> views</h6>
                <h6 class="video-upload-date"><?php echo $data[0]["dayupload"]; ?></h6>
                <div class="video-like"><i class="fa-solid fa-thumbs-up"></i> <span class="number-of-liked">123</span></div>
                <div class="video-share"> <i class="fa-solid fa-share-from-square"> </i> Share</div>
                <div class="video-playlist-save"><i class="fa-solid fa-floppy-disk"></i> Save</div>
            </div>
            <div class="stick-separate"></div>

            <!-- user make video -->
            <div class="infomation-video-maker" onclick="watchProfile('<?php echo $data[0]["uname"]; ?>')" style="cursor: pointer;">
                <img src="<?php echo $data[0]["avt"]?>" alt="" class="video-maker-avt" style="border-radius: 50%;">
                <h3 class="video-maker-username"><?php echo $data[0]["fullname"]; ?></h3>
                <h5 class="subcriber"><span class="number-of-subcriber">123</span> Subcirbers</h5>
                <button class="btn subcribe-btn " type="submit" name="subcribe">Subcribe</button>
            </div>

            <!-- description -->
            <div class="video-description">
                <h3 class="desc-title">Description</h3>
                <p class="details-description line-clamp"></p>
            </div>
            <div class="stick-separate"></div>

            <!-- create comment -->
            <div class="comment-box">
                <a href=""><img src="<?php echo $avt;?>" alt="" class="user-avt"></a>
                <form class="body-user-comment" action="index.php?controller=User&action=comment&id=<?php echo $_GET['id']; ?>" method="post">
                    <label for="comment-area"><h3 class="user-name"><?php echo $fullname;?></h3></label>
                    <textarea name="comment-area" id="comment-area" cols="100" rows="" class="comment-input"></textarea>
                    <!-- comment btn -->
                    <input type="submit" name="comment" class="comment-btn button-6" value="Comment">
                </form>
            </div>
            <!-- comments of other users -->

            <!-- title -->
            <h2 class="comments-titles">Comments</h2>
            <?php
                foreach($data_comments as $item){
                    echo '<div class="comment-box">
                            <a href=""><img src="'.$item['avt'].'" alt="" class="user-avt"></a>
                            <div class="body-user-comment">
                                <h3 class="user-name">'.$item["fullname"].'</h3>
                                <p class="comment-details">'.$item["content"].'</p>
                                <!-- comment btn -->
                            </div>
                        </div>';
                }
            ?>
        </div>
        
        <div class="right-side">
        <?php foreach($data_videos as $item){
                echo '<div class="suggest-video" style="padding-top: 20px; display: flex;" onclick=watch('.$item["id_video"].')>
                        <img src="'.$item['thumbnail'].'" alt="" style="width: 15vw; height: 18vh; border-radius: 5px;">
                        <div class="inf-video">
                            <h1 class="content-video">'.$item["namevideo"].'</h1>
                            <!-- click move to chanel -->
                            <a href="#"><p class="name-user">'.$item["fullname"].'</p></a>
                            <p>'.$item["view"].' lượt xem  '.$item["dayupload"].'</p>
                        </div>

                    </div>';
            }
        ?>
        </div>

    </div>

    </div>

    <script>
        const navbarMenu = document.querySelector('.navbar-main-menu');
        const navbarSlider = document.querySelector('.navbar-main-slider');
        const navbarItems = document.querySelectorAll('.nav-items');
        
        // change theme BG
        const setTheme = theme => document.documentElement.className = theme;
        
        // show and hide the navbar slider
        navbarMenu.addEventListener('click', function () {
            navbarSlider.classList.toggle('open')
        })
        //active the items in navbar slider
        navbarItems.forEach(items=>{
            items.addEventListener('click',function(){
                console.log('chose')
                navbarItems.forEach(item=>{
                    item.classList.remove('active')
                })
                items.classList.add('active')

            })
        }
        )
        $('textarea').each(function () {
            this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;');
            }).on('input', function () {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
        //show all description which was hidden
        $('.video-description').click(function(){
            $('.details-description').toggleClass('none-line-clamp line-clamp')
        })
        // solve comments
        document.querySelectorAll('.comment-others').forEach(function(cmt){
            cmt.addEventListener('mouseover',function(){
                let details=cmt.querySelector('.comment-details')
                details.style.background ='#c49999'
                details.style.zIndex = '999'
                details.classList.add('none-line-clamp')
                details.classList.remove('line-clamp')


            })
            cmt.addEventListener('mouseout',function(){
                let details=cmt.querySelector('.comment-details')
                details.style.background ='#f3f3f3'
                details.style.zIndex = '1'
                details.classList.add('line-clamp')
                details.classList.remove('none-line-clamp')


            })
        })
        
        function watch(id){
            window.open("index.php?controller=Video&action=watch&id=" + id, "_self");
        }

        function watchProfile(username){
            window.open("index.php?controller=User&action=getProfileOfUser&username=" + username, "_self");
        }
    </script>
</body>

</html>