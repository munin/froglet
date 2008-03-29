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
Copy your fleets from <b>Fleets</b> screen with Ctrl+A, then paste it here.
Tick the checkboxes of fleets that are not home and click parse.
