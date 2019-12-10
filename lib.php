<?php
class human{
  function getName($gender="male"){ //picking a random name from names txt files based on gender
    if($gender == "male"){//erkek
      $filename = "data/names/man.txt";
      $file = fopen($filename, "r");
      $names = [];
      if ($file) {
         $names = explode("\n", fread($file, filesize($filename)));
      }
      fclose($file);
      array_pop($names);
      return $names[rand(1,count($names)-1)]; //-1 to prevent offset
    }
    else if($gender == "female"){//kadin
      $filename = "data/names/woman.txt";
      $file = fopen($filename, "r");
      $names = [];
      if ($file) {
         $names = explode("\n", fread($file, filesize($filename)));
      }
      fclose($file);
      array_pop($names);
      return $names[rand(1,count($names)-1)];
    }
    else if($gender == "unisex"){//unisex
      $filename = "data/names/unisex.txt";
      $file = fopen($filename, "r");
      $names = [];
      if ($file) {
         $names = explode("\n", fread($file, filesize($filename)));
      }
      fclose($file);
      array_pop($names);
      return $names[rand(1,count($names)-1)];
    }else{
      return "unexpected parameter. accepted parameters are: man, woman";
    }
  }
  function getSurname(){ //getting data from surnames txt file
      $filename = "data/names/surnames.txt";
      $file = fopen($filename, "r");
      $surnames = [];
      if ($file) {
         $surnames = explode("\n", fread($file, filesize($filename)));
      }
      fclose($file);
      array_pop($surnames);
      return $surnames[rand(1,count($surnames)-1)];
    }
  function getJob(){ //getting data from jobs txt file
    $filename = "data/jobs.txt";
    $file = fopen($filename, "r");
    $jobs = [];
    if ($file) {
       $jobs = explode("\n", fread($file, filesize($filename)));
    }
    fclose($file);
    array_pop($jobs);
    return trim($jobs[rand(1,count($jobs)-1)]);
  }
  function getLocation(){ //getting data from location txt file
    $filename = "data/locations.txt";
    $file = fopen($filename, "r") or die("Unable to open file!");
    $data = explode("\n", fread($file, filesize($filename)));
    fclose($file);
    $random = rand(0,969);
    $location = explode("\t", $data[$random]);
    return $location;
  }
  function getSalary(){ //generation random salary
    $info = [];
    (float)$minimum = 2558.40;
    (float)$salary = $minimum*((rand(1,10)/10)+(rand(1,3)));
    number_format($salary,2);
    return $salary;
  }
  function getPicture($gender = "male"){
    if($gender == "male"){
      $directory = 'pictures/man';
      $files = array_diff(scandir($directory), array('..', '.'));

      $data = [];
      foreach ($files as $name) {
          $path_parts = pathinfo('pictures/man/'.$name);
          array_push($data,$path_parts['filename']);
      }

      $strJsonFileContents = file_get_contents("pictures/credits_man.json");
      $json = json_decode($strJsonFileContents, true);

      $x = rand(1,90);
      $src = $data[$x];
      $user_name = $json[$data[$x]]["user_name"];
      $user_url = $json[$data[$x]]["user_url"];
      $photo_url = $json[$data[$x]]["photo_url"];

      return array(
        "src" => "pictures/man/".$src.".jpg",
        "user_name" => $user_name,
        "user_url" => $user_url,
        "photo_url" => $photo_url
      );
    }
    else if($gender == "female"){
      $directory = 'pictures/woman';
      $files = array_diff(scandir($directory), array('..', '.'));

      $data = [];
      foreach ($files as $name) {
          $path_parts = pathinfo('pictures/woman/'.$name);
          array_push($data,$path_parts['filename']);
      }

      $strJsonFileContents = file_get_contents("pictures/credits_woman.json");
      $json = json_decode($strJsonFileContents, true);

      $x = rand(1,90);
      $src = $data[$x];
      $user_name = $json[$data[$x]]["user_name"];
      $user_url = $json[$data[$x]]["user_url"];
      $photo_url = $json[$data[$x]]["photo_url"];

      return array(
        "src" => "pictures/woman/".$src.".jpg",
        "user_name" => $user_name,
        "user_url" => $user_url,
        "photo_url" => $photo_url
      );
    }
    else if($gender == "unisex"){
      $y = rand(1,2);
      if($y==1){
        $directory = 'pictures/man';
        $files = array_diff(scandir($directory), array('..', '.'));

        $data = [];
        foreach ($files as $name) {
            $path_parts = pathinfo('pictures/man/'.$name);
            array_push($data,$path_parts['filename']);
        }

        $strJsonFileContents = file_get_contents("pictures/credits_man.json");
        $json = json_decode($strJsonFileContents, true);

        $x = rand(1,90);
        $src = $data[$x];
        $user_name = $json[$data[$x]]["user_name"];
        $user_url = $json[$data[$x]]["user_url"];
        $photo_url = $json[$data[$x]]["photo_url"];

        return array(
          "src" => "pictures/man/".$src.".jpg",
          "user_name" => $user_name,
          "user_url" => $user_url,
          "photo_url" => $photo_url
        );
      }else{
        $directory = 'pictures/woman';
        $files = array_diff(scandir($directory), array('..', '.'));

        $data = [];
        foreach ($files as $name) {
            $path_parts = pathinfo('pictures/woman/'.$name);
            array_push($data,$path_parts['filename']);
        }

        $strJsonFileContents = file_get_contents("pictures/credits_woman.json");
        $json = json_decode($strJsonFileContents, true);

        $x = rand(1,90);
        $src = $data[$x];
        $user_name = $json[$data[$x]]["user_name"];
        $user_url = $json[$data[$x]]["user_url"];
        $photo_url = $json[$data[$x]]["photo_url"];

        return array(
          "src" => "pictures/woman/".$src.".jpg",
          "user_name" => $user_name,
          "user_url" => $user_url,
          "photo_url" => $photo_url
        );
      }
    }
  }
  function getBirthdate(){ //generation random birthdate
    $start = strtotime("1 January 1960");
    $end = strtotime("1 January 2000");
    $timestamp = mt_rand($start, $end);
    return date("d.m.Y", $timestamp);
  }
  function getAge($birthDate){ //calculating age from randomly generated birthdate
      $birthDate = explode(".", $birthDate);
      $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
        ? ((date("Y") - $birthDate[2]) - 1)
        : (date("Y") - $birthDate[2]));
      return $age;
  }
  function getMailAdress($name,$surname,$city){ //generating !totally! random e-mail adress
    $x = rand(1,7);
    switch ($x) {
      case 1:
        return strtolower(replace_tr($name.".".$surname."@ornek.com"));
        break;
      case 2:
        return strtolower(replace_tr($name.".".$surname.".".$city."@ornek.com"));
        break;
      case 3:
        return strtolower(replace_tr($name."_".$city."@ornek.com"));
        break;
      case 4:
        return strtolower(replace_tr($surname."_".$name."@ornek.com"));
        break;
      case 5:
        return strtolower(replace_tr($surname."_".$city."@ornek.com"));
        break;
      case 6:
        return strtolower(replace_tr($name."-".$city."@ornek.com"));
        break;
      default:
        return strtolower(replace_tr($city."_".$name."_".$city."@ornek.com"));
        break;
    }
  } //generating !totally! random e-mail based on some information
  function getMobileNumber(){ //generating !totally! random phone number
    return "+".rand(1,100)."".rand(1000000,9999999);
  }
  function getHobby(){ //getting 2 random hobbies
    $filename = "data/hobbies.txt";
    $file = fopen($filename, "r") or die("Unable to open file!");
    $hobbies = [];
    $data = explode("\n", fread($file, filesize($filename)));
    array_pop($data);
    fclose($file);
    $hobby1= trim($data[rand(30,145)]);
    $hobby2= trim($data[rand(0,145)]);
    $hobbies = ucfirst($hobby1)." ve ".ucfirst($hobby2);
    return $hobbies;
  }
  function getUsername($name,$surname,$city){
    $x = rand(1,7);
    switch ($x) {
      case 1:
        return strtolower(replace_tr($name."".$surname));
        break;
      case 2:
        return strtolower(replace_tr($name.$surname.".".$city));
        break;
      case 3:
        return strtolower(replace_tr($name."_".$city.rand(1,99)));
        break;
      case 4:
        return strtolower(replace_tr($surname."_".$name));
        break;
      case 5:
        return strtolower(replace_tr($surname."_".$city."".rand(1,99)));
        break;
      case 6:
        return strtolower(replace_tr($name."-".$city));
        break;
      default:
        return strtolower(replace_tr($city."_".$name.rand(1,99)));
        break;
    }
  } //creating username based on some data
  function getPassword(){//creating a 8 to 16 character long password
    $length = rand(8,16);
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
     $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
     for ($i = 0; $i < $length; $i++) {
         $n = rand(0, $alphaLength);
         $pass[] = $alphabet[$n];
   }
   return implode($pass); //turn the array into a string
  }
  function createProfile($gender="male"){ // creating a profile array
    $human = new human;
    $name = $human->getName("$gender");
    $surname = $human->getSurname();
    $job = $human->getJob();
    $location = $human->getLocation();
    $salary = $human->getSalary();
    $picture = $human->getPicture("$gender");
    $birthdate = $human->getBirthdate();
    $age = $human->getAge($birthdate);
    $mobile = $human->getMobileNumber();
    $hobbies = $human->getHobby();
    $mail = $human->getMailAdress($name,$surname,$location[2]);
    $username = $human->getUsername($name,$surname,$location[2]);
    $password = $human->getPassword();
    $picture = $human->getPicture("$gender");

    return array(
      'gender' => htmlspecialchars($gender),
      'name' => htmlspecialchars($name),
      'surname' => htmlspecialchars($surname),
      'job' => htmlspecialchars($job),
      'mail' => htmlspecialchars($mail),
      'username' => htmlspecialchars($username),
      'password' => htmlspecialchars($password),
      'city' => htmlspecialchars(ucwords_tr(mb_strtolower($location[2]))),
      'district' => htmlspecialchars(ucwords_tr(mb_strtolower($location[1]))),
      'salary' => htmlspecialchars($salary),
      'birthdate' => htmlspecialchars($birthdate),
      'age' => htmlspecialchars($age),
      'phone' => htmlspecialchars($mobile),
      'hobbies' => htmlspecialchars($hobbies),
      'picture_src' => htmlspecialchars($picture["src"]),
      'picture_username' => htmlspecialchars($picture["user_name"]),
      'picture_user_url' => htmlspecialchars($picture["user_url"])
    );
  }
}
function replace_tr($text) { //shoutout to https://www.kodevreni.com/639-php-t%C3%BCrk%C3%A7e-karakterleri-ingilizceye-d%C3%B6n%C3%BC%C5%9Ft%C3%BCrme/
   $text = trim($text);
   $search = array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü',' ');
   $replace = array('c','c','g','g','i','i','o','o','s','s','u','u','-');
   $new_text = str_replace($search,$replace,$text);
   return $new_text;
}
function ucwords_tr($gelen){//shoutout to https://ahmetimamoglu.com.tr/turkce-karakter-destekli-ucwords-fonksiyonu
  $sonuc='';
  $kelimeler=explode(" ", $gelen);
  foreach ($kelimeler as $kelime_duz){
    $kelime_uzunluk=strlen($kelime_duz);
    $ilk_karakter=mb_substr($kelime_duz,0,1,'UTF-8');
    if($ilk_karakter=='Ç' or $ilk_karakter=='ç'){
      $ilk_karakter='Ç';
    }elseif ($ilk_karakter=='Ğ' or $ilk_karakter=='ğ') {
      $ilk_karakter='Ğ';
    }elseif($ilk_karakter=='I' or $ilk_karakter=='ı'){
      $ilk_karakter='I';
    }elseif ($ilk_karakter=='İ' or $ilk_karakter=='i'){
      $ilk_karakter='İ';
    }elseif ($ilk_karakter=='Ö' or $ilk_karakter=='ö'){
      $ilk_karakter='Ö';
    }elseif ($ilk_karakter=='Ş' or $ilk_karakter=='ş'){
      $ilk_karakter='Ş';
    }elseif ($ilk_karakter=='Ü' or $ilk_karakter=='ü'){
      $ilk_karakter='Ü';
    }else{
      $ilk_karakter=strtoupper($ilk_karakter);
    }
    $digerleri=mb_substr($kelime_duz,1,$kelime_uzunluk,'UTF-8');
    $sonuc.=$ilk_karakter.kucuk_yap($digerleri).' ';
  }
  $son=trim(str_replace('  ', ' ', $sonuc));
  return $son;
}
function kucuk_yap($gelen){ //shoutout to https://ahmetimamoglu.com.tr/turkce-karakter-destekli-ucwords-fonksiyonu
  $gelen=str_replace('Ç', 'ç', $gelen);
  $gelen=str_replace('Ğ', 'ğ', $gelen);
  $gelen=str_replace('I', 'ı', $gelen);
  $gelen=str_replace('İ', 'i', $gelen);
  $gelen=str_replace('Ö', 'ö', $gelen);
  $gelen=str_replace('Ş', 'ş', $gelen);
  $gelen=str_replace('Ü', 'ü', $gelen);
  $gelen=strtolower($gelen);
  return $gelen;
}
?>
