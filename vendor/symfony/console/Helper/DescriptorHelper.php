<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace MonorepoBuilder20210822\Symfony\Component\Console\Helper;

use MonorepoBuilder20210822\Symfony\Component\Console\Descriptor\DescriptorInterface;
use MonorepoBuilder20210822\Symfony\Component\Console\Descriptor\JsonDescriptor;
use MonorepoBuilder20210822\Symfony\Component\Console\Descriptor\MarkdownDescriptor;
use MonorepoBuilder20210822\Symfony\Component\Console\Descriptor\TextDescriptor;
use MonorepoBuilder20210822\Symfony\Component\Console\Descriptor\XmlDescriptor;
use MonorepoBuilder20210822\Symfony\Component\Console\Exception\InvalidArgumentException;
use MonorepoBuilder20210822\Symfony\Component\Console\Output\OutputInterface;
/**
 * This class adds helper method to describe objects in various formats.
 *
 * @author Jean-François Simon <contact@jfsimon.fr>
 */
class DescriptorHelper extends \MonorepoBuilder20210822\Symfony\Component\Console\Helper\Helper
{
    /**
     * @var DescriptorInterface[]
     */
    private $descriptors = [];
    public function __construct()
    {
        $this->register('txt', new \MonorepoBuilder20210822\Symfony\Component\Console\Descriptor\TextDescriptor())->register('xml', new \MonorepoBuilder20210822\Symfony\Component\Console\Descriptor\XmlDescriptor())->register('json', new \MonorepoBuilder20210822\Symfony\Component\Console\Descriptor\JsonDescriptor())->register('md', new \MonorepoBuilder20210822\Symfony\Component\Console\Descriptor\MarkdownDescriptor());
    }
    /**
     * Describes an object if supported.
     *
     * Available options are:
     * * format: string, the output format name
     * * raw_text: boolean, sets output type as raw
     *
     * @throws InvalidArgumentException when the given format is not supported
     * @param object|null $object
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @param mixed[] $options
     */
    public function describe($output, $object, $options = [])
    {
        $options = \array_merge(['raw_text' => \false, 'format' => 'txt'], $options);
        if (!isset($this->descriptors[$options['format']])) {
            throw new \MonorepoBuilder20210822\Symfony\Component\Console\Exception\InvalidArgumentException(\sprintf('Unsupported format "%s".', $options['format']));
        }
        $descriptor = $this->descriptors[$options['format']];
        $descriptor->describe($output, $object, $options);
    }
    /**
     * Registers a descriptor.
     *
     * @return $this
     * @param string $format
     * @param \Symfony\Component\Console\Descriptor\DescriptorInterface $descriptor
     */
    public function register($format, $descriptor)
    {
        $this->descriptors[$format] = $descriptor;
        return $this;
    }
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'descriptor';
    }
}
