<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Аргунов Денис Сергеевич 241-321 Solve</title>
</head>
<body>
    <?php
        $equation = "22 * X = 220";

        echo "Исходное уравнение: " . $equation . "<br><br>";

        // Разбиваем уравнение по пробелам
        $parts = explode(' ', $equation);
        $leftOperand = $parts[0]; // 22
        $operator = $parts[1]; // *
        $rightOperand = $parts[2]; // X
        $result = $parts[4]; // 220

        // Узнаем где X
        if ($leftOperand == "X") {
            $position = 'left';
            $knownValue = $rightOperand;
        } elseif ($rightOperand == 'X') {
            $position = 'right';
            $knownValue = $leftOperand;
        } else {
            die("Неизвестная переменная X не найдена в уравнении");
        }

        echo "Оператор: " . $operator . "<br>";
        echo "Неизвестная X находится на " . ($position == 'left' ? "левой" : "правой") . " стороне уравнения<br>";

        // Решаем уравнение в зависимости от оператора
        switch ($operator) {
            case '+':
                $x = ($position == 'right') ? ($result - $knownValue) : ($result - $knownValue);
                break;
            case '-':
                $x = ($position == 'right') ? ($knownValue - $result) : ($result + $knownValue);
                break;
            case '*':
                $x = ($position == 'right') ? ($result / $knownValue) : ($result / $knownValue);
                break;
            case '/':
                $x = ($position == 'right') ? ($knownValue / $result) : ($result * $knownValue);
                break;
            default:
                die("Неизвестный оператор: " . $operator);
        }

        echo "Решение: X = " . $x;
    ?>
</body>
</html>