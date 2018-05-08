<?php

namespace App\Actions;

use Exception;
use Php\File;
use Php\JSON;
use Php\Text;
use const PHP_EOL;
use PhpBrasil\Telegram\Bot;
use PhpBrasil\Telegram\Match;
use function uniqid;

/**
 * Class LinkAdd
 * @package App\Actions
 */
class LinkAdd
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
        $link = Text::replace(Text::trim($parameters['link']), '#', PHP_EOL);
        $message = $match->get('$message');
        $chatId = get($message, 'chat.id');
        $filename = APP_ROOT . "/storage/{$chatId}.json";
        $array = [];
        if (File::exists($filename)) {
            $text = File::read($filename);
            $array = (array)JSON::decode($text);
        }
        $id = get($parameters, 'id', uniqid());
        $array[$id] = $link;
        File::write($filename, JSON::encode($array));

        return $bot->replyTo("Done!");
    }
}