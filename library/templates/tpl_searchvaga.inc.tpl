<div align="center"><input type=text id="add_Vantazhopidjomnist" placeholder="Введіть необхідний  тоннаж авто" size="30"></div>
<br /><div align="center" id='ajax_result'></div>
<script type="text/javascript">
document.getElementById('add_Vantazhopidjomnist').addEventListener('keyup', function()
{
  //сщздаем функцию обработчик
  var Handler = function(Request)
  {
    let container = document.getElementById('ajax_result');
    container.innerHTML = Request.responseText;
  }
  let Vantazhopidjomnist = String(this.value);
  SendRequest("POST","/seach_avto", "ID=" + Vantazhopidjomnist, Handler );
});
</script>
