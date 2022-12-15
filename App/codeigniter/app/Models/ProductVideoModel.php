<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductVideoModel extends Model
{
    protected $table      = 'ProductVideos';
    protected $primaryKey = 'video_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
   // protected $useSoftDeletes = true;

    protected $allowedFields = ['video_id', 'video_name', 'product_id'];

    protected $useTimestamps = false;
    //protected $createdField  = 'created_at';
    //protected $updatedField  = 'updated_at';
    //protected $deletedField  = 'deleted_at';

    //protected $validationRules    = [];
    //protected $validationMessages = [];
    //protected $skipValidation     = false;
}