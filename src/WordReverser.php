<?php

declare(strict_types=1);

namespace App;

class WordReverser
{
    /**
     * @param string $word
     *
     * @return string
     */
    public static function reverseWordPreserveCase(string $word): string
    {
        if ($word === '') {
            return '';
        }

        $characters = preg_split('//u', $word, -1, PREG_SPLIT_NO_EMPTY);
        $length = count($characters);

        $isUpperCaseMap = [];
        foreach ($characters as $char) {
            $upper = mb_strtoupper($char, 'UTF-8');
            $lower = mb_strtolower($char, 'UTF-8');
            $isUpperCaseMap[] = ($upper === $char && $lower !== $char);
        }

        $lowercasedChars = array_map(fn(string $char): string => mb_strtolower($char, 'UTF-8'), $characters);
        $reversedChars = array_reverse($lowercasedChars);

        $resultChars = [];
        for ($i = 0; $i < $length; $i++) {
            $resultChars[] = $isUpperCaseMap[$i]
                ? mb_strtoupper($reversedChars[$i], 'UTF-8')
                : $reversedChars[$i];
        }

        return implode('', $resultChars);
    }

    /**
     * @param string $text
     *
     * @return string
     */
    public static function reverseWordsInString(string $text): string
    {
        $parts = preg_split('/([^\p{L}]+)/u', $text, -1, PREG_SPLIT_DELIM_CAPTURE);

        $processedParts = array_map(
            function (string $part): string {
                return preg_match('/^\p{L}+$/u', $part)
                    ? self::reverseWordPreserveCase($part)
                    : $part;
            },
            $parts
        );

        return implode('', $processedParts);
    }
}
