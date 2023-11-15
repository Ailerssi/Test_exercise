<?php
/**
  1. Есть плоский массив с элементами, содержащими уникальный идентификатор и идентификатор родительского элемента, необходимо построить "деревовидную" структуру. Пример:
    [
        [
            id: [0-9],
            parent_id: [0-9]
        ],
        ...
    ]
необходимо построить массив вида
    [
        [
            id: [0-9],
            childs: [
                [
                    id: [0-9],
                    childs: [
                    ...
                ]
          ],
          ...
        ]
    ],
      ...
  ];
 */
function buildTree(array $elements, $parentId = 0) {
    $branch = [];

    foreach ($elements as $element) {
        if ($element['parent_id'] == $parentId) {
            $children = buildTree($elements, $element['id']);
            if ($children) {
                $element['childs'] = $children;
            }
            $branch[] = $element;
        }
    }

    return $branch;
}

$flatArray = [
    ['id' => 1, 'parent_id' => 0],
    ['id' => 2, 'parent_id' => 1],
    ['id' => 3, 'parent_id' => 1],
    ['id' => 4, 'parent_id' => 2],
    ['id' => 5, 'parent_id' => 0],
    ['id' => 6, 'parent_id' => 5],
];


$tree = buildTree($flatArray);

// Выводим результат
echo '<pre>';
echo json_encode($tree, JSON_PRETTY_PRINT);
echo '</pre>';


/**
  2. Необходимо конвертировать чиcло в excel координату колонки. Пример:
  1 => A
  2 => B
  27 => AA
  28 => AB
 */


function Convert_To_Excel_Column($number) {
    $column = '';
    while ($number > 0) {
        $remind = ($number - 1) % 26;
        $column = chr(65 + $remind) . $column;
        $number = intdiv($number - $remind, 26);
    }
    return $column;
}


echo Convert_To_Excel_Column(1) . '<br>';
echo Convert_To_Excel_Column(2) . '<br>';
echo Convert_To_Excel_Column(27) . '<br>';
echo Convert_To_Excel_Column(600) . '<br>';


