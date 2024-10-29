<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Conversor de Moedas</title>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Conversor de Moedas</h1>
        <form id="currencyForm">
            <div class="form-group">
                <label for="from_currency">Moeda de Origem:</label>
                <select class="form-control" name="from_currency" id="from_currency">
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>
                    <option value="BRL">BRL</option>
                    <!-- Adicione mais opções conforme necessário -->
                </select>
            </div>

            <div class="form-group">
                <label for="to_currency">Moeda de Destino:</label>
                <select class="form-control" name="to_currency" id="to_currency">
                    <option value="BRL">BRL</option>
                    <option value="EUR">EUR</option>
                    <option value="USD">USD</option>
                    <!-- Adicione mais opções conforme necessário -->
                </select>
            </div>

            <div class="form-group">
                <label for="amount">Valor:</label>
                <input type="number" class="form-control" name="amount" id="amount" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Converter</button>
        </form>
        <div id="result" class="mt-4"></div>
    </div>

    <script>
        document.getElementById("currencyForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Impede o envio do formulário

            const fromCurrency = document.getElementById("from_currency").value;
            const toCurrency = document.getElementById("to_currency").value;
            const amount = document.getElementById("amount").value;

            // Chave da API
            const apiKey = 'SUA_CHAVE_API_AQUI';
            const apiUrl = `https://v6.exchangerate-api.com/v6/${apiKey}/latest/${fromCurrency}`;

            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    if (data.conversion_rates && data.conversion_rates[toCurrency]) {
                        const rate = data.conversion_rates[toCurrency];
                        const convertedAmount = (amount * rate).toFixed(2);
                        document.getElementById("result").innerHTML = `<h4>${amount} ${fromCurrency} é igual a ${convertedAmount} ${toCurrency}</h4>`;
                    } else {
                        document.getElementById("result").innerHTML = "<h4>Erro ao obter a cotação. Tente novamente mais tarde.</h4>";
                    }
                })
                .catch(error => {
                    document.getElementById("result").innerHTML = "<h4>Erro ao se conectar à API.</h4>";
                });
        });
    </script>
</body>

</html>