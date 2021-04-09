function CreateRequest()
{
	let request = null;
	try
	{
		request = new XMLHttpRequest();
	} catch(trymicrosoft)
	{
		try
		{
			request = new ActiveXObject("Msxml2.XMLHTTP");
		} catch(othermicrosoft)
		{
			try
			{
				// Fallback for IE5/6
				request = new ActiveXObject("Microsoft.XMLHTTP");
			} catch(failed)
			{
				request = null;
			}
		}
	}
	if(request == null) alert("Ошибка создания XMLHttpRequest!");
	return request;
}
/*
Metod - метод передачи данных (POST | GET)
Url - адрес на страницу или файл
formData - передаваемые параметры (например par1=1&par2=2&par3=3...)
_Handler - функция-обработчик ответа от сервера
*/
function SendRequest(Metod, Url, formData, _Handler)
{
	// Создаём запрос функция описана выше
	let Request = CreateRequest();
	// Проверяем существование запроса еще раз
	if(!Request) return;
	// Назначаем пользовательский обработчик
	Request.onreadystatechange = function()
	{
		// Если обмен данными завершен
		if(Request.readyState === 4)
		{
			if(Request.status === 200)
			{
				// Передаем управление обработчику пользователя
				_Handler(Request);
			} else
			{
				// Оповещаем пользователя о произошедшей ошибке
				alert("Error! Request status is " + Request.status);
			}
		} else
		{
			// Оповещаем пользователя о загрузке
		}
	}
	// Проверяем, если требуется сделать GET-запрос
	if(Metod.toLowerCase() == "get" && formData.length > 0) Url += "?" + formData;
	// Инициализируем соединение
	Request.open(Metod, Url, true);
	if(Metod.toLowerCase() == "post")
	{
		// Если это POST-запрос
		// Устанавливаем заголовок
		Request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=utf-8");
		// Посылаем запрос
		Request.send(formData);
	} else
	{
		// Если это GET-запрос
		// Посылаем нуль-запрос
		Request.send(null);
	}
}