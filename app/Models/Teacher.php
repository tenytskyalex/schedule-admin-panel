<?php

namespace App\Models;

class Teacher extends AbstractAdminModel
{
    protected $fillable = [
        'first_name',
        'last_name',
        'father_name',
    ];

    public function getFullNameAttribute(): string
    {
        return $this->first_name. ' '. $this->last_name.' '.$this->father_name;
    }

    public function getInitials(): string
    {
        return $this->last_name. ' '. substr($this->first_name, 0, 1). '. '. substr($this->father_name, 0, 1).'.';
    }

    static function getValidationRules(): array {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'father_name' => 'required',
        ];
    }

    public function getNameForForm(): string
    {
        return $this->getFullNameAttribute();
    }
}
