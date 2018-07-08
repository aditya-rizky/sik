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
    </tbody>
</table>