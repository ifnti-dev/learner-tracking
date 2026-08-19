<?php

namespace App\Http\Requests;

enum TypeMessage
{
    case SUCCESS;
    case INFO;
    case ERROR;
}

class Message
{

    public TypeMessage $type;
    public String $content;
    /**
     * Create a new class instance.
     */
    public function __construct(TypeMessage $_type, String $_content)
    {
        $this->type = $_type;
        $this->content = $_content;
    }

    public function toMap(): array
    {
        return [
            $this->type->name => $this->content,
        ];
    }

    public static function success(String $content): Message
    {
        return new Message(TypeMessage::SUCCESS, $content);
    }
    public static function info(String $content): Message
    {
        return new Message(TypeMessage::INFO, $content);
    }
    public static function error(String $content): Message
    {
        return new Message(TypeMessage::ERROR, $content);
    }
}
