<?php

namespace App\Enum;

use Symfony\Contracts\Translation\TranslatableInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

enum GenderEnum: string implements TranslatableInterface
{
    case Man = 'man';
    case Woman = 'woman';

    public function trans(TranslatorInterface $translator, string $locale = null): string
    {
        return $translator->trans('gender.'.$this->value, locale: $locale);
    }
}
