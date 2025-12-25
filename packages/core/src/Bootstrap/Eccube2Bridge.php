<?php

namespace Kaizen\Core\Bootstrap;

class Eccube2Bridge
{
    public static function init(): void
    {
        $eccubePath = realpath(__DIR__ . '/../../../../eccube2');

        if (!defined('ECCUBE2_ROOT')) {
            define('ECCUBE2_ROOT', $eccubePath);
        }

        require_once ECCUBE2_ROOT . '/require.php'; // Loads all SC_* classes
    }
}
