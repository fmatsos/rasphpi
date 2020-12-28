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

interface InputPinInterface extends PinInterface
{
    public const EDGE_NONE = 'none';
    public const EDGE_BOTH = 'both';
    public const EDGE_RISING = 'rising';
    public const EDGE_FALLING = 'falling';

    public function getEdge(): string;
    public function setEdge(string $edge): void;
}