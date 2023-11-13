 
<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style_upload.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/style.css">
    <link rel="shortcut icon" href="assets/images/logo.png"/>
    <!-- css -->
    <link rel="stylesheet" href="assets/css/style_home.css">
    <link rel="stylesheet" href="assets/css/style_common.css">
    <link rel="stylesheet" href="assets/css/style_upload.css">
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
 
    <!-- icon -->
    <script src="https://kit.fontawesome.com/198f11ff77.js" crossorigin="anonymous"></script>
      <!-- loading page -->
    <link rel="stylesheet" href="assets/css/Page-loading.css">
    <script src="assets/scripts/Page-loading.js"></script>
    <title>Home Page</title>
</head>
 
<body>
    <div class="navbar-main">
        <!-- menu -->
        <div class="navbar-main-menu "><i class="fa-solid fa-bars"></i></div>
        <!-- logo -->
        <a href="index.php" class="navbar-main-logo"><img src="assets/images/logo.png" alt=""></a>
        <!-- search -->
        <div class="search-box">
            <!-- search input -->
            <input type="text" name="search-input" placeholder="Search...">
            <!-- search button - looking event-->
            <a href="#">
                <i class="fa-solid fa-magnifying-glass"></i>
            </a>
        </div>
        <a href="index.php?controller=Home&action=logout" class="log-in-btn button-57"><span class="text">Log out</span><span>Exist Account
            </span></a>
    </div>
        </div>
    </div>
 
            </div>
 
            <!-- Content upload -->
            <div class="container_item">
                 <h1>CHÀO ADMIN</h1>
                 <div class="row m-2">

                 <?php
                    foreach($result as $value){
                    //  echo $value[0];
                 ?>


                <div class="card m-2 my-4" style="width: 18rem;">
                <img class="card-img-top" src="<?php echo $value[4]; ?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $value[1]; ?></h5>
                    <p class="card-text">Descirbe of video</p>
                    <a href="index.php?action=watch&id=<?php echo $value[0]?>" class="btn btn-primary">See Video</a>               
                </div>
                <form method="post" action="index.php?action=process_save" class="mx-4">
                    <h5>Thực Hiện Thao Tác Thêm:</h5>
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="1" id="<?php echo $value[0] . 'id' ?>" name="save_">Feature Video
                </label>
                <br>
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="0" id="<?php echo $value[0] . 'id' ?>" name="save_"> Ẩn Video
                </label>
                <input type="hidden" name="id_video" value="<?php echo $value[0]; ?>" />

                <h5 class=  "my-2">Thực Hiện Thao Tác Xóa:</h5>
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="1" id="<?php echo $value[0] . 'id' ?>" name="delete_">Xóa Feature
                </label>
                <br>
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="0" id="<?php echo $value[0] . 'id' ?>" name="delete_">Xóa Hạn Chế
                </label>
                <input type="hidden" name="id_video" value="<?php echo $value[0]; ?>" />
                <input type="submit" value="Save" name="ok" />
                </form>
                <?php if(in_array((string)$value[0], $feature)){ ?>
                <p class="m-2">Trạng Thái: Feature</p>
                <?php } elseif (in_array($value[0], $vipham)) { ?>
                    <p class="m-2">Trạng Thái: Vi Phạm nên bị hạn chế</p>
                <?php } else { ?>
                    <p class="m-2">Trạng Thái: Bình thường</p>
                <?php }?>
                </div>
                 <?php }?>
        </div>
 
    </div>
   
 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="/main.js"></script> <!-- Sử dụng link tuyệt đối tính từ root, vì vậy có dấu / đầu tiên -->
    <script>
        const navbarMenu = document.querySelector('.navbar-menu');
        const navbarSlider = document.querySelector('.navbar-slider');
        const navbarItems = document.querySelectorAll('.nav-items');
        const navbarItemsTITLE = document.querySelectorAll('a.nameItem');
       
       
        // show and hide the navbar slider
        navbarMenu.addEventListener('click',function(){
            navbarSlider.classList.toggle('open')
			// navbarItemsTITLE.classList.toggle('d-none')
			// console.log(navbarItemsTITLE[0].classList.toggle('d-none'));

			navbarItemsTITLE.forEach(element => {
				element.classList.toggle('d-none')
			});
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

        // upload thumbnails
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
            const thumbnailImg = `
                <img src="${url}" alt="Thumbnails" id="thumbnails-img">
            `
            $('.thumbnails').append(thumbnailImg);  
            };
    </script>
</body>
 
</html>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="/main.js"></script> <!-- Sử dụng link tuyệt đối tính từ root, vì vậy có dấu / đầu tiên -->
    <script>
        $(document).ready(() => {
  // upload thumbnails
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
            const thumbnailImg = `
                <img src="${url}" alt="Thumbnails" id="thumbnails-img">
            `
            $('.thumbnails').append(thumbnailImg);  
            };
 
 
 
            $('#thumbnails-upload-button1').click(function() {
            // hide the upload btn
            $('#sample-img1').css('display','none')
            if($('#thumbnails-img1')){
                $('#thumbnails-img1').remove()
            }
            $(this).parents().find('#thumbnails-img-src1').click();
        });
 
            document.getElementById('thumbnails-img-src1').onchange = e => {
            const file = e.target.files[0];
            //src of img file
            const url = URL.createObjectURL(file);
 
            //create img
            const thumbnailImg = `
                <img src="${url}" alt="Thumbnails" id="thumbnails-img1">
            `
            $('.thumbnails1').append(thumbnailImg);  
            };
});