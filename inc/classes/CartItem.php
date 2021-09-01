<?php

class CartItem{
  public $product_id;
  public $product_name;
  public $product_quantity;

  public function __construct($productID, $productLabel, $quantity){
    $this->product_id = $productID;
    $this->product_name = $productLabel;
    $this->product_quantity = $quantity;
  }

  public function getProductName(){
    return $this->product_name;
  }

  public function getQuantity(){
    return $this->product_quantity;
  }

  public function updateQuantity($amount){
    $this->product_quantity = $amount;
  }

  public function removeQuantity($amount){
    // return $this->product_quantity - $amount;
  }

  public function getProductID(){
    return $this->product_id;
  }
}


?>