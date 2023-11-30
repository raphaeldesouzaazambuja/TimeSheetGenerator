<?php
function locateDays($numberOfDays, &$data, $shift)
{
  for ($day = 1; $day <= $numberOfDays; $day++) 
  { 
    $dayOfMonth="$day" ; 
    $dateString=date('Y-m') . '-' . $dayOfMonth;
    
    $dayOfWeek=date('w', strtotime($dateString)); 
    
    switch ($shift) 
    {
      case 1:
        $entryAndExit = [
          "option1" => ["entry" => "07:50", "exit" => "13:50"],
          "option2" => ["entry" => "07:55", "exit" => "13:55"],
          "option3" => ["entry" => "08:00", "exit" => "14:00"],
          "option4" => ["entry" => "08:05", "exit" => "14:05"],
          "option5" => ["entry" => "08:10", "exit" => "14:10"]
        ];
        break;
      case 2:
        $entryAndExit = [
          "option1" => ["entry" => "10:50", "exit" => "16:50"],
          "option2" => ["entry" => "10:55", "exit" => "16:55"],
          "option3" => ["entry" => "11:00", "exit" => "17:00"],
          "option4" => ["entry" => "11:05", "exit" => "17:05"],
          "option5" => ["entry" => "11:10", "exit" => "17:10"]
        ];
        break;
      case 3:
        $entryAndExit = [
          "option1" => ["entry" => "12:50", "exit" => "16:50"],
          "option2" => ["entry" => "12:55", "exit" => "16:55"],
          "option3" => ["entry" => "13:00", "exit" => "17:00"],
          "option4" => ["entry" => "13:05", "exit" => "17:05"],
          "option5" => ["entry" => "13:10", "exit" => "17:10"]
        ];
        break;
    }

    switch ($dayOfWeek) 
    {
      case 0: //Domingo-Sunday
      break;
      case 1:
      $option = array_rand($entryAndExit);
      break;
      case 2:
      $option = array_rand($entryAndExit, 1);
      break;
      case 3:
      $option = array_rand($entryAndExit, 1);
      break;
      case 4:
      $option = array_rand($entryAndExit, 1);
      break;
      case 5:
      $option = array_rand($entryAndExit, 1);
      break;
      case 6: //Sábado-Saturday
      $option = array_rand($entryAndExit, 1);
      break;
    }

    $data[$day] = [
      "day" => $day,
      "dayOfWeek" => $dayOfWeek,
      "entry" => $entryAndExit[$option]["entry"],
      "exit" => $entryAndExit[$option]["exit"]   
    ];
  }
}