<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Repositories\ListRepository;


class ListService
{
    private $listRepository;

    public function __construct(ListRepository $listRepository)
    {
        $this->listRepository = $listRepository;
    }

    /**
     * 取得 doList 表指定 userid 的資料
     *
     * @param integer $input
     * @return void
     */
    public function getById($input = 0)
    {
        $result = $this->listRepository->selectByColumn('user_id', $input);
        return $result;
    }

    /**
     * 整理資料存入 dolists 表
     *
     * @param array $result
     * @return void
     */
    public function createDoList($result = [])
    {
        $status = $this->calDayStatus();
        $collection = collect($result)->merge(['status' => $status]);
        DB::transaction(function () use ($collection) {
            $result = collect($collection)->only(['user_id', 'task', 'description', 'operate_at', 'complete_at', 'status'])->all();
            $result = $this->listRepository->store($result);

            if (!$result) {
                DB::rollBack();
            }
        });
        return $result;
    }

    /**
     * 計算延遲天數
     *
     * @param array $result
     * @return integer
     */
    public function calDelayDay()
    {
        $delayDay = 0;

        // $today = Carbon::now()->format('Y-m-d');
        // $complete_at = collect($result)->get('complete_at');
        // $completeDay = Carbon::parse($complete_at)->format('Y-m-d');

        // // 完成日超過今天，延遲天數是 0 天
        // if ($completeDay >= $today) {
        //     $delayDay = 0;
        // } else {
        //     $delayDay = carbon::parse($completeDay)->diffInDays($today, true);
        // }
        return $delayDay;
    }

    /**
     * 執行時間更改狀態
     *
     * @return void
     */
    public function calDayStatus()
    {
        $status = 3;
        return $status;
    }
}
