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

class GreaterThanOrEqualToVersionConstraint extends \MonorepoBuilder20210706\PharIo\Version\AbstractVersionConstraint
{
    /** @var Version */
    private $minimalVersion;
    public function __construct(string $originalValue, \MonorepoBuilder20210706\PharIo\Version\Version $minimalVersion)
    {
        parent::__construct($originalValue);
        $this->minimalVersion = $minimalVersion;
    }
    public function complies(\MonorepoBuilder20210706\PharIo\Version\Version $version) : bool
    {
        return $version->getVersionString() === $this->minimalVersion->getVersionString() || $version->isGreaterThan($this->minimalVersion);
    }
}
