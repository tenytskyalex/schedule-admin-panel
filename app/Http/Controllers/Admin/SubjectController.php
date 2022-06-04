<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subject;

class SubjectController extends AdminBaseController
{
    protected function getModel(): string
    {
        return Subject::class;
    }

}
