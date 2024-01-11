Yii2 Assets Compressor PHP 7 - 8
=================
Runtime minification and combination of asset files.

Installation
------------

Extension for runtime minification and combination of asset files (css, js)

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require --prefer-dist pavlovich-app/yii2-compressor "2.*"
```

or add

```
"pavlovich-app/yii2-compressor": "2.*"
```

to the require section of your `composer.json` file.


Usage
-----

##Config

###Minimal Configuration

```php
'bootstrap' => ['assetMinifier'],
'components' => [
    // ...
    'assetMinifier' => [
        'class' => \compressor\Component::className(),
    ],
    // ...
],
// ...
```

###Full Configuration

```php
'bootstrap' => ['assetMinifier'],
'components' => [
    // ...
    'assetMinifier' => [
        'class' => \compressor\Component::className(),
        'minifyJs' => true,                     // minify js files. [default]
        'minifyCss' => true,                    // minify css files [default]
        'combine' => true,                      // combine asset files. [default]
        'createGz' => false,                    // create compressed .gz file, (so the web server doesn’t need to
                                                // compress asset files on each page view). Requires
                                                // special web server configuration. [default]
                          
                                                
        //'minifier' => [                        // Settings of the components performing the minification of asset files
        //    'workPath' => compressor\Minifier::WORKPATH_SOURCE, // default setting
        //    'js' => '', // override default minifier, see available minifiers below
        //    'css' => '', // override default minifier, see available minifiers below
        //],
        
        'combiner' => [
            'class' => 'compressor\Combiner',
            'combinedFilesPath' => '/lajax-asset-minifier'      // default setting
        ]
    ],
    // ...
]
// ...
```

####AVAILABLE MINIFIERS:

* #WEB:

```php
'js' => [                           // minify js via web API
    'class' => 'compressor\minifiers\WebJsMinifier',
    'url' => 'http://javascript-inifier.com/raw'   // default setting
],
'css' => [
    'class' => 'compressor\minifiers\WebCssMinifier',
    'url' => 'http://cssminifier.com/raw'           // default setting
]
```

* #PHP (*Default minifiers*):

```php
'js' => [                                        // Default JS minifier.
    'class' => 'compressor\minifiers\PhpJsMinifier',
    // default settings, you can override them
    'options' => [
       'flaggedComments' => true                // Disable YUI style comment preservation.
    ]
],
'css' => [                                       // Default CSS minifier.
    'class' => 'compressor\minifiers\PhpCssMinifier',
    // default settings, you can override them
    'filters' => [
        'ImportImports' => false,
        'RemoveComments' => true,
        'RemoveEmptyRulesets' => true,
        'RemoveEmptyAtBlocks' => true,
        'ConvertLevel3AtKeyframes' => false,
        'ConvertLevel3Properties' => false,
        'Variables' => true,
        'RemoveLastDelarationSemiColon' => true
    ],
    'plugins' => [
        'Variables' => true,
        'ConvertFontWeight' => true,
        'ConvertHslColors' => true,
        'ConvertRgbColors' => true,
        'ConvertNamedColors' => true,
        'CompressColorValues' => true,
        'CompressExpressionValues' => true,
    ]
]
```

* #CLI:

```php
'js' => [
    'class' => 'compressor\minifiers\CliJsMinifier',
    // default settings, you can override them
    'command' => 'java -jar ' . Yii::getAlias('@vendor/packagist/closurecompiler-bin/bin/compiler.jar') . ' --js {from}',
],
'css' => [
    'class' => 'compressor\minifiers\CliCssMinifier',
    // default settings, you can override them
    'command' => 'java -jar ' . Yii::getAlias('@vendor/packagist/yuicompressor-bin/bin/yuicompressor.jar') . ' --type css {from}',
]
```


###Serving *.js.gz and *.css.gz files instead of *.js or *.css in Nginx:

```
gzip_static on | off | always
```

[Nginx gzip static module](http://nginx.org/en/docs/http/ngx_http_gzip_static_module.html)

Projects for example:
-----

- [Minfin PL](https://minfin.pl) - курс валют в Польщі
- [Говерла Курс](https://goverla.lutsk.ua) - курс валют Говерла

