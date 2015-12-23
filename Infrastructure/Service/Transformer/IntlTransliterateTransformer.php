<?php

namespace Zelenin\Ddd\String\Infrastructure\Service\Transformer;

use InvalidArgumentException;
use RuntimeException;
use Transliterator;
use UnexpectedValueException;
use Zelenin\Ddd\String\Domain\Service\Transformer;

class IntlTransliterateTransformer implements Transformer
{
    /**
     * @link http://userguide.icu-project.org/transforms/general
     *
     * @var string
     */
    private $transliterateOptions;

    /**
     * @var Transliterator
     */
    private $transliterator;

    /**
     * @param string $transliterateOptions
     */
    public function __construct($transliterateOptions = 'Any-Latin; Latin-ASCII; NFD; [:Nonspacing Mark:] Remove; NFKC;'
    ) {
        if (extension_loaded('intl') === false) {
            throw new RuntimeException('Intl extension not loaded.');
        }

        if (is_string($transliterateOptions) && $transliterateOptions) {
            $this->transliterateOptions = $transliterateOptions;
        } else {
            throw new InvalidArgumentException('Invalid $transliterateOptions.');
        }

        $transliterator = Transliterator::create($this->transliterateOptions);
        if (!$transliterator instanceof Transliterator) {
            throw new InvalidArgumentException(sprintf('%s is not instance of %s.', '$transliterator', 'Transliterator'));
        }
        $this->transliterator = $transliterator;
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public function transform($string)
    {
        $string = $this->transliterator->transliterate($string);
        if ($string === false) {
            throw new UnexpectedValueException($this->transliterator->getErrorMessage(), $this->transliterator->getErrorCode());
        }
        return $string;
    }
}
