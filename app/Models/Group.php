<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends AbstractAdminModel
{
    protected $fillable = [
        'name'
    ];

    static function getValidationRules(): array {
        return [
            'name' => 'required'
        ];
    }

    public function getNameForForm(): string
    {
        return $this->name;
    }
}
