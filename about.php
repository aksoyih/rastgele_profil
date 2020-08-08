<!DOCTYPE html>
<html lang="tr" dir="ltr">
<head>
<?php
require_once("../include/head.php");
?>
    <style>
    html{
      width:100%;
      overflow-x: hidden;
    }
    .col-11 mb-1 mt-3{
      width:80%;
    }
    </style>
</head>

  <body>
<!-- navbar -->
<?php
function getFileSize($file)
    {
        $bytes = filesize($file);

        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}
require_once("../include/navbar.php");
?>
<!-- navbar -->

<!-- body -->
<div class="containter-fluid ml-2 mb-3">
  <div class="row mt-5 mb-5 pl-2">
    <div class="col-12">
      <h1>Rastgele Profil Oluşturma</h1>
    </div>
    <div class="col-12 pt-3 pb-2">
      <p>Bu uygulama ile cinsiyete göre rastgele profil oluşturabilirsiniz.</p>
      <p>Uygulamada kullanılan veriler (isim ve soyadları, iller ve ilçeler, meslekler ve hobiler) aşağıda indirilebilir.</p>
      <p>Uygulamada kullanılan profil fotoğrafları CC0 1.0 lisansı altında <a href="https://www.unsplash.com">unsplash.com</a> sitesinden alınmıştır.</p>
      <p><a href="index.php" class="btn btn-lg btn-primary mx-auto mb-3 mt-3">Uygulamaya geri dön</a>  <a href="api_info.php" class="btn btn-lg btn-primary mx-auto mb-3 mt-3">API</a></p>

      <div class="col-10 ml-2 border">
        <p class="pt-2">Todo List</p>
          <ul>
            <li>hobilerin iyileştirilmesi
              <ul><li>Türkçeleştirme</li></ul>
            </li>
              <li><strike>api eklenmesi</strike>
                <ul><strike><li>JSON çoklu profil</li></strike></ul>
            </li>
          </ul>
      </div>
    </div>


    <div class="col-10 ml-2 border">
      <p class="pt-2">İndirilebilir dosyalar</p>
      <ul>
      <li><b><a href="data/names/names.zip" download>İsimler ve Soyadları</a></b> <?php echo "(kadın, erkek, unisex isimleri ve soyadları olarak 4 TXT dosyasını içeren ZIP dosyası - boyut: ".getFileSize("data/names/names.zip");?>)</li>
      <li><b><a href="data/locations.txt" download>İller ve İlçeler</a></b> <?php echo " (boyut: ".getFileSize("data/locations.txt");?>)</li>
      <li><b><a href="data/hobbies.txt" download>Hobiler</a></b> <?php echo " (boyut: ".getFileSize("data/hobbies.txt");?>)</li>
      <li><b><a href="data/jobs.txt" download>Meslekler</a></b> <?php echo " (boyut: ".getFileSize("data/jobs.txt");?>)</li>

    </ul>
    </div>

    <div class="col-9 mt-3">
    <p>Uygulamada kullandığım fonksiyonlar aşağıdadır:</p>
    <button class="btn btn-primary" data-clipboard-action="copy" data-clipboard-target="#code">Kodu Kopyala</button><br>
    <p class="text-muted"> last modified: <?= date("d m Y", filemtime("lib.php"))?></p>

    </div>
    </div>

    <div class="col-11 bg-light" id="code">
      <?php
      highlight_file("lib.php");
      ?>
    </div>

  </div>
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

<?php
require_once("../include/footer.php");
?>
  </body>
</html>
