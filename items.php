<?php

abstract class Item {
    public $location;
    // abstract public function store();
}

class Part extends Item {
    // public $barcode;
    public $bags = array(); // [barcode => [bag quantity]]
    public $mpn; // Manufacturer part number
    public $description;
    private $octopart_uid;

    public $categories = array(); // array? of categories
    public $datasheet; // multiple datasheets?
    private $attributes = array(); // json? of specs
    // exact or approximate quantity?
    // images?

    public function __construct() {

    }

    public function addBags($barcode, $quantity = array()) {
        $add = is_array($quantity) ? $quantity : array($quantity);
        if (array_key_exists($barcode, $this->bags)) {
            $this->bags[$barcode] = array_merge($this->bags[$barcode], $add);
        } else {
            $this->bags[$barcode] = $add;
        }
    }

    // public function store() {
    //
    // }
}

class Board extends Item {
    public $board_type;
    public $version;
    public $number;

    public $status;
    // schematic?
    // bill of materials?

    // public function store() {
    //
    // }
}

class Bin {
    public $barcode;
    public $number;
    public $size;
}

// $test = new Part();
// $test->addBags('abc', 5);
// $test->addBags('abcd', 6);
// print json_encode($test->bags);