<?php

namespace App\Http\Controllers\Backend;

use App\Libs\Configs\StatusConfig;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Permission;
use App\Models\Unit;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->orderModel = new Order();
        $this->unitModel = new Unit();
        $this->userModel = new User();
        $this->permissionModel = new Permission();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Backend.Contents.order.index');
    }

    public function getList(Request $request) {
                


        $freeText = $request->freetext;
        $status = $request->status;
        $end = isset($request->end) ? Carbon::parse($request->end)->format('Y-m-d') : '';
        $start = isset($request->start) ? Carbon::parse($request->start)->format('Y-m-d') : '';
        $long = $request->long;



        if (Auth::user()->is_customer == 1) {
 
            $data = $this->orderModel->filterName($freeText)
                                    ->filterCode($freeText)
                                    ->filterAddress1($freeText)
                                    ->filterAddress2($freeText)
                                    ->filterStatus($status)
                                    ->filterDate($start, $end)
                                    ->filterLong($long)
                                    ->buildCond()
                                    ->with('user')
                                    ->with('shipper')
                                    ->where('customer_id', Auth::user()->id)
                                    ->orderBy('id', 'desc')
                                    ->paginate(10);
        } else {
            if (Auth::check() && Auth::user()->can('order.view_all')) {

                $data = $this->orderModel->filterName($freeText)
                                        ->filterCode($freeText)
                                        ->filterAddress1($freeText)
                                        ->filterAddress2($freeText)
                                        ->filterStatus($status)
                                        ->filterDate($start, $end)
                                        ->filterLong($long)
                                        ->buildCond()
                                        ->with('user')
                                        ->with('shipper')
                                        ->orderBy('id', 'desc')
                                        ->paginate(10);
            } else if (Auth::user()->can('order.view_shipper_personal')){
                $data = $this->orderModel->filterName($freeText)
                                        ->filterCode($freeText)
                                        ->filterAddress1($freeText)
                                        ->filterAddress2($freeText)
                                        ->filterStatus($status)
                                        ->filterDate($start, $end)
                                        ->filterLong($long)
                                        ->buildCond()
                                        ->with('user')
                                        ->with('shipper')
                                        ->where('shipper', Auth::user()->id)
                                        ->orWhere('customer_id', Auth::user()->id)
                                        ->orderBy('id', 'desc')
                                        ->paginate(10);
            } else {
                $data = array();
            }
        }
        return response()->json($data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unit = $this->unitModel::where('status', StatusConfig::CONST_AVAILABLE)
                                ->orderBy('id', 'desc')
                                ->first();

        return view('Backend.Contents.order.add', ['unit' => $unit]);
    }

    public function pickShipper($id) {
        $order = $this->orderModel::findOrFail($id);

        $permissions = $this->permissionModel->with('roles')->where('name', 'order.shipped')->first();

        $roles = array_column($permissions->roles->toArray(), 'id');

        $user_roles = DB::table('role_user')->whereIn('role_id', $roles)->get()->toArray();

        $staffs = $this->userModel::with('roles')->whereIn('id', array_column($user_roles, 'user_id'))->get();

        return view('Backend.Contents.order.pick_shipper', ['order' => $order, 'staffs' => $staffs]);
    }

    public function pickShipperPost(Request $request, $id) {

        DB::beginTransaction();
        $orderModel = $this->orderModel::findOrFail($id);

        try {
            $orderModel->shipper = $request->shipper;
            $orderModel->save();
            DB::commit();
            return redirect()->route('orders.index')->with(['stauts' => 'success', 'Chọn shiper cho đơn  thành công!']);

        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->route('orders.index')->with(['stauts' => 'errors', 'Chọn shiper cho đơn thất bại!']);
        }
    }   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required',
            'address1' => 'required',
            'address2' => 'required',
            'phone'    => 'required',
            'long'     => 'required',
            'price'    => 'required',
        ]);
        DB::beginTransaction();
        if ($request->long > 50) {
            return redirect()->back()->with('messages', 'Chỉ ship dưới 50 km');
        }
        try {
            if (Auth::user()->is_vip == 1 || Auth::user()->is_customer == 0) {
                $this->orderModel->status = 2;

            } else {
                $this->checkVip(Auth::user()->id);
            }
            $this->orderModel->code        = $this->generateRandomString(6);
            $this->orderModel->customer_id = Auth::user()->id;
            $this->orderModel->address1    = $request->address1;
            $this->orderModel->address2    = $request->address2;
            $this->orderModel->name        = $request->name;
            $this->orderModel->date        = Carbon::parse($request->date)->format('Y-m-d');
            $this->orderModel->phone       = $request->phone;
            $this->orderModel->email       = $request->email;
            $this->orderModel->long        = $request->long;
            $this->orderModel->price       = $request->price;
            $this->orderModel->save();
            DB::commit();
            return redirect()->route('orders.index')->with(['stauts' => 'success', 'Tạo mới đơn hàng thành công!']);

        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->route('orders.index')->with(['stauts' => 'errors', 'Tạo mới đơn hàng thất bại!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function status ($id,Request $request)
    {
        $this->validate($request, [
            'status' => 'required'
        ]);

        DB::beginTransaction();
        $orderModel = $this->orderModel::findOrFail($id);
        try {
            $orderModel->status     = $request->status;
            $orderModel->updated_by = Auth::user()->id;
            $orderModel->save();
            DB::commit();
            return response()->json(['status' => true]);
        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json(['status' => false]);
        }
    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $checked = $this->orderModel::where('code', $randomString)->first();
        if (!empty($checked)) {
            generateRandomString();
        }
        return $randomString;
    }

    public function checkVip($id) {
        $checked = $this->orderModel->where('id', $id)->get();
        $total = 0;
        if (count($checked) > 10) {
            $user = $this->userModel->findOrFail($id);
            $user->is_vip = 1;
        }
        foreach ($checked as $value) {
            $total += str_replace(',', '', $value->price);
            if ($total > 10000000) {
                $user         = $this->userModel->findOrFail($id);
                $user->is_vip = 1;
                break;
            }
        }
        return true;
    }
}
