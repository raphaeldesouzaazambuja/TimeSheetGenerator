<?php
require 'vendor/autoload.php';
require './holidaysAPI.php';
require './locateDays.php';

use Dompdf\Dompdf;

date_default_timezone_set('America/Sao_Paulo');

$currentMonth = date('n');
$currentYear = date('Y');
$data = [];
$numberOfDays;

$monthNamesPt = [ 1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril', 5 => 'Maio', 6 => 'Junho', 7 => 'Julho', 8 => 'Agosto',
  9 => 'Setembro',
  10 => 'Outubro',
  11 => 'Novembro',
  12 => 'Dezembro'
];

switch ($currentMonth) {
  case 1: // January
  case 3: // March
  case 5: // May
  case 7: // July
  case 8: // August
  case 10: // October
  case 12: // December
    $numberOfDays = 31;
    break;

  case 4: // April
  case 6: // June
  case 9: // September
  case 11: // November
    $numberOfDays = 30;
    break;

  case 2: // February
    $currentYear % 4 === 0 && ($currentYear % 100 !== 0 || $currentYear % 400 === 0) ? $numberOfDays = 29 : $numberOfDays = 28;
    break;

  default:
    echo "How did you end up here?";
    break;
}

locateDays($numberOfDays, $data);

ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de Estágio</title>
   <style>
    body {
      width: 100vw;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .container {
      width: 80%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      margin-left: 10%;
      margin-top: 5%;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      border: 1px solid black;
      padding: 2px;
      text-align: center;
      font-size: 12px;
    }

    td>p {
      text-align: left;
      margin-top: 10px;
      font-size: 12px;
    }

    .signature{
      display: flex;
      flex-direction: row;
      justify-content: center;
    }

    
  </style>
</head>

<body>
  <div class="container">
    <table>
      <tr>
        <th colspan="1"><strong>NOME DO ESTAGIÁRIO</strong></th>
        <td colspan="1">maxuel</td>
      </tr>
      <tr>
        <th colspan="1"><strong>LOCAL DE TRABALHO</strong></th>
        <td colspan="1">Diretoria Executiva de TI</td>
      </tr>
      <tr>
        <th colspan="1"><strong>HORÁRIO DE ESTÁGIO</strong></th>
        <td colspan="1">8h-14h</td>
      </tr>
      <tr>
        <th colspan="1"><strong>RESPONSÁVEL DO SETOR</strong></th>
        <td colspan="1">Kerolen Abgail Assunção Vieira de S.</td>
      </tr>
      <tr>
        <th colspan="1"><strong>MÊS DE REFERÊNCIA</strong></th>
        <th colspan="1"><?= $monthNamesPt[$currentMonth] ?></th>
      </tr>
    </table>

    <table>
      <tr>
        <th>DIA</th>
        <th>MANHÃ - ENTRADA</th>
        <th>MANHÃ - SAÍDA</th>
        <th>TARDE - ENTRADA</th>
        <th>TARDE - SAÍDA</th>
      </tr>
      <?php foreach ($data as $dayData): ?>
        <tr>
          <td>
            <?php
              $day = $dayData["day"];
              $month = $currentMonth;
              $isHoliday = false;

              for ($i = 0; $i < count($holidayDay); $i++) 
              {
                if ($holidayMonth[$i] == $month && $holidayDay[$i] == $day) 
                {
                  $isHoliday = true;
                  break;
                }
              }

              if ($isHoliday) 
              {
                echo $day;
              } 
              else 
              {
                echo $dayData["day"];
              }
            ?>
          </td>
          <?php if ($isHoliday): ?>
            <td>Feriado</td>
            <td>-</td>
            <td>-</td>
            <td>Feriado</td>
          <?php elseif ($dayData["dayOfWeek"] == 0): ?>
            <td>Domingo</td>
            <td>-</td>
            <td>-</td>
            <td>Domingo</td>
          <?php elseif ($dayData["dayOfWeek"] == 6): ?>
            <td>Sábado</td>
            <td>-</td>
            <td>-</td>
            <td>Sábado</td>
          <?php else: ?>
            <td>
              <?= $dayData["entry"] ?>
            </td>
            <td>-</td>
            <td>-</td>
            <td>
              <?= $dayData["exit"] ?>
            </td>
          <?php endif; ?>
        </tr>
      <?php endforeach; ?>

      <tr>
        <td colspan="5">
          <p><strong>REGISTRAR AQUI ATESTADOS, JUSTIFICATIVAS E O QUAISQUER SITUAÇÃO ANORMAL.</strong></p>
        </td>
      </tr>
      <tr>
        <td colspan="5">
          <p><strong>OBRIGATÓRIO ENTREGAR NO DPTO. DE PESSOAS ATÉ O DIA 10 DO MÊS SEGUINTE AO MÊS DE REFERÊNCIA, O NÃO
              RECEBIMENTO IMPLICARÁ A SUSPENSÃO DE SEUS PROVENTOS.</strong></p>
        </td>
      </tr>

    </table>
    <br><br>
    <pre>  _________________________    _________________________</pre>
    <pre>         ESTAGIÁRIO                   RESPONSÁVEL       </pre>
    
  </div>
</body>

</html>

<?php
$content = ob_get_clean();
$dompdf = new Dompdf();
$dompdf->loadHtml($content);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

if (!is_dir("./files")){
  mkdir("./files");
  echo "sus";
}

$pdfPath = "files/maxuel.pdf";

file_put_contents($pdfPath, $dompdf->output());
?>