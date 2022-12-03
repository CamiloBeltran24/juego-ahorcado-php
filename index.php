<?php
function clear() {
  if (PHP_OS === "WINNT") {
      system("cls");
  }
  else {
      system("clear");
  }
}

$possible_words = ["Bebida","Prisma","Goku","Frontend","Futbol","Dolor", "Asteroide","Pollito","Bacteria", "Bateria","Rectangulo"];

define("MAX_ATTEMPS", 6); //definimos las constante de intentos Maximos

echo "¡Juego del ahorcado! \n \n";

//Inicializamos el juego

$choosen_word = $possible_words[rand(1, count($possible_words))];
$choosen_word = strtolower($choosen_word);
$word_length = strlen($choosen_word);
$discovered_letters = str_pad("",$word_length,"_");
$attemps = 0;

do {
  
  echo "Palabra de $word_length letras \n";
  echo $discovered_letters. "\n\n";

  $player_letter = readline("Escribe una letra: ");
  $player_letter = strtolower($player_letter);

  if(str_contains($choosen_word, $player_letter)){
    //Verificamos todas las ocurrencias de esta letra para remplazarla 
    $offset = 0;
    while (($letter_position = strpos($choosen_word, $player_letter, $offset) ) !== false) {
      $discovered_letters[$letter_position] = $player_letter;
      $offset = $letter_position + 1; //aumentamos la posición en el string desde donde empezamos a validar nuevamente !
    }
  } else {
    clear();
    $attemps++;
    echo "Letra Incorrecta, Te quedan ".(MAX_ATTEMPS - $attemps).' intentos';

    sleep(2);
  }
  clear();


} while ($attemps < MAX_ATTEMPS &&  $discovered_letters  != $choosen_word);

clear();

if($attemps < MAX_ATTEMPS){
  echo "Felicidades ! Has adivinado la palabra \n\n";
}
else {
  echo "Suerte para la proxima \n\n";
}

echo "La palabra es $choosen_word\n";
echo "tu descubriste: $discovered_letters\n";
echo "\n";
