<?php

declare(strict_types=1);

namespace Rasphpi\Process;

interface PipeInterface
{
    public function close() : bool;
}