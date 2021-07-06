<?php

declare (strict_types=1);
namespace MonorepoBuilder20210706;

use MonorepoBuilder20210706\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (\MonorepoBuilder20210706\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->defaults()->public()->autowire()->autoconfigure();
    $services->load('MonorepoBuilder20210706\Symplify\MonorepoBuilder\\', __DIR__ . '/../packages')->exclude([
        // register manually
        __DIR__ . '/../packages/Release/ReleaseWorker',
    ]);
};
