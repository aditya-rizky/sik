<table class="table">
	<thead>
		<tr>
			<td width="25%"></td>
			<td width="1%"></td>
			<td></td>
		</tr>
	</thead>
    <tbody>
    	<tr>
    		<td>Nomor Surat</td>
    		<td>:</td>
    		<td>{{ $detail->nomor_surat }}</td>
    	</tr>
    	<tr>
    		<td>Tanggal Surat</td>
    		<td>:</td>
    		<td>{{ date('d M Y', strtotime($detail->tanggal_surat)) }}</td>
    	</tr>
    	<tr>
    		<td>Tujuan</td>
    		<td>:</td>
    		<td>
                @foreach($tujuan as $key => $row)
                    {{ $key+1 }}. {{ $row->nama_bagian }}<br>
                @endforeach
            </td>
    	</tr>
    	<tr>
    		<td>Perihal</td>
    		<td>:</td>
    		<td>{{ $detail->perihal }}</td>
    	</tr>
    	<tr>
    		<td>Konseptor</td>
    		<td>:</td>
    		<td>{{ $detail->nama_karyawan }}</td>
    	</tr>
    	<tr>
    		<td>Pembuat Nomor</td>
    		<td>:</td>
    		<td>{{ $detail->name }}</td>
    	</tr>
        <tr>
            <td>Tindasan</td>
            <td>:</td>
            <td>
                @foreach($tindasan as $key => $row)
                    {{ $key+1 }}. {{ $row->nama_bagian }}<br>
                @endforeach
            </td>
        </tr>
        <tr>
            <td>Keterangan</td>
            <td>:</td>
            <td>{{ $detail->keterangan }}</td>
        </tr>
    </tbody>
</table>
================================================================
<table class="table">
    <thead>
        <tr>
            <td width="25%"></td>
            <td width="1%"></td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>No. Agenda Direksi</td>
            <td>:</td>
            <td>
                @if($agenda == NULL)
                    Tidak diagenda direksi
                @else
                    {{ $agenda->nomor_agenda }}
                @endif
            </td>
        </tr>
        <tr>
            <td>Tgl. Agenda Direksi</td>
            <td>:</td>
            <td>
                @if($agenda == NULL)
                    Tidak diagenda direksi
                @else
                    {{ date('d M Y', strtotime($agenda->tanggal_agenda)) }}
                @endif
            </td>
        </tr>
        <tr>
            <td>Tgl. Distribusi</td>
            <td>:</td>
            <td>
                @if($agenda == NULL)
                    Tidak diagenda direksi
                @else
                    {{ date('d M Y', strtotime($agenda->tanggal_bagian)) }}
                @endif
            </td>
        </tr>
        <tr>
            <td>Tujuan Disposisi</td>
            <td>:</td>
            <td>
                @if($tujuan_dispo == NULL)
                    Tidak diagenda direksi
                @else
                    @foreach($tujuan_dispo as $key => $row)
                        {{ $key+1 }}. {{ $row->nama_bagian }}<br>
                    @endforeach
                @endif
            </td>
        </tr>
        <tr>
            <td>Disposisi Direksi</td>
            <td>:</td>
            <td>
                @if($direksi_dispo == NULL)
                    Tidak diagenda direksi
                @else
                    @foreach($direksi_dispo as $key => $row)
                        {{ $key+1 }}. {{ $row->nama_disposisi }}<br>
                    @endforeach
                @endif
            </td>
        </tr>
        <tr>
            <td>Uraian Disposisi</td>
            <td>:</td>
            <td>
                @if($agenda == NULL)
                    Tidak diagenda direksi
                @else
                    {{ $agenda->uraian_dispo }}
                @endif
            </td>
        </tr>
    </tbody>
</table>