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
     * 取得 doLists 表全部資料
     *
     * @return void
     */
    public function get()
    {
        $result = $this->dolists->all();
        return $result;
    }

    /**
     * 找 dolists 表中欄位與帶入參數相同的列
     *
     * @param string $column
     * @param string $input
     * @return void
     */
    public function selectByColumn($column = '', $input = '')
    {
        $result = $this->dolists::where($column, $input)->get();
        return $result;
    }

    /**
     * 儲存到 dolists 表
     *
     * @param array $params
     * @return void
     */
    public function store($params = [])
    {
        $result = $this->dolists->create($params);
        return $result;
    }
}
