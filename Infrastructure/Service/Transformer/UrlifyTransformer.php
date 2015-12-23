<?php

namespace Zelenin\Ddd\String\Infrastructure\Service\Transformer;

use Zelenin\Ddd\String\Domain\Service\Transformer;

class UrlifyTransformer implements Transformer
{
    /**
     * @var string
     */
    private $replacement;

    /**
     * @var bool
     */
    private $lowercase;

    /**
     * @param string $replacement
     * @param bool $lowercase
     */
    public function __construct($replacement = '-', $lowercase = true)
    {
        $this->replacement = $replacement;
        $this->lowercase = $lowercase;
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public function transform($string)
    {
        $string = preg_replace('/[^\p{L&}\p{Lo}\d]/u', $this->replacement, $string);
        $string = preg_replace('/[' . preg_quote($this->replacement) . ']+/u', $this->replacement, $string);
        $string = trim($string, $this->replacement);
        return $this->lowercase ? mb_strtolower($string) : $string;
    }
}
