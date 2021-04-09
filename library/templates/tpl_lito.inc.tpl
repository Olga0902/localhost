<div>
  <script type="text/javascript">
if {
  $sum = 0;
$result = $db->("SELECT" Zimni_vytraty_na_sto_km FROM paluvo);
foreach ($res->fetchAll(PDO::FETCH_COLUMN) as $Zimni_vytraty_na_sto_km) {
    $sum += array_sum(explode('|', $Zimni_vytraty_na_sto_km));
}

echo $sum;
}
	</script>

    </div>
