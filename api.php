<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if(isset($_GET['cinsiyet'])){ //check if cinsiyet parameter value is set
  $GETgender = $_GET['cinsiyet'];
  if (($GETgender == "erkek")||($GETgender == "kadin")||($GETgender == "unisex")) { //if cinsiyet parameter value is erkek, kadin or unisex
    $statusCinsiyetCinsiyet = false; //backup status, if something goes wrong
    if($GETgender == "erkek"){ //cinsiyet = erkek
      $gender = "male";
      $cinsiyet = "Erkek";//for displaying purposes
      $statusCinsiyet = true;//no errors, first green light to create profile
    }
    else if($GETgender == "kadin"){//cinsiyet = kadin
      $gender = "female";
      $cinsiyet = "Kadın";
      $statusCinsiyet = true;
    }
    else {//cinsiyet = unisex
      $gender = "unisex";
      $cinsiyet = "Unisex";
      $statusCinsiyet = true;
    }

  }
  else{//cinsiyet parameter value is not erkek, kadin or unisex
    $statusCinsiyet = false;//error encountered, red light. stops creating the profile
    $errorCinsiyet = "kabul edilmeyen <b>cinsyet</b> parametresi<br>kabul edilen değerler: <b>erkek,kadin,unisex</b>";
  }
}
else{// cinsiyet parameter is not set
  $x = rand(1,3);//creating random number between 1-3
  switch ($x) { //1:erkek , 2:kadin , 3:unisex
    case 1:
      $gender = "male";
      $cinsiyet = "Erkek";
      break;
    case 2:
      $gender = "female";
      $cinsiyet = "Kadın";
      break;
    default:
      $gender = "unisex";
      $cinsiyet = "Unisex";
      break;
  }
  $statusCinsiyet = true;//no errors, first green light to create profile
}

if(isset($_GET['adet'])){//check if adet parameter value is set
  if(is_numeric($_GET['adet'])){//check if the parameter value is numeric
  $amount = $_GET['adet'];
  $statusAdet = true; //no errors, second green light to create profile
}else{ //parameter value is not numeric
    $statusAdet = false; //error encountered, red light. stops creating the profile
    $errorAdet = "kabul edilmeyen <b>adet</b> parametresi değeri.<br>kabul edilen değerler: <b>tam sayılar.</b>";
  }
}
else{ //parameter is not set
  $amount = 1; //generate 1 profile by default
  $statusAdet = true; //no errors, second green light to create profile
}


if(($statusCinsiyet === true)&&($statusAdet===true)){ //checks for both green lights to create profile

  include 'lib.php';

  if($amount > 1){ //if multiple profiles are requested
  $data = []; //initializing array to store multiple profiles
  for ($i=1; $i <= $amount ; $i++) { //loop to specified amount

    $human = new human; //create human object
    $profile = $human->createProfile($gender); //creates a profile from human

      array_push($data,$json = (object) [ //adding created profile as JSON object to the array
        'cinsiyet' => $cinsiyet,
        'ad' => $profile["name"],
        'soyad' => $profile["surname"],
        'meslek' => $profile["job"],
        'mail' => $profile["mail"],
        'kullanici_adi' => $profile["username"],
        'sifre' => $profile["password"],
        'il' => $profile["city"],
        'ilce' => $profile["district"],
        'maas' => $profile["salary"],
        'd_tarihi' => $profile["birthdate"],
        'yas' => $profile["age"],
        'telefon' => $profile["phone"],
        'hobiler' => $profile["hobbies"],
        'fotograf' => "http://www.ihaksoy.com/projects/rastgele_profil/".$profile["picture_src"],
        'fotograf_credits_name' => $profile['picture_username'],
        'fotograf_credits_url' => $profile['picture_user_url']
      ]);
    }
  }else{ //no amount specified, printing only one JSON object
    $human = new human;
    $profile = $human->createProfile($gender);

    $data = (object) [
        'cinsiyet' => $cinsiyet,
        'ad' => $profile["name"],
        'soyad' => $profile["surname"],
        'meslek' => $profile["job"],
        'mail' => $profile["mail"],
        'kullanici_adi' => $profile["username"],
        'sifre' => $profile["password"],
        'il' => $profile["city"],
        'ilce' => $profile["district"],
        'maas' => $profile["salary"],
        'd_tarihi' => $profile["birthdate"],
        'yas' => $profile["age"],
        'telefon' => $profile["phone"],
        'hobiler' => $profile["hobbies"],
        'fotograf' => "http://www.ihaksoy.com/projects/rastgele_profil/".$profile["picture_src"],
        'fotograf_credits_name' => $profile['picture_username'],
        'fotograf_credits_url' => $profile['picture_user_url']
      ];
  }
    header('Content-type: application/json; charset=UTF-8');
    echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES); //printing created data

      $fp = fopen("data/visits.txt", "r"); //counting total api requests for display purposes
      $count = fread($fp, 1024);
      fclose($fp);
      $count = $count + 1;
      $fp = fopen("data/visits.txt", "w");
      fwrite($fp, $count);
      fclose($fp);


  }else{ //handle errors
    if ((isset($errorAdet))&&(isset($errorCinsiyet))){ //if both of checks are false
    echo "hata 1: ".$errorCinsiyet."<br><br>hata 2: ".$errorAdet; //print both of errors
    }
    else if (isset($errorAdet)){//only one error
    echo "hata : ".$errorAdet;//print the error
    }
    else{
    echo "hata : ".$errorCinsiyet;
    }
  }

?>
