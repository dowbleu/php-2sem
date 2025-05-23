<?php
function getMenu(string $active, string $type): string
{
    $menuItems = [
        'view' => 'Просмотр',
        'add' => 'Добавление записи',
        'edit' => 'Редактирование записи',
        'delete' => 'Удаление записи'
    ];

    $sortItems = [
        'added' => 'По добавлению',
        'lastname' => 'По фамилии',
        'birthday' => 'По дате рождения'
    ];

    $html = '';
    // основное меню
    $html = '<nav class="main-menu">';
    foreach ($menuItems as $key => $label) {
        $class = ($active === $key) ? 'menu-item active' : 'menu-item';
        $href = ($key === 'view') ? "index.php?action=view&type={$type}&page=1" : "index.php?action={$key}";
        $html .= "<a href=\"{$href}\" class=\"{$class}\">{$label}</a>";
    }
    $html .= '</nav>';

    // подменю для сортировки
    if ($active === 'view') {
        $html .= '<div class="submenu">';
        foreach ($sortItems as $key => $label) {
            $class = ($type === $key) ? 'submenu-btn active' : 'submenu-btn';
            $href = "index.php?action=view&type={$key}&page=1";
            $html .= "<a href=\"{$href}\" class=\"{$class}\">{$label}</a>";
        }
        $html .= '</div>';
    }

    return $html;
}
