<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HamsUserType extends Model
{
    protected $table = 'UserCategories';
    protected $fillable = ['Description', 'UserID', 'CapID', 'Archived', 'ArchivedDate', 'ArchivedTime', 'ArchiverID'];
    protected $primaryKey = 'CatID';
    public $timestamps = false;
}
