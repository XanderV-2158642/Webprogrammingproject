<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfilepicModel extends Model
{
    protected $table      = 'ProfilePictures';
    protected $primaryKey = 'picture_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
   // protected $useSoftDeletes = true;

    protected $allowedFields = ['picture_id', 'picture_name', 'user_id'];

    protected $useTimestamps = false;
    //protected $createdField  = 'created_at';
    //protected $updatedField  = 'updated_at';
    //protected $deletedField  = 'deleted_at';

    //protected $validationRules    = [];
    //protected $validationMessages = [];
    //protected $skipValidation     = false;
}