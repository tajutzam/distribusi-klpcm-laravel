<?php

namespace App\Http\Controllers;

use App\Models\Poly;
use Illuminate\Http\Request;

class PolyController extends Controller
{
    //

    public function index(Request $request)
    {
        $perawats = Poly::when($request->get('search'), function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->get('search') . '%');
        })->paginate(10);

        return view('pages.poly.index', compact('perawats'));
    }


    public function destroy(Request  $request, $id)
    {

        Poly::where('id', $id)->delete();
        return redirect()->back()->with('success', 'berhasil menghapus data perawat');
    }

    public function edit($id)
    {
        $perawat = Poly::findOrFail($id);
        return view('pages.poly.edit', compact('perawat'));
    }

    public function update(Request $request, $id)
    {
        $perawat = Poly::findOrFail($id);

        $validated = $request->validate(
            [
                'nip' => 'required',
                'name' => 'required',
                'poly' => 'required',
                'no_wa' => 'required'
            ]
        );

        $perawat->update(
            $validated
        );

        return redirect()->route('perawat.index')->with('success', 'Success update data perawat');
    }

    public function create()
    {
        return view('pages.poly.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'nip' => 'required|unique:polis,nip',
                'name' => 'required|unique:polis,name',
                'poly' => 'required',
                'no_wa' => 'required'
            ]
        );
        Poly::create($validated);
        return redirect()->route('perawat.index')->with('success', 'Berhasil menambahkan data perawat!');
    }


    public function searchByPoly(Request $request)
    {
        $request->validate([
            'poly' => 'required|string'
        ]);

        $poly = $request->get('poly');

        $perawats = Poly::whereRaw('LOWER(poly) LIKE ?', ['%' . strtolower($poly) . '%'])->get();

        return response()->json([
            'success' => true,
            'data' => $perawats
        ]);
    }
}
