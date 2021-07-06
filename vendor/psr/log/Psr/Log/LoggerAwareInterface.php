<?php

namespace MonorepoBuilder20210706\Psr\Log;

/**
 * Describes a logger-aware instance.
 */
interface LoggerAwareInterface
{
    /**
     * Sets a logger instance on the object.
     *
     * @param LoggerInterface $logger
     *
     * @return void
     */
    public function setLogger(\MonorepoBuilder20210706\Psr\Log\LoggerInterface $logger);
}
