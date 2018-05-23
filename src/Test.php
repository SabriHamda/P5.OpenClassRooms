<?php
namespace src;

/**
 *
 */
class Test implements \Twig_ExtensionInterface
{
    public function echoMe()
    {
        echo 'hello';
    }
}
