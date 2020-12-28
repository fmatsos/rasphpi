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

interface FilesystemInterface
{
    public function exists(string $path): bool;
    public function isDir(string $path): bool;

    /**
     * Open a file.
     *
     * @param string $path The path of the file to open
     * @param string $mode The mode to open the file in (see fopen())
     *
     * @return resource A stream resource.
     */
    public function open(string $path, string $mode);
    public function getContents(string $path): string;
    public function putContents(string $path, $buffer): int;
}