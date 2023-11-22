<?php

require_once __DIR__ . '/../Database/Database.php';

abstract class Controller
{
    // database connection and table name
    protected $db;
    protected $table;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    abstract public function getAll();

    abstract public function store();

    abstract public function destroy();
}
