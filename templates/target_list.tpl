<form action="target.php" method="post">
<table cellspacing="1" cellpadding="3">
	<tr class="datahigh">
		<th colspan="4">Show targets</th>
	</tr>
	<tr class="header">
		<th>
			Select alliance(s):
		</th>
		<td colspan="3">
			{html_options name=alliances[] options=$options selected=$alli multiple="multiple"}
		</td>
	</tr>
	<tr class="header">
		<th>
			Min roids:
		</th>
		<td>
			<input type="text" name="minroids" value="{$minroids}" size="10"/>
		</td>
		<th>
			Max roids:
		</th>
		<td>
			<input type="text" name="maxroids" value="{$maxroids}" size="10"/>
		</td>
	</tr>
	<tr class="header">
		<th>
			Min value:
		</th>
		<td>
			<input type="text" name="minvalue" value="{$minvalue}" size="10"/>
		</td>
		<th>
			Max value:
		</th>
		<td>
			<input type="text" name="maxvalue" value="{$maxvalue}" size="10"/>
		</td>
	</tr>
	<tr class="header">
		<th colspan="4">
			<input type="submit" value="Show"/>
		</th>
	</tr>
</table>
</form>
<p>&nbsp;</p>
<pre style="font-size: 10pt;">
<a href="target.php?alliances={$alli}&minroids={$minroids}&maxroids={$maxroids}&minvalue={$minvalue}&maxvalue={$maxvalue}&order=x,y,z">Coords</a>   	<a href="target.php?alliances={$alli}&minroids={$minroids}&maxroids={$maxroids}&minvalue={$minvalue}&maxvalue={$maxvalue}&order=race,size&dir=desc">Race</a>	<a href="target.php?alliances={$alli}&minroids={$minroids}&maxroids={$maxroids}&minvalue={$minvalue}&maxvalue={$maxvalue}&order=size&dir=desc">Size</a>		<a href="target.php?alliances={$alli}&minroids={$minroids}&maxroids={$maxroids}&minvalue={$minvalue}&maxvalue={$maxvalue}&order=value&dir=desc">Value</a>		<a href="target.php?alliances={$alli}&minroids={$minroids}&maxroids={$maxroids}&minvalue={$minvalue}&maxvalue={$maxvalue}&order=galsizerank&dir=asc">GSR</a>	<a href="target.php?alliances={$alli}&minroids={$minroids}&maxroids={$maxroids}&minvalue={$minvalue}&maxvalue={$maxvalue}&order=galvaluerank&dir=asc">GVR</a>	<a href="target.php?alliances={$alli}&minroids={$minroids}&maxroids={$maxroids}&minvalue={$minvalue}&maxvalue={$maxvalue}&order=alliance&dir=asc">Alliance</a>
{foreach name="p" from=$data item="plan"}
{$plan.x|string_width:"3"}:{$plan.y|string_width:"2"}:{$plan.z|string_width:"2"}	{$plan.race}	{$plan.size|number_format:"0"|string_width:"6"}	{$plan.value|number_format:"0"|string_width:"15"}		{$plan.galsizerank|string_width:"3"}	{$plan.galvaluerank|string_width:"3"}	{$plan.alliance}
{/foreach}
</pre>