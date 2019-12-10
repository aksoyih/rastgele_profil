<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php include '../needed/include/head.html'; ?>
    <script src="https://kit.fontawesome.com/d120c0b89f.js"></script>
    <style>
    .table{
    width: auto;
    margin:auto;
  }
    </style>
  </head>
  <body>
    <?php
    include '../needed/include/navbar.html';

    if(isset($_GET['cinsiyet'])) {
      if($_GET['cinsiyet'] == "erkek")
        $cinsiyet = "erkek";
      else if($_GET['cinsiyet'] == "kadin")
        $cinsiyet = "kadin";
      else if($_GET['cinsiyet'] == "unisex")
        $cinsiyet = "unisex";
    }
    else {
      $x = rand(1,3);
      switch ($x) {
        case 1:
          $cinsiyet = "erkek";
          break;
        case 2:
          $cinsiyet = "kadin";
          break;
        default:
          $cinsiyet = "unisex";
          break;
      }
    }
    $json = file_get_contents("http://ihaksoy.com/rastgele_profil/api.php?cinsiyet=$cinsiyet");
    $data = json_decode($json,true);

    $fp = fopen("data/visitsProfile.txt", "r");
    $count = fread($fp, 1024);
    fclose($fp);
    $count = $count + 1;

    ?>

      <body>
        <div class="containter-fluid">
          <div class="row mt-4 mb-4">
            <div class="col-12 ml-2">
                  <center>
                    <a href="index.php?cinsiyet=erkek"><i class="fas fa-venus icon-3x" style="color:#00F;"></i></a>
                    <a href="index.php?cinsiyet=kadin"><i class="fas fa-mars icon-3x" style="color:#F00; margin-left:10px"></i></a>
                    <a href="index.php?cinsiyet=unisex"><i class="fas fa-venus-mars icon-3x" style="color:#000; margin-left:10px"></i></a>
                  </center>
              <table class="table">
                <tbody>
                  <tr>
                    <td colspan=2><center><img src="<?=$data["fotograf"]?>" class="img-thumbnail rounded <?php if($cinsiyet == "erkek") echo"border-primary"; else if($cinsiyet == "kadin") echo"border-danger"; else echo "border-dark";?>" width="300px" height="300px"></img>
                      <div class="blockquote-footer text-center mb-3 font-weight-lighter">credit: <a href="<?=$data["fotograf_credits_url"]?>"><?=$data["fotograf_credits_name"]?></a></div></center></td>
                  </tr>
                  <tr>
                    <td>Ad Soyad</td>
                    <td><?php echo $data["ad"]." ".$data["soyad"]?></td>
                  </tr>
                  <tr>
                    <td>Doğum Tarihi</td>
                    <td><?php echo $data["d_tarihi"]." / ".$data["yas"]." yaşında"?></td>
                  </tr>
                  <tr>
                    <td>Yaşadığı yer</td>
                    <td><?= $data["il"]." / ".$data["ilce"] ?></td>
                  </tr>
                  <tr>
                    <td>Meslek</td>
                    <td><?=$data["meslek"]?></td>
                  </tr>
                  <tr>
                    <td>Email</td>
                    <td><?= $data["mail"]?></td>
                  </tr>
                  <tr>
                    <td>Kullanıcı Adı</td>
                    <td><?=$data["kullanici_adi"]?></td>
                  </tr>
                  <tr>
                    <td>Şifre</td>
                    <td><?=$data["sifre"]?></td>
                  </tr>
                  <tr>
                    <td>Telefon No</td>
                    <td><?=$data["telefon"]?></td>
                  </tr>
                  <tr>
                    <td>Hobiler</td>
                    <td><?=$data["hobiler"]?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <footer class="page-footer font-small blue">

              <!-- Copyright -->
              <center><p><a href="about.php" class="btn btn-lg btn-primary mx-auto mb-0">Uygulama hakkında</a></p>
              <p><a href="api_info.php">API</a></p></center>
              <div class="blockquote-footer text-center mb-3 font-weight-lighter">Pictures used in this application are licensed under CC0 1.0 by <a href="https://www.unsplash.com">unsplash.com</a></div>
              <!-- Copyright -->

            </footer>
            </div>
          </div>
        </div>

        <?php
          include '../needed/include/footer.html';
          include '../needed/include/js.html';
          $fp = fopen("data/visitsProfile.txt", "w");
          fwrite($fp, $count);
          fclose($fp)
          ?>
      </body>
</html>
