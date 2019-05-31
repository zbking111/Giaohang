<?php

namespace App\Http\Controllers\Frontend;

use App\Libs\Configs\StatusConfig;
use App\Models\ProductContact;
use App\Models\SellProducts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Project;
use App\Models\Province;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    public function __construct()
    {
        $this->productModel  = new Product();
        $this->categoryModel = new Category();
        $this->projectModel  = new Project();
        $this->provinceModel = new Province();
        $this->contactModel = new ProductContact();
        $this->sellModel = new SellProducts();
    }

    public function index (Request $request) {
        $projects  = $this->projectModel::select('name', 'id')->get();
        $provinces = $this->provinceModel::select('name', 'id')->get();
        $categories = $this->categoryModel::get();

        $products = $this->productModel::with(['province', 'category', 'project'])
                                        ->where('status', StatusConfig::CONST_AVAILABLE)
                                        ->paginate(10);

        return view('Frontend.Contents.product.list', ['products' => $products,
                                                       'projects'  => $projects,
                                                       'provinces' => $provinces,
                                                       'categories' => $categories]);
    }

    public function detail(Request $request, $slug, $id) {

        $product = $this->productModel::with(['province', 'category', 'project'])->findOrFail($id);

        return view('Frontend.Contents.product.detail', ['product' => $product]);
    }

    public function postContact ($id, Request $request) {
        DB::beginTransaction();
        try {
            $this->contactModel->name       = $request->name;
            $this->contactModel->phone      = $request->phone;
            $this->contactModel->email      = $request->email;
            $this->contactModel->product_id = $id;
            $this->contactModel->contact    = $request->contact ;
            $this->contactModel->save();
            DB::commit();
            return redirect()->back()->with('status', 'success');
        } catch (Exception $exception ){
            DB::rollBack();
            return redirect()->back()->with('status', 'errors');
        }
    }

    public function sell() {
        return view('Frontend.Contents.sell.index');
    }

    public function postSell(Request $request) {
        DB::beginTransaction();
        try {
            $this->sellModel->name     = $request->name;
            $this->sellModel->phone    = $request->phone;
            $this->sellModel->email    = $request->email;
            $this->sellModel->province = $request->province;
            $this->sellModel->district = $request->district;
            $this->sellModel->wards    = $request->wards;
            $this->sellModel->type     = $request->type;
            $this->sellModel->save();
            DB::commit();
            return redirect()->back()->with('status', 'success');
        } catch (Exception $exception ){
            DB::rollBack();
            return redirect()->back()->with('status', 'errors');
        }
    }
}
