<?php

namespace App\Listeners;

use App\Events\SuggestionCreated;
use Http;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendSuggestionConfirmation
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SuggestionCreated $event): void
    {
        $suggestion = $event->suggestion;

        // Send message to Discord
        Http::post(config('services.discord.webhook_url'), [
            'content' => "New suggestion created: {$suggestion->title}",
            'embeds' => [
                [
                    'title' => "Request: {$suggestion->title}",
                    'description' => "{$suggestion->desc}",
                    'color' => 7506394,
                    'fields' => [
                        [
                            'name' => 'Status',
                            'value' => $suggestion->status,
                            'inline' => true
                        ],
                        [
                            'name' => 'Technology',
                            'value' => $suggestion->technology,
                            'inline' => true
                        ],
                        [
                            'name' => 'Tags',
                            'value' => collect($suggestion->tags)->implode(', '),
                            'inline' => false
                        ]
                    ],
                    "author" => [
                        "name" => $suggestion->user->name,
                        "url" => route('site.suggestion.show', $suggestion),
                        "icon_url" => $suggestion->user->avatar

                    ],
                    'url' => route('site.suggestion.show', $suggestion),
                    'footer' => [
                        'text' => 'Tutorial requests',
                        'icon_url' => asset('img/avatar.webp')
                    ],
                    'timestamp' => now()->toIso8601String()
                ]
            ],
        ]);

        // Send message to Telegram
        $telegramUrl = "https://api.telegram.org/bot" . config('services.telegram.bot_token') . "/sendMessage";
        $message = "*New Suggestion Created*\n\n";
        $message .= "*Title:* {$suggestion->title}\n";
        $message .= "*Description:* {$suggestion->desc}\n";
        $message .= "*Status:* {$suggestion->status}\n";
        $message .= "*Technology:* {$suggestion->technology}\n";
        $message .= "*Tags:* " . collect($suggestion->tags)->implode(', ') . "\n";
        $message .= "*User:* [{$suggestion->user->name}](" . route('site.suggestion.show', $suggestion) . ")\n";

        Http::post($telegramUrl, [
            'chat_id' => config('services.telegram.chat_id'),
            'text' => $message,
            'parse_mode' => 'Markdown'
        ]);
    }
}
