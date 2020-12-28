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

final class ReadPipe implements PipeInterface
{
    public const METHOD = [self::TYPE, self::READ];

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