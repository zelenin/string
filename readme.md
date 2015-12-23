# String

String transformers collection.

Library uses transformer concept. You may write new transformer implementing ```\Zelenin\Ddd\String\Domain\Service\Transformer``` interface.
Built-in transformers:
- ```RawTransformer``` uses a string as is
- ```IntlNormalizeTransformer``` normalizes a string (uses php-intl)
- ```IntlTransliterator``` transliterates a string (uses php-intl)
- ```UrlifyTransformer``` cleans a string for friendly url (slugifier)
- ```TemplateTransformer``` transforms a string according a template

## Installation

### Composer

The preferred way to install this extension is through [Composer](http://getcomposer.org/).

Either run

```
php composer.phar require zelenin/string "~0.0.0"
```

or add

```
"zelenin/string": "~0.0.0"
```

to the require section of your ```composer.json```

## Usage

```php
$string = 'Jeanne Françoise Julie Adélaïde Récamier';
$transformers = [
	new IntlNormalizeTransformer(),
	new IntlTransliterateTransformer(),
	new UrlifyTransformer(),
	new TemplateTransformer('{id}-{slug}', ['{id}' => $model->id])
];
$transformer = new Transformer($transformers);
$slug = $transformer->transform($string); // '12-jeanne-francoise-julie-adelaide-recamier'
```

You may set some options:

```php
$string = 'Jeanne Françoise Julie Adélaïde Récamier';
$transformers = [
	new IntlNormalizeTransformer(Normalizer::FORM_D),
	new IntlTransliterateTransformer('Russian-Latin/BGN; Any-Latin; Latin-ASCII; NFD; [:Nonspacing Mark:] Remove; NFKC;'),
	new UrlifyTransformer('_', false),
	new TemplateTransformer('{id}-{slug}', ['{id}' => $model->id])
];
$transformer = new Transformer($transformers);
$slug = $transformer->transform($string);
```

## Author

[Aleksandr Zelenin](https://github.com/zelenin/), e-mail: [aleksandr@zelenin.me](mailto:aleksandr@zelenin.me)
