<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Replacement;

class ReplacementController extends AdminBaseController
{

    protected function getModel(): string
    {
        return Replacement::class;
    }
}
