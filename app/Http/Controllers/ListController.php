<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\ListService;
use App\ServiceManager\ListServiceManager;

class ListController extends Controller
{
    private $listService;
    private $listServiceManager;
    private $order;
    private $status;
    private $type;

    public function __construct(ListService $listService, ListServiceManager $listServiceManager)
    {
        $this->listService = $listService;
        $this->listServiceManager = $listServiceManager;
        $this->order = 'operate_at';
        $this->type = 'asc';
        $this->status = null;
    }

    /**
     * 前台首頁
     *
     * @return void
     */
    public function home(Request $request)
    {
        // 事項筆數判斷
        $count = 0;
        $status = $this->status;
        $this->order($request, $operate_at, $complete_at);
        $this->statusSelect($request, $status);

        $list = $this->listServiceManager->doListWithUser($this->order, $this->type) ?? [];
        // 加上延遲天數
        $list = $this->listService->calDelayDay($list) ?? [];
        // 數字改為狀態
        $list = $this->listService->calDayStatus($list) ?? [];
        // 狀態不為 null 時的畫面處理
        $list = $this->listService->statusNotNull($list, $status);
        // 軟刪除的畫面處理
        $list = $this->listService->notDeleted($list);

        return view('public.home', compact(['list', $list], ['count', $count], ['operate_at', $operate_at], ['complete_at', $complete_at]));
    }

    /**
     * 執行與完成時間的排序判斷
     *
     * @return void
     */
    function order($request, &$operate_at, &$complete_at)
    {
        $operate_at = 'operate=desc';
        $complete_at = 'complete=desc';

        // 排序判斷
        switch (true) {
            case ($request->path() == 'operate=desc'):
                $this->order = 'operate_at';
                $this->type = 'desc';
                $operate_at = '/operate=asc';
                break;

            case ($request->path() == 'operate=asc'):
                $this->order = 'operate_at';
                $this->type = 'asc';
                $operate_at = '/operate=desc';
                break;

            case ($request->path() == 'complete=desc'):
                $this->order = 'complete_at';
                $this->type = 'desc';
                $complete_at = '/complete=asc';
                break;

            case ($request->path() == 'complete=asc'):
                $this->order = 'complete_at';
                $this->type = 'asc';
                $complete_at = '/complete=desc';
                break;

            default:
                $this->order = 'operate_at';
                $this->type = 'asc';
        }
    }

    /**
     * 狀態欄位的篩選
     *
     * @return void
     */
    function statusSelect($request, &$status)
    {
        switch (true) {
            case ($request->path() == '3'):
                $status = 3;
                break;

            case ($request->path() == '2'):
                $status = 2;
                break;

            case ($request->path() == '1'):
                $status = 1;
                break;

            default:
                $status = null;
        }
    }

    /**
     * 新增待辦事項
     *
     * @param Request $request
     * @return void
     */
    public function addList(Request $request)
    {
        $result = $this->validate($request, [
            "task" => "required|max:50",
            "description" => "max:200",
            "operate_at" => "date",
            "complete_at" => "date|after:operate_at",
        ]);
        if (is_null($result)) {
            return redirect('/')->withErrors([
                'errors' => ['新增時發生錯誤!!']
            ]);
        } else {
            $this->listServiceManager->addUsersDoList($result);
            return redirect("/");
        };
    }

    public function deleteList(Request $request)
    {
        $deletedId = $request->id;

        if (is_null($deletedId)) {
            return redirect('/')->withErrors([
                'errors' => ['刪除時發生錯誤!!']
            ]);
        } else {
            $this->listService->deleteUsersDoList($deletedId);
            return redirect("/");
        };
    }
}
