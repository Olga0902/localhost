<div>
<p><strong>Статус доставки</strong></p>
<table cellspacing="0" id="table_dostavka" class="sorttable">
<thead>
<tr>
  <th  id="noedit"><h3>ID</h3></th>
	<th><h3>№заказу </h3></th>
	<th class="nosort"><h3>Назва закладу</h3></th>
	<th ><h3>Адрес</h3></th>
	<th><h3>Дата доставки</h3></th>
<th><h3>№авто</h3></th>
	<th><h3>Статус</h3></th>
  <th class="nosort"><span class="rowadd" onclick="obj.showWinModal()"><img style="vertical-align:middle" src="css/images/add.png" width="20" height="20" alt="" />&nbsp;добавить</span></th>
</tr>
</thead>
<tbody>
<?foreach($content as $item):?>
<tr align="center">
  <td><?=$item['ID']?></td>
	<td><?=$item['Nomer_zakazu']?></td>
	<td><?=$item['Nazva_zakladu']?></td>
	<td><?=$item['Adres']?></td>
	<td><?=$item['Data_dostavki']?></td>
	<td><?=$item['№avto']?></td>
  <? if ($item['Status'] == "Доставлено") { echo "<td style='background: #99ff99;'>".$item['Status']."</td>"; }
  else { echo "<td style='background: red;'>".$item['Status']."</td>"; } ?>
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
			formData += "&Nomer_zakazu=" + arrayDataRow[1];
			formData += "&Nazva_zakladu=" + arrayDataRow[2];
			formData += "&Adres=" + arrayDataRow[3];
			formData += "&Data_dostavki=" + arrayDataRow[4];
      formData += "&№avto=" + arrayDataRow[5];
      formData += "&Status=" + arrayDataRow[6];
			// выполняем Ajax запрос
			obj.runRequest("POST", "/editdostavka", formData, "edit");
		}
	}
	// событие вызываемое при нажатие кнопки "добавить"
  function ResultClickAdd(arrayDataRow)
	{
		// создаем Ajax запрос
		if(obj.createRequest() != null)
		{
			// формируем передаваемые параметры
			let formData = "&Nomer_zakazu=" + arrayDataRow[0];
			formData += "&Nazva_zakladu=" + arrayDataRow[1];
			formData += "&Adres=" + arrayDataRow[2];
      formData += "&Data_dostavki=" + arrayDataRow[3];
      formData += "&№avto=" + arrayDataRow[4];
      formData += "&Status=" + arrayDataRow[5];
			// выполняем Ajax запрос
			obj.runRequest("POST", "/adddostavka", formData, "add");
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
			obj.runRequest("POST", "/deldostavka", formData, "del");
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
	obj.Init("table_dostavka", 0); // 0 - номер сортируемой колонки по умолчанию
</script>
</div>
