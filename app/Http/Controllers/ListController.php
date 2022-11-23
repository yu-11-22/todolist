<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListController extends Controller
{
    public function addList(Request $request)
    {
        $result = $this->validate($request, [
            "task" => "required|max:50",
            "description" => "max:200",
            "operate_at" => "date",
            "complete_at" => "date",
        ]);

        return redirect("/");
    }
}
