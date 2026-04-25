<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'priority',
        'category',
        'is_completed',
        'deadline',
    ];

    protected $casts = [
        'is_completed' => 'boolean',
        'deadline' => 'datetime',
    ];

    protected $attributes = [
        'category' => 'personal',
        'priority' => 'medium',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeCompleted($query)
    {
        return $query->where('is_completed', true);
    }

    public function scopePending($query)
    {
        return $query->where('is_completed', false);
    }

    public function scopeByPriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function isOverdue()
    {
        return $this->deadline && $this->deadline->isPast() && !$this->is_completed;
    }
}
