<?php
function calculateTrigonometric($function, $param) {
    // Градусы в радианы
    $rad = deg2rad($param);
    
    // Доступные тригонометрические функции
    $trigFunctions = [
        'sin' => fn($x) => sin($x),
        'cos' => fn($x) => cos($x),
        'tan' => fn($x) => tan($x),
        'cot' => fn($x) => 1 / tan($x),
        'sec' => fn($x) => 1 / cos($x),
        'csc' => fn($x) => 1 / sin($x),
    ];
    
    $function = strtolower($function);
    
    if (isset($trigFunctions[$function])) {
        return $trigFunctions[$function]($rad);
    }
    
    return 0; // Если функция не найдена :(
}
?>