<table class="table text-left">
	<thead>
		<tr>
			<td colspan="3" class="text-center"><span class="label label-success">DETAIL SURAT KELUAR DIREKSI</span></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td width="35%">No Surat</td>
			<td width="1%">:</td>
			<td>{{ $detail->nomor_surat }}</td>
		</tr>
		@if($detail->tujuan == NULL)
		<tr>
			<td>Tujuan</td>
			<td>:</td>
			<td>{{ $detail->nama_tujuan }}</td>
		</tr>
		@else
		<tr>
			<td>Tujuan</td>
			<td>:</td>
			<td>
				@foreach($tujuan as $key => $row)
	                {{ $key+1 }}. {{ $row->nama_bagian }}<br>
	            @endforeach
			</td>
		</tr>
		@endif
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
<input type="text" name="id_surat_keluar" id="id_surat_keluar" value="{{ $detail->id_surat_keluar }}" style="display: none;">