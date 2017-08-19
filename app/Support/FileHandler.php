<?php

namespace PMW\Support;

use Illuminate\Support\Facades\Auth;

trait FileHandler
{

    /**
     * Mengunggah berkas
     *
     * @param  $file
     * @return string
     */
    public function unggahBerkas($file)
    {
        $namaFile = Auth::user()->id . ' ' . Auth::user()->nama . '.' . $file->getClientOriginalExtension();
        $file->storePubliclyAs('public/' . $this->dir, $namaFile);

        return $namaFile;
    }

    /**
     * Mengecek apakah berkas yang diunggah valid atau tidak
     *
     * @param $berkas
     * @return bool
     */
    private function berkasValid($berkas)
    {
        // memecah nama dari berkas
        $berkas = explode('.', $berkas->getClientOriginalName());

        // mengambil ekstensi berkas
        $formatBerkas = $berkas[count($berkas) - 1];

        if (is_array($this->validExtension)) {
            if (in_array($formatBerkas, $this->validExtension))
                return true;
        } elseif (is_string($this->validExtension)) {
            if ($formatBerkas === $this->validExtension)
                return true;
        }

        return false;
    }

    /**
     * Memastikan bahwa user adalah ketua tim
     *
     * @return boolean
     */
    private function bolehUnggah()
    {
        return (Auth::user()->isKetua());
    }

}
