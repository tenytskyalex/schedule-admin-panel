<?php

namespace App\Http\Controllers\Admin;

use App\Models\Schedule;

class ScheduleController extends AdminBaseController
{
    protected function getModel(): string
    {
        return Schedule::class;
    }
}
