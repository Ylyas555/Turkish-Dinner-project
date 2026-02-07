<?php
/*
----------------------------------------------------
Order Class
Stores order data and provides accessors/mutators
----------------------------------------------------
*/

class Order {

    private int $item_id;
    private string $item_name;
    private int $quantity;
    private float $price;
    private float $cost;

    // Constructor
    public function __construct($item_id, $item_name, $quantity, $price) {
        $this->item_id = $item_id;
        $this->item_name = $item_name;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->cost = $quantity * $price;
    }

    // Accessors (getters)
    public function getItemId() {
        return $this->item_id;
    }

    public function getItemName() {
        return $this->item_name;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getCost() {
        return $this->cost;
    }

    // Mutators (setters)
    public function setQuantity($quantity) {
        $this->quantity = $quantity;
        $this->cost = $this->quantity * $this->price;
    }
}
