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
                @if($detail->tujuan == NULL)
                    {{ $detail->nama_tujuan }}
                @else
                @foreach($tujuan as $key => $row)
                        {{ $key+1 }}. {{ $row->nama_bagian }}<br>
                    @endforeach
                @endif
            </td>
    	</tr>
    	<tr>
    		<td>Perihal</td>
    		<td>:</td>
    		<td>{{ $detail->perihal }}</td>
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
            <td>{{ $surat->nomor_agenda }}</td>
        </tr>
        <tr>
            <td>Tgl. Agenda Direksi</td>
            <td>:</td>
            <td>{{ date('d M Y', strtotime($surat->tanggal_agenda)) }}</td>
        </tr>
        <tr>
            <td>Tgl. Distribusi</td>
            <td>:</td>
            <td>
                @if($surat->tanggal_bagian == NULL)
                    --
                @else
                    {{ date('d M Y', strtotime($surat->tanggal_bagian)) }}
                @endif
            </td>
        </tr>
        <tr>
            <td>Tujuan Disposisi</td>
            <td>:</td>
            <td>
                @foreach($tujuan_dispo as $key => $row)
                    {{ $key+1 }}. {{ $row->nama_bagian }}<br>
                @endforeach
            </td>
        </tr>
        <tr>
            <td>Disposisi Direksi</td>
            <td>:</td>
            <td>
                @foreach($direksi_dispo as $key => $row)
                    {{ $key+1 }}. {{ $row->nama_disposisi }}<br>
                @endforeach
            </td>
        </tr>
        <tr>
            <td>Uraian Disposisi</td>
            <td>:</td>
            <td>{{ $surat->uraian_dispo }}</td>
        </tr>
    </tbody>
</table>