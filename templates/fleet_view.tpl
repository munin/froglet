<form action="fleet.php" method="post">
<table cellspacing="1" cellpadding="3">
	<tr>
		<td colspan="3">
				<textarea rows="15" cols="60" name="paste"></textarea>
		</td>
	</tr>
	<tr>
		<td>
			Fleets that are not home:
		</td>
		<td>
			Fleet 1: <input type="checkbox" name="alpha"/>
			Fleet 2: <input type="checkbox" name="beta"/>
			Fleet 3: <input type="checkbox" name="gamma"/>
		</td>
		<td>
			<input type="submit" value="Parse"/>
		</td>
	</tr>
</table>
</form>
<p>
Copy your fleets from <b>Fleets</b> screen with Ctrl+A, Ctrl+C, then paste it here with Ctrl+V.
Tick the checkboxes of fleets that are <b>not</b> home and click parse.
</p>
<p>&nbsp;</p>
<table cellspacing="0" cellpadding="0" class="black">
<tr>
<td>
<table cellspacing="1" cellpadding="3" width="100%">
	<tr class="datahigh">
		<th colspan="5">Fleets</th>
	</tr>
	<tr class="header">
		<th>Ships</th>
		<th>Base</th>
		<th>Alpha</th>
		<th>Beta</th>
		<th>Gamma</th>
	</tr>
	{foreach from=$fleet item="ship"}
	<tr class="{cycle values="odd,even"}">
		<td>{$ship.shipname}</td>
		<td>{$ship.base}</td>
		<td>{$ship.fleet1}</td>
		<td>{$ship.fleet2}</td>
		<td>{$ship.fleet3}</td>
	</tr>
	{/foreach}
	<tr class="header">
		<th>&nbsp;</th>
		<th>&nbsp;</th>
		<th>{$alpha}</th>
		<th>{$beta}</th>
		<th>{$gamma}</th>
	</tr>
</table>
</td>
</tr>
</table>