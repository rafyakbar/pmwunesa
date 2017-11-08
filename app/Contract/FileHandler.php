<?php

namespace PMW\Contract;

/**
 * Contract untuk meng-handle storage
 */
interface FileHandler {

    /**
     * Menyimpan file yang telah diunggah ke storage
     *
     * @param string $dir
     * @param string $filename
     * @param string $contents
     * @return void
     */
    public function save($dir, $filename, $contents);

    /**
     * Menghapus file
     *
     * @param string $filepath
     * @return void
     */
    public function delete($filepath);

    /**
     * Menngunduh file
     *
     * @param string $filepath
     * @return void
     */
    public function get($filepath);

}