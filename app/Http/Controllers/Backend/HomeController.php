<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Order;
use DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->orderModel = new Order();
    }

    public function index(Request $request) {
        $orders= [];

        $day7 = $this->orderModel::select(DB::raw('DATE(created_at) as created'), DB::raw('count(id) as count_order') )
                                    ->whereBetween ((DB::raw('DATE(created_at)')), [
                                        Carbon::now()->subDays(7)->format('Y-m-d'),
                                        Carbon::now()->subDays(0)->format('Y-m-d')
                                    ])->groupBy((DB::raw('DATE(created_at)')) )
                                    ->get();
        $date = [];
        for ($i = 0; $i <= 6; $i++) {
            foreach ($day7 as $key => $value) {
                if (Carbon::now()->subDays($i)->format('Y-m-d') == $value->created) {
                    $date[$i] = ['date' => Carbon::parse($value->created)->format('d-m'),
                                'count_order'  => $value->count_order
                                ];
                    break;
                } else {
                    $date[$i] = ['date' => Carbon::now()->subDays($i)->format('d-m'),
                                 'count_order'  => 0
                                ];
                }
            }
        }
        if (isset($request->start)) {
            if (isset($request->end)) {
                $orders = $this->orderModel::whereBetween(
                                DB::raw('DATE(created_at)'),
                                [Carbon::parse($request->start)->format('Y-m-d'),
                                 Carbon::parse($request->end)->format('Y-m-d')])
                                ->with('user')
                                ->with('shipper')
                                ->orderBy('id', 'desc')
                                ->paginate(10);
            } else {
                $orders = $this->orderModel::whereDate('created_at', $request->start)
                                            ->with('user')
                                            ->with('shipper')
                                            ->orderBy('id', 'desc')
                                            ->paginate(10);
            }
        }


        return view('Backend.Contents.index', ['data_7day'=> $date, 'orders' => $orders]);

    }
}
