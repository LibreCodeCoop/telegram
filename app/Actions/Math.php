<?php

namespace App\Actions;

use Exception;
use PhpBrasil\Telegram\Bot;
use PhpBrasil\Telegram\Match;

/**
 * Class Math
 * @package App\Actions
 */
class Math
{
    /**
     * The __invoke method is called when a script tries to call an object as a function.
     *
     * @param Bot $bot
     * @param Match $match
     * @return mixed
     * @throws Exception
     * @link http://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     */
    public function __invoke($bot, $match)
    {
        $parameters = $match->get('$parameters');
        if (!isset($parameters['a']) or !isset($parameters['b']) or !isset($parameters['o'])) {
            return $bot->reply('Can`t resolve this math');
        }

        $first = $parameters['a'];
        $second = $parameters['b'];
        $answer = function ($value) {
            return "That is easy, the answer is `{$value}`";
        };
        switch ($parameters['o']) {
            case '*':
                return $bot->replyTo($answer($first * $second));
            case '/':
                return $bot->replyTo($answer($first / $second));
            case '+':
                return $bot->replyTo($answer($first + $second));
            case '-':
                return $bot->replyTo($answer($first - $second));
        }
        return $bot->replyTo("What??");
    }
}
