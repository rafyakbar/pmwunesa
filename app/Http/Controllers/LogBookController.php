<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PMW\Models\LogBook;
use Illuminate\Support\Facades\Auth;

/**
 * Controller ini berfungsi untuk melakukan aksi yang berkaitan dengan
 * logbook
 * 
 * @author BagasMuharom <bagashidayat@mhs.unesa.ac.id|bagashidayat45@gmail.com>
 * @package PMW\Http\Controllers
 */
class LogBookController extends Controller
{

    private $validationArr = [
        'catatan' => 'required',
        'biaya' => 'required|numeric'
    ];

    /**
     * Menambah LogBook
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function tambah(Request $request)
    {

        $this->validate($request, $this->validationArr);

        if ($this->bolehTambahLogBook()) {

            // Menambah Logbook ke database
            $tambah = LogBook::create([
                'catatan' => $request->catatan,
                'biaya' => $request->biaya,
                'id_proposal' => Auth::user()->mahasiswa()->proposal()->id
            ]);

            Session::flash('message', 'Berhasil menambah logbook !');
            return redirect()->route('logbook');
        }

        Session::flash('message', 'Anda tidak bisa menambah logbook !');
        return back()->withInput();
    }

    /**
     * Mengedit logbook tertentu
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request)
    {
        $this->validate($request, $this->validationArr);

        // Menambah LogBook ke database
        $edit = LogBook::find($request->id)->update([
            'catatan' => $request->catatan,
            'biaya' => $request->biaya,
        ]);

        Session::flash('message', 'Berhasil mengubah logbook !');
        return redirect()->route('logbook');
    }

    /**
     * Menghapus logbook tertentu
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function hapus(Request $request)
    {
        $logbook = LogBook::find($request->id);

        if(is_null($logbook)){
            return response()->json([
                'message' => 'Anda tidak bisa menghapus logbook tersebut !',
                'type' => 'error'
            ]);
        }

        if($logbook->id_proposal !== Auth::user()->mahasiswa()->proposal()->id){
            return response()->json([
                'message' => 'Anda tidak bisa menghapus logbook tersebut !',
                'type' => 'error'
            ]);
        }

        try {
            $logbook->delete();
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Anda tidak bisa menghapus logbook tersebut !',
                'type' => 'error'
            ]);
        }

        return response()->json([
            'message' => 'Berhasil menghapus logbook !',
            'type' => 'success'
        ]);
    }

    /**
     * Mengecek apakah user terkait bisa menambah logbook
     *
     * @return boolean
     */
    private function bolehTambahLogBook()
    {
        // Jika user adalah ketua tim dan
        // proposal dinyatakan lolos
        return (Auth::user()->isKetua() && Auth::user()->mahasiswa()->proposal()->lolos());
    }

}
