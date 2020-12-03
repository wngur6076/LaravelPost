<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUsername()
    {
        return current(explode('@', $this->user()->value('email')));
    }

    public function getCreatedAt()
    {
        return date('h:i: A, M j', strtotime($this->created_at));
    }

    public function getSummary()
    {
        return filter_var(mb_substr(strip_tags($this->content), 0, 200), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
}
