<?php

declare(strict_types=1);

namespace Rasphpi\Process;

use Rasphpi\Exception\InterfaceNotOpenException;

final class Process
{
    const DESCRIPTOR_TYPE_PIPE = 'pipe';
    const DESCRIPTOR_TYPE_FILE = 'file';
    const DESCRIPTOR_READ = 'r';
    const DESCRIPTOR_WRITE = 'w';

    private array $pipes;
    private mixed $resource;

    public function __construct(
        public array $stdin = [self::DESCRIPTOR_TYPE_PIPE => self::DESCRIPTOR_READ],
        public array $stdout = [self::DESCRIPTOR_TYPE_PIPE => self::DESCRIPTOR_WRITE],
        public array $stderr = [self::DESCRIPTOR_TYPE_PIPE => self::DESCRIPTOR_WRITE]
    ) {}

    public function open(string $command): bool
    {
        $pipes = [];
        $descriptor = [$this->stdin, $this->stdout, $this->stderr];

        $resource = proc_open($command, $descriptor, $pipes);

        if (is_resource($resource)) {
            $this->resource = $resource;

            foreach ($descriptor as $index => $pipe) {
                $descriptorType = array_keys($pipe)[0];
                $option = array_values($pipe)[0];

                /** @todo Implement 'file' type */
                $this->pipes[] = match($descriptorType) {
                    self::DESCRIPTOR_TYPE_PIPE =>  StaticPipeFactory::create($pipe, $option)
                };
            }

            return true;
        }

        return false;
    }

    /** @throws InterfaceNotOpenException */
    public function close(): int
    {
        if (false === $this->isOpen()) {
            throw new InterfaceNotOpenException();
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