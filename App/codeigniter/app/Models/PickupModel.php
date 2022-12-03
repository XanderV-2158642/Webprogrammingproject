<?php

namespace App\Models;

use CodeIgniter\Model;

class PickupModel extends Model
{
    protected $table      = 'PickupOrders';
    protected $primaryKey = 'order_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
   // protected $useSoftDeletes = true;

    protected $allowedFields = ['buyer_id', 'product_id', 'seller_id', 'date', 'time', 'pickedup', 'amount'];

    protected $useTimestamps = false;
    //protected $createdField  = 'created_at';
    //protected $updatedField  = 'updated_at';
    //protected $deletedField  = 'deleted_at';

    //protected $validationRules    = [];
    //protected $validationMessages = [];
    //protected $skipValidation     = false;
}