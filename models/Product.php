<?php
namespace App\Models;
use App\Models\CRUD;

class Product extends CRUD{

    protected $table = "product";
    protected $primaryKey = "id";
    protected $fillable = ['name', 'description', 'price'];
}