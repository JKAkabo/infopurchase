<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class HamsUser extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected  $table = 'users';
    protected $fillable = [
        'UserIDNo', 'UserName', 'UserID', 'EmailAddress', 'User_Password', 'UserType', 'UserNo', 'User_Locked', 'CAP_ID', 'User_Date', 'User_Time', 'AlternativeEmailAddress', 'CatID', 'DataDate', 'Archived', 'ArchivedDate', 'ArchivedTime', 'ArchiverID', 'PrimaryCellNo', 'SecondaryCellNo', 'UserGrade', 'Hams_DHIS2_PWD', 'UserTDOB', 'UserDOB', 'UserGender', 'ContractID', 'AcctExpiryDate', 'UserTitle', 'PO_password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'User_Password', /*'remember_token'*/
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        /*'email_verified_at' => 'datetime', */
    ];

    protected $table = 'Users';

    public $timestamps = false;

}
