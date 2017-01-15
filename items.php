<?php

class Item {
    public $location;
}

class Part extends Item {
    public $barcode;
    public $mpn; // Manufacturer part number
    public $description;

    public $categories;
    public $datasheet;
    private $octopart_uid;
    private $attributes;
    // exact or approximate quantity?
    // images?
}

class Board extends Item {
    public $board_type;
    public $version;
    public $number;

    public $status;
    // schematic?
    // bill of materials?
}

class Bin {
    public $barcode;
    public $number;
    public $size;
}