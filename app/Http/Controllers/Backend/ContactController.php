<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libs\Configs\StatusConfig;

use DB, App;
use App\Models\Contact;

class ContactController extends Controller
{
	public function __construct()
	{
		$this->contactModel = new Contact();
	}

    public function index() {
        return view('Backend.Contents.contact.index');
    }

     public function list() {
        $data = Contact::paginate(10);
        return response()->json($data);
    }

}
