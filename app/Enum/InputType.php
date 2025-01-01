<?php

namespace App\Enum;

enum InputType: string
{
    case TEXT = 'text';
    case NUMBER = 'number';
    case EMAIL = 'email';
    case FILE = 'file';
    case DATE = 'date';
    case TIME = 'time';
    case DATETIME = 'datetime';
}
