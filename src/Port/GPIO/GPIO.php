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

namespace Rasphpi\Port\GPIO;

use Rasphpi\Port\GPIO\Pin\InputPinInterface;
use Rasphpi\Port\GPIO\Pin\OutputPinInterface;

/**
 * @author Franck Matsos <franck@matsos.fr>
 */
final class GPIO implements GPIOInterface
{
    public GPIOGrid $grid;

    /**
     * {@inheritdoc}
     */
    public function getInputPins(): iterable
    {
        foreach ($this->grid->getGrid() as $pin) {
            if ($pin instanceof InputPinInterface) {
                yield $pin;
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getOutputPins(): iterable
    {
        foreach ($this->grid->getGrid() as $pin) {
            if ($pin instanceof OutputPinInterface) {
                yield $pin;
            }
        }
    }

    public function getInputPin(int $number): InputPinInterface
    {
        foreach ($this->grid->getGrid() as $pin) {
            if ($pin instanceof InputPinInterface && $pin->getNumber() === $number) {
                return $pin;
            }
        }
    }

    public function getOutputPin(int $number): OutputPinInterface
    {
        foreach ($this->grid->getGrid() as $pin) {
            if ($pin instanceof OutputPinInterface && $pin->getNumber() === $number) {
                return $pin;
            }
        }
    }

    public function createWatcher()
    {
        // TODO: Implement createWatcher() method.
    }
}