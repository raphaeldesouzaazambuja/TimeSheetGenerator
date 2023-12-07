# Sistema de Controle de Ponto para Estagiários

Este é um script PHP em desenvolvimento, sua função é gerar automaticamente a folha de ponto dos estagiários da empresa onde trabalho, levando em consideração feriados regionais e fins de semana. O script utiliza a biblioteca Dompdf para gerar um arquivo PDF com as informações da folha de ponto.

## Funcionalidades

1. **Registro de Ponto:**
   - Os estagiários têm suas marcações de ponto geradas automaticamente com base no turno e horário de trabalho designados.

2. **Validação de Feriados Regionais:**
   - Utiliza uma API externa para obter informações sobre feriados regionais, garantindo que os estagiários não registrem ponto em dias de feriado.

3. **Consideração de Fins de Semana:**
   - Leva em consideração os fins de semana, ajustando as marcações de ponto para refletir a jornada de trabalho apenas nos dias úteis.

4. **Geração de Relatório em PDF:**
   - Gera um arquivo PDF personalizado para cada estagiário, contendo informações detalhadas sobre as marcações de ponto do mês.

## Uso

1. **Configuração:**
   - O script utiliza a biblioteca Dompdf. Certifique-se de ter o Composer instalado e execute `composer install` para instalar as dependências.

2. **Configuração da API de Feriados:**
   - O script utiliza uma API externa para obter informações sobre feriados. Certifique-se de que a URL da API está correta e que você tem permissão para acessá-la.

3. **Execução do Script:**
   - Execute o script PHP para gerar as folhas de ponto dos estagiários. Os arquivos PDF serão salvos no diretório `./files`.

## Configuração Personalizada

- O script contém informações específicas dos estagiários, como nome, turno e horário de trabalho. Certifique-se de atualizar essas informações conforme necessário.

- Personalize o estilo do PDF ajustando as classes CSS no início do script, se desejado.

## Contribuições

Contribuições são bem-vindas! Sinta-se à vontade para melhorar e expandir este script para atender às necessidades específicas da sua empresa.
