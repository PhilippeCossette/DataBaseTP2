<?php
namespace App\Models;
use App\Models\CRUD;

class Log extends CRUD
{
    protected $table = "logs";
    protected $primaryKey = "id";
    protected $fillable = ['ip_address', 'username', 'visited_page', 'visit_date'];

    public function createLog($data)
    {
        return $this->insert($data);
    }

    // Method to retrieve all logs
    public function getAll()
    {
        return $this->select(); // Use select method from CRUD base class
    }
}