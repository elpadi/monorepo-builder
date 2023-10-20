<?php

declare (strict_types=1);
namespace MonorepoBuilderPrefix202310;

use MonorepoBuilderPrefix202310\Symfony\Component\Console\Application;
use MonorepoBuilderPrefix202310\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use MonorepoBuilderPrefix202310\Symplify\EasyTesting\Command\ValidateFixtureSkipNamingCommand;
use function MonorepoBuilderPrefix202310\Symfony\Component\DependencyInjection\Loader\Configurator\service;
return static function (ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->defaults()->public()->autowire();
    $services->load('MonorepoBuilderPrefix202310\Symplify\EasyTesting\\', __DIR__ . '/../src')->exclude([__DIR__ . '/../src/DataProvider', __DIR__ . '/../src/Kernel', __DIR__ . '/../src/ValueObject']);
    // console
    $services->set(Application::class)->call('add', [service(ValidateFixtureSkipNamingCommand::class)]);
};
