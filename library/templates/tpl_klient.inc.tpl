<div>
<p><strong>Список клієнтів</strong></p>
<table cellspacing="0" id="table_klient" class="sorttable">
<thead>
<tr>
	<th ><h3>№</h3></th>
	<th class="nosort"><h3>Лицевой рахунок</h3></th>
	<th class="nosort"><h3>Назва клієнта</h3></th>
	<th class="nosort"><h3>Адрес клієнта</h3></th>
<th><h3>Дата підпису договору</h3></th>
	<th><h3>Дата закінчення договору</h3></th>
</tr>
</thead>
<tbody>
<?foreach($content as $item):?>
<tr align="center">
	<td><?=$item['id_code']?></td>
	<td><?=$item['lizevoy_shet']?></td>
	<td><?=$item['nazva_klienta']?></td>
	<td><?=$item['adres_klienta']?></td>
	<td><?=$item['data_pidpus_dog']?></td>
	<td><?=$item['data_zakinch_dog']?></td>
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
	obj.Init("table_klient", 4); // 1 - номер сортируемой колонки по умолчанию
</script>
</div>
