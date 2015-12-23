<?php

namespace Zelenin\Ddd\String\Infrastructure\Service\Transformer;

use Normalizer;
use RuntimeException;
use UnexpectedValueException;
use Zelenin\Ddd\String\Domain\Service\Transformer;

class IntlNormalizeTransformer implements Transformer
{
    /**
     * @var string
     */
    private $form;

    /**
     * @param string $form
     */
    public function __construct($form = Normalizer::FORM_C)
    {
        if (extension_loaded('intl') === false) {
            throw new RuntimeException('Intl extension not loaded.');
        }

        $this->form = $form;
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public function transform($string)
    {
        $string = Normalizer::normalize($string, $this->form);
        if ($string === null) {
            throw new UnexpectedValueException('Normalizer error.');
        }
        return $string;
    }
}
