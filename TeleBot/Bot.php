<?php

require_once 'TelegramRequests.php';

class Bot extends TelegramRequests
{
    public $botToken, $json_data;
    private $data;

    function __construct($token)
    {
        $this->botToken = $token;
        $this->json_data = file_get_contents('php://input');
        $this->data = json_decode($this->json_data);
        parent::__construct($this->botToken);
    }

    function handler($func)
    {
        $func($this->data);
        exit;
    }

    function command_handler(array $commands, $func)
    {
        if (isset($this->data->message->text) and $this->data->message->text[0] == '/') {
            $command = substr(explode(' ', $this->data->message->text)[0], 1);
            if (in_array($command, $commands)) {
                $func($this->data->message);
                exit;
            }
        }
    }

    function callback_query_handler($func)
    {
        if (isset($this->data->callback_query)) {
            $func($this->data->callback_query);
            exit;
        }
    }

    function game_query_handler($func)
    {
        if (isset($this->data->callback_query->game_short_name)) {
            $func($this->data->callback_query);
            exit;
        }
    }

    function inline_query_handler($func)
    {
        if (isset($this->data->inline_query)) {
            $func($this->data->inline_query);
            exit;
        }
    }

    function message_handler($func)
    {
        if (isset($this->data->message->text)) {
            $func($this->data->message);
            exit;
        }
    }

    function dice_handler($func)
    {
        if (isset($this->data->message->dice) && empty($this->data->message->forward_date)) {
            $func($this->data->message);
            exit;
        }
    }

    function send_message($chat_id, $text, $reply_markup = null): bool|string
    {
        return $this->api_request('sendMessage', ['chat_id' => $chat_id, 'text' => $text, 'parse_mode' => 'HTML', 'reply_markup' => $reply_markup]);
    }

    function send_dice($chat_id, string $emoji)
    {
        $data = $this->api_request('sendDice', ['chat_id' => $chat_id, 'emoji' => $emoji]);
        return json_decode($data, true)['result']['dice']['value'];
    }

    function send_chat_action($chat_id, string $action): bool|string
    {
        return $this->api_request('sendChatAction', ['chat_id' => $chat_id, 'action' => $action]);
    }

    function edit_message_text($chat_id, $message_id, $text, $reply_markup = null): bool|string
    {
        return $this->api_request('editMessageText', ['chat_id' => $chat_id, 'message_id' => $message_id, 'text' => $text, 'parse_mode' => 'HTML', 'reply_markup' => $reply_markup]);
    }

    function answer_callback_query($callback_query_id, $text, $show_alert = false, $url = ''): bool|string
    {
        return $this->api_request('answerCallbackQuery', ['callback_query_id' => $callback_query_id, 'text' => $text, 'show_alert' => $show_alert, 'url' => $url]);
    }

    function answer_inline_query($id, $results): bool|string
    {
        return $this->api_request('answerInlineQuery', ['inline_query_id' => $id, 'results' => $results]);
    }

    function forward_message($chat_id, $from_id, $message_id): bool|string
    {
        return $this->api_request('forwardMessage', ['chat_id' => $chat_id, 'from_chat_id' => $from_id, 'message_id' => $message_id]);
    }

    function get_chat_member($chat_id, $user_id)
    {
        $data = $this->api_request('getChatMember', ['chat_id' => $chat_id, 'user_id' => $user_id]);
        return json_decode($data, true);
    }
}