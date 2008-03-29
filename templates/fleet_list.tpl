<form action="fleet.php" method="post">
<input type="hidden" name="action" value="list"/>
<table cellspacing="1" cellpadding="3">
	<tr class="datahigh">
		<th colspan="2">Show ships</th>
	</tr>
	<tr class="header">
		<th>
			Defending class:
		</th>
		<td>
			{html_options name=defclass options=$classes selected=$def}
		</td>
	</tr>
	<tr class="header">
		<th>
			Attacking class:
		</th>
		<td>
			{html_options name=attclass options=$classes selected=$att}
		</td>
	</tr>
	<tr class="header">
		<th>
			ETA:
		</th>
		<td>
			{html_options name=eta options=$etas selected=$eta}
		</td>
	</tr>
	<tr class="header">
		<th colspan="2">
			<input type="submit" value="Show"/>
		</th>
	</tr>
</table>
</form>
<p>&nbsp;</p>
<table cellspacing="0" cellpadding="0" class="black">
<tr>
<td>
<table cellspacing="1" cellpadding="3" width="100%">
	<tr class="datahigh">
		<th colspan="20">Available ships</th>
	</tr>
	<tr class="header">
		<th>Ship</th>
		<th>Count</th>
		<th>Nick</th>
		<th>Phone</th>
		<th>Last update</th>
	</tr>
	{foreach from=$data item="ship"}
	<tr class="{cycle values="odd,even"}">
		<td>{$ship.shipname}</td>
		<td align="right">{$ship.count}</td>
		<td>{$ship.username}</td>
		<td align="right">{$ship.phone}</td>
		<td align="right">{$ship.last}h</td>
	</tr>
	{/foreach}
</table>
</td>
</tr>
</table>