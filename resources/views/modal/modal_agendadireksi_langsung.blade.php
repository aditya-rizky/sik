<table class="table text-left">
	<thead>
		<tr>
			<td colspan="3" class="text-center"><span class="label label-success">DETAIL SURAT MASUK DIREKSI LANGSUNG</span></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td width="35%">No Surat</td>
			<td width="1%">:</td>
			<td>{{ $detail->nomor_surat }}</td>
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
<input type="text" name="id_surat_keluar" id="id_surat_keluar" value="{{ $detail->id_surat_keluar }}" style="display: none;">