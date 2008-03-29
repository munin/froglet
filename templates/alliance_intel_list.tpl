<table cellspacing="0" cellpadding="0" width="100%" class="black">
<tr>
<td>
<table cellspacing="1" cellpadding="3" width="100%">
	<tr class="datahigh">
		<th colspan="17">Alliance listing (intel)</th>
	</tr>
	<tr class="header">
		<th colspan="9">&nbsp;</th>
		<th colspan="4">Score</th>
		<th colspan="4">Value</th>
	</tr>
	<tr class="header">
		<th>#</th>
		<th>Alliance</th>
		<th><a href="alliance.php?action=intel&order=members&dir=desc">Members</a></th>
		<th><a href="alliance.php?action=intel&order=avg_size&dir=desc">Av. Size</a></th>
		<th><a href="alliance.php?action=intel&order=avg_value&dir=desc">Av. Value</a></th>
		<th><a href="alliance.php?action=intel&order=avg_score&dir=desc">Av. Score</a></th>
		<th><a href="alliance.php?action=intel&order=size&dir=desc">Size</a></th>
		<th><a href="alliance.php?action=intel&order=value&dir=desc">Value</a></th>
		<th><a href="alliance.php?action=intel&order=score&dir=desc">Score</a></th>
		<th><a href="alliance.php?action=intel&order=t10&dir=desc">Top 10</a></th>
		<th><a href="alliance.php?action=intel&order=t50&dir=desc">Top 50</a></th>
		<th><a href="alliance.php?action=intel&order=t100&dir=desc">Top 100</a></th>
		<th><a href="alliance.php?action=intel&order=t200&dir=desc">Top 200</a></th>
		<th><a href="alliance.php?action=intel&order=t10v&dir=desc">Top 10</a></th>
		<th><a href="alliance.php?action=intel&order=t50v&dir=desc">Top 50</a></th>
		<th><a href="alliance.php?action=intel&order=t100v&dir=desc">Top 100</a></th>
		<th><a href="alliance.php?action=intel&order=t200v&dir=desc">Top 200</a></th>
	</tr>
	{foreach name="a" from=$data item="alli"}
	<tr class="{cycle values="odd,even"}">
		<td>{$smarty.foreach.a.iteration}</td>
		<td><a href="alliance.php?name={$alli.name}" class="gray">{$alli.name}</a></td>
		<td align="right">{$alli.members}</td>
		<td align="right">{$alli.avg_size|number_format:"0"}</td>
		<td align="right">{$alli.avg_value|number_format:"0"}</td>
		<td align="right">{$alli.avg_score|number_format:"0"}</td>
		<td align="right">{$alli.size|number_format:"0"}</td>
		<td align="right">{$alli.value|number_format:"0"}</td>
		<td align="right">{$alli.score|number_format:"0"}</td>
		<td align="right">{$alli.t10}</td>
		<td align="right">{$alli.t50}</td>
		<td align="right">{$alli.t100}</td>
		<td align="right">{$alli.t200}</td>
		<td align="right">{$alli.t10v}</td>
		<td align="right">{$alli.t50v}</td>
		<td align="right">{$alli.t100v}</td>
		<td align="right">{$alli.t200v}</td>
	</tr>
	{/foreach}
	<tr class="datahigh">
		<td colspan="17">Pages: {$count|paginate:$page:"action=intel"}</td>
	</tr>
</table>
</td>
</tr>
</table>