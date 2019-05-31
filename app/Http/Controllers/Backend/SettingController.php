<?php

namespace App\Http\Controllers\Backend;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->settingModel = new Setting();

        $this->middleware('permission:setting.contact.read', ['only' => ['contact']]);
        $this->middleware('permission:setting.seoDefault.read', ['only' => ['seoDefault']]);

    }

    public function contact () {
        return view('Backend.Contents.setting.contact');
    }

    public function seoDefault () {
        return view('Backend.Contents.setting.seo_default');
    }

    public function record(Request $request) {
        $data = $this->settingModel::where('type', $request->type)
                                    ->first();
        if (!empty($data)) {
            $data->data = json_decode($data->data);
        }
        return response()->json($data);
    }

    public function saveSetting(Request $request) {
        DB::beginTransaction();
        try {
            $this->settingModel::updateOrCreate(['type' => $request->key],
                ['data' => $request->setting]
            );

            DB::commit();
            return response()->json(['status' => true], 200);

        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => false], 422);
        }
    }

}
