<?php
declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\MonorepoBuilder\Release\ReleaseWorker\PushSplitRepositoriesReleaseWorker;
use Symplify\MonorepoBuilder\Release\ReleaseWorker\PushTagReleaseWorker;
use Symplify\MonorepoBuilder\Release\ReleaseWorker\SetCurrentMutualDependenciesReleaseWorker;
use Symplify\MonorepoBuilder\Release\ReleaseWorker\TagVersionReleaseWorker;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();
    $services = $containerConfigurator->services();

    $parameters->set('package_directories', [
        __DIR__ . '/packages/core',
        __DIR__ . '/packages/survey',
        __DIR__ . '/packages/aws_agent',
    ]);

    $parameters->set('directory_to_repository', [
        __DIR__ . '/packages/core'      => 'git@github.com:kyncore/kaizen-core.git',
        __DIR__ . '/packages/survey'    => 'git@github.com:kyncore/kaizen-survey.git',
        __DIR__ . '/packages/aws_agent' => 'git@github.com:kyncore/kaizen-aws-agent.git',
    ]);

    $services->set(SetCurrentMutualDependenciesReleaseWorker::class);
    $services->set(TagVersionReleaseWorker::class);
    $services->set(PushSplitRepositoriesReleaseWorker::class);
    $services->set(PushTagReleaseWorker::class);
};
