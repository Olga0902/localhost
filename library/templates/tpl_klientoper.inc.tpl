<div>
<p><strong>Список клієнтов</strong></p>
<table cellspacing="0" id="table_klient" class="sorttable">
<thead>
<tr>
	<th id="noedit"><h3>№</h3></th>
	<th><h3>Лицевой рахунок</h3></th>
	<th><h3>Назва клієнта</h3></th>
	<th><h3>Адрес клієнта</h3></th>
	<th><h3>Дата підпису договору</h3></th>
	<th ><h3>Дата закінчення договору</h3></th>
	<th class="nosort"><span class="rowadd" onclick="obj.showWinModal()"><img style="vertical-align:middle" src="css/images/add.png" width="20" height="20" alt="" />&nbsp;добавить</span></th>
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
			let formData = "id_code=" + arrayDataRow[0];
			formData += "&lizevoy_shet=" + arrayDataRow[1];
			formData += "&nazva_klienta=" + arrayDataRow[2];
			formData += "&adres_klienta=" + arrayDataRow[3];
			formData += "&data_pidpus_dog=" + arrayDataRow[4];
			formData += "&data_zakinch_dog=" + arrayDataRow[5];
			// выполняем Ajax запрос
			obj.runRequest("POST", "/editklient", formData, "edit");
		}
	}
	// событие вызываемое при нажатие кнопки "добавить"
	function ResultClickAdd(arrayDataRow)
	{
		// создаем Ajax запрос
		if(obj.createRequest() != null)
		{
			// формируем передаваемые параметры
			let formData = "&lizevoy_shet=" + arrayDataRow[0];
			formData += "&nazva_klienta=" + arrayDataRow[1];
			formData += "&adres_klienta=" + arrayDataRow[2];
			formData += "&data_pidpus_dog=" + arrayDataRow[3];
			formData += "&data_zakinch_dog=" + arrayDataRow[4];
			// выполняем Ajax запрос
			obj.runRequest("POST", "/addklient", formData, "add");
		}
	}
	// событие вызываемое при нажатие кнопки "удалить"
	function ResultClickDelete(arrayDataRow)
	{
		// создаем Ajax запрос
		if(obj.createRequest() != null)
		{
			// формируем передаваемые параметры
			var formData = "id_code=" + arrayDataRow[0];
			// выполняем Ajax запрос
			obj.runRequest("POST", "/delklient", formData, "del");
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
	obj.Init("table_klient", 0); // 0 - номер сортируемой колонки по умолчанию
</script>
</div>
