<?php

namespace compressor\minifiers;

use compressor\minifiers\JsMinifier;

/**
 * Minifying js using php script.
 * 
 * @author Lajos Molnár <lajax.m@gmail.com>
 * @since 1.0
 */
class PhpJsMinifier extends \yii\base\BaseObject implements MinifierInterface
{

    /**
     *
     * @var array jShrink lib configuration.
     */
    public $options = [
        'flaggedComments' => true       // Disable YUI style comment preservation.
    ];
    
    /**
     * @inheritdoc
     */
    public function minify($path)
    {
        return JsMinifier::minify(file_get_contents($path), $this->options);
    }

}
