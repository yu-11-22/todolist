<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private $userRepository;

    public function __construct(UserRepository $user)
    {
        $this->userRepository = $user;
    }

    /**
     * 取得 user 表全部資料
     *
     * @return void
     */
    public function get()
    {
        $result = $this->userRepository->get();
        return $result;
    }

    /**
     * 與 user 表做登入驗證
     *
     * @param array $inputArray
     * @return boolean
     */
    public function loginCheck($inputArray = [])
    {
        $result = false;
        // 輸入的帳密
        $account = collect($inputArray)->get('account');
        $password = collect($inputArray)->get('password');

        // 資料表的帳密
        $userData = $this->userRepository->selectByColumn('account', $account);
        $userData = collect($userData)->first() ?? [];
        $dataPassword = $userData['password'] ?? '';

        // 確認密碼是否吻合
        if (!Hash::check($password, $dataPassword)) {
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }
}
