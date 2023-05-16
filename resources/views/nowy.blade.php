<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 2px solid #1E90FF;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .question {
            margin-bottom: 15px;
        }

        h4 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        .answers label {
            display: block;
            margin-bottom: 10px;
        }

        .answers input[type="radio"] {
            margin-right: 5px;
        }

        button[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 15px;
            background-color: #1E90FF;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: 'Roboto', sans-serif;
            font-weight: bold;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <script>
        // Skrypt do wyświetlania alertów
        window.addEventListener('DOMContentLoaded', (event) => {
            let results = {!! json_encode(session('results')) !!};
            if (results) {
                let alertText = '';

                results.forEach(result => {
                    alertText += 'Pytanie: ' + result.pytanie + '\n';
                    alertText += 'Twoja odpowiedź: ' + result.userAnswer + '\n';
                    alertText += 'Poprawna odpowiedź: ' + result.correctAnswer + '\n\n';
                });

                alert(alertText);
            }
        });
    </script>
</head>
<body>
    <div class="container">
    <form action="{{ route('testy.submit', $test->id) }}" method="POST">
    @csrf
    @foreach ($pytania as $pytanie)
    <div class="question">
        <h4>{{ $pytanie->pytanie }}</h4><br>
        <div class="answers">
            @php
                $odpowiedzi = [$pytanie->odp1, $pytanie->odp2, $pytanie->odp3, $pytanie->odp4];
                shuffle($odpowiedzi);
            @endphp

            @foreach ($odpowiedzi as $odpowiedz)
            <label>
                <input type="radio" name="pytanie_{{ $pytanie->id }}" value="{{ $odpowiedz }}">
                {{ $odpowiedz }}
            </label>
            @endforeach
        </div>
    </div>
    @endforeach
    <button type="submit">Zatwierdź</button>
</form>
    </div>
   
</body>
</html>