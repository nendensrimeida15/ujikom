<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penjualan = Penjualan::with('pelanggan')->get();
        return view('penjualan.index',compact('penjualan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pelanggan  =  Pelanggan::all();
        return view('penjualan.form_create',compact('pelanggan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_penjualan' => 'required',
            'Total_harga' => 'required',
            'pelanggan_id' => 'required',
        ],
        [
            'tanggal_penjualan.required' => 'nama wajib diisi',
            'Total_harga.required' => 'Total_harga wajib diisi',
            'pelanggan_id.required' => 'nama pelanggan wajib diisi',
        ]
        );
        $penjualan = [
            'tanggal_penjualan' => $request->tanggal_penjualan,
            'Total_harga' => $request->Total_harga,
            'pelanggan_id' => $request->pelanggan_id,
        ];

        Penjualan::create($penjualan);
        return redirect()->route('penjualan.index')->with('success', 'Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pelanggan  =  Pelanggan::all();
        $dt = Penjualan::find($id);
        return view('penjualan.form_edit', compact('pelanggan','dt'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_penjualan' => 'required',
            'Total_harga' => 'required',
            'pelanggan_id' => 'required',
        ],
        [
            'tanggal_penjualan.required' => 'nama wajib diisi',
            'Total_harga.required' => 'Total_harga wajib diisi',
            'pelanggan_id.required' => 'nama pelanggan wajib diisi',
        ]
        );
        $penjualan = [
            'tanggal_penjualan' => $request->tanggal_penjualan,
            'Total_harga' => $request->Total_harga,
            'pelanggan_id' => $request->pelanggan_id,
        ];
        Penjualan::where('id',$id)->update($penjualan);
        return redirect()->route('penjualan.index')->with('success','Data Berhasil Di edit');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $penjualan = Penjualan::findorfail($id);

        $penjualan->delete();

        return redirect()->route('penjualan.index')->with('success', 'Data berhasil dihapus');
    }
    public function export_pdf()//membuat pdf
    {
        $data = Penjualan::orderBy('tanggal_penjualan', 'asc');
        $data = $data->get();

        //membuka halaman yang ada di data pelanggan di folder data Pelanggan
        $pdf = PDF::loadview('penjualan.exportPdf', ['data'=>$data]);
        $pdf->setPaper('a4', 'potrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        //untuk memberi nama di file nya
        $filename = date('YmsdHis') . '_data_pelanggan';
        //untuk mendowload
        return $pdf->download($filename.'.pdf');
    }
}