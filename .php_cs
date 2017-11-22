<?php
$header = <<<EOF
Copyright (c) 2017 Salah Alkhwlani <yemenifree@yandex.com>

For the full copyright and license information, please view
the LICENSE file that was distributed with this source code.
EOF;

$config = new Refinery29\CS\Config\Php56($header);
$config->getFinder()
    ->exclude('bootstrap')
    ->exclude('storage')
    ->exclude('vendor')
    ->name('*.php')
    ->notName('*.blade.php')
    ->notName('_ide_helper.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true)
    ->notName('plugin.php')->in(__DIR__);

$cacheDir = getenv('TRAVIS') ? getenv('HOME') . '/.php-cs-fixer' : __DIR__;

$config->setCacheFile($cacheDir . '/.php_cs.cache');

return $config;