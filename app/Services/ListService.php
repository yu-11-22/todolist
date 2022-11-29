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
    public function getById($input = 0, $order, $type)
    {
        $result = $this->listRepository->selectByColumn('user_id', $input, $order, $type);
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
        $collection = collect($result)->merge(['status' => '3']);
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
     * @return array
     */
    public function calDelayDay($result = [])
    {
        $delayDay = '';
        $today = Carbon::now()->format('Y-m-d');

        $arr = collect($result)->map(function ($item) use ($today, &$delayDay) {
            $complete_at = $item['complete_at'];
            $completeDay = Carbon::parse($complete_at)->format('Y-m-d');
            // 完成日超過今天，延遲天數是 0 天
            if ($completeDay >= $today) {
                $delayDay = '0';
            } else {
                $delayDay = carbon::parse($completeDay)->diffInDays($today, true);
            }
            $delay = ['delay' => "$delayDay"];
            $collection = collect($item)->merge($delay);
            return $collection;
        });

        return $arr;
    }

    /**
     * 執行時間更改狀態
     *
     * @param array $result
     * @return array
     */
    public function calDayStatus($result = [])
    {
        $status = '';
        $statusArray = [
            1 => '已完成',
            2 => '執行中',
            3 => '待執行',
        ];
        $arr = collect($result)->map(function ($item) use (&$statusArray, &$status) {
            $status = $item['status'] ?? $status;
            $statusResult = ['statusResult' => $statusArray[$status]];
            $collection = collect($item)->merge($statusResult);
            return $collection;
        });
        return $arr;
    }
}
