<?php
declare(strict_types = 1);

session_start();


class ShoppingCart {
    public $cart;
    public $cartTotal;

    public function __construct(){
        if(isset($_SESSION['shopping_cart']['items']))
        {
            $this->cart = unserialize($_SESSION['shopping_cart']['items']);
            $this->cartTotal = $_SESSION['shopping_cart']['total'];
        }
        else {
            $this->cart = [];
            $this->cartTotal = 0;
        }

    }

    public function addCartItem($item){

        #check if item already exist in the cart
        $product_id = $item->getProductID();

        if(isset($this->cart[$product_id])){ #exist
            #get current quantity
            $current_quant = $this->cart[$product_id]->getQuantity();

            $item_quant = $item->getQuantity();

            #new item quantity
            $new_Quant = $current_quant + $item_quant;

            $this->cart[$product_id]->updateQuantity($new_Quant); #update quant
        } else { #no
            $this->cart[$product_id] = $item; #add item
        }
        
        $this->updateSession();
    }

    public function updateCartItem($product_id, $quantity){
        $this->cart[$product_id]->updateQuantity($quantity); #update quant
        $this->updateSession();
    }

    public function removeCartItem($product_id){
        unset($this->cart[$product_id]);
        $this->updateSession();
    }

    private function updateSession(){
        var_dump($this->cart);
        $_SESSION['shopping_cart']['items'] = serialize($this->cart);
        $_SESSION['shopping_cart']['total'] = $this->cartTotal;
    }
    

  }

?>