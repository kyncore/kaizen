<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\MonorepoBuilder\Release\ReleaseWorker\PushSplitRepositoriesReleaseWorker;
use Symplify\MonorepoBuilder\Release\ReleaseWorker\PushTagReleaseWorker;
use Symplify\MonorepoBuilder\Release\ReleaseWorker\SetCurrentMutualDependenciesReleaseWorker;
use Symplify\MonorepoBuilder\Release\ReleaseWorker\TagVersionReleaseWorker;
use Symplify\MonorepoBuilder\ValueObject\Option;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();
    $services   = $containerConfigurator->services();

    // 1️⃣ Package directories
    $parameters->set(Option::PACKAGE_DIRECTORIES, [
        __DIR__ . '/packages/core',
        __DIR__ . '/packages/survey',
        __DIR__ . '/packages/aws_agent',
    ]);

    // 2️⃣ Split repositories mapping (IMPORTANT)
    $parameters->set(Option::DIRECTORY_TO_REPOSITORY, [
        __DIR__ . '/packages/core'      => 'git@github.com:kyncore/kaizen-core.git',
        __DIR__ . '/packages/survey'    => 'git@github.com:kyncore/kaizen-survey.git',
        __DIR__ . '/packages/aws_agent' => 'git@github.com:kyncore/kaizen-aws-agent.git',
    ]);

    // 3️⃣ Release workers (order matters)
    $services->set(SetCurrentMutualDependenciesReleaseWorker::class);
    $services->set(TagVersionReleaseWorker::class);
    $services->set(PushSplitRepositoriesReleaseWorker::class);
    $services->set(PushTagReleaseWorker::class);
};
