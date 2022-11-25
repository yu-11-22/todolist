<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\ListService;
use App\ServiceManager\ListServiceManager;

class ListController extends Controller
{
    private $listService;
    private $listServiceManager;

    public function __construct(ListService $listService, ListServiceManager $listServiceManager)
    {
        $this->listService = $listService;
        $this->listServiceManager = $listServiceManager;
    }

    /**
     * 前台首頁
     *
     * @return void
     */
    public function home($order = 'operate_at', $type = 'asc')
    {
        $count = 0;
        $list = $this->listServiceManager->doListWithUser($order, $type);
        $list = $this->listService->calDelayDay($list);
        $list = $this->listService->calDayStatus($list);
        return view('public.home', compact(['list', $list], ['count', $count]));
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
        $result = $this->listServiceManager->addUsersDoList($result);
        if (!$result) {
            return redirect('/')->withErrors([
                'errors' => ['新增內容有誤']
            ]);
        };
        return redirect("/");
    }

    public function order()
    {
        $order = 'operate_at';
        // $type = 'asc';
        $orderCheck = 1;
        if ($orderCheck) {
            $type = 'desc';
            $orderCheck -= 1;
        } else {
            $type = 'asc';
            $orderCheck += 1;
        }
        return $this->home($order, $type);
    }
}
