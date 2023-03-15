<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>
<?php

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
?>

<header class="header">

   <section class="flex">

      <a href="home.php" class="logo">Fypee<span>.</span></a>

      <nav class="navbar">
         <a href="home.php"><?php echo $lang['home']; ?></a>
         <a href="about.php"><?php echo $lang['about']; ?></a>
         <a href="orders.php"><?php echo $lang['orders']; ?></a>
         <a href="shop.php"><?php echo $lang['shop']; ?></a>
         <a href="contact.php"><?php echo $lang['contact']; ?></a>
      </nav>



      <div class="icons">
         <?php
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
            $total_wishlist_counts = $count_wishlist_items->rowCount();

            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_counts = $count_cart_items->rowCount();
         ?>
         <div id="menu-btn" class="fas fa-bars"></div>
         <a href="search_page.php"><i class="fas fa-search"></i></a>
         <a href="wishlist.php"><i class="fas fa-heart"></i><span>(<?= $total_wishlist_counts; ?>)</span></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_counts; ?>)</span></a>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php          
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile["name"]; ?></p>
         <a href="update_user.php" class="btn">update profile</a>
         <div class="flex-btn">
            <a href="user_register.html" class="option-btn">register</a>
            <a href="user_login.html" class="option-btn">login</a>
         </div>
         <a href="components/user_logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a> 
         <?php
            }else{
         ?>
         <p>please login or register first!</p>
         <div class="flex-btn">
            <a href="user_register.html" class="option-btn">register</a>
            <a href="user_login.html" class="option-btn">login</a>
         </div>

         <?php
            }
         ?>      
         
         
         </div>

         <?php
            // 定义 $selected_language 变量
            $selected_language = isset($_GET['lang']) ? $_GET['lang'] : 'en';
         ?>

         <div class="language-switch">
            <!-- 示例：语言切换下拉菜单 -->
            <select onchange="changeLanguage(this)" id="languageSelect">
               <option value="en" <?php if($selected_language === 'en') echo 'selected'; ?>>Eng</option>
               <option value="zh" <?php if($selected_language === 'zh') echo 'selected'; ?>>中文</option>
               <option value="ms" <?php if($selected_language === 'ms') echo 'selected'; ?>>BM</option>
            </select>

            <!-- 示例：使用JavaScript切换语言 -->
            <script>
                  function changeLanguage(select) {
                     var language = select.value;
                     window.location.href = '?lang=' + language;
                  }
                  
                  var languageSelect = document.getElementById('languageSelect');
                  languageSelect.addEventListener('change', function() {
                     var selectedLanguage = this.value;
                     var currentUrl = window.location.href;
                     var newUrl;

                     if (currentUrl.includes('?')) {
                        if (currentUrl.includes('lang=')) {
                           newUrl = currentUrl.replace(/lang=\w+/, 'lang=' + selectedLanguage);
                        } else {
                           newUrl = currentUrl + '&lang=' + selectedLanguage;
                        }
                     } else {
                        newUrl = currentUrl + '?lang=' + selectedLanguage;
                     }

                     window.location.href = newUrl;
                  });
            </script>
         </div>


   </section>

</header>