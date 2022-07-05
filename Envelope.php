<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Messenger;

use Symfony\Component\Messenger\Stamp\StampInterface;

/**
 * A message wrapped in an envelope with stamps (configurations, markers, ...).
 *
 * @author Maxime Steinhausser <maxime.steinhausser@gmail.com>
 */
final class Envelope
{
    /**
     * @var array<string, list<StampInterface>>
     */
    private array $stamps = [];
    private object $message;

    /**
     * @param object|Envelope  $message
     * @param StampInterface[] $stamps
     */
    public function __construct(object $message, array $stamps = [])
    {
        $this->message = $message;

        foreach ($stamps as $stamp) {
            $this->stamps[\get_class($stamp)][] = $stamp;
        }
    }

    /**
     * Makes sure the message is in an Envelope and adds the given stamps.
     *
     * @param StampInterface[] $stamps
     */
    public static function wrap(object $message, array $stamps = []): self
    {
        $envelope = $message instanceof self ? $message : new self($message);

        return $envelope->with(...$stamps);
    }

    /**
     * Adds one or more stamps.
     * @return $this
     */
    public function with(StampInterface ...$stamps)
    {
        $cloned = clone $this;

        foreach ($stamps as $stamp) {
            $cloned->stamps[\get_class($stamp)][] = $stamp;
        }

        return $cloned;
    }

    /**
     * Removes all stamps of the given class.
     * @return $this
     */
    public function withoutAll(string $stampFqcn)
    {
        $cloned = clone $this;

        unset($cloned->stamps[$stampFqcn]);

        return $cloned;
    }

    /**
     * Removes all stamps that implement the given type.
     */
    public function withoutStampsOfType(string $type): self
    {
        $cloned = clone $this;

        foreach ($cloned->stamps as $class => $stamps) {
            if ($class === $type || is_subclass_of($class, $type)) {
                unset($cloned->stamps[$class]);
            }
        }

        return $cloned;
    }

    /**
     * @template TStamp of StampInterface
     *
     * @param class-string<TStamp> $stampFqcn
     *
     * @return TStamp|null
     */
    public function last(string $stampFqcn): ?StampInterface
    {
        return isset($this->stamps[$stampFqcn]) ? end($this->stamps[$stampFqcn]) : null;
    }

    /**
     * @return StampInterface[]|StampInterface[][] The stamps for the specified FQCN, or all stamps by their class name
     */
    public function all(string $stampFqcn = null): array
    {
        if (null !== $stampFqcn) {
            return $this->stamps[$stampFqcn] ?? [];
        }

        return $this->stamps;
    }

    public function getMessage(): object
    {
        return $this->message;
    }
}
