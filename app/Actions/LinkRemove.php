<?php

namespace App\Actions;

use Exception;
use Php\File;
use Php\JSON;
use PhpBrasil\Telegram\Bot;
use PhpBrasil\Telegram\Match;

/**
 * Class LinkRemove
 * @package App\Actions
 */
class LinkRemove
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
        if (is_numeric($id)) {
            $id = intval($id);
        }

        $message = $match->get('$message');
        $chatId = get($message, 'chat.id');
        $filename = APP_ROOT . "/storage/{$chatId}.json";
        $links = [];
        if (File::exists($filename)) {
            $text = File::read($filename);
            $links = JSON::decode($text);
        }

        if (get($links, $id)) {
            if (is_array($links)) {
                unset($links[$id]);
            }
            if (is_object($links)) {
                /** @noinspection PhpVariableVariableInspection */
                unset($links->$id);
            }
            File::write($filename, JSON::encode($links));
            /** @noinspection PhpVariableVariableInspection */
            return $bot->replyTo("Done!");
        }
        return $bot->replyTo("There is nothing with `{$id}`");
    }
}
