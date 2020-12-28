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

interface GPIOInterface
{
    /** @return iterable|InputPinInterface */
    public function getInputPins(): iterable;

    /** @return iterable|OutputPinInterface */
    public function getOutputPins(): iterable;

    public function getInputPin(int $number): InputPinInterface;
    public function getOutputPin(int $number): OutputPinInterface;

    /**
     * Create an interrupt watcher.
     *
     * @return InterruptWatcherInterface
     */
    public function createWatcher();
}