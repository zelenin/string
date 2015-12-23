<?php

namespace Zelenin\Ddd\String\Domain\Service;

interface Transformer
{
    /**
     * @param string $string
     *
     * @return string
     */
    public function transform($string);
}
