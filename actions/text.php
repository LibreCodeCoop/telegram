<?php

use App\Actions\Help;
use App\Actions\LinkAdd;
use App\Actions\LinkGet;
use App\Actions\LinkList;
use App\Actions\LinkRemove;
use App\Actions\Start;
use PhpBrasil\Telegram\Bot;
use PhpBrasil\Telegram\Match;

/**
 * @param Bot $bot
 */
return function (Bot $bot) {
    // start command
    $bot->text('/start(.*?)', Start::class);
    // start command
    $bot->text('/help(.*?)', Help::class);

    $bot->text('/link(.*?) add (?<link>.*) as (?<id>.*)', LinkAdd::class);
    $bot->text('/link(.*?) add (?<link>.*)', LinkAdd::class);
    $bot->text('/link(.*?) get (?<id>.*)', LinkGet::class);
    $bot->text('/link(.*?) rm (?<id>.*)', LinkRemove::class);
    $bot->text('/link_rm_(?<id>.*)@(.*?)', LinkRemove::class);
    $bot->text('/link_rm_(?<id>.*)', LinkRemove::class);
    $bot->text('/link(.*?) ls', LinkList::class);
    $bot->text('/link(.*?)', LinkList::class);

    $bot->text('delete:(?<message>.*)', function ($bot, $match) {
        /** @var Match $match */
        $parameters = $match->get('$parameters');
        $message = get($parameters, 'message');
        /** @var Bot $bot */
        $bot->delete();
        return $bot->reply("The message `{$message}` was deleted");
    });

    // $bot->text('.*', OtherWise::class);
};
