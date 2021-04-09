<div>
<p><strong>Список продуктов</strong></p>
<table cellspacing="0" id="table_product" class="sorttable">
<thead>
<tr>
	<th id="noedit" class="nosort"><h3>№</h3></th>
	<th class="nosort"><h3>Код продукту</h3></th>
	<th><h3>Найменування продукту</h3></th>
	<th><h3>Ціна, грн.</h3></th>
	<th><h3>Кількість, шт.</h3></th>
	<th class="nosort" id="noedit"><h3 >Фото</h3></th>
	<th class="nosort"><span class="rowadd" onclick="obj.showWinModal()"><img style="vertical-align:middle" src="css/images/add.png" width="20" height="20" alt="" />&nbsp;добавить</span></th>
</tr>
</thead>
<tbody>
<?foreach($content as $item):?>
<tr align="center">
	<td><?=$item['id_code']?></td>
	<td><?=$item['code']?></td>
	<td><?=$item['name']?></td>
	<td><?=$item['price']?></td>
	<td><?=$item['quantity']?></td>
	<?if($item['image']==NULL):?>
	<td><img alt="" src="images/no-image.png" width="50" height="50"/></td>
	<?else: ?>
	<td><img alt="" src="data:image/*;base64,<?=$item['image']?>"  width="50" height="50"/></td>
	<?endif;?>
	<td><input class="btn" id="edit" type="button" value="&#10000;" />&nbsp;<input class="btn" id="image" type="button" value="&#127912;" onclick="ImageClick(this)" /><input class="btn" id="delete" type="button" value="&#10008;" /></td>
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
			formData += "&code=" + arrayDataRow[1];
			formData += "&name=" + arrayDataRow[2];
			formData += "&price=" + arrayDataRow[3];
			formData += "&quantity=" + arrayDataRow[4];
			// выполняем Ajax запрос
			obj.runRequest("POST", "/editproduct", formData, "edit");
		}
	}
	// событие вызываемое при нажатие кнопки "добавить"
	function ResultClickAdd(arrayDataRow)
	{
		// создаем Ajax запрос
		if(obj.createRequest() != null)
		{
			// формируем передаваемые параметры
			let formData = "code=" + arrayDataRow[0];
			formData += "&name=" + arrayDataRow[1];
			formData += "&price=" + arrayDataRow[2];
			formData += "&quantity=" + arrayDataRow[3];
			// выполняем Ajax запрос
			obj.runRequest("POST", "/addproduct", formData, "add");
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
			obj.runRequest("POST", "/delproduct", formData, "del");
		}
	}
//событие вызываемое при нажатии кнопки "картинка"
function ImageClick(object)
{
	//определяем строку для изменения  картинки
	let rowIndex = object.parentElement.parentElement.rowIndex;
	//обработчик выбора файлов
function fileOnChange(file)
{
	console.log("Имя файла -", file.target.files[0].name);
	console.log("Тип файла -", file.target.files[0].type);
	console.log("Размер файла -", file.target.files[0].size);
	console.log("Строка № - ", rowIndex);
	//Проверяем загружаемый файл - картинка
	if(file.target.files[0].type.substr(0,5) !='image') return;
	let reader = new FileReader();
	reader.onloadend = function()
	{
		//изменяем картинку в заданой строке и колонке №5
		object.parentNode.parentNode.cells[5].firstChild.src = reader.result;
	}
	reader.readAsDataURL(file.target.files[0]);
	//создаем aJax запрос
	let Request = obj.createRequest();
	if( Request != null)
	{
		//формурием передаваемые параметры
		let formData = new FormData();
		formData.append('id_product', rowIndex);
		formData.append('image', file.target.files[0]);
//иннициализируемый соединение
Request.open("POST", "/add_image_product", true);
Request.send(formData);
console.log(reader.result);
console.log("Картинка добавлена")
}
  file.preventDefault();
	}
	//создаем элемент выбора файла
	let fileElement = document.createElement('input');
	fileElement.type = 'file'
	//назначаем событию onchange элементу выбор файла(fileElement) обработчик fileOnChange
	fileElement.onchange = fileOnChange;
	//если выбор файла не активен, активируем выбор файла
	if (fileElement) fileElement.click();
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
	obj.Init("table_product", 0); // 0 - номер сортируемой колонки по умолчанию
</script>
</div>
