<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        return view('admin.customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        $data = $request->all();

        // Cek apakah file foto ada
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');

            // Generate nama unik untuk file
            $fotoName = Str::random(20) . '.' . $foto->getClientOriginalExtension();

            // Simpan file ke dalam folder 'customers' di storage 'public'
            $fotoPath = $foto->storeAs('customers', $fotoName, 'public');

            // Masukkan path foto ke dalam data yang akan disimpan
            $data['foto'] = $fotoPath;
        }

        // Simpan data customer ke database
        Customer::create($data);

        // Redirect dengan pesan sukses
        return to_route('customer')->with('success', 'Berhasil menambah data');
    }


    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $id)
    {
        return view('admin.customer.update', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, $id)
    {
        try {

            $customer = Customer::findOrFail($id);
            $data = $request->all();

            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('customers', 'public');

                $oldFile = public_path('storage/' . $customer->foto);
                if ($customer->foto && file_exists($oldFile)) unlink($oldFile);

                $data['foto'] = $fotoPath;
            }

            $customer->update($data);
            return to_route('customer')->with('success', 'Berhasil memperbarui data');

        } catch (\Throwable $th) {
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
        $data = Customer::findOrFail($id);
        Storage::disk('public')->delete($data->foto);
        $data->delete();
        return redirect()->route('customer')->with('success', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('customer')->with('danger', 'Data gagal dihapus');
        }
    }
}
