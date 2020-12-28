<?php

/*
 * This file is part of the Rasphpi project.
 *
 * (c) Franck Matsos <franck@matsos.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Rasphpi\Port\Serial;

use Rasphpi\Port\SerialInterface;
use Rasphpi\Process\Pipe\PipeInterface;
use Rasphpi\Process\Process;
use Rasphpi\Exception\PortNotOpenException;

final class Serial implements SerialInterface {
    public const DEFAULT_PATH = '/dev/ttyAMA0';
    public const PARITY_NONE = 'none';

    public int $baudRate = 115200;
    public int $charLength = 8;
    public int $startBitsLength = 1;
    public int $stopBitsLength = 1;

    public string $path = self::DEFAULT_PATH;
    public string $parity = self::PARITY_NONE;

    private Process $process;

    public function open(): bool
    {
        $this->process = new Process();

        return $this->process->open("stty -F $this->path");
    }

    /** @throws PortNotOpenException */
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