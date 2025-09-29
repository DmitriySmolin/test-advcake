<?php

namespace tests;

use App\WordReverser;
use PHPUnit\Framework\TestCase;


class WordReverserTest extends TestCase
{
    public function testReverseWordsInString()
    {
        $tests = [
            ['Cat', 'Tac'],
            ['Мышь', 'Ьшым'],
            ['houSe', 'esuOh'],
            ['домИК', 'кимОД'],
            ['elEpHant', 'tnAhPele'],

            ['cat,', 'tac,'],
            ['Зима:', 'Амиз:'],
            ["is 'cold' now", "si 'dloc' won"],
            ['это «Так» "просто"', 'отэ «Кат» "отсорп"'],

            ['third-part', 'driht-trap'],
            ['can`t', 'nac`t'],

            ['Hello, world!', 'Olleh, dlrow!'],
            ['I`m fine-thanks.', 'I`m enif-sknaht.'],
            ['', ''],
            ['   ', '   '],
            ['a b c', 'a b c'],
        ];

        foreach ($tests as [$input, $expected]) {
            $this->assertEquals(
                $expected,
                WordReverser::reverseWordsInString($input), "Failed on input: $input"
            );
        }
    }
}