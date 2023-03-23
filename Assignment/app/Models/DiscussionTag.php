<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscussionTag extends Model
{
    protected $table = 'discussion_tag';

    protected $fillable = [
        'discussion_id',
        'tag_id',
    ];

    public function discussion()
    {
        return $this->belongsTo(Discussion::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
