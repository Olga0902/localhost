<div>
<p><strong>Список готової продукції</strong></p>
<table cellspacing="0" id="table_gotprod" class="sorttable">
<thead>
  <button class="btn"><a href='/pdfgotprod'>Накладна на готову продукцію</a> </p></button>
<tr>
	<th id="noedit" class="nosort"><h3>№</h3></th>
	<th class="nosort"><h3>Штрих-код</h3></th>
	<th><h3>Назва продукції</h3></th>
	<th><h3>Цена</h3></th>
	<th><h3>Кількість на складі</h3></th>
	<th><h3>Вага/1шт.</h3></th>
  <th><h3>Дата виготовлення</h3></th>
  <th><h3>Закінчення терміну придатності</h3></th>
	<th class="nosort"><span class="rowadd" onclick="obj.showWinModal()"><img style="vertical-align:middle" src="css/images/add.png" width="20" height="20" alt="" />&nbsp;добавить</span></th>
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
  <td><?=$item['Vzhutu_do']?></td>
	<td><input class="btn" id="edit" type="button" value="&#10000;" />&nbsp;<input class="btn" id="delete" type="button" value="&#10008;" /></td>
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
<div style="text-align:center" id="popupWin" class="modalwin"></div>
<script type="text/javascript">
	// событие вызываемое при нажатие кнопки "редактировать"
	function ResultClickEdit(arrayDataRow)
	{
		// создаем Ajax запрос
		if(obj.createRequest() != null)
		{
			// формируем передаваемые параметры
			let formData = "ID=" + arrayDataRow[0];
			formData += "&Nomer_produkcii=" + arrayDataRow[1];
			formData += "&Nazva_produkcii=" + arrayDataRow[2];
			formData += "&Cena=" + arrayDataRow[3];
      formData += "&Kilkist_na_skladi=" + arrayDataRow[4];
			formData += "&Vaga_1pro=" + arrayDataRow[5];
			formData += "&Data_vygotovlennya=" + arrayDataRow[6];
	   formData += "&Vzhutu_do=" + arrayDataRow[7]
			// выполняем Ajax запрос
			obj.runRequest("POST", "/editgotprod", formData, "edit");
		}
	}
	// событие вызываемое при нажатие кнопки "добавить"
	function ResultClickAdd(arrayDataRow)
	{
		// создаем Ajax запрос
		if(obj.createRequest() != null)
		{
			// формируем передаваемые параметры
			let formData = "&Nomer_produkcii=" + arrayDataRow[0];
			formData += "&Nazva_produkcii=" + arrayDataRow[1];
			formData += "&Cena=" + arrayDataRow[2];
      formData += "&Kilkist_na_skladi=" + arrayDataRow[3];
			formData += "&Vaga_1pro=" + arrayDataRow[4];
      formData += "&Data_vygotovlennya=" + arrayDataRow[5];
      formData += "&Vzhutu_do=" + arrayDataRow[6];
			// выполняем Ajax запрос
			obj.runRequest("POST", "/addgotprod", formData, "add");
		}
	}
	// событие вызываемое при нажатие кнопки "удалить"
	function ResultClickDelete(arrayDataRow)
	{
		// создаем Ajax запрос
		if(obj.createRequest() != null)
		{
			// формируем передаваемые параметры
			var formData = "ID=" + arrayDataRow[0];
			// выполняем Ajax запрос
			obj.runRequest("POST", "/delgotprod", formData, "del");
		}
	}
	let obj = new CTabaleEdit("obj");
	obj.head = "head";
	obj.asc = "asc";
	obj.desc = "desc";
	obj.even = "evenrow";
	obj.odd = "oddrow";
	obj.evensel = "evenselected";
	obj.oddsel = "oddselected";
	obj.paginate = true;
	obj.ResultClickEdit = ResultClickEdit; // Функция обработки запроса на редактирование данных
	obj.ResultClickAdd = ResultClickAdd; // Функция обработки запроса на добавление данных
	obj.ResultClickDelete = ResultClickDelete; // Функция обработки запроса на удаление данных
	obj.pagesize = 10; // Количество строк в таблице, по умолчанию
	obj.currentid = "currentpage"; // id span, где выводится текущая страница
	obj.limitid = "pagelimit"; // id span, где выводится общее количество страниц
	obj.Init("table_gotprod", 0); // 0 - номер сортируемой колонки по умолчанию
</script>
</div>
