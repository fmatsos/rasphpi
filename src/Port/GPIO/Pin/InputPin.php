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

use Rasphpi\Filesystem\FilesystemInterface;

final class InputPin extends AbstractPin implements InputPinInterface
{
    public const GPIO_PIN_FILE_EDGE = 'edge';

    public function __construct(FilesystemInterface $fileSystem, int $number)
    {
        parent::__construct($fileSystem, $number);

        $this->setDirection(self::DIRECTION_IN);
    }

    /**
     * {@inheritdoc}
     */
    public function getEdge(): string
    {
        $edgeFile = $this->getPinFile(self::GPIO_PIN_FILE_EDGE);
        return trim($this->fileSystem->getContents($edgeFile));
    }

    /**
     * {@inheritdoc}
     */
    public function setEdge(string $edge): void
    {
        $edgeFile = $this->getPinFile(self::GPIO_PIN_FILE_EDGE);
        $this->fileSystem->putContents($edgeFile, $edge);
    }

    public function getType(): string
    {
        return self::TYPE_INPUT;
    }
}