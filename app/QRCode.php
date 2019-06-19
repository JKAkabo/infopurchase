<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QRCode extends Model
{
    protected $connection = 'sqlsrv_auth';

    protected $table = 'q_r_codes';

    protected $fillable =['order_id','qr_code_image'];
}
