<?php
require_once('struk.php');
require_once('toko.php');

class Menu {
    protected $idMenu;
    protected $namaMenu;
    protected $price;
    protected $finalPrice;
    protected $promo;
    protected $textPromo;
    protected $image;
    protected $orderCount = 0;
    protected static $id = 1;

    public function __construct($namaMenu, $price, $promo, $orderCount, $image) {
        $this->namaMenu = $namaMenu;
        $this->price = $price;
        $this->promo = $promo;
        $this->orderCount = $orderCount;
        $this->image = $image;
        $this->idMenu = self::$id++;
    }

    public function getIdMenu() {
        return $this->idMenu;
    }

    public function setIdMenu($idMenu) {
        $this->idMenu = $idMenu;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function getNamaMenu() {
        return $this->namaMenu;
    }

    public function setNamaMenu($namaMenu) {
        $this->namaMenu = $namaMenu;
    }

    public function getOrderCount() {
        return $this->orderCount;
    }

    public function setOrderCount($orderCount) {
        $this->orderCount = $orderCount;
    }

    public function getPromo() {
        return $this->promo;
    }

    public function setPromo($promo) {
        $this->promo = $promo;
    }

    public function countFinalPrice() {
        if ($this->getPromo() != 1) {
            $this->finalPrice =  $this->price * $this->orderCount * $this->promo ;
        } else {
            $this->finalPrice =  $this->price * $this->orderCount;
        }
        return $this->finalPrice;
    }

    public function prepTextPromo() {
        if ($this->getPromo() != 1) {
            $this->textPromo = "(Promo! ". (1 - $this->getPromo())*100 ."%)";
        }
    }

    public function getTextPromo() {
        $this->prepTextPromo();
        return $this->textPromo;
    }

    public function getFinalPrice() {
        self::countFinalPrice();
        return $this->finalPrice;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function __destruct()
    {

    }
}


class Food extends Menu {
    private $kepedasan;

    public function __construct($namaMenu, $price, $promo, $orderCount, $image) {
        parent::__construct($namaMenu, $price, $promo, $orderCount, $image);
    }

    public function getKepedasan() {
        return $this->kepedasan;
    }

    public function setKepedasan($kepedasan) {
        $this->kepedasan = $kepedasan;
    }


    public function __destruct()
    {

    }
}


class Drink extends Menu {
    private $type;

    public function __construct($namaMenu, $price, $promo, $orderCount, $type, $image) {
        parent::__construct($namaMenu, $price, $promo, $orderCount, $image);
        $this->type = $type;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }


    public function __destruct()
    {

    }
}