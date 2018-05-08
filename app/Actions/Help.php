<?php

namespace App\Actions;

use Exception;
use PhpBrasil\Telegram\Bot;
use PhpBrasil\Telegram\Match;

/**
 * Class Help
 * @package App\Actions
 */
class Help
{
    /**
     * @param Bot $bot
     * @param Match $match
     * @param array $message
     * @throws Exception
     * @SuppressWarnings(Unused)
     */
    function __invoke($bot, $match, $message)
    {
        $chatId = get($message, 'chat.id');
        $parameters = [
            'chat_id' => $chatId,
            "text" => "Help\n" .
                "/link add <label>#<link>[ as <id>]\n" .
                "/link rm <id>\n" .
                "/link get <id>\n" .
                "/link ls\n",
        ];
        $bot->answer($parameters);
    }
}
