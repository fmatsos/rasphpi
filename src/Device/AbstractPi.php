<?php
/*
 * This file is part of the Rasphpi project.
 *
 * (c) Franck Matsos <franck@matsos.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rasphpi\Device;

use Rasphpi\Port\GPIO\GPIO;
use Rasphpi\Port\Serial\Serial;

/**
 * @author Franck Matsos <franck@matsos.fr>
 */
abstract class AbstractPi implements PiInterface
{
    private GPIO $gpio;
    private Serial $serial;

    abstract protected function getGrid(): array;

    public function getModelName(): string
    {
        return shell_exec('cat /proc/device-tree/model');
    }

    public function getLocalIp(): string
    {
        return shell_exec('hostname -I | grep -o "^[0-9.]*"');
    }

    public function getWanIp(): string
    {
        return shell_exec('dig TXT +short o-o.myaddr.l.google.com @ns1.google.com');
    }

    public function getNetworkInfo(): string
    {
        return shell_exec('ifconfig');
    }

    public function getOSInfo(): string
    {
        return shell_exec('cat /proc/version');
    }

    public function getGPIO(): GPIO
    {
        if (!$this->gpio) {
            $this->gpio = new GPIO();
            $this->gpio->grid->setGrid($this->getGrid());
        }

        return $this->gpio;
    }

    public function getSerial(): Serial
    {
        if (!$this->serial) {
            $this->serial = new Serial();
        }

        return $this->serial;
    }
}