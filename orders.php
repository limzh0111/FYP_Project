<?php
include 'components/connect.php';
session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
}

// Variable to store the selected order details
$selected_order = null;

if(isset($_GET['order_id'])){
   $order_id = $_GET['order_id'];

   // Retrieve the selected order details from the database
   $select_order = $conn->prepare("SELECT * FROM `orders` WHERE id = ? AND user_id = ?");
   $select_order->execute([$order_id, $user_id]);
   $selected_order = $select_order->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   
   <style>
      .box-container {
         cursor: pointer;
      }
      .box-container:hover {
         background-color: #f1f1f1;
      }
      .box-details h2{
         font-size: 50px;
      }
      .box-details p {
         margin-bottom: 5px;
         font-size: 40px;
      }
   </style>

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="orders">

   <h1 class="heading">Placed Orders</h1>

   <div class="box-container">

   <?php
   if($user_id == ''){
      echo '<p class="empty">Please login to see your orders</p>';
   }else{
      $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
      $select_orders->execute([$user_id]);
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
            // Check if the order is selected or not
            $isSelected = ($selected_order && $selected_order['id'] == $fetch_orders['id']);
   ?>
            <div class="box" onclick="window.location.href='?order_id=<?= $fetch_orders['id'] ?>'">
               <p>Date Purchased: <span><?= $fetch_orders['placed_on']; ?></span></p>
               <p>ID: <span><?= $fetch_orders['id']; ?></span></p>
               <p>Delivery Status: <span><?= $fetch_orders['delivery_status']; ?></span></p>
               <p>Payment Status: <span><?= $fetch_orders['payment_status']; ?></span></p>
            </div>

            <?php if ($isSelected) { ?>
               <div class="box-details">
                  <h2>Order Details</h2>
                  <p>Date Purchased: <span><?= $selected_order['placed_on']; ?></span></p>
                  <p>ID: <span><?= $selected_order['id']; ?></span></p>
                  <p>Name: <span><?= $selected_order['name']; ?></span></p>
                  <p>Email: <span><?= $selected_order['email']; ?></span></p>
                  <p>Number: <span><?= $selected_order['number']; ?></span></p>
                  <p>Address: <span><?= $selected_order['address']; ?></span></p>
                  <p>Quantity of Commodity: <span><?= $selected_order['total_products']; ?></span></p>
                  <p>Grand Total: <span>$<?= $selected_order['total_price']; ?>/-</span></p>
                  <p>Payment status: <span style="color:<?php if($selected_order['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; } ?>"><?= $selected_order['payment_status']; ?></span></p>
                  <p>Delivery status: <span style="color:<?php if($selected_order['delivery_status'] == 'packing'){ echo 'red'; }else{ echo 'green'; } ?>"><?= $selected_order['delivery_status']; ?></span></p>
               </div>
            <?php }
         }
      }else{
         echo '<p class="empty">No orders placed yet!</p>';
      }
   }
   ?>

   </div>

</section>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>