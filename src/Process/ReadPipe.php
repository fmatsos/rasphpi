<?php

declare(strict_types=1);

namespace Rasphpi\Process;

class ReadPipe implements PipeInterface
{
    const DESCRIPTOR = ['pipe', 'r'];

    /** @var resource|null */
    private $resource;

    public function __construct($resource)
    {
        $this->resource = $resource;
    }

    public function close(): bool
    {
        return fclose($this->resource);
    }
}