<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends AbstractAdminModel
{
    protected $fillable = [
        'lesson',
        'date',
        'cabinet'
    ];

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    static function getValidationRules(): array {
        return [
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers,id',
            'group_id' => 'required|exists:groups,id',
            'lesson' => 'required|integer|min:1|max:10',
            'date' => 'required|date',
            'cabinet' => 'required'
        ];
    }

    public function getNameForForm(): string
    {
        return $this->group->name. ", ". $this->subject->name. ", ". $this->lesson. ", ". $this->date;
    }
}
