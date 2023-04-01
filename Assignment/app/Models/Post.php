<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Mail\Markdown;
use Illuminate\Support\Facades\Mail;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'discussion_id',
        'content',
        'ip_address',
    ];

    protected $appends = [
        'content_html',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function discussion(): BelongsTo
    {
        return $this->belongsTo(Discussion::class);
    }

    public function contentHtml(): Attribute
    {
        return Attribute::get(fn () => Markdown::parse($this->content)->toHtml());
    }
}
