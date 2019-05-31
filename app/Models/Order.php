<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MyModel;
use DB;

class Order extends MyModel
{
    protected $table = "orders";

    public function user() {
        return $this->hasOne('App\User', 'id', 'customer_id');
    }
    public function shipper() {
        return $this->hasOne('App\User', 'id', 'shipper');
    }

    public function filterName($param) {
        if (!empty($param)) {
            $this->setFunctionCond("orWhere", ["name", "like", "%$param%"]);
        }
        return $this;
    }
    public function filterCode($param) {
        if (!empty($param)) {
            $this->setFunctionCond("orWhere", ["code", "like", "%$param%"]);
        }
        return $this;
    }

    public function filterAddress1($param) {
        if (!empty($param)) {
            $this->setFunctionCond("orWhere", ["address1", "like", "%$param%"]);
        }
        return $this;
    }

    public function filterAddress2($param) {
        if (!empty($param)) {
            $this->setFunctionCond("orWhere", ["address2", "like", "%$param%"]);
        }
        return $this;
    }
    public function filterStatus($param) {
        if (!empty($param)) {
            $this->setFunctionCond("where", ["status", $param]);
        }
        return $this;
    }
    public function filterDate($param, $param2) {
        if (!empty($param)) {
            if (!empty($param2)) {
                $this->setFunctionCond("whereBetween", [DB::raw('DATE(created_at)'), [$param, $param2]]);
            } else {
                $this->setFunctionCond("whereDate", ["created_at", $param]);
            }
        }
        return $this;
    }

    public function filterLong($param) {
        if (!empty($param)) {
            if ($param == 1) {
                $this->setFunctionCond("where", ["long", ">", 30]);
            }
            else if ($param == 2){
                $this->setFunctionCond("where", ["long", "<", 30]);
            }

        }
        return $this;
    }
}
