<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\DataPelangganExportView;
use App\Imports\ImportDataPelangganClass;
use Maatwebsite\Excel\Facades\Excel;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelanggan = Pelanggan::all();
        return view('pelanggan.index',compact('pelanggan'));   
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pelanggan.form_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            // dd($request);
            $request->validate(
                [
                    'nama_pelanggan' => 'required',
                    'alamat' => 'required',
                    'nomor_telepon' => 'required',
                ],
                [
                    'nama_pelanggan.required' => 'nama_pelanggan wajib diisi',
                    'alamat.required' => 'alamat wajib diisi',
                    'nomor_telepon.required' => 'nomor_telepon wajib diisi',
    
                ],
            );
            $data = [
                'nama_pelanggan' => $request->nama_pelanggan,
                'alamat' => $request->alamat,
                'nomor_telepon' => $request->nomor_telepon,
    
            ];
    
            Pelanggan::create($data);
            return redirect()->route('pelanggan.index')->with('success','Data Berhasil Disimpan');
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
        $dt = Pelanggan::find($id);
        return view('pelanggan.form_edit', compact('dt'));
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
        $request->validate(
            [
                'nama_pelanggan' => 'required',
                'alamat' => 'required',
                'nomor_telepon' => 'required',
            ],
            [
                'nama_pelanggan.required' => 'nama pelanggan wajib diisi',
                'alamat.required' => 'alamat wajib diisi',
                'nomor_telepon.required' => 'nomor_telepon wajib diisi',

            ],
        );
        $data = [
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->alamat,
            'nomor_telepon' => $request->nomor_telepon,

        ];

        Pelanggan::where('id',$id)->update($data);
        return redirect()->route('pelanggan.index')->with('success','Data Berhasil Di Edit');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pelanggan::find($id)->delete();
        return back()->with('succes', 'Data Berhasil Di Hapus');
    }
    public function export_pdf()//membuat pdf
    {
        $data = Pelanggan::orderBy('nama_pelanggan', 'asc');
        $data = $data->get();

        //membuka halaman yang ada di data pelanggan di folder data Pelanggan
        $pdf = PDF::loadview('pelanggan.exportPdf', ['data'=>$data]);
        $pdf->setPaper('a4', 'potrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        //untuk memberi nama di file nya
        $filename = date('YmsdHis') . '_data_pelanggan';
        //untuk mendowload
        return $pdf->download($filename.'.pdf');
    }
    public function export_excel(Request $request) 
    {
        //query mengambil data dari data base
        $data = Pelanggan::select('*');
        $data = $data->get();

        //untuk mengakses yang sudah di dowload
        $export = new DatapelangganExportView($data);
    
        //untuk memberi nama di file
        $filename = date('YmdHis') . '_data_pelanggan';

        //untuk mendowload
        return Excel::download($export, $filename . '.xlsx');
    }
    //membuat import excel
   
}