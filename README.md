<h1>Library for PHP telegram-bot development</h1>

```php

require_once 'TeleBot/Bot.php'
require_once 'TeleBot/Types.php'

$bot = new Bot('token')

$bot->command_handler(['start'], function ($msg) use ($bot) {
        $bot->send_message($msg->chat->id, 'Hello, world!');
});

$bot->message_handler(function ($msg) use ($bot) {
        $bot->send_message($msg->chat->id, $msg->text);
});

```
