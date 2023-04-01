<?php

namespace App\Listeners;

use App\Events\DiscussionStarted;
use App\Models\Post;
use OpenAI\Laravel\Facades\OpenAI;

class GenerateAnswerForDiscussion
{
    public function handle(DiscussionStarted $event): void
    {
        $discussion = $event->discussion;
        /** @var Post $post */
        $post = $discussion->firstPost;

        $result = OpenAI::completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => $post->content,
            'max_tokens' => 4001,
        ]);

        $discussion->posts()->create([
            'content' => $result->choices[0]->text,
            'user_id' => 2,
            'ip_address' => request()->ip(),
        ]);
    }
}
