<?php

declare (strict_types=1);
/*
 * This file is part of PharIo\Version.
 *
 * (c) Arne Blankerts <arne@blankerts.de>, Sebastian Heuer <sebastian@phpeople.de>, Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace MonorepoBuilder20210706\PharIo\Version;

abstract class AbstractVersionConstraint implements \MonorepoBuilder20210706\PharIo\Version\VersionConstraint
{
    /** @var string */
    private $originalValue;
    public function __construct(string $originalValue)
    {
        $this->originalValue = $originalValue;
    }
    public function asString() : string
    {
        return $this->originalValue;
    }
}
