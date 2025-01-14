<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Messenger\Stamp;

use Symfony\Component\Validator\Constraints\GroupSequence;

/**
 * @author Maxime Steinhausser <maxime.steinhausser@gmail.com>
 */
final class ValidationStamp implements StampInterface
{
    /**
     * @var mixed[]|\Symfony\Component\Validator\Constraints\GroupSequence
     */
    private $groups;

    /**
     * @param mixed[]|\Symfony\Component\Validator\Constraints\GroupSequence $groups
     */
    public function __construct($groups)
    {
        $this->groups = $groups;
    }

    /**
     * @return mixed[]|\Symfony\Component\Validator\Constraints\GroupSequence
     */
    public function getGroups()
    {
        return $this->groups;
    }
}
