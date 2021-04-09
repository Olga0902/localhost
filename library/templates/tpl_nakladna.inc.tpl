<div>
	 <br /><br /><div>
		<button class="btn"><a href='/pdf'>Експорт в pdf формат</a> </p></button>
		 <button class="btn"> <a href='/excel'>Cкачать .xls файлом</a> </p></button></div>
<p><strong>Список накладних</strong></p>
<table cellspacing="0" id="table_nakladna" class="sorttable">
<thead>
<tr>
	<th ><h3>№</h3></th>
	<th class="nosort"><h3>Код накладної</h3></th>
	<th class="nosort"><h3>Лицевой счет клієнта</h3></th>
	<th class="nosort"><h3>Дата створення</h3></th>

</thead>
<tbody>
<?foreach($content as $item):?>
<tr align="center">
	<td><?=$item['id_code']?></td>
	<td><?=$item['kod_naklod']?></td>
	<td><?=$item['lizevoy_shet_kl']?></td>
	<td><?=$item['data_stvor']?></td>

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
	obj.Init("table_nakladna", 2); // 1 - номер сортируемой колонки по умолчанию
</script>
</div>
