<?php

declare(strict_types=1);

use Monorepo\MonorepoConfig;
use Monorepo\Release\ReleaseWorker\SetCurrentMutualDependenciesReleaseWorker;
use Monorepo\Release\ReleaseWorker\TagVersionReleaseWorker;
use Monorepo\Release\ReleaseWorker\PushTagReleaseWorker;
use Monorepo\Release\ReleaseWorker\PushSplitRepositoriesReleaseWorker;

return static function (MonorepoConfig $config): void {
    $config->packages([
        'packages/core',
        'packages/survey',
        'packages/aws_agent',
    ]);

    $config->defaultBranch('main');

    $config->packageDirectories([
        'packages/core'      => 'git@github.com:kyncore/kaizen-core.git',
        'packages/survey'    => 'git@github.com:kyncore/kaizen-survey.git',
        'packages/aws_agent' => 'git@github.com:kyncore/kaizen-aws-agent.git',
    ]);

    $config->releaseWorkers([
        SetCurrentMutualDependenciesReleaseWorker::class,
        TagVersionReleaseWorker::class,
        PushSplitRepositoriesReleaseWorker::class,
        PushTagReleaseWorker::class,
    ]);
};
