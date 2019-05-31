<?php

namespace App\Libs\Functions {

    //Goi DB
    use Illuminate\Support\Facades\DB;

    class Nestedset {

        public $table = '';
        public $data = NULL;
        public $checked = NULL;
        public $count = 0;
        public $count_level = 0;
        public $lft = NULL;
        public $rgt = NULL;
        public $level = NULL;

        public function get($table = '') {
            !empty($table) ? $this->table = trim($table) : '';
            $this->data = DB::table($this->table)
                ->select()
                ->orderBy('lft', 'ASC')
                ->get();
        }

        public function set() {
            if (!empty($this->data)) {
                $arr = NULL;
                foreach ($this->data as $key => $val) {
                    $arr[$val->id][$val->parent_id] = 1;
                    $arr[$val->parent_id][$val->id] = 1;
                }
                return $arr;
            }
        }

        public function recursive($start = 0, $arr = NULL) {
            $this->lft[$start] = ++$this->count;
            $this->level[$start] = $this->count_level;

            if (isset($arr) && is_array($arr)) {
                foreach ($arr as $key => $val) {
                    if ((isset($arr[$start][$key]) || isset($arr[$key][$start])) && (!isset($this->checked[$key][$start]) && !isset($this->checked[$start][$key]))) {
                        $this->count_level++;
                        $this->checked[$start][$key] = 1;
                        $this->checked[$key][$start] = 1;
                        $this->recursive($key, $arr);
                        $this->count_level--;
                    }
                }
            }
            $this->rgt[$start] = ++$this->count;
        }

        function action() {
            if (isset($this->level) && is_array($this->level) && isset($this->lft) && is_array($this->lft) && isset($this->rgt) && is_array($this->rgt)) {
                $data = NULL;
                foreach ($this->level as $key => $val) {
                    $data[] = array(
                        'id' => $key,
                        'level' => $val,
                        'lft' => $this->lft[$key],
                        'rgt' => $this->rgt[$key],
                    );
                }
                if (!empty($data) && is_array($data)) {
                    $num_key = count($data);
                    for ($i = 1; $i < $num_key; $i++) {
                        DB::table($this->table)
                            ->where('id', $data[$i]['id'])
                            ->update($data[$i]);
                    }
                }
            }
        }

        public function dropdown($text = '') {
            $this->get();
            if (isset($this->data)) {
                $temp = NULL;
                if (!empty($text)) {
                    $temp[0] = $text;
                }
                foreach ($this->data as $key => $val) {
                    $temp[$val->id] = str_repeat('&emsp;&emsp;+ ', (($val->level > 0) ? ($val->level - 1) : 0)) . $val->cat_name;
                }
                return $temp;
            }
        }

        //breadcrumb
        public function breadcrumb($lft = 0, $rgt = 0) {
            $data = DB::table($this->table)
                ->select('id', 'cat_name', 'cat_slug')
                ->where('lft', '<=', $lft)
                ->where('rgt', '>=', $rgt)
                ->orderBy('lft', 'ASC')
                ->get();
            return $data;
        }

    }

}