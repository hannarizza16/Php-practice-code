<?php
namespace App\Controllers;

class TodoController {

    protected $db;
    public function __construct(){
        $this->db = $GLOBALS['dbconn'];

    }

    public function getAll() {
        // return view('sample.sample');
        // echo "Controller is showing";
        // return "hello from todolist!";
        $pdo = $this->db->getPDO();
        $stmt = $pdo->query("SELECT * FROM todos");
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $results;
    }

    public function getTodo() {
        $pdo = $this->db->getPDO();
        $stmt = $pdo->query("SELECT * FROM todo");
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        // return $results;
        view('todolist.todolist');
        return;

    }
}