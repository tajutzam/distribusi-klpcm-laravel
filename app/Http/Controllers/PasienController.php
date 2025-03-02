<?php

namespace App\Http\Controllers;

use App\Imports\PasienImport;
use App\Models\DataPasien;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PasienController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = DataPasien::query();

        if ($search = $request->input('search')) {
            $query->where('nama', 'like', "%{$search}%")
                ->orWhere('kode_wilayah', 'like', "%{$search}%")
                ->orWhere('no_rm', 'like', "%{$search}%");
        }

        $pasiens = $query->paginate(10);
        return view('pages.pasien.index', compact('pasiens'));
    }

    public function downloadTemplates()
    {
        $filePath = public_path('templates.xlsx');

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }
        return response()->download($filePath, 'template-pasien.xlsx', [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);
        try {
            Excel::import(new PasienImport, $request->file('file'));
            return redirect()->back()->with('success', 'Data pasien berhasil diimpor.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Terjadi kesalahan saat mengimpor: ' . $e->getMessage());
        }
    }


    public function search(Request $request)
    {
        $dataPasien = DataPasien::where('no_rm', '=' , $request->no_rm)->first();


        if (!isset($dataPasien)) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'data pasien tidak ditemukan!'
                ]
            );
        }
        return response()->json(
            [
                'status' => true,
                'message' => 'data pasien ditemukan',
                'data' => $dataPasien
            ]
        );
    }
}
