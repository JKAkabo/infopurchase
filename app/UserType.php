<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    protected $connection = 'sqlsrv_auth';

    protected $table = 'user_types';
    protected $fillable = ['type'];
    protected $primaryKey = 'id';
}
