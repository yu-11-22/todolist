<?php

namespace App\Repositories;

use App\Model\DoList;

class ListRepository
{
    private $dolists;

    public function __construct(DoList $dolists)
    {
        $this->dolists = $dolists;
    }

    /**
     * 取得 doList 表全部資料
     *
     * @return void
     */
    public function get()
    {
        $result = $this->dolists::all();
        return $result;
    }
}
