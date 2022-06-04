<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Replacement extends AbstractAdminModel
{
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'new_subject_id', 'id');
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class, 'schedule_id', 'id');
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, 'new_teacher_id', 'id');
    }

    public function getNameForForm(): string
    {
        return $this->newSubject->name . 'instead of '. $this->schedule->subject->name;
    }

    static function getValidationRules(): array {
        return [
            'schedule_id' => 'required|exists:schedules,id',
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',
        ];
    }
}
