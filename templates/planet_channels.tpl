<table cellspacing="1" cellpadding="3">
	<tr class="datahigh">
		<th colspan="2">Show channels</th>
	</tr>
	<tr class="header">
		<th>
			Search by channel:
		</th>
		<td>
			<form action="planet.php" method="post">
				<input type="hidden" name="action" value="channels"/>
				<input type="text" name="channel" size="20" value="{$channel}"/>
				<input type="submit" value="View"/>
			</form>
		</td>
	</tr>
	<tr class="header">
		<th>
			Search by alliance:
		</th>
		<td>
			<form action="planet.php" method="post">
				<input type="hidden" name="action" value="channels"/>
				{html_options name=alliance options=$options selected=$alliance}
				<input type="submit" value="View"/>
			</form>
		</td>
	</tr>
</table>
<p>&nbsp;</p>
<table cellspacing="0" cellpadding="0" width="100%" class="black">
<tr>
<td>
<table cellspacing="1" cellpadding="3" width="100%">
	<tr class="datahigh">
		<th colspan="5">Planet listing</th>
	</tr>
	<tr class="header">
		<th><a href="planet.php?action=channels&order=channel">Channel</a></th>
		<th><a href="planet.php?action=channels&order=alliance">Alliance</a></th>
		<th>Nick</th>
		<th>Coords</th>
	</tr>
	{foreach from=$data item="plan"}
	<tr class="{cycle values="odd,even"}">
		<td>{$plan.channel}</td>
		<td>{$plan.alliance}</td>
		<td>{$plan.nick}</td>
		<td><a href="planet.php?x={$plan.x}&y={$plan.y}&z={$plan.z}">{$plan.x}:{$plan.y}:{$plan.z}</a></td>
	</tr>
	</tr>
	{/foreach}
	<tr class="datahigh">
		<td colspan="5">Pages: {$count|paginate:$page:"action=channels&order=$order"}</td>
	</tr>
</table>
</td>
</tr>
</table>