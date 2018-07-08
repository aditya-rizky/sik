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
<p class="text-center">================================================================</p>
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
                @if($agenda_dir == NULL)
                    --
                @else
                    {{ $agenda_dir->nomor_agenda }}
                @endif
            </td>
        </tr>
        <tr>
            <td>Tgl. Agenda Direksi</td>
            <td>:</td>
            <td>
                @if($agenda_dir == NULL)
                    --
                @else
                    {{ date('d M Y', strtotime($agenda_dir->tanggal_agenda)) }}
                @endif
            </td>
        </tr>
        <tr>
            <td>Tgl. Distribusi</td>
            <td>:</td>
            <td>
                @if($agenda_dir == NULL)
                    --
                @else
                    {{ date('d M Y', strtotime($agenda_dir->tanggal_bagian)) }}
                @endif
            </td>
        </tr>
        <tr>
            <td>Tujuan Disposisi</td>
            <td>:</td>
            <td>
                @if(!isset($tujuan_dispo))
                    --
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
                @if(!isset($direksi_dispo))
                    --
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
                @if($agenda_dir == NULL)
                    --
                @else
                    {{ $agenda_dir->uraian_dispo }}
                @endif
            </td>
        </tr>
    </tbody>
</table>