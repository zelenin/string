<?php

namespace Zelenin\Ddd\String\Infrastructure\Service\Transformer;

use InvalidArgumentException;
use Zelenin\Ddd\String\Domain\Service\Transformer;

class TemplateTransformer implements Transformer
{
    /**
     * @var string
     */
    private $template;

    /**
     * @var array
     */
    private $params;

    /**
     * @param string $template
     * @param array $params
     */
    public function __construct($template = '{slug}', $params = [])
    {
        if (!$template) {
            throw new InvalidArgumentException('Empty template.');
        }
        $this->template = $template;
        $this->params = $this->normalizeParams($params);
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public function transform($string)
    {
        return strtr($this->template, $this->params + ['{slug}' => $string]);
    }

    /**
     * @param array $params
     *
     * @return array
     */
    private function normalizeParams($params)
    {
        $keys = array_keys($params);
        $values = array_values($params);

        $keys = array_map(function ($key) {
            return '{' . trim($key, '{}') . '}';
        }, $keys);

        $normalizedParams = array_combine($keys, $values);

        if (count($normalizedParams) !== count($params)) {
            throw new InvalidArgumentException('Identical params.');
        }

        return $normalizedParams;
    }
}
