<?php

namespace App\Enums;

enum SystemType: string
{
    case REGISTRATION = 'enable_registration';
    case SOCIAL_LOGINS = 'enable_social_logins';
    case FORGOTTEN_PASSWORD = 'enable_forgotten_password';
    case MULTIPLE_LANGUAGES = 'enable_multiple_languages';

    public function label(): string
    {
        return 'message.system.' . $this->value;
    }
}
