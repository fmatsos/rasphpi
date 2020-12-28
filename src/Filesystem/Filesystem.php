<?php

/*
 * This file is part of the Rasphpi project.
 *
 * (c) Franck Matsos <franck@matsos.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rasphpi\Filesystem;

use RuntimeException;

final class Filesystem implements FilesystemInterface
{
    /**
     * {@inheritdoc}
     */
    public function open(string $path, string $mode)
    {
        $stream = @fopen($path, $mode);

        $this->exceptionIfFalse($stream);

        return $stream;
    }

    /**
     * {@inheritdoc}
     */
    public function getContents(string $path): string
    {
        $stream = $this->open($path, 'r');

        $contents = @stream_get_contents($stream);
        fclose($stream);

        $this->exceptionIfFalse($contents);

        return $contents;
    }

    /**
     * {@inheritdoc}
     */
    public function putContents(string $path, $buffer): int
    {
        $stream = $this->open($path, 'w');

        $bytesWritten = @fwrite($stream, $buffer);
        fclose($stream);

        $this->exceptionIfFalse($bytesWritten);

        return $bytesWritten;
    }

    /**
     * {@inheritdoc}
     */
    public function exists(string $path): bool
    {
        return file_exists($path);
    }

    /**
     * {@inheritdoc}
     */
    public function isDir(string $path): bool
    {
        return is_dir($path);
    }

    private function exceptionIfFalse($result)
    {
        if (false === $result) {
            $errorDetails = error_get_last();
            throw new RuntimeException($errorDetails['message']);
        }
    }
}