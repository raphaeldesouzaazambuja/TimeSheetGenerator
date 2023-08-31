<?php
require 'vendor/autoload.php';
// require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

date_default_timezone_set('America/Sao_Paulo');

$currentMonth = date('n');
$currentYear = date('Y');
$numberOfDays;
$monthNamesPt = [
  1 => 'Janeiro',
  2 => 'Fevereiro',
  3 => 'Março',
  4 => 'Abril',
  5 => 'Maio',
  6 => 'Junho',
  7 => 'Julho',
  8 => 'Agosto',
  9 => 'Setembro',
  10 => 'Outubro',
  11 => 'Novembro',
  12 => 'Dezembro'
];

$data = [];

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

function locateDays($numberOfDays, &$data) // Passa o array por referência
{
  for ($day = 1; $day <= $numberOfDays; $day++) {
    $dayOfMonth = "$day";
    $dateString = date('Y-m') . '-' . $dayOfMonth;

    $dayOfWeek = date('w', strtotime($dateString));

    $entryAndExit = [
      "option1" => ["entry" => "07:50", "exit" => "13:50"],
      "option2" => ["entry" => "07:55", "exit" => "13:55"],
      "option3" => ["entry" => "08:00", "exit" => "14:00"],
      "option4" => ["entry" => "08:05", "exit" => "14:05"],
      "option5" => ["entry" => "08:10", "exit" => "14:10"]
    ];

    switch ($dayOfWeek) {
      case 0:
        // echo "$day Domingo\n";
        break;
      case 1:
        $option = array_rand($entryAndExit);

        // echo "$day ".$entryAndExit[$option]["entry"]."-". $entryAndExit[$option]["exit"]."\n";
        break;
      case 2:
        $option = array_rand($entryAndExit, 1);

        // echo "$day " .$entryAndExit[$option]["entry"] . " " . $entryAndExit[$option]["exit"] . "\n";
        break;
      case 3:
        $option = array_rand($entryAndExit, 1);

        // echo "$day " .$entryAndExit[$option]["entry"]." ". $entryAndExit[$option]["exit"]."\n";
        break;
      case 4:
        $option = array_rand($entryAndExit, 1);

        // echo "$day " .$entryAndExit[$option]["entry"] . " " . $entryAndExit[$option]["exit"] . "\n";
        break;
      case 5:
        $option = array_rand($entryAndExit, 1);

        // echo "$day " .$entryAndExit[$option]["entry"] . " " . $entryAndExit[$option]["exit"] . "\n";
        break;
      case 6:
        $option = array_rand($entryAndExit, 1);

        // echo "$day Sabado\n";
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

    p {
      text-align: left;
      margin-top: 10px;
      font-size: 12px;
    }

    .signature {
      display: flex; 
      justify-content: space-between; 
      align-items: center; 
      text-align: center; 
      margin-top: 10px; 
      font-size: 10px;"
    }
  </style>
</head>

<body>
  <div class="container">
    <table>
      <tr>
        <th colspan="1"><strong>NOME DO ESTAGIÁRIO</strong></th>
        <td colspan="1">Raphael de Souza Azambuja</td>
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
            <?= $dayData["day"] ?>
          </td>
          <?php if ($dayData["dayOfWeek"] == 0): ?>
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
    <div class="signature">
      <div>_______________________<br>ESTAGIÁRIO</div>
      <div>_______________________<br>RESPONSÁVEL</div>
    </div>
  </div>
</body>

</html>

<?php
$content = ob_get_clean();

// Crie uma nova instância do Dompdf
$dompdf = new Dompdf();

// Carregue o HTML no Dompdf
$dompdf->loadHtml($content);

// Defina o tamanho do papel e orientação (opcional)
$dompdf->setPaper('A4', 'portrait');

// Renderize o PDF
$dompdf->render();

// Saída do PDF
$dompdf->stream('registro_estagio.pdf', ['Attachment' => false]);
?>