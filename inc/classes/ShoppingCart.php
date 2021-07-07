<?php
declare(strict_types = 1);

session_start();

class Cart {
    public $cart = [];
    public $cart_total = [];

    function __construct(){
        if(isset($_SESSION['shopping_cart']))
        {
            $this->cart = $_SESSION['shopping_cart'];
        }
        $this->update_cart_variables();
    }
    
    public function get_cart() 
    {
      return $this->cart;
    }

    public function update_cart($new_cart) 
    {
        $this->cart = $new_cart;
        $_SESSION['shopping_cart'] = $this->cart;
        $this->update_cart_variables();
    }

    private function update_cart_variables()
    {
        $_SESSION['shopping_cart'] = $this->cart;
        $this->update_cart_total();
        return;
    }

    public function remove_cart($product_id) 
    {
      unset($this->cart[$product_id]);
      $this->update_cart_variables();
    }

    public function get_cart_total()
    {
        return $this->cart_total;
    }

    private function update_cart_total()
    {
        $temp_total = 0;
        foreach($this->cart as $item => $item_details)
        {
            $temp_total+= $item_details['price'] * $item_details['quantity'];
        }
        $this->cart_total = number_format($temp_total, 2);
    }
  }

?>