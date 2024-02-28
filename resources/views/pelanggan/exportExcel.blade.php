<table>
    <tbody>
        <tr>
            <td colspan="9" style="font-weight:bold;text-align:center">DATA PELANGGAN</td>
        </tr>
        <tr>
            <td colspan="9" style="font-weight:bold;text-align:center">Waktu Export : {{date('d-m-Y H:i')}}</td>
        </tr>
    </tbody>
</table>
<table>
    <thead>
    <tr>
        <th style="font-weight:bold;text-align:center;background:#f4f4f4;border:1px solid #000000;">No</th> <!-- kolom A -->
        <th style="font-weight:bold;text-align:center;background:#f4f4f4;border:1px solid #000000;">Nama Pelanggan</th> <!-- kolom B -->
        <th style="font-weight:bold;text-align:center;background:#f4f4f4;border:1px solid #000000;">Alamat</th> <!-- kolom C -->
        <th style="font-weight:bold;text-align:center;background:#f4f4f4;border:1px solid #000000;">Nomor Telepon</th> <!-- kolom D -->
    </tr>
    </thead>
    <tbody>
    @php $no=1; @endphp
    @if(count($data))
    @foreach($data as $dt)
        <tr>
            <td>{{$no++}}</td>
            <td>{{$dt->nama_pelanggan??''}}</td>
            <td>{{$dt->alamat??''}}</td>
            <td>{{$dt->nomor_telepon??''}}</td>
        </tr>
    @endforeach
    @endif
    </tbody>
</table>