<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{

    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="L5 OpenApi",
     *      description="This an Infoech HAMS Supplier Purchase Order Interface API",
     *     version="1.0.0",
     *     @OA\Contact(
     *     email="support@example.com",
     *     name="Infoech Dot Net Systems Support Team"
     *   )
     * )
     *
     *
     */

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
