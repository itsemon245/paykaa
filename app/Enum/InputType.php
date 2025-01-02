<?php

namespace App\Enum;

enum InputType: string
{
    case TEXT = 'text';
    case FILE = 'file';
    case TEXTAREA = 'textarea';
}
