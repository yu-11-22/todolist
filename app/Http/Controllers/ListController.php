<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\ListService;

class ListController extends Controller
{
    private $listService;

    public function __construct(ListService $listService)
    {
        $this->listService = $listService;
    }

    public function addList(Request $request)
    {
        $result = $this->validate($request, [
            "task" => "required|max:50",
            "description" => "max:200",
            "operate_at" => "date",
            "complete_at" => "date",
        ]);
        dd($this->listService->get());
        return redirect("/");
    }
}
