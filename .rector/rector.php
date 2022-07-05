<?php

declare(strict_types = 1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\DowngradeLevelSetList;

return static function (RectorConfig $rectorConfig): void {
	$rectorConfig->paths([
		__DIR__ . '/..',
	]);

	$rectorConfig->skip([
		__DIR__ . '/../.github',
		__DIR__ . '/../.rector',
		__DIR__ . '/../vendor',
	]);

	$rectorConfig->sets([
		DowngradeLevelSetList::DOWN_TO_PHP_74,
	]);
};