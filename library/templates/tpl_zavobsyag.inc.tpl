<div>
<p><strong>Норми витарти палива</strong></p>
<table cellspacing="0" id="table_zagvutr" class="sorttable">
<thead>
<tr>
	<th ><h3>ID</h3></th>
	<th class="nosort"><h3>Номер авто</h3></th>
<th><h3>Літні витрати на 100км</h3></th>
	<th><h3>Зимні витрати на 100км</h3></th>

</tr>
</thead>
<tbody>
<?foreach($content as $item):?>
<tr align="center">
	<td><?=$item['ID']?></td>
	<td><?=$item['№_avto']?></td>
	<td><?=$item['Litni_vitrati_na_sto_km']?></td>
	<td><?=$item['Zimni_vytraty_na_sto_km']?></td>
</tr>
<?endforeach;?>
</tbody>
</table>
<div id="controls">
	<div id="perpage">
		<span>Количество строк</span>
		<select onchange="obj.Size(this.value)">
			<option value="10" selected="selected">10</option>
			<option value="20">20</option>
			<option value="50">50</option>
			<option value="100">100</option>
		</select>
	</div>
	<div id="navigation">
		<img src="css/images/first.gif" width="16" height="16" alt="" onclick="obj.Move(-1,true)" />
		<img src="css/images/previous.gif" width="16" height="16" alt="" onclick="obj.Move(-1)" />
		<img src="css/images/next.gif" width="16" height="16" alt="" onclick="obj.Move(1)" />
		<img src="css/images/last.gif" width="16" height="16" alt="" onclick="obj.Move(1,true)" />
	</div>
	<div id="text">Отображено <span id="currentpage"></span> из <span style="margin-right:5px" id="pagelimit"></span></div>
</div>
<button class="btn"><a href='/lito'>Розрахувати літні витрати</a> </p></button>
 <button class="btn"> <a href='/zuma'>Розрахувати зимні витрати</a> </p></button></div>
 <button class="btn"><a href='/zag'>Загальні витрати</a> </p></button>
<script type="text/javascript">
	let obj = new CTableSort("obj");
	obj.head="head";
	obj.asc="asc";
	obj.desc="desc";
	obj.even="evenrow";
	obj.odd="oddrow";
	obj.evensel="evenselected";
	obj.oddsel="oddselected";
	obj.paginate=true;
	obj.pagesize=10; // кол-во строк в таблице, по умолчанию
	obj.currentid="currentpage"; // id span, где выводится текущая страница
	obj.limitid="pagelimit"; // id span, где выводится общее кол-во страниц
	obj.Init("table_sagvutr", 4); // 1 - номер сортируемой колонки по умолчанию
</script>
</div>
