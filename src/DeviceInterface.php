<?php

declare(strict_types=1);

namespace Rasphpi;

use Rasphpi\Process\Process;

interface DeviceInterface
{
    public function open(): bool;
    public function close(): int;
    public function read(): mixed;
    public function write($value): bool;

    public function getProcess(): Process;
    public function getConfig(): array;
    public function setConfig(array $config);
}