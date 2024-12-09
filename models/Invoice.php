<?php
namespace App\Models;
use App\Models\CRUD;

class Invoice extends CRUD{

    protected $table = "invoice";
    protected $primaryKey = "id";
    protected $fillable = ['date', 'client_id'];
}