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

use Illuminate\Support\Collection;
use Rasphpi\Exception\PinAlreadyExistsException;
use Rasphpi\Port\GPIO\Pin\PinInterface;
use Rasphpi\Port\GPIO\Pin\StaticPinFactory;

/**
 * @author Franck Matsos <franck@matsos.fr>
 */
final class GPIOGrid
{
    /** @var PinInterface[] */
    private Collection $grid;

    public function __construct()
    {
        $this->grid = new Collection;
    }

    /** @throws PinAlreadyExistsException */
    public function addPin(int $number, string $type): void
    {
        if ($this->grid->has($number)) {
            throw new PinAlreadyExistsException();
        }

        $pin = StaticPinFactory::create($number, $type);
        $this->grid->offsetSet($number, $pin);
    }

    public function removePin(int $number): void
    {
        $this->grid->offsetUnset($number);
    }

    public function setGrid(array $grid): void
    {
        $this->grid = new Collection;

        /** @var PinInterface $pin */
        foreach ($grid as $pin) {
            $this->addPin($pin->getNumber(), $pin->getType());
        }
    }

    public function getGrid(): array
    {
        $this->grid->toArray();
    }
}