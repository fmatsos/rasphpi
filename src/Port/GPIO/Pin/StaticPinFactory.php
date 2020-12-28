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

/**
 * @author Franck Matsos <franck@matsos.fr>
 */
final class StaticPinFactory
{
    /** @throws \InvalidArgumentException */
    public static function create(int $number, string $type): PinInterface
    {
        return match ($type) {
            PinInterface::TYPE_OUTPUT => self::createOutputPin($number),
            PinInterface::TYPE_INPUT => self::createInputPin($number),
            default => throw new \InvalidArgumentException("Type `$type` is invalid")
        };
    }

    /** @throws \InvalidArgumentException */
    public static function createOutputPin(int $number): OutputPinInterface
    {
        return new OutputPin($number);
    }

    /** @throws \InvalidArgumentException */
    public static function createInputPin(int $number): InputPinInterface
    {
        return new InputPin($number);
    }
}