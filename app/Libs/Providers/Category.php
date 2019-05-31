<?php

namespace App\Libs\Providers;

use App\Models\Category as CategoryModel;
use App\Libs\Configs\StatusConfig;


class Category {
	public function recordCategory($id, $locale) {
		$categoryModel = new CategoryModel();
		$data = $categoryModel::findOrFail($id)->translate($locale);

		return $data;
	}

	public function listCategory($locale) {
		$categoryModel = new CategoryModel();
		$data = $categoryModel::select('id', 'parent_id')
								->where('status', StatusConfig::CONST_AVAILABLE)
								->get();

		return $data;
	}

}



    
