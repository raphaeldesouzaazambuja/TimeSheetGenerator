<?php
function locateDays($numberOfDays, &$data)
{
for ($day = 1; $day <= $numberOfDays; $day++) { $dayOfMonth="$day" ; $dateString=date('Y-m') . '-' . $dayOfMonth;
  $dayOfWeek=date('w', strtotime($dateString)); $entryAndExit=[ "option1"=> ["entry" => "07:50", "exit" => "13:50"],
  "option2" => ["entry" => "07:55", "exit" => "13:55"],
  "option3" => ["entry" => "08:00", "exit" => "14:00"],
  "option4" => ["entry" => "08:05", "exit" => "14:05"],
  "option5" => ["entry" => "08:10", "exit" => "14:10"]
  ];

  switch ($dayOfWeek) {
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