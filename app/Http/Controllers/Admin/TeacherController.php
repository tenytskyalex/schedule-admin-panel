<?php

namespace App\Http\Controllers\Admin;

use App\Models\Teacher;

class TeacherController extends AdminBaseController
{
    protected function getModel(): string
    {
        return Teacher::class;
    }
}
