<table class="table">
	<thead>
		<tr>
			<td colspan="3"><span class="label label-success">DETAIL SURAT</span></td>
		</tr>
	</thead>
    <tbody>
    	<tr>
    		<td width="25%">Nomor Surat</td>
    		<td width="1%">:</td>
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
<table class="table">
    <thead>
        <tr>
            <td colspan="3"><span class="label label-success">DETAIL AGENDA SENTRAL</span></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td width="25%">No. / Tgl. Sentral</td>
            <td width="1%">:</td>
            <td>
                @if($agenda_sentral == NULL)
                    --
                @else
                    {{ $agenda_sentral->nomor_agenda }} / {{ date('d M Y', strtotime($agenda_sentral->tanggal_agenda)) }}
                @endif
            </td>
        </tr>
    </tbody>
</table>
<table class="table">
    <thead>
        <tr>
            <td colspan="3"><span class="label label-success">DETAIL AGENDA DIREKSI</span></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td width="25%">No. Agenda Direksi</td>
            <td width="1%">:</td>
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
                    @if($agenda_dir->tanggal_bagian == NULL)
                        --
                    @else
                        {{ date('d M Y', strtotime($agenda_dir->tanggal_bagian)) }}
                    @endif
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