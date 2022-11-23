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

    public function get()
    {
        $result = $this->dolists::all();
        return $result;
    }
}
