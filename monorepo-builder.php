<?php

declare(strict_types=1);

use Symplify\MonorepoBuilder\Config\MBConfig;
use Symplify\MonorepoBuilder\Release\ReleaseWorker\PushTagReleaseWorker;
use Symplify\MonorepoBuilder\Release\ReleaseWorker\PushSplitRepositoriesReleaseWorker;
use Symplify\MonorepoBuilder\Release\ReleaseWorker\SetCurrentMutualDependenciesReleaseWorker;

return static function (MBConfig $mbConfig): void {
    $mbConfig->workers([
        SetCurrentMutualDependenciesReleaseWorker::class,
        PushSplitRepositoriesReleaseWorker::class,
        PushTagReleaseWorker::class,
    ]);
};
