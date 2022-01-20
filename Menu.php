<?php

include_once "Item.php";
class Menu
{
    public $products;
    public $html;

    public function __construct()
    {
        $arr = array(
            array("id" => 1, "name"=>"Quần áo", "parentId" => 0),
            array("id" => 2, "name"=>"Quần áo nam", "parentId" => 1),
            array("id" => 3, "name"=>"Quần áo nam mùa đông", "parentId" => 2),
            array("id" => 4, "name"=>"Quần áo nữ", "parentId" => 1),
            array("id" => 5, "name"=>"Quần áo nữ mùa đông", "parentId" => 4),
            array("id" => 6, "name"=>"Áo khoác nữ mùa đông", "parentId" => 5),
            array("id" => 7, "name"=>"Áo khoác dạ nữ", "parentId" => 6),
            array("id" => 8, "name"=>"Phụ kiện", "parentId" => 0),
            array("id" => 9, "name"=>"Mũ lưỡi trai", "parentId" => 8),
        );

        foreach ($arr as $item){
            $product = new Item($item["id"],$item["name"],$item["parentId"]);
            $this->products[] = $product;
        }

    }

    public function getChildren($product)
    {
        $children = [];
        foreach ($this->products as $item){
            if($item->parentId == $product->id){
                $children[] = $item;
            }
        }
        return $children;
    }

    public function printProduct($product, $level) //Đệ quy
    {
        echo $level.$product->name ."<br>";
        $children = $this->getChildren($product);
        if(!empty($children)){
            foreach ($children as $product){
                $this->printProduct($product,$level."----");
            }
        }

    }

    public function getParent($id)
    {
        $parent = [];
        foreach ($this->products as $item){
            if($item->parentId == $id){
                $parent[] = $item;
            }
        }
        return $parent;
    }

    public function showMenu($id = 0)
    {
        foreach ($this->getParent($id) as $product){
            $this->printProduct($product,"");

        }
    }


    /*
     * <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                </ul>
     *
     * */
}