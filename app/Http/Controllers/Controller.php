<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $tmp = DB::select('SELECT members.name, count(DATEDIFF(NOW(), date_end)) AS tanggal_kembali 
        FROM `transactions` JOIN members ON transactions.member_id = members.id 
        WHERE date_end < NOW() GROUP BY members.name');
        view()->share('notif', $tmp);
    }
}