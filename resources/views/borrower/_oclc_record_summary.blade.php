<table class="table" id="oclc-data">
    <tr>
	<td>Your temporary bar code:</td>
	<td><strong>{{$borrower->barCode}}</strong></td>
    </tr>
    <tr>
	<td>Worldshare OCLC no:</td>
	<td><strong>{{$borrower->oclc_data['no']}}</strong></td>
    </tr>
    @endif
</table>
