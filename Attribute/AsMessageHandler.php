<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Messenger\Attribute;

/**
 * Service tag to autoconfigure message handlers.
 *
 * @author Alireza Mirsepassi <alirezamirsepassi@gmail.com>
 */
#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::TARGET_METHOD)]
class AsMessageHandler
{
    public ?string $bus = null;
    public ?string $fromTransport = null;
    public ?string $handles = null;
    public ?string $method = null;
    public int $priority = 0;
    public function __construct(?string $bus = null, ?string $fromTransport = null, ?string $handles = null, ?string $method = null, int $priority = 0)
    {
        $this->bus = $bus;
        $this->fromTransport = $fromTransport;
        $this->handles = $handles;
        $this->method = $method;
        $this->priority = $priority;
    }
}
