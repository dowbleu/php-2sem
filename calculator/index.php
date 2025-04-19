<?php
if (isset($_GET['expression'])) {
  $expression = $_GET['expression'];

  // Убираем лишние пробелы и заменяем -- на +
  $expression = str_replace(" ", "", $expression);
  $expression = str_replace("--", "+", $expression);

  // Функция для вычисления выражения
  function evaluate($expr)
  {
    return calculate($expr, 0, strlen($expr) - 1);
  }

  // Рекурсивная функция для вычисления
  function calculate($expr, $start, $end)
  {
    $num = 0;
    $op = '+';
    $stack = [];
    $i = $start;

    while ($i <= $end) {
      $ch = $expr[$i];

      if (is_numeric($ch)) { // Если цифра
        $num = $num * 10 + (int)$ch;
      } elseif ($ch == '(') { // Если открывающая скобка, рекурсивно вычисляем
        $openCount = 1;
        $subStart = $i + 1;
        $subEnd = $i + 1;
        while ($openCount > 0) {
          if ($expr[$subEnd] == '(') {
            $openCount++;
          } elseif ($expr[$subEnd] == ')') {
            $openCount--;
          }
          $subEnd++;
        }
        $subExpr = substr($expr, $subStart, $subEnd - $subStart - 1);
        $num = calculate($subExpr, 0, strlen($subExpr) - 1);
        $i = $subEnd - 1; // Перемещаем индекс в конец подвыражения
      }

      if ($i == $end || in_array($expr[$i], ['+', '-', '*', '/'])) { // Если операторы
        if ($op == '+') {
          array_push($stack, $num);
        } elseif ($op == '-') {
          array_push($stack, -$num);
        } elseif ($op == '*') {
          $stack[count($stack) - 1] *= $num;
        } elseif ($op == '/') {
          if ($num == 0) {
            return 'Ошибка: деление на ноль';
          }
          $stack[count($stack) - 1] /= $num;
        }

        $op = $expr[$i];
        $num = 0;
      }

      $i++;
    }

    // Возвращаем сумму всех чисел в стеке
    return array_sum($stack);
  }

  // Вызов функции и вывод результата
  $result = evaluate($expression);
  echo json_encode(['result' => $result]);
  exit;
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Калькулятор на PHP</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f7f6;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    #calculator {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      width: 350px;
      text-align: center;
    }

    #display {
      width: 100%;
      height: 60px;
      font-size: 32px;
      text-align: right;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ddd;
      border-radius: 8px;
      background-color: #f9f9f9;
      box-sizing: border-box;
      color: #333;
      font-weight: bold;
    }

    .buttons {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 15px;
    }

    button {
      padding: 20px;
      font-size: 24px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      background-color: #f1f1f1;
      transition: background-color 0.2s ease-in-out, transform 0.2s ease;
    }

    button:hover {
      background-color: #ddd;
      transform: scale(1.1);
    }

    button:active {
      background-color: #ccc;
    }

    .clearBtn {
      background-color: #f76c6c;
      color: white;
      grid-column: 3/4;
    }

    .equallyBtn {
      background-color: #4CAF50;
      color: white;
      grid-column: 4/5;
    }

    .clearBtn:hover {
      background-color: #f44336;
    }

    .equallyBtn:hover {
      background-color: #45a049;
    }

    .W {
      cursor: default;
      color: white;
      grid-column: 1/3;
      background-color: rgb(66, 66, 66);
    }

    .W:hover {
      color: black;
      transform: scale(1.0);
    }
  </style>
</head>

<body>
  <div id="calculator">
    <div id="display"></div>
    <div class="buttons">
      <button onclick="append('7')">7</button>
      <button onclick="append('8')">8</button>
      <button onclick="append('9')">9</button>
      <button onclick="append('/')">/</button>

      <button onclick="append('4')">4</button>
      <button onclick="append('5')">5</button>
      <button onclick="append('6')">6</button>
      <button onclick="append('*')">*</button>

      <button onclick="append('1')">1</button>
      <button onclick="append('2')">2</button>
      <button onclick="append('3')">3</button>
      <button onclick="append('-')">-</button>

      <button onclick="append('0')">0</button>
      <button onclick="append('(')">(</button>
      <button onclick="append(')')">)</button>
      <button onclick="append('+')">+</button>

      <button class="W">dowbleu ©</button>
      <button class="clearBtn" onclick="clearDisplay()">C</button>
      <button class="equallyBtn" onclick="calculate()">=</button>
    </div>
  </div>

  <script>
    const display = document.getElementById('display');

    function append(value) {
      display.textContent += value;
    }

    function clearDisplay() {
      display.textContent = '';
    }

    function calculate() {
      const expression = display.textContent;

      fetch(`?expression=${encodeURIComponent(expression)}`)
        .then(res => res.json())
        .then(data => {
          display.textContent = data.result;
        })
        .catch(err => {
          display.textContent = 'Ошибка';
          console.error(err);
        });
    }
  </script>
</body>

</html>