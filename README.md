<h1>Library for PHP telegram-bot development</h1>

```php

require_once 'TeleBot/Bot.php'
require_once 'TeleBot/Types.php'

$bot = new Bot('token') // bot initialization 

$bot->command_handler(['start'], function ($msg) use ($bot) { // command start handler
        $keyboard = new InlineKeyboardMarkup()
        
        $button = new InlineKeyboardButton('Button Text', 'button_data')
        $keyboard->add($button)
        
        $bot->send_message($msg->chat->id, 'Hello, world!', $keyboard);
});

$bot->message_handler(function ($msg) use ($bot) { // any message handler
        $bot->send_message($msg->chat->id, $msg->text);
});

```
