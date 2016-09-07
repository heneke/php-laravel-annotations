<?php

$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->in('src/')->in('test/');

return Symfony\CS\Config\Config::create()
    ->fixers(['psr0', 'psr1', 'psr2'])
    ->finder($finder);