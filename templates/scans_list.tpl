<table cellspacing="0" cellpadding="0" width="100%" class="black">
<tr>
<td>
<table cellspacing="1" cellpadding="3" width="100%">
	<tr class="datahigh">
		<th colspan="10">Scans listing</th>
	</tr>
	<tr class="header">
		<th><a href="scans.php?order=scan_id&dir=asc">ID</a></th>
		<th><a href="scans.php?order=type&dir=asc">Type</a></th>
		<th><a href="scans.php?order=x,y,z&dir=asc">X</a></th>
		<th><a href="scans.php?order=y,x,z&dir=asc">Y</a></th>
		<th><a href="scans.php?order=z,x,y&dir=asc">Z</a></th>
		<th><a href="scans.php?order=amplifiers&dir=asc">Amps needed</a></th>
		<th><a href="scans.php?order=status&dir=asc">Status</a></th>
		<th><a href="scans.php?order=request_time&dir=asc">Request time</a></th>
	</tr>
	{counter start=$page*50-50 print=false}
	{foreach from=$data item="scan"}
	<tr class="{cycle values="odd,even"}">
		<td align="right"><a href="scan.php?id={$scan.id}" target="_blank">{$scan.id}</a></td>
		<td>{$scan.scantype}</td>
		<td align="right">{$scan.x}</td>
		<td align="right">{$scan.y}</td>
		<td align="right">{$scan.z}</td>
		<td align="right">{$scan.wave_distorters}</td>
		<td>{$scan.status}</td>
		<td>{$scan.request_time}</td>
	</tr>
	{/foreach}
	<tr class="datahigh">
		<td colspan="10">Pages: {$count|paginate:$page:"order=$order&dir=$dir"}</td>
	</tr>
</table>
</td>
</tr>
</table>