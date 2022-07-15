<?php

namespace App\Services;

use App\Models\FormLog;

class FormLogService
{
    private $FormLog;

    public function __construct(FormLog $FormLog)
    {
        $this->FormLog = $FormLog;
    }

    public function all()
    {
        return $this->FormLog->query();
    }

    public function store($data)
    {
        return $this->FormLog->create($data);
    }
}
