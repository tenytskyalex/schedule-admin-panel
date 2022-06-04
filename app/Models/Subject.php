<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Subject extends AbstractAdminModel
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
