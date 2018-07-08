<table class="table text-left">
	<thead>
		<tr>
			<td colspan="3" class="text-center"><span class="label label-success">DETAIL SURAT KELUAR</span></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td width="35%">No Surat</td>
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
	</tbody>
</table>
<input type="text" name="id_surat_keluar" id="id_surat_keluar" value="{{ $detail->id_surat_keluar }}" style="display: none;">
<input type="text" name="id_tujuan" id="id_tujuan" value="{{ $detail->tujuan }}" style="display: none;">
<input type="text" name="nomor_surat" id="nomor_surat" value="{{ $detail->nomor_surat }}" style="display: none;">
<input type="text" name="perihal" id="perihal" value="{{ $detail->perihal }}" style="display: none;">
<input type="text" name="tahun_surat" id="tahun_surat" value="{{ $detail->tahun_surat }}" style="display: none;">
<input type="text" name="tindasan" id="tindasan" value="{{ $detail->tindasan }}" style="display: none;">
<input type="text" name="tanggal_surat" id="tanggal_surat" value="{{ $detail->tanggal_surat }}" style="display: none;">
<input type="text" name="id_bagian" id="id_bagian" value="{{ $detail->id_bagian }}" style="display: none;">