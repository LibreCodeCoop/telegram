<?php

namespace App\Actions;

use Exception;
use Php\File;
use Php\JSON;
use PhpBrasil\Telegram\Bot;
use PhpBrasil\Telegram\Match;

/**
 * Class LinkGet
 * @package App\Actions
 */
class LinkGet
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
        $parameters = $match->get('$parameters');
        $id = trim($parameters['id']);

        $message = $match->get('$message');
        $chatId = get($message, 'chat.id');

        $filename = APP_ROOT . "/storage/{$chatId}.json";
        $links = [];
        if (File::exists($filename)) {
            $text = File::read($filename);
            $links = (array)JSON::decode($text);
        }
        /** @noinspection PhpAssignmentInConditionInspection */
        if ($link = get($links, $id)) {
            /** @noinspection PhpVariableVariableInspection */
            return $bot->replyTo($link);
        }
        return $bot->replyTo("There is nothing with `{$id}`");
    }
}