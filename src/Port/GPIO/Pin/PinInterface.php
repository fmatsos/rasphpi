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

namespace Rasphpi\Port\GPIO\Pin;

interface PinInterface
{
    public const TYPE_INPUT = 'input';
    public const TYPE_OUTPUT = 'output';

    public const VALUE_LOW = 0;
    public const VALUE_HIGH = 1;

    public function export();
    public function unexport();
    public function getNumber(): int;
    public function getType(): string;
    public function getValue(): int;
}