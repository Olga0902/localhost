<div>
<p><strong>Список зареєстрованих користувачів</strong></p>
<table class="tabl" id="tabale_user" cellspacing="1" style="margin:0 auto;width:50%">
<tr>
	<th>№</th>
	<th>ПІБ</th>
	<th>Посада</th>
	<th>Им'я користувача</th>
	<th>Рівень доступу</th>
	<th>Особисте фото</th>
	<th>Особисте фото</th>
	<th>Управління</th>
</tr>
<?foreach($content as $item):?>
<tr align="center">
	<td><?=$item['id_user']?></td>
	<td><?=$item['fio']?></td>
		<td><?=$item['dolzhnost']?></td>
	<td><?=$item['login']?></td>
	<td><?=$item['access_level']?></td>
<td class="btn" ><a href='photo'>Загрузить<?=$item['photo']?></a></td>
<td class="btn" ><a href='...'>Переглянути<?=$item['photo']?></a></td>
	<td><input class="btn" id="edit" type="button" value="&#10000;" /><?if($item['id_user'] != 1):?>&nbsp;<input class="btn" id="delete" type="button" value="&#10008;" /><?endif?></td>

</tr>
<?endforeach;?>
</table>
</div>
