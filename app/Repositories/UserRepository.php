<?php

namespace App\Repositories;

use App\Model\User;

class UserRepository
{
    private $users;

    public function __construct(User $users)
    {
        $this->users = $users;
    }

    /**
     * 取得 users 表全部資料
     *
     * @return void
     */
    public function get()
    {
        $result = $this->users->all();
        return $result;
    }

    /**
     * 找 users 表中欄位與帶入參數相同的列
     *
     * @param string $column
     * @param string $input
     * @return void
     */
    public function selectByColumn($column = '', $input = '')
    {
        $result = $this->users::where($column, $input)->get();
        $result = collect($result)->toArray();
        return $result;
    }
}
