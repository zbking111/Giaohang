<?php

namespace App\Libs\Providers;

use App\Models\Language as LanguageModel;
use App\Libs\Configs\StatusConfig;


class Language {
	public function getLanguage() {
		$languageModel = new LanguageModel();

		$data = $languageModel->select('id', 'locale', 'name_display', 'icon', 'description', 'status')
							  ->where('status', StatusConfig::CONST_AVAILABLE)
							  ->get();
		return $data;
	}
}



    
