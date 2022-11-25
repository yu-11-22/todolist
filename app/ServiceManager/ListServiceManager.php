<?php

namespace App\ServiceManager;

use App\Services\ListService;
use Illuminate\Support\Facades\Auth;

class ListServiceManager
{
    private $listService;

    public function __construct(ListService $listService)
    {
        $this->listService = $listService;
    }

    /**
     * 合併 userid 到並新增的待辦事項
     *
     * @param array $result
     * @return void
     */
    public function addUsersDoList($result = [])
    {
        $id = Auth::guard('user')->id();

        $collection = collect($result)->merge(['user_id' => $id]);
        $result = $this->listService->createDoList($collection);
        return $result;
    }

    /**
     * 待辦事項綁定 user
     *
     * @return void
     */
    public function doListWithUser($order, $type)
    {
        $id = Auth::guard('user')->id();
        $result = $this->listService->getById($id, $order, $type);
        return $result;
    }
}
