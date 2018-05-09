<?php

namespace App\Actions;

use Exception;
use PhpBrasil\Telegram\Bot;
use PhpBrasil\Telegram\Match;

/**
 * Class Start
 * @package App\Actions
 */
class Start
{
    /**
     * @param Bot $bot
     * @param Match $match
     * @param array $message
     * @throws Exception
     * @SuppressWarnings(Unused)
     */
    public function __invoke($bot, $match, $message)
    {
        $chatId = get($message, 'chat.id');
        $parameters = [
            'chat_id' => $chatId,
            'text' => 'Hello',
            'reply_markup' => [
                'keyboard' => [['Hello', 'Hi']],
                'one_time_keyboard' => true,
                'resize_keyboard' => true
            ]
        ];
        $bot->answer($parameters);
    }
}
