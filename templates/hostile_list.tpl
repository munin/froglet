<table cellspacing="0" cellpadding="0" width="100%" class="black">
<tr>
<td>
<table cellspacing="1" cellpadding="3" width="100%">
	<tr class="datahigh">
		<th colspan="8">Hostile alliances breakdown</th>
	</tr>
	<tr class="header">
		<th><a href="hostile.php?order=alliance">Alliance</a></th>
		<th><a href="hostile.php?order=last24&dir=desc">Last 24h</a></th>
		<th><a href="hostile.php?order=last48&dir=desc">Last 48h</a></th>
		<th><a href="hostile.php?order=last72&dir=desc">Last 72h</a></th>
		<th><a href="hostile.php?order=today&dir=desc">Today</a></th>
		<th><a href="hostile.php?order=yday&dir=desc">Yesterday</a></th>
		<th><a href="hostile.php?order=daybefore&dir=desc">The day before</a></th>
		<th><a href="hostile.php?order=alltime&dir=desc">All time</a></th>
	</tr>
	{foreach from=$data item="alli"}
	<tr class="{cycle values="odd,even"}">
		<td><a href="hostile.php?name={$alli.name}" class="gray">{$alli.alliance}</a></td>
		<td align="right">{$alli.last24}</td>
		<td align="right">{$alli.last48}</td>
		<td align="right">{$alli.last72}</td>
		<td align="right">{$alli.today}</td>
		<td align="right">{$alli.yday}</td>
		<td align="right">{$alli.daybefore}</td>
		<td align="right">{$alli.alltime}</td>
	</tr>
	{/foreach}
	<tr class="header">
		<td>Total</td>
		<td align="right">{$total.last24}</td>
		<td align="right">{$total.last48}</td>
		<td align="right">{$total.last72}</td>
		<td align="right">{$total.today}</td>
		<td align="right">{$total.yday}</td>
		<td align="right">{$total.daybefore}</td>
		<td align="right">{$total.alltime}</td>
	</tr>
	<tr class="datahigh">
		<td colspan="8">Pages: {$count|paginate:$page:"order=$order&dir=$dir"}</td>
	</tr>
</table>
</td>
</tr>
</table>