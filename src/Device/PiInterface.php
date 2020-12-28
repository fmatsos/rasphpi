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

use Rasphpi\Port\GPIO\GPIO;
use Rasphpi\Port\Serial\Serial;

/**
 * @author Franck Matsos <franck@matsos.fr>
 */
interface PiInterface
{
    public function getModelName(): string;

    // Info
    public function getLocalIp(): string;
    public function getWanIp(): string;
    public function getNetworkInfo(): string;
    public function getOSInfo(): string;

    // Ports
    public function getGPIO(): GPIO;
    public function getSerial(): Serial;
}