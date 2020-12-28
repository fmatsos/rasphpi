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

namespace Rasphpi\Process\Pipe;

final class StaticPipeFactory
{
    /** @throws \InvalidArgumentException */
    public static function create($resource, string $option): PipeInterface
    {
        if (!is_resource($resource)) {
            throw new \InvalidArgumentException();
        }

        return match ($option) {
            PipeInterface::READ => self::createReadPipe($resource),
            PipeInterface::WRITE => self::createWritePipe($resource),
            default => throw new \InvalidArgumentException("Option `$option` is invalid")
        };
    }

    /** @throws \InvalidArgumentException */
    public static function createReadPipe($resource): ReadPipe
    {
        if (!is_resource($resource)) {
            throw new \InvalidArgumentException();
        }

        return new ReadPipe($resource);
    }

    /** @throws \InvalidArgumentException */
    public static function createWritePipe($resource): WritePipe
    {
        if (!is_resource($resource)) {
            throw new \InvalidArgumentException();
        }

        return new WritePipe($resource);
    }
}