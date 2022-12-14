<?php

namespace App\Helper;

class NameConvert extends 
{
    protected $length = 2;
    protected $initials = 'JD';
    protected $keepCase = false;
    protected $allowSpecialCharacters = true;
    protected $name = 'John Doe';

    public function __construct()
    {
    }

    /**
     * Set the name used for generating initials.
     *
     * @param string $nameOrInitials
     *
     * @return Initials
     */
    public static function name($nameOrInitials)
    {
        $this->generate($nameOrInitials);

        return $this;
    }

    /**
     * Set if should keep lettercase on name.
     * Setting this to false (default) will uppercase the name.
     *
     * @param boolean $keepCase
     *
     * @return Initials
     */
    public function keepCase($keepCase = true)
    {
        $this->keepCase = $keepCase;

        return $this;
    }

    /**
     * Set if should allow (or remove) special characters.
     *
     * @param boolean $allowSpecialCharacters
     *
     * @return Initials
     */
    public function allowSpecialCharacters($allowSpecialCharacters = true)
    {
        $this->allowSpecialCharacters = $allowSpecialCharacters;

        return $this;
    }

    /**
     * Set the length of the generated initials.
     *
     * @param int $length
     *
     * @return Initials
     */
    public function length($length = 2)
    {
        $this->length = (int) $length;
        $this->initials = $this->generateInitials();

        return $this;
    }

    /**
     * Generate the initials.
     *
     * @param null|string $name
     *
     * @return string
     */
    public function generate($name = null)
    {
        if ($name !== null) {
            $this->name = $name;
            $this->initials = $this->generateInitials();
        }

        return (string) $this;
    }

    /**
     * Will return the generated initials.
     *
     * @return string
     */
    public function getInitials()
    {
        return $this->initials;
    }

    /**
     * Will return the generated initials,
     * without special characters.
     *
     * @return string
     */
    public function getUrlfriendlyInitials()
    {
        $urlFriendlyInitials = $this->convertToUrlFriendlyString($this->getInitials());

        $urlFriendlyInitials = mb_substr($urlFriendlyInitials, 0, $this->length);

        return $urlFriendlyInitials;
    }

    /**
     * Return the initials.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getInitials();
    }

    /**
     * Generate a two-letter initial from a name,
     * and if no name, assume its already initials.
     * For safety, we limit it to two characters,
     * in case its a single, but long, name.
     *
     * @return string
     */
    protected function generateInitials()
    {
        $nameOrInitials = trim($this->name);

        if (!$this->keepCase) {
            $nameOrInitials = mb_strtoupper($nameOrInitials);
        }

        if (!$this->allowSpecialCharacters) {
            $nameOrInitials = preg_replace('/[!@#$%^&*(),.?":{}|<>_]/', '', $nameOrInitials);
        }

        $nameOrInitials = trim(trim($nameOrInitials, '-'));

        $names = explode(' ', $nameOrInitials);

        // Get names with dash (-) between into separate names
        $names = array_map(static function ($namePart) {
            return explode('-', $namePart);
        }, $names);
        $realNames = [];

        foreach (new \RecursiveIteratorIterator(new \RecursiveArrayIterator($names)) as $namePart) {
            $realNames[] = $namePart;
        }

        $names = $realNames;

        $initials = $nameOrInitials;
        $assignedNames = 0;

        if (count($names) > 1) {
            $initials = '';
            $start = 0;

            for ($i = 0; $i < $this->length; $i++) {
                $index = $i;

                if (($index === ($this->length - 1) && $index > 0) || ($index > (count($names) - 1))) {
                    $index = count($names) - 1;
                }

                if ($assignedNames >= count($names)) {
                    $start++;
                }

                $initials .= mb_substr($names[$index], $start, 1);
                $assignedNames++;
            }
        }

        $initials = mb_substr($initials, 0, $this->length);

        return $initials;
    }

    /**
     * Converts specialcharacters to url-friendly characters.
     *
     * Copied from: https://github.com/laravel/framework/blob/5.4/src/Illuminate/Support/Str.php#L56
     *
     * @param $string
     *
     * @return string
     */
    protected function convertToUrlFriendlyString($string)
    {
        foreach (static::charsArray() as $key => $val) {
            $string = str_replace($val, mb_substr($key, 0, 1), $string);
        }

        return preg_replace('/[^\x20-\x7E]/u', '', $string);
    }

    /**
     * Returns the replacements for the ascii method.
     *
     * Note: Adapted from Stringy\Stringy.
     *
     * @see https://github.com/danielstjules/Stringy/blob/2.3.1/LICENSE.txt
     *
     * @return array
     */
    protected static function charsArray()
    {
        static $charsArray;

        if (isset($charsArray)) {
            return $charsArray;
        }

        return $charsArray = [
            '0'    => ['??', '???', '??'],
            '1'    => ['??', '???', '??'],
            '2'    => ['??', '???', '??'],
            '3'    => ['??', '???', '??'],
            '4'    => ['???', '???', '??', '??'],
            '5'    => ['???', '???', '??', '??'],
            '6'    => ['???', '???', '??', '??'],
            '7'    => ['???', '???', '??'],
            '8'    => ['???', '???', '??'],
            '9'    => ['???', '???', '??'],
            'a'    => [
                '??',
                '??',
                '???',
                '??',
                '???',
                '??',
                '???',
                '???',
                '???',
                '???',
                '???',
                '??',
                '???',
                '???',
                '???',
                '???',
                '???',
                '??',
                '??',
                '??',
                '??',
                '??',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '??',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '??',
                '??',
                '???',
                '???',
                '???',
                '??',
                '??',
                '??',
                '???',
                '???',
                '??',
            ],
            'b'    => ['??', '??', '??', '??', '??', '???', '???'],
            'c'    => ['??', '??', '??', '??', '??'],
            'd'    => ['??', '??', '??', '??', '??', '??', '??', '???', '???', '???', '??', '??', '??', '??', '???', '???', '???'],
            'e'    => [
                '??',
                '??',
                '???',
                '???',
                '???',
                '??',
                '???',
                '???',
                '???',
                '???',
                '???',
                '??',
                '??',
                '??',
                '??',
                '??',
                '??',
                '??',
                '??',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '??',
                '??',
                '??',
                '??',
                '??',
                '??',
                '???',
                '???',
                '???',
                '???',
                '???',
                '??',
                '??',
            ],
            'f'    => ['??', '??', '??', '??', '???'],
            'g'    => ['??', '??', '??', '??', '??', '??', '??', '???', '???', '??'],
            'h'    => ['??', '??', '??', '??', '??', '??', '???', '???', '???'],
            'i'    => [
                '??',
                '??',
                '???',
                '??',
                '???',
                '??',
                '??',
                '??',
                '??',
                '??',
                '??',
                '??',
                '??',
                '??',
                '??',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '??',
                '???',
                '???',
                '???',
                '??',
                '???',
                '???',
                '??',
                '??',
                '??',
                '???',
                '???',
                '???',
                '??????',
                '??',
                '???',
                '???',
            ],
            'j'    => ['??', '??', '??', '???', '??'],
            'k'    => ['??', '??', '??', '??', '??', '??', '??', '???', '???', '???', '??'],
            'l'    => ['??', '??', '??', '??', '??', '??', '??', '??', '???', '???'],
            'm'    => ['??', '??', '??', '???', '???'],
            'n'    => ['??', '??', '??', '??', '??', '??', '??', '??', '??', '???', '???'],
            'o'    => [
                '??',
                '??',
                '???',
                '??',
                '???',
                '??',
                '???',
                '???',
                '???',
                '???',
                '???',
                '??',
                '???',
                '???',
                '???',
                '???',
                '???',
                '??',
                '??',
                '??',
                '??',
                '??',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '??',
                '??',
                '??',
                '??',
                '??????',
                '??',
                '??',
                '??',
                '???',
                '???',
            ],
            'p'    => ['??', '??', '???', '???', '??'],
            'q'    => ['???'],
            'r'    => ['??', '??', '??', '??', '??', '??', '???'],
            's'    => ['??', '??', '??', '??', '??', '??', '??', '??', '??', '???', '??', '???'],
            't'    => ['??', '??', '??', '??', '??', '??', '??', '???', '???', '??', '???', '???'],
            'u'    => ['??', '??', '???', '??', '???', '??', '???', '???', '???', '???', '???', '??', '??', '??', '??', '??', '??', '??', '??', '???', '???', '???', '??', '??', '??', '??', '??', '???', '???'],
            'v'    => ['??', '???', '??'],
            'w'    => ['??', '??', '??', '???', '???'],
            'x'    => ['??', '??'],
            'y'    => ['??', '???', '???', '???', '???', '??', '??', '??', '??', '??', '??', '??', '??', '??', '???'],
            'z'    => ['??', '??', '??', '??', '??', '??', '???', '???'],
            'aa'   => ['??', '???', '??'],
            'ae'   => ['??', '??', '??'],
            'ai'   => ['???'],
            'at'   => ['@'],
            'ch'   => ['??', '???', '???', '??'],
            'dj'   => ['??', '??'],
            'dz'   => ['??', '???'],
            'ei'   => ['???'],
            'gh'   => ['??', '???'],
            'ii'   => ['???'],
            'ij'   => ['??'],
            'kh'   => ['??', '??', '???'],
            'lj'   => ['??'],
            'nj'   => ['??'],
            'oe'   => ['??', '??', '??'],
            'oi'   => ['???'],
            'oii'  => ['???'],
            'ps'   => ['??'],
            'sh'   => ['??', '???', '??'],
            'shch' => ['??'],
            'ss'   => ['??'],
            'sx'   => ['??'],
            'th'   => ['??', '??', '??', '??', '??'],
            'ts'   => ['??', '???', '???'],
            'ue'   => ['??'],
            'uu'   => ['???'],
            'ya'   => ['??'],
            'yu'   => ['??'],
            'zh'   => ['??', '???', '??'],
            '(c)'  => ['??'],
            'A'    => [
                '??',
                '??',
                '???',
                '??',
                '???',
                '??',
                '???',
                '???',
                '???',
                '???',
                '???',
                '??',
                '???',
                '???',
                '???',
                '???',
                '???',
                '??',
                '??',
                '??',
                '??',
                '??',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '??',
                '???',
                '??',
                '??',
                '??',
            ],
            'B'    => ['??', '??', '???'],
            'C'    => ['??', '??', '??', '??', '??'],
            'D'    => ['??', '??', '??', '??', '??', '??', '???', '???', '??', '??'],
            'E'    => [
                '??',
                '??',
                '???',
                '???',
                '???',
                '??',
                '???',
                '???',
                '???',
                '???',
                '???',
                '??',
                '??',
                '??',
                '??',
                '??',
                '??',
                '??',
                '??',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '??',
                '???',
                '??',
                '??',
                '??',
                '??',
                '??',
            ],
            'F'    => ['??', '??'],
            'G'    => ['??', '??', '??', '??', '??', '??'],
            'H'    => ['??', '??', '??'],
            'I'    => ['??', '??', '???', '??', '???', '??', '??', '??', '??', '??', '??', '??', '??', '??', '???', '???', '???', '???', '???', '???', '???', '???', '???', '???', '??', '??', '??', '??', '??', '??'],
            'K'    => ['??', '??'],
            'L'    => ['??', '??', '??', '??', '??', '??', '??', '???'],
            'M'    => ['??', '??'],
            'N'    => ['??', '??', '??', '??', '??', '??', '??'],
            'O'    => [
                '??',
                '??',
                '???',
                '??',
                '???',
                '??',
                '???',
                '???',
                '???',
                '???',
                '???',
                '??',
                '???',
                '???',
                '???',
                '???',
                '???',
                '??',
                '??',
                '??',
                '??',
                '??',
                '??',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '???',
                '??',
                '??',
                '??',
                '??',
                '??',
                '??',
            ],
            'P'    => ['??', '??'],
            'R'    => ['??', '??', '??', '??', '??'],
            'S'    => ['??', '??', '??', '??', '??', '??', '??'],
            'T'    => ['??', '??', '??', '??', '??', '??'],
            'U'    => ['??', '??', '???', '??', '???', '??', '???', '???', '???', '???', '???', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??'],
            'V'    => ['??'],
            'W'    => ['??', '??', '??'],
            'X'    => ['??', '??'],
            'Y'    => ['??', '???', '???', '???', '???', '??', '???', '???', '???', '??', '??', '??', '??', '??', '??'],
            'Z'    => ['??', '??', '??', '??', '??'],
            'AE'   => ['??', '??', '??'],
            'CH'   => ['??'],
            'DJ'   => ['??'],
            'DZ'   => ['??'],
            'GX'   => ['??'],
            'HX'   => ['??'],
            'IJ'   => ['??'],
            'JX'   => ['??'],
            'KH'   => ['??'],
            'LJ'   => ['??'],
            'NJ'   => ['??'],
            'OE'   => ['??', '??'],
            'PS'   => ['??'],
            'SH'   => ['??'],
            'SHCH' => ['??'],
            'SS'   => ['???'],
            'TH'   => ['??'],
            'TS'   => ['??'],
            'UE'   => ['??'],
            'YA'   => ['??'],
            'YU'   => ['??'],
            'ZH'   => ['??'],
            ' '    => [
                "\xC2\xA0",
                "\xE2\x80\x80",
                "\xE2\x80\x81",
                "\xE2\x80\x82",
                "\xE2\x80\x83",
                "\xE2\x80\x84",
                "\xE2\x80\x85",
                "\xE2\x80\x86",
                "\xE2\x80\x87",
                "\xE2\x80\x88",
                "\xE2\x80\x89",
                "\xE2\x80\x8A",
                "\xE2\x80\xAF",
                "\xE2\x81\x9F",
                "\xE3\x80\x80",
            ],
        ];
    }
}
