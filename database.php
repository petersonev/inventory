<?php

require 'config_local.php'

/*
Tables:
- Parts
- Boards

? Categories (or just JSON?)
? Bins
? Board types

*/

class Database {

    private $connection

    private function createConnection() {
        try {
            $this->connection = New mysqli(HOST, USER, PASSWORD, DATABASE);
        } catch (Exception $e) {
            exit("Unable to create a connection to the database. " . USER . "@" . DATABASE;);
        }
    }

    private function closeConnection() {
        $this->connection->close();
    }

    public function checkTables() {

    }

    public function storeItem($item) {
        // Input of single item or array of items
    }

    public function removeItem($item) {

    }

    public function searchParts($input) {
        // Input of array with different parameters

        // return array of items
    }

    public function searchBoards($input) {

    }
}