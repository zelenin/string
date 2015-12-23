<?php

namespace Zelenin\Ddd\String\Infrastructure\Service\Transformer;

use Zelenin\Ddd\String\Domain\Service\Transformer;

class RawTransformer implements Transformer
{
    /**
     * @param string $string
     *
     * @return string
     */
    public function transform($string)
    {
        return $string;
    }
}
