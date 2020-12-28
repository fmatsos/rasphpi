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

namespace Rasphpi\Port;

use Rasphpi\Process\Process;

interface SerialInterface
{
    public function open(): bool;
    public function close(): int;

    public function getProcess(): Process;
    public function getConfig(): array;
    public function setConfig(array $config): void;
}