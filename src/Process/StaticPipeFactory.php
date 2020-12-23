<?php

declare(strict_types=1);

namespace Rasphpi\Process;

final class StaticPipeFactory
{
    /** @throws \InvalidArgumentException */
    public static function create($resource, string $option): PipeInterface
    {
        if (false === is_resource($resource)) {
            throw new \InvalidArgumentException();
        }

        return match ($option) {
            Process::DESCRIPTOR_READ => self::createReadPipe($resource),
            Process::DESCRIPTOR_WRITE => self::createWritePipe($resource),
            default => throw new \InvalidArgumentException("Option `$option` is invalid")
        };
    }

    public static function createReadPipe($resource): ReadPipe
    {
        if (is_resource($resource)) {
            return new ReadPipe($resource);
        }

        throw new \InvalidArgumentException();
    }

    public static function createWritePipe($resource): WritePipe
    {
        if (is_resource($resource)) {
            return new WritePipe($resource);
        }

        throw new \InvalidArgumentException();
    }
}