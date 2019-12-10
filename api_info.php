<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php require '../needed/include/head.html'; ?>
  <body>
<!-- navbar -->
<?php require '../needed/include/navbar.html';
$fp = fopen("data/visits.txt", "r");
$count = fread($fp, 1024);
fclose($fp);
?>
<!-- navbar -->

<!-- body -->
<div class="containter-fluid ml-2">
  <div class="row mt-5 mb-5 pl-2">
    <div class="col-12">
      <h3>Rastgele Profil Oluşturma / <b class="text-danger">API</b></h3>
    </div>
    <div class="col-12 pt-3 pb-2">
      <p>Bu API ile JSON formatında rastgele profil verisi elde edebilirsiniz.</p>
      <p>JSON verisinin doğruluğu <a href="https://jsonlint.com/">www.jsonlint.com</a> adresi üzerinden teyit edilebilir.</p>

      <p>Kabul edilen parametreler:
      <ul>
        <li></i>cinsyet = (erkek,kadin ve unisex)</i></li>
        <li></i>adet = (istenilen sayıda profil, tam sayı)</i></li>
      </ul></p>
      <p>Örnek kullanım:</p>
      <p>
        <ul>
          <li>Erkek profili için: <a href="api.php?cinsiyet=erkek"><b>http://ihaksoy.com/rastgele_profil/api.php?cinsiyet=erkek</b></a></li>
          <li>Kadın profili için: <a href="api.php?cinsiyet=kadin"><b>http://ihaksoy.com/rastgele_profil/api.php?cinsiyet=kadin</b></a></li>
          <li>Unisex profil için: <a href="api.php?cinsiyet=unisex"><b>http://ihaksoy.com/rastgele_profil/api.php?cinsiyet=unisex</b></a></li>
          <li>Belirtilen sayıda profil için: <a href="api.php?adet=10"><b>http://ihaksoy.com/rastgele_profil/api.php?adet=10</b></a></li>
        </ul>
        <i>Önemli: Herhangi bir parametre girilmeden (<b>örnek: <a href="http://ihaksoy.com/rastgele_profil/api.php">http://ihaksoy.com/rastgele_profil/api.php</a></b>) rastegele cinsiyet belirlenir.</i></p>
        <p class="text-muted">Toplam API istekleri: <b><?= $count?></b></p>
  </div>

  <div class="col-9 mt-3">
  <p>API kaynak kodları</p>
  <button class="btn btn-primary" data-clipboard-action="copy" data-clipboard-target="#code">Kodu Kopyala</button><br>
  <p class="text-muted"> last modified: <?= date("d m Y", filemtime("api.php"))?></p>
  </div>


  <div class="col-12 ml-2 bg-light" id="code">
    <?php
    highlight_file("api.php");
    ?>
  </div>
  </div>
</div>
<?php include '../needed/include/footer.html'; ?>
<?php require '../needed/include/js.html'; ?>
<script src="../needed/clipboard.js-master/dist/clipboard.min.js"></script>
<script>
    var clipboard = new ClipboardJS('.btn');

    clipboard.on('success', function(e) {
        console.log(e);
        showTooltip(event.trigger, 'copied!');
    });

    clipboard.on('error', function(e) {
        console.log(e);
    });

    </script>
  </body>
</html>
