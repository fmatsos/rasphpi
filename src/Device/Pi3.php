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

namespace Rasphpi\Device;

use Rasphpi\Port\GPIO\Pin\PinInterface;

/**
 * @author Franck Matsos <franck@matsos.fr>
 */
final class Pi3 extends AbstractPi
{
    protected function getGrid(): array
    {
        return [
            1 => PinInterface::TYPE_INPUT,
            12 => PinInterface::TYPE_OUTPUT,
        ];
    }
}