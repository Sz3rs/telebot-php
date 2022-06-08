<?php

class ReplyKeyboardMarkup
{

    public array $markup;

    function __construct($resize_keyboard = true, $one_time_keyboard = true)
    {
        $this->markup = [
            'keyboard' => [],
            'resize_keyboard' => $resize_keyboard,
            'one_time_keyboard' => $one_time_keyboard
        ];
    }

    function __toString(): string
    {
        return json_encode($this->markup);
    }

    function add()
    {
        $elements = func_get_args();
        array_push($this->markup['keyboard'], $elements);
    }

}

class InlineKeyboardMarkup
{
    public array $markup;

    function __construct()
    {
        $this->markup = [
            'inline_keyboard' => []
        ];
    }

    function __toString(): string
    {
        return json_encode($this->markup);
    }

    function add()
    {
        $arguments = func_get_args();
        $elements = [];
        foreach ($arguments as $element => $value) {
            array_push($elements, $value->button);
        }
        array_push($this->markup['inline_keyboard'], $elements);
    }
}

class InlineKeyboardButton
{
    public array $button;

    function __construct($text, $callback_data = '', $url = '')
    {
        $this->button = ['text' => $text, 'callback_data' => $callback_data, 'url' => $url];
    }

}

class InlineQueryResultArticle
{
    public array $element;
    public string $type;

    function __construct($id, $title, $message_text, $description = '')
    {
        $this->type = 'article';
        $this->element = [
            'type' => $this->type,
            'id' => $id,
            'title' => $title,
            'message_text' => $message_text,
            'description' => $description
        ];
    }

    function __toString(): string
    {
        return json_encode($this->element);
    }

}

class InlineQueryResultAudio
{
    public array $element;
    public string $type;

    function __construct($id, $title, $audio_url)
    {
        $this->type = 'audio';
        $this->element = [
            'type' => $this->type,
            'id' => $id,
            'title' => $title,
            'audio_url' => $audio_url,
        ];
    }

    function __toString(): string
    {
        return json_encode($this->element);
    }
}

class InlineQueryResultGame
{
    public array $element;
    public string $type;

    function __construct($id, $game_short_name)
    {
        $this->type = 'game';
        $this->element = [
            'type' => $this->type,
            'id' => $id,
            'game_short_name' => $game_short_name,
        ];
    }

    function __toString(): string
    {
        return json_encode($this->element);
    }
}



