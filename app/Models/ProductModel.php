<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id_product';
    protected $useAutoIncrement = true;

    protected $returnType       = 'array';

    protected $allowedFields = [
        'id_category',
        'product_name',
        'description',
        'price',
        'stock',
        'image'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
