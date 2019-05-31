<?php

	function statusAvailable($status) {
		if ($status ==  App\Libs\Configs\StatusConfig::CONST_AVAILABLE) {
			return true;
		} 
		return false;
	}

	function statusDisable($status) {
		if ($status ==  App\Libs\Configs\StatusConfig::CONST_DISABLE) {
			return true;
		} 
		return false;
	}

	function showCategories($categories, $parent_id = 0, $char = ' -- ', $selected = 0, $category_id = -1) {
	    foreach ($categories as $key => $item) {
	    	if ($item->parent_id == $parent_id && $item->parent_id != $category_id && $category_id != $item->id) {
	    		if ($selected == $item->id) {
					echo '<option selected = "selected" value="'.$item->id.'">';
			        echo $char ." ". $item->name ." ". $char;
			        echo '</option>';

			        unset($categories[$key]);
	    		} else {
					echo '<option value="'.$item->id.'">';
			        echo $char ." ". $item->name ." ". $char;
			        echo '</option>';

			        unset($categories[$key]);
	    		}
	    		showCategories($categories, $item->id, $char.' -- ', $selected, $category_id);
	    	}
	    }
	}