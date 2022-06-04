<?php

namespace App\Http\Controllers\Admin;

use App\Models\Group;

class GroupController extends AdminBaseController
{
    protected function getModel(): string
    {
        return Group::class;
    }
}
