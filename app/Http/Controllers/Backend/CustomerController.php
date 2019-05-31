<?php

namespace App\Http\Controllers\Backend;

use App\Libs\Configs\StatusConfig;
use App\Models\Customer;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{

    public function __construct()
    {
        $this->customerModel = new User();
        $this->middleware('permission:customer.active', ['only' => ['index']]);
        $this->middleware('permission:customer.read', ['only' => ['getList']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Backend.Contents.customer.index');
    }


    public function getList(Request $request) {

        // $data = $this->customerModel::where('is_customer', 1)->paginate(10);

        // return response()->json($data);
        $customerModel = $this->customerModel::select('*');
        if (isset($request->freetext) && !empty($request->freetext)) {
            $customerModel->where('name', 'like', '%'.$request->freetext.'%');
        } 
        $customers = $customerModel->where('is_customer', 1)
                    ->orderBy('id', 'desc')
                    ->paginate(10);

        return response()->json($customers);

        $customerModel = $this->customerModel::select('*');
        if (isset($request->freetext) && !empty($request->freetext)) {
            $customerModel->where('phone', 'like', '%'.$request->freetext.'%');
        } 
        $customers = $customerModel->where('is_customer', 1)
                    ->orderBy('id', 'desc')
                    ->paginate(10);

        return response()->json($customers);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.Contents.customer.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->customerModel->code            = $request->code;
            $this->customerModel->name            = $request->name;
            $this->customerModel->email           = $request->email;
            $this->customerModel->phone           = $request->phone;
            $this->customerModel->address         = $request->address;
            $this->customerModel->atm             = $request->atm;
            $this->customerModel->company         = $request->company;
            $this->customerModel->company_address = $request->company_address;
            $this->customerModel->company_email   = $request->company_email;
            $this->customerModel->company_phone   = $request->company_phone;
            $this->customerModel->note            = $request->note;
            $this->customerModel->password        = Hash::make('12345678');
            $this->customerModel->is_customer     = 1;
            $this->customerModel->avatar          = $request->avatar;
            $this->customerModel->status          = $request->status;
            $this->customerModel->save();
            DB::commit();
            return redirect()->route('customers.index')
                            ->with(['status'=> 'success', 'messages' => "Thêm mới khách hàng thành công!"]);
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->route('customers.index')
                ->with(['status'=> 'errors', 'messages' => "Thêm mới khách hàng thất bại!"]);
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = $this->customerModel::findOrfail($id);
        return view('Backend.Contents.customer.add', ['customer' => $customer]);
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
        DB::beginTransaction();
        $customerModel = $this->customerModel::findOrFail($id);
        try {
            $customerModel->name            = $request->name;
            $customerModel->email           = $request->email;
            $customerModel->phone           = $request->phone;
            $customerModel->address         = $request->address;
            $customerModel->atm             = $request->atm;
            $customerModel->company         = $request->company;
            $customerModel->company_address = $request->company_address;
            $customerModel->company_email   = $request->company_email;
            $customerModel->company_phone   = $request->company_phone;
            $customerModel->note            = $request->note;
            $customerModel->avatar          = $request->avatar;
            $customerModel->status          = $request->status;
            $customerModel->save();
            DB::commit();
            return redirect()->route('customers.index')
                ->with(['status'=> 'success', 'messages' => "Cập nhật khách hàng thành công!"]);
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->route('customers.index')
                ->with(['status'=> 'errors', 'messages' => "Cập nhật khách hàng thất bại!"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        $customerModel = $this->customerModel::findOrFail($id);
        try {
            $customerModel->delete();
            DB::commit();
            return response()->json(['status' => true]);
        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json(['status' => false]);
        }
    }

    public function status ($id) {
        DB::beginTransaction();
        $customerModel = $this->customerModel::findOrFail($id);
        $status_old = $customerModel->status;
        try {
            if ($status_old ==  "AVAILABLE") {
                $customerModel->status          = "DISABLE";
            } else {
                $customerModel->status          = "AVAILABLE";
            }
            $customerModel->save();
            DB::commit();
            return response()->json(['status' => true]);
        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json(['status' => false]);
        }
    }
    // public function checkVip($id) {
    //     $checked = $this->orderModel->where('id', $id)->get();
    //     $total = 0;
    //     if (count($checked) > 10) {
    //         $user = $this->userModel->findOrFail($id);
    //         $user->is_vip = 1;
    //     }
    //     foreach ($checked as $value) {
    //         $total += str_replace(',', '', $value->price);
    //         if ($total > 10000000) {
    //             $user         = $this->userModel->findOrFail($id);
    //             $user->is_vip = 1;
    //             break;
    //         }
    //     }
    //     return true;
    // }
}
