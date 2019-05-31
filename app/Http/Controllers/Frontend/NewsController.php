<?php

namespace App\Http\Controllers\Frontend;

use App\Libs\Configs\StatusConfig;
use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->newsModel = new News();
    }

    public function index() {
        $listNews = $this->newsModel::where('status', StatusConfig::CONST_AVAILABLE)->paginate(10);
        return view('Frontend.Contents.news.list', ['listNews' => $listNews]);
    }

    public function detail(Request $request, $slug, $id) {

        $news = $this->newsModel::findOrFail($id);

        return view('Frontend.Contents.news.detail', ['news' => $news]);
    }
}
