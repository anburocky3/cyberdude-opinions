<?php

namespace App\Console\Commands;

use Discord\Builders\Components\ActionRow;
use Discord\Builders\Components\Button;
use Discord\Builders\MessageBuilder;
use Discord\Discord;
use Discord\Exceptions\IntentException;
use Discord\Parts\Channel\Message;
use Discord\WebSockets\Event;
use Discord\WebSockets\Intents;
use Illuminate\Console\Command;

class RunDiscordBot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'discord:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the Discord bot';

    /**
     * Execute the console command.
     * @throws IntentException
     */
    public function handle(): int
    {
        $token = config('services.discord.token');

        if (is_null($token)) {
            $this->error('Discord bot token is not set.');
            return 1;
        }

        $discord = new Discord([
            'token' => $token,
            'intents' => Intents::getDefaultIntents() | Intents::MESSAGE_CONTENT,
        ]);

        $discord->on('init', function ($discord) {
            $this->info("Logged in as {$discord->user->username}#{$discord->user->discriminator}!");

            $discord->on(Event::MESSAGE_CREATE, function (Message $message, Discord $discord) {
                // Ignore other bot messages
                if ($message->author->bot && $message->author->username != 'CyberDude Opinions') return;

                // Check if the message is from your webhook
                if (str_contains($message->content, "New suggestion created:")) {
                    // Add reactions to the message
                    $message->react('👍'); // Vote Up
                    $message->react('👎'); // Vote Down
                    $message->react('💖'); // Heart

                    //// Add a button to navigate to the website
                    // $message->channel->sendMessage(
                    //     MessageBuilder::new()
                    //         ->setContent('Click the button below to view the suggestion on the website:')
                    //         ->addComponent(
                    //             ActionRow::new()->addComponent(
                    //                 Button::new(Button::STYLE_LINK)
                    //                     ->setLabel('View Suggestion')
                    //                     ->setUrl('https://cyberdude-opinions.test')
                    //             )
                    //         )
                    // );
                }
            });
        });

        $discord->run();

        return 0;
    }
}
