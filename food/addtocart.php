<?php
    session_start();
    include("connection1.php");
    
    if($SERVER["REQUEST_METHOD"]=="GET")
    {
    if (isset($_GET["add"]))
       {
          if (isset($_SESSION["cart"]))
          {

            $myitems = array_column($_SESSION["cart"],'food_id');
            if (in_array($_GET['food_id'],$myitems))
            {
                echo "<script>
                alert("Product is already Added to Cart");
                window.location.herf='menu1.php';
                </script>";
            }
            else
            {
                 $count = count($_SESSION['cart']);
                
                echo '<script>window.location="addtocart.php"</script>';
                 $_SESSION["cart"][$count] = array('food_name' => $_GET['hidden_name'],'price' => $_GET['hidden_price'],'quantity'=>1);
                 echo "<script>
                 alert("Product Added to Cart");
                 window.location.herf='menu1.php';
                 </script>";
              }
                }
                  else
                  {
                      $_SESSION["cart"][0] = array('food_name' => $_GET['hidden_name'],'price' => $_GET['hidden_price'],'quantity'=>1);
                      echo "<script>
                      alert("Product  Added to Cart");
                      window.location.herf='menu1.php';
                      </script>";}
                }
            
            if (isset($_GET["remove"]))
            {
               foreach($_SESSION['cart'] as $key => $value)
               {
                   if($value['food_name']==$_GET['hidden_name'])
                   {
                 unset($_SESSION['cart'][$key]);
                 $_SESSION['cart']=array_value($_SESSION['cart']);
                 echo "<script>
                 alert("Product  Removed from Cart");
                 window.location.herf='mycart.php';
                 </script>";
               }
            }
        }
        }    
?>


