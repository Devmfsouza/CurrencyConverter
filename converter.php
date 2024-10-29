<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $from_currency = $_POST['from_currency'];
    $to_currency = $_POST['to_currency'];
    $amount = $_POST['amount'];

    // Chave da API
    $apiKey = 'cd5ae1298c51f328592a8d05';
    $apiUrl = "https://v6.exchangerate-api.com/v6/$apiKey/latest/$from_currency";

    // Obtendo os dados da API
    $response = file_get_contents($apiUrl);
    $data = json_decode($response, true);

    // Verificando se a resposta da API é válida
    if (isset($data['conversion_rates'][$to_currency])) {
        $rate = $data['conversion_rates'][$to_currency];
        $converted_amount = $amount * $rate;

        echo "<h2>$amount $from_currency é igual a $converted_amount $to_currency</h2>";
    } else {
        echo "<h2>Erro ao obter a cotação. Tente novamente mais tarde.</h2>";
    }
} else {
    header('Location: index.php');
}
