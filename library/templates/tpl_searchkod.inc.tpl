<div align="center"><input type=text id="add_code" placeholder="Введіть штрих-код" size="30"></div>
<br /><div align="center" id='ajax_result'></div>
<script type="text/javascript">
document.getElementById('add_code').addEventListener('keyup', function()
{
  //сщздаем функцию обработчик
  var Handler = function(Request)
  {
    let container = document.getElementById('ajax_result');
    container.innerHTML = Request.responseText;
  }
  let code = String(this.value);
  SendRequest("POST","/seach_product", "id_code=" + code, Handler );
});
</script>
