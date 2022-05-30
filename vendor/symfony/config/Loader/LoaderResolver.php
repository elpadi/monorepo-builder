<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace MonorepoBuilder20220530\Symfony\Component\Config\Loader;

/**
 * LoaderResolver selects a loader for a given resource.
 *
 * A resource can be anything (e.g. a full path to a config file or a Closure).
 * Each loader determines whether it can load a resource and how.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class LoaderResolver implements \MonorepoBuilder20220530\Symfony\Component\Config\Loader\LoaderResolverInterface
{
    /**
     * @var LoaderInterface[] An array of LoaderInterface objects
     */
    private $loaders = [];
    /**
     * @param LoaderInterface[] $loaders An array of loaders
     */
    public function __construct(array $loaders = [])
    {
        foreach ($loaders as $loader) {
            $this->addLoader($loader);
        }
    }
    /**
     * {@inheritdoc}
     * @return \Symfony\Component\Config\Loader\LoaderInterface|true
     * @param mixed $resource
     */
    public function resolve($resource, string $type = null)
    {
        foreach ($this->loaders as $loader) {
            if ($loader->supports($resource, $type)) {
                return $loader;
            }
        }
        return \false;
    }
    public function addLoader(\MonorepoBuilder20220530\Symfony\Component\Config\Loader\LoaderInterface $loader)
    {
        $this->loaders[] = $loader;
        $loader->setResolver($this);
    }
    /**
     * Returns the registered loaders.
     *
     * @return LoaderInterface[]
     */
    public function getLoaders() : array
    {
        return $this->loaders;
    }
}
