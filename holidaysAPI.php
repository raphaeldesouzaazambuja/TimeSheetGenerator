<?php
  //Holidays of Santa Catarina-Brazil 
  $response = file_get_contents('https://api.invertexto.com/v1/holidays/2023?token=4739|f4VZWlNjngV6z3Dk3J3XGYEyhJzEy86N&state=SC');
  
  $holidayMonth = [];
  $holidayDay = [];
  
  if ($response !== false) 
  {  
    $data = json_decode($response);

    if ($data !== null) 
    {
      foreach ($data as $holiday) 
      {
        $day = new DateTime($holiday->date);
        $month = new DateTime($holiday->date);

        $day = $day->format('d');
        $month = $month->format('m');

        if ($holiday->type == 'feriado')
        {
          array_push($holidayDay, $day);
          array_push($holidayMonth, $month);
        }
      }
    }  
  }   
?>
