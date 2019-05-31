<?php

namespace App\Http\Controllers\Backend;

use App\Libs\Configs\StatusConfig;
use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UnitController extends Controller
{

    public function __construct()
    {
        $this->unitModel = new Unit();

       
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Backend.Contents.unit.index');
    }

    public function getList(Request $request) {
        $data = $this->unitModel::with('createdBy')->paginate(10);

        return response()->json($data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.Contents.unit.add');
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

            $this->unitModel->price      = $request->price;
            $this->unitModel->status     = $request->status;
            $this->unitModel->created_by = Auth::user()->id;
            $this->unitModel->updated_by = Auth::user()->id;
            $this->unitModel->save();

            DB::commit();
            return redirect()->route('units.index')
                            ->with(['status'=> 'success', 'messages' => "Thêm mới giá tiền thành công!"]);
        } catch (Exception $exception) {
          DB::rollBack();
            return redirect()->route('units.index')
                            ->with(['status'=> 'errors', 'messages' => "Thêm mới giá tiền thất bại!"]);
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
     */
    public function edit($id)
    {
        $unit = $this->unitModel::findOrFail($id);
        return view('Backend.Contents.unit.add', ['unit' => $unit]);
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
        $unitModel = $this->unitModel::findOrFail($id);
        try {
            $unitModel->price      = $request->price;
            $unitModel->status     = $request->status;
            $unitModel->updated_by = Auth::user()->id;
            $unitModel->save();

            DB::commit();
            return redirect()->route('units.index')
                ->with(['status'=> 'success', 'messages' => "Thêm mới giá tiền thành công!"]);
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->route('units.index')
                ->with(['status'=> 'errors', 'messages' => "Thêm mới giá tiền thất bại!"]);
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
        $unitModel= $this->unitModel::findOrFail($id);
        try {
            $unitModel->delete();
            DB::commit();
            return response()->json(['status' => true]);
        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json(['status' => false]);
        }
    }

    public function status ($id) {
        DB::beginTransaction();
        $unitModel = $this->unitModel::findOrFail($id);
        $status_old = $unitModel->status;
        try {
            if ($status_old ==  StatusConfig::CONST_AVAILABLE) {
                $unitModel->status          = StatusConfig::CONST_DISABLE;
            } else {
                $unitModel->status          = StatusConfig::CONST_AVAILABLE;
            }
            $unitModel->save();
            DB::commit();
            return response()->json(['status' => true]);
        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json(['status' => false]);
        }
    }
}
