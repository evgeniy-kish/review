<?php

namespace App\Models;

class Language
{
    /**
     * @var string
     */
    protected static string $default = 'ru';

    /**
     * @var string[]
     */
    protected static array $languages = [
        'ru',
        'en'
    ];

    /**
     * @var array
     */
    protected static array $translations = [
        'ru' => 'Русский',
        'en' => 'English',
    ];

    /**
     * @var array
     */
    public static array $fake_translations = [
        'ru' => 'Русский',
        'en' => 'English',
        'de' => 'Deutsch',
        'es' => 'Español',
        'fr' => 'Français',
        'pt' => 'Portu',
        'it' => 'Italiano'
    ];

    /**
     * @param string|null $name
     *
     * @return bool
     */
    public static function exists(?string $name): bool
    {
        return in_array($name, static::$languages, true);
    }

    /**
     * @param string|null $name
     *
     * @return string
     */
    public static function resolve(?string $name): string
    {
        return static::exists($name) ? $name : static::$default;
    }

    /**
     * @return string[]
     */
    public static function list(): array
    {
        return static::$translations;
    }

    /**
     * @param string $lang
     *
     * @return string
     */
    public static function getIcon(string $lang): string
    {
        return "/img/flags/{$lang}.png";
    }

    /**
     * @return string
     */
    public static function getFakeLocale(): string
    {
        return isset(static::$fake_translations[$lang = request()?->cookie('lang')]) ? $lang : static::$default;
    }
}
