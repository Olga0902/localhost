<div>
<p><strong>Список автотраспорта</strong></p>
<table cellspacing="0" id="table_avto" class="sorttable">
<thead>
<tr>
	<th id="noedit">ID</h3></th>
	<th><h3>#авто</h3></th>
	<th  ><h3>Марка автомобіля</h3></th>
	<th ><h3>Тип двигуна</h3></th>
	<th ><h3>Вантажопідйомність</h3></th>
	<th class="nosort"><span class="rowadd" onclick="obj.showWinModal()"><img style="vertical-align:middle" src="css/images/add.png" width="20" height="20" alt="" />&nbsp;добавить</span></th>
</tr>
</thead>
<tbody>
<?foreach($content as $item):?>
<tr align="center">
	<td><?=$item['ID']?></td>
	<td><?=$item['№avto']?></td>
	<td><?=$item['Marka_avtomobilya']?></td>
	<td><?=$item['Tip_dvigatelya']?></td>
	<td><?=$item['Vantazhopidjomnist']?></td>
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
			formData += "&№avto=" + arrayDataRow[1];
			formData += "&Marka_avtomobilya=" + arrayDataRow[2];
			formData += "&Tip_dvigatelya=" + arrayDataRow[3];
			formData += "&Vantazhopidjomnist=" + arrayDataRow[4];
			// выполняем Ajax запрос
			obj.runRequest("POST", "/editavto", formData, "edit");
		}
	}
	// событие вызываемое при нажатие кнопки "добавить"
  function ResultClickAdd(arrayDataRow)
	{
		// создаем Ajax запрос
		if(obj.createRequest() != null)
		{
			// формируем передаваемые параметры
			let formData = "&№avto=" + arrayDataRow[0];
			formData += "&Marka_avtomobilya=" + arrayDataRow[1];
			formData += "&Tip_dvigatelya=" + arrayDataRow[2];
      formData += "&Vantazhopidjomnist=" + arrayDataRow[3];

			// выполняем Ajax запрос
			obj.runRequest("POST", "/addavto", formData, "add");
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
			obj.runRequest("POST", "/delavto", formData, "del");
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
	obj.Init("table_avto", 0); // 0 - номер сортируемой колонки по умолчанию
</script>
</div>
