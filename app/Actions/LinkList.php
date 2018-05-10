<?php

namespace App\Actions;

use Exception;
use Php\File;
use Php\JSON;
use const PHP_EOL;
use PhpBrasil\Telegram\Bot;
use PhpBrasil\Telegram\Match;

/**
 * Class LinkList
 * @package App\Actions
 */
class LinkList
{
    /**
     * The __invoke method is called when a script tries to call an object as a function.
     *
     * @param Bot $bot
     * @param Match $match
     * @return mixed
     * @throws Exception
     * @link http://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     * @SuppressWarnings(ShortVariable)
     */
    public function __invoke($bot, $match)
    {
        $message = $match->get('$message');
        $chatId = get($message, 'chat.id');
        $filename = APP_ROOT . "/storage/{$chatId}.json";
        $array = [];
        if (File::exists($filename)) {
            $text = File::read($filename);
            $array = (array)JSON::decode($text);
        }
        $items = [];
        foreach ($array as $index => $item) {
            $items[] = "{$item}" . PHP_EOL . "Remover: /link_rm_{$index}";
        }
        if (!count($items)) {
            $items = ['empty'];
        }

        $text = implode(PHP_EOL . ' -- ' . PHP_EOL, $items);

        $options = [
            'disable_web_page_preview' => true,
            'reply_markup' => [
                'inline_keyboard' => [
                    [
                        [
                            'text' => 'Remover',
                            'switch_inline_query' => 'share'
                        ]
                    ]
                ]
            ]
        ];

        return $bot->replyTo($text, $options);
    }
}