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

final class OutputPin extends AbstractPin implements OutputPinInterface
{
    public function __construct(FilesystemInterface $fileSystem, int $number, string $exportDirection = self::DIRECTION_OUT)
    {
        parent::__construct($fileSystem, $number);

        $direction = self::DIRECTION_OUT;

        if ($this->exported) {
            $direction = $exportDirection;
        }

        $this->setDirection($direction);
    }

    /**
     * {@inheritdoc}
     */
    public function setValue(int $value): void
    {
        $valueFile = $this->getPinFile(self::GPIO_PIN_FILE_VALUE);
        $this->fileSystem->putContents($valueFile, $value);
    }

    public function getType(): string
    {
        return self::TYPE_OUTPUT;
    }
}