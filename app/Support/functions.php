<?php

if (!function_exists('parseRating')) {
    /**
     * Парсит рейтинг переданный в REQUEST
     *
     * @param ?string $string
     *
     * @return array|null
     */
    function parseRating(?string $string = null)
    {
        try {
            $array = json_decode((string)$string, false, 512, JSON_THROW_ON_ERROR);

            if (!is_array($array) || !array_is_list($array)) {
                throw new InvalidArgumentException();
            }

            $rating = array_filter($array, static fn($v) => (int)$v <= 5 && (int)$v > 0);

            if (empty($rating)) {
                throw new InvalidArgumentException();
            }

            return array_unique($rating);
        } catch (JsonException|InvalidArgumentException) {
            return null;
        }
    }
}

if (!function_exists('_br')) {
    /**
     * Все переносы строк в <br>
     * Замена функции nl2br, т.к. она не заменяет переносы, а просто добавляет <br />
     *
     * @param ?string $string
     *
     * @return string
     */
    function _br(?string $string): string
    {
        return str_replace(["\r\n", "\r", "\n"], '<br>', (string)$string);
    }
}

if (!function_exists('time_to_read')) {
    /**
     * Время на прочтение текста
     *
     * @param string $string
     *
     * @return int
     */
    function time_to_read(string $string): int
    {
        $string = preg_replace('/[^A-zА-яё\d]/ui', '', strip_tags($string));
        $count = mb_strlen($string);

        return (int)ceil($count / 1500);
    }
}

if (!function_exists('punycode_decode')) {
    /**
     * Декодирует punycode(IDN ASCII)
     *
     * @param string $link
     *
     * @return bool|string
     */
    function punycode_decode(string $link): bool|string
    {
        if(str_contains($link, 'xn--')) {

            $link_parse = parse_url($link);

            $link_host_decode = idn_to_utf8($link_parse['host'] ?? '');

            return (!empty($link_parse['scheme']) ? $link_parse['scheme'] . '://' : '') . $link_host_decode . ($link_parse['path'] ?? '');
        }
        return false;
    }
}
