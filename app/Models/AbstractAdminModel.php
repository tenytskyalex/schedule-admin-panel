<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractAdminModel extends Model
{
    static function getValidationRules(): array
    {
        return [];
    }

    abstract public function getNameForForm(): string;
}
