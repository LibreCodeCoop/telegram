<?php

define('APP_ROOT', dirname(__DIR__));

require APP_ROOT . '/vendor/autoload.php';

use Php\File;
use Php\JSON;
use PhpBrasil\Telegram\Bot;

try {
    $input = File::read('php://input');
    $body = (array)JSON::decode($input, true);

    $telegram = new Bot(environment('APP_TOKEN'));

    if (environment('APP_DEBUG')) {
        $telegram->info(
            get($body, 'message.message_id'),
            $body
        );
    }

    if ($body) {
        $telegram
            ->actions(dirname(__DIR__) . '/actions/text.php')
            ->handleText($body);
    }

} catch (Throwable $e) {
    $message = "Error: {$e->getMessage()} on {$e->getFile()} in line {$e->getLine()}";
    if (isset($telegram) && $telegram instanceof Bot) {
        /** @noinspection PhpUnhandledExceptionInspection */
        $replied = $telegram->reply($message);
        if ($replied) {
            return;
        }
    }
    echo $message;
    http_response_code(500);
    error_log($e);
}