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

namespace Rasphpi\Process;

use Rasphpi\Exception\PortNotOpenException;
use Rasphpi\Process\Pipe\PipeInterface;
use Rasphpi\Process\Pipe\ReadPipe;
use Rasphpi\Process\Pipe\StaticPipeFactory;
use Rasphpi\Process\Pipe\WritePipe;

final class Process
{
    public array $stdin = ReadPipe::METHOD;
    public array $stdout = WritePipe::METHOD;
    public array $stderr = WritePipe::METHOD;

    private array $pipes;
    private mixed $resource;

    /** @throws \InvalidArgumentException */
    public function open(string $command): bool
    {
        $pipes = [];
        $descriptor = [$this->stdin, $this->stdout, $this->stderr];
        $resource = proc_open($command, $descriptor, $pipes);

        if (!is_resource($resource)) {
            return false;
        }

        $this->resource = $resource;

        foreach ($descriptor as $index => $pipe) {
            $descriptorType = array_keys($pipe)[0];
            $option = array_values($pipe)[0];

            /** @todo Implement 'file' type */
            $this->pipes[] = match($descriptorType) {
                PipeInterface::TYPE =>  StaticPipeFactory::create($pipe, $option)
            };
        }

        return true;
    }

    /** @throws PortNotOpenException */
    public function close(): int
    {
        if (!$this->isOpen()) {
            throw new PortNotOpenException();
        }

        /** @var PipeInterface $pipe */
        foreach ($this->pipes as $pipe) {
            $pipe->close();
        }

        return proc_close($this->resource);
    }

    public function isOpen(): bool
    {
        return is_resource($this->resource);
    }

    public function getPipes(): array
    {
        return $this->pipes;
    }
}