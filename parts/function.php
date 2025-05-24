<?php
    function getMenuData(string $type){
        $menu = [];
        if(validateMenuType($type)){
            if($type ===  "header"){
                $menu = [
                    'home' = [
                        'name' => 'Domov',
                        'path' => 'index.php',
                    ],
                    'contact' = [
                        'name' => 'kontakt',
                        'path' => 'contact.php',
                    ],
                    'about' = [
                        'name' => '',
                        'path' => 'about.php',
                    ]
                    'shop' = [
                        'name' => '',
                        'path' => 'shop.php',
                    ]

                ];
            }
        }
        return $menu;
    }

    function printMenu(array $menu){
        foreach ($menu as $menuName => $manuData){
            echo '<li><a href = "'.$menuData['path'].'">'.$menuData['name']'</a>'
        }
    }
?>