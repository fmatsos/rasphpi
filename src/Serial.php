<?php

declare(strict_types=1);

namespace Rasphpi;

use Rasphpi\Process\PipeInterface;
use Rasphpi\Process\Process;
use Rasphpi\Exception\InterfaceNotOpenException;

final class Serial implements DeviceInterface {
    const DEFAULT_PATH = '/dev/ttyAMA0';
    const PARITY_NONE = 'none';

    private Process $process;
    
    public function __construct(
        public string $path = self::DEFAULT_PATH,
        public int $baudRate = 115200,
        public string $parity = self::PARITY_NONE,
        public int $charLength = 8,
        public int $startBitsLength = 1,
        public int $stopBitsLength = 1
    ) {}

    public function open(): bool
    {
        $this->process = new Process();

        return $this->process->open("stty -F $this->path");
    }

    /** @throws InterfaceNotOpenException */
    public function close(): int
    {
        $this->process->close();
    }

    public function getProcess(): Process
    {
        return $this->process;
    }

    /** @return PipeInterface[] */
    public function getPipes(): array
    {
        return $this->process->getPipes();
    }

    public function read(): mixed
    {
        // TODO: Implement read() method.
    }

    public function write($value): bool
    {
        // TODO: Implement write() method.
    }

    public function getConfig(): array
    {
        // TODO: Implement getConfig() method.
    }

    public function setConfig(array $config): void
    {
        // TODO: Implement setConfig() method.
    }
}