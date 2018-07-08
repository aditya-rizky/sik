<table class="table text-left">
    <thead>
        <tr>
            <td colspan="3" class="text-center"><span class="label label-maroon">DETAIL DISPOSISI DIREKSI</span></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td width="35%">No Surat</td>
            <td width="1%">:</td>
            <td>{{ $detail->nomor_surat }}</td>
        </tr>
        <tr>
            <td>Nomor / Tanggal Agenda</td>
            <td>:</td>
            <td>{{ $detail->nomor_agenda }} | {{ date('d M Y', strtotime($detail->tanggal_agenda)) }}</td>
        </tr>
        <tr>
            <td>Tanggal Distribusi</td>
            <td>:</td>
            <td>
                @if($detail->tanggal_bagian == "")
                    --
                @else
                    {{ date('d M Y', strtotime($detail->tanggal_bagian)) }}
                @endif
            </td>
        </tr>
        <tr>
            <td>Tujuan Disposisi</td>
            <td>:</td>
            <td>
                @foreach($tujuan as $key => $row)
                    {{ $key+1 }}. {{ $row->nama_bagian }}<br>
                @endforeach
            </td>
        </tr>
        <tr>
            <td>Disposisi</td>
            <td>:</td>
            <td>
                @foreach($disposisi as $key => $row)
                    {{ $key+1 }}. {{ $row->nama_disposisi }}<br>
                @endforeach
            </td>
        </tr>
        <tr>
            <td>Uraian Disposisi</td>
            <td>:</td>
            <td>{{ $detail->uraian_disposisi }}</td>
        </tr>
    </tbody>
</table>