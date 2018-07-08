<table class="table text-left">
	<thead>
		<tr>
			<td colspan="3" class="text-center"><span class="label label-success">DETAIL AGENDA SENTRAL INTERNAL</span></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td width="35%">No Surat</td>
			<td width="1%">:</td>
			<td>{{ $detail->nomor_surat }}</td>
		</tr>
		@if($detail->nama_pengirim != NULL)
		<tr>
			<td>Nama Pengirim</td>
			<td>:</td>
			<td>{{ $detail->nama_pengirim }}</td>
		</tr>
		@endif
		<tr>
			<td>Tgl. Agnd Sentral</td>
			<td>:</td>
			<td>{{ date('d M Y', strtotime($detail->tanggal_agenda)) }}</td>
		</tr>
		<tr>
			<td>No. Agnd Sentral</td>
			<td>:</td>
			<td>{{ $detail->nomor_agenda }}</td>
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