<?php

/**
 * @file
 * Tests event dispatching.
 */
namespace MonorepoBuilder20220530\cweagans\Composer\Tests;

use MonorepoBuilder20220530\cweagans\Composer\PatchEvent;
use MonorepoBuilder20220530\cweagans\Composer\PatchEvents;
use MonorepoBuilder20220530\Composer\Package\PackageInterface;
class PatchEventTest extends \MonorepoBuilder20220530\PHPUnit_Framework_TestCase
{
    /**
     * Tests all the getters.
     *
     * @dataProvider patchEventDataProvider
     */
    public function testGetters($event_name, \MonorepoBuilder20220530\Composer\Package\PackageInterface $package, $url, $description)
    {
        $patch_event = new \MonorepoBuilder20220530\cweagans\Composer\PatchEvent($event_name, $package, $url, $description);
        $this->assertEquals($event_name, $patch_event->getName());
        $this->assertEquals($package, $patch_event->getPackage());
        $this->assertEquals($url, $patch_event->getUrl());
        $this->assertEquals($description, $patch_event->getDescription());
    }
    public function patchEventDataProvider()
    {
        $prophecy = $this->prophesize('MonorepoBuilder20220530\\Composer\\Package\\PackageInterface');
        $package = $prophecy->reveal();
        return array(array(\MonorepoBuilder20220530\cweagans\Composer\PatchEvents::PRE_PATCH_APPLY, $package, 'https://www.drupal.org', 'A test patch'), array(\MonorepoBuilder20220530\cweagans\Composer\PatchEvents::POST_PATCH_APPLY, $package, 'https://www.drupal.org', 'A test patch'));
    }
}
