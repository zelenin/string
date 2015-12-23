<?php

namespace Zelenin\Ddd\String\Domain\Model;

use InvalidArgumentException;
use Zelenin\Ddd\String\Domain\Service\Transformer;

class TransformerCollection
{
    /**
     * @var Transformer[]
     */
    private $transformers;

    /**
     * @param Transformer[] $transformers
     */
    public function __construct(array $transformers)
    {
        foreach ($transformers as $transformer) {
            if (!$transformer instanceof Transformer) {
                throw new InvalidArgumentException(sprintf('%s is not instance of %s.', '$transformer', 'Transformer'));
            }
        }
        $this->transformers = $transformers;
    }

    /**
     * @return Transformer[]
     */
    public function getTransformers()
    {
        return $this->transformers;
    }
}
