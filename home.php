<?php

include 'components/connect.php';

session_start();

$language = 'en';

if (isset($_GET['lang'])) {
   // 用户通过URL参数指定了语言
   $language = $_GET['lang'];

   // 将语言存储在会话中
   $_SESSION['language'] = $language;
} elseif (isset($_SESSION['language'])) {
   // 检查会话中是否存在语言选择
   $language = $_SESSION['language'];
}

// 根据语言选择包含相应的语言文件
if ($language == 'en') {
   include 'lang_en.php';
} elseif ($language == 'zh') {
   include 'lang_ch.php';
} elseif ($language == 'ms') {
   include 'lang_my.php';
} elseif ($language == 'ms') {
   include 'lang_jp.php';
}

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="<?php echo $selected_lang; ?>">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?php echo $lang['home']; ?></title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<div class="home-bg">

<section class="home">

<div class="swiper home-slider">
   <div class="swiper-wrapper">
      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/V27.jpg" alt="">
         </div>
         <div class="content">
            <span><?php echo $lang['vivo_v27_series']; ?></span>
            <h3><?php echo $lang['new_products']; ?></h3>
            <a href="shop.php" class="btn"><?php echo $lang['shop_now']; ?></a>
         </div>
      </div>
      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/a95-black-silver-1920.png" alt="">
         </div>
         <div class="content">
            <h3><?php echo $lang['oppo_series']; ?></h3>
            <a href="shop.php" class="btn"><?php echo $lang['shop_now']; ?></a>
         </div>
      </div>
      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/0000696_vivo-v21e-128gb-8gb-ram-original-malaysia-set_625.jpeg" alt="">
         </div>
         <div class="content">
            <h3><?php echo $lang['vivo_series']; ?></h3>
            <a href="shop.php" class="btn"><?php echo $lang['shop_now']; ?></a>
         </div>
      </div>
      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/fb.jpg" alt="">
         </div>
         <div class="content">
            <h3><?php echo $lang['honor_magic_series']; ?></h3>
            <a href="shop.php" class="btn"><?php echo $lang['shop_now']; ?></a>
         </div>
      </div>
      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/596688-Product-0-I-637982218040540343.webp" alt="">
         </div>
         <div class="content">
            <h3><?php echo $lang['iphone_series']; ?></h3>
            <a href="shop.php" class="btn"><?php echo $lang['shop_now']; ?></a>
         </div>
      </div>
   </div>

   <div class="swiper-pagination"></div>

   <!-- Navigation buttons -->
   <div class="swiper-button-next"></div>
   <div class="swiper-button-prev"></div>
</div>

<!-- Include Swiper library -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
   var swiper = new Swiper('.home-slider', {
      loop: true,
      navigation: {
         nextEl: '.swiper-button-next',
         prevEl: '.swiper-button-prev',
      },
      autoplay:{
         delay:5000,
      },
   });
</script>


</section>

</div>

<!-- 
<section class="category">

   

   <div class="swiper-pagination"></div>

   </div>

</section>-->

<section class="home-products">

   <h1 class="heading"><?php echo $lang['latest_products']; ?></h1>

   <div class="swiper products-slider">

      <div class="swiper-wrapper">

         <?php
         $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6"); 
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
         ?>

         <form action="" method="post" class="swiper-slide slide">
            <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
            <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
            <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
            <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">

            <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
            <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
            <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
            <div class="name"><?= $fetch_product['name']; ?></div>
            <div class="flex">
               <div class="price"><span>$</span><?= $fetch_product['price']; ?><span>/-</span></div>
               <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
            </div>
            <input type="submit" value="<?php echo $lang['add_to_cart']; ?>" class="btn" name="add_to_cart">
         </form>

         <?php
            }
         }else{
            echo '<p class="empty">no products added yet!</p>';
         }
         ?>

      </div>

      <div class="swiper-pagination"></div>

       <!-- Navigation buttons -->
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>

   </div>

   <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
      var swiper = new Swiper('.products-slider', {
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
        // Add other Swiper options and configurations here

        // Set the number of slides to be displayed at once
         slidesPerView: 3, 

         // Enable loop mode to create an infinite carousel
         loop: true,

         // Set the breakpoints for responsive design
         breakpoints: {
         // When window width is >= 768px
         768: {
            slidesPerView: 2,
         },
         // When window width is >= 992px
         992: {
            slidesPerView: 4,
         },
         },

         // Enable autoplay with a specified interval
         autoplay: {
         delay: 3000, 
         disableOnInteraction: false, // Continue autoplay even when the user interacts with the carousel
         },

         /*
         // Enable pagination dots
         pagination: {
         el: '.swiper-pagination',
         clickable: true,
         },*/
      });

      
    </script>

</section>









<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".home-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
    },
});

 var swiper = new Swiper(".category-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
         slidesPerView: 2,
       },
      650: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 4,
      },
      1024: {
        slidesPerView: 5,
      },
   },
});

var swiper = new Swiper(".products-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      550: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
   },
});



</script>

</body>
</html>