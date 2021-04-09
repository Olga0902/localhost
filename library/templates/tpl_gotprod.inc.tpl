<div>
<table cellspacing="0" id="table_gotprod" class="sorttable">
<thead>
<tr>
	<th class="nosort"  ><h3>№</h3></th>
	<th class="nosort" ><h3>Штрих-код </h3></th>
	<th><h3>Назва продукції</h3></th>
  <th><h3>Цена</h3></th>
	<th class="nosort"><h3>Кількість на складі</h3></th>
  <th class="nosort"><h3>Вага/1шт.</h3></th>
  <th ><h3>Дата виготовлення</h3></th>
  <th ><h3>Закінчення терміну придатності</h3></th>
</tr>
</thead>
<tbody>
<?foreach($content as $item):?>
<tr align="center">
	<td><?=$item['ID']?></td>
	<td><?=$item['Nomer_produkcii']?></td>
	<td><?=$item['Nazva_produkcii']?></td>
  <td><?=$item['Cena']?></td>
	<td><?=$item['Kilkist_na_skladi']?></td>
	<td><?=$item['Vaga_1pro']?></td>
  <td><?=$item['Data_vygotovlennya']?></td>
  <td><?=$item['Vzhutu_do:']?></td>
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
	obj.head = "head";
	obj.asc = "asc";
	obj.desc = "desc";
	obj.even = "evenrow";
	obj.odd = "oddrow";
	obj.evensel = "evenselected";
	obj.oddsel = "oddselected";
	obj.paginate = true;
	obj.pagesize = 10; // количество строк видимых в таблице, по умолчанию
	obj.currentid = "currentpage"; // id span, где выводится текущая страница
	obj.limitid = "pagelimit"; // id span, где выводится общее количество страниц
	obj.Init("table_gotprod", 0); // 0 - номер сортируемой колонки по умолчанию
</script>
</div>
