<?php

namespace Zelenin\Ddd\String\Infrastructure\Service;

use Zelenin\Ddd\String\Domain\Model\TransformerCollection;

class Transformer implements \Zelenin\Ddd\String\Domain\Service\Transformer
{
    /**
     * @var TransformerCollection
     */
    private $collection;

    /**
     * @param TransformerCollection $collection
     */
    public function __construct(TransformerCollection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public function transform($string)
    {
        foreach ($this->collection->getTransformers() as $transformer) {
            $string = $transformer->transform($string);
        }
        return $string;
    }
}
