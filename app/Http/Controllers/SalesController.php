<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Http\Requests\StoreSalesRequest;
use App\Http\Requests\UpdateSalesRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sales::all();
        return view('admin.sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sales.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSalesRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');

            $fotoName = str::random(20) . '.' . $foto->getClientOriginalExtension();

            $fotoPath = $foto->storeAs('sales', $fotoName, 'public');

            $data['foto'] = $fotoPath;
        }

        Sales::create($data);

        return to_route('sales')->with('success', 'Berhasil menambah data');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sales $sales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sales $id)
    {
        return view('admin.sales.update', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSalesRequest $request, Sales $id)
    {
        try {
            $sales = Sales::findOrFail($id);
            $data = $request->all();

            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('sales', 'public');

                $oldFile = public_path('storage/' . $sales->foto);
                if ($sales->foto && file_exists($oldFile)) unlink($oldFile);

                $data['foto'] = $fotoPath;
            }

            $sales->update($data);
            return to_route('sales')->with('success', 'Berhasil memperbarui data');
        } catch (\Throwable $th) {
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sales $id)
    {
        try {
            $data = Sales::findOrFail($id);
            Storage::disk('public')->delete($data->foto);
            $data->delete();
            return redirect()->route('sales')->with('success', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('sales')->with('danger', 'Data gagal dihapus');
        }
    }
}
