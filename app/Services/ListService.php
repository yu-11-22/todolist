<?php

namespace App\Services;

use App\Repositories\ListRepository;


class ListService
{
    private $listRepository;

    public function __construct(ListRepository $listRepository)
    {
        $this->listRepository = $listRepository;
    }

    public function get()
    {
        $result = $this->listRepository->get();
        return $result;
    }
}
