<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace MonorepoBuilderPrefix202308\Symfony\Component\Process;

use MonorepoBuilderPrefix202308\Symfony\Component\Process\Exception\RuntimeException;
/**
 * Provides a way to continuously write to the input of a Process until the InputStream is closed.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 *
 * @implements \IteratorAggregate<int, string>
 */
class InputStream implements \IteratorAggregate
{
    /** @var callable|null */
    private $onEmpty;
    private $input = [];
    private $open = \true;
    /**
     * Sets a callback that is called when the write buffer becomes empty.
     *
     * @return void
     */
    public function onEmpty(callable $onEmpty = null)
    {
        $this->onEmpty = $onEmpty;
    }
    /**
    * Appends an input to the write buffer.
    *
     * @param mixed $input The input to append as scalar,
                                                              stream resource or \Traversable
    *
    * @return void
    */
    public function write($input)
    {
        if (null === $input) {
            return;
        }
        if ($this->isClosed()) {
            throw new RuntimeException(\sprintf('"%s" is closed.', static::class));
        }
        $this->input[] = ProcessUtils::validateInput(__METHOD__, $input);
    }
    /**
     * Closes the write buffer.
     *
     * @return void
     */
    public function close()
    {
        $this->open = \false;
    }
    /**
     * Tells whether the write buffer is closed or not.
     *
     * @return bool
     */
    public function isClosed()
    {
        return !$this->open;
    }
    public function getIterator() : \Traversable
    {
        $this->open = \true;
        while ($this->open || $this->input) {
            if (!$this->input) {
                (yield '');
                continue;
            }
            $current = \array_shift($this->input);
            if ($current instanceof \Iterator) {
                yield from $current;
            } else {
                (yield $current);
            }
            if (!$this->input && $this->open && null !== ($onEmpty = $this->onEmpty)) {
                $this->write($onEmpty($this));
            }
        }
    }
}
