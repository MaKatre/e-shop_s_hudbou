<?php
    function getMenuData(string $type){
        $menu = [];
        if(validateMenuType($type)){
            if($type ===  "header"){
                $menu = [
                    'home' = [
                        'name' => 'home',
                        'path' => 'index.php',
                    ],
                    'contact' = [
                        'name' => 'contact',
                        'path' => 'contact.php',
                    ],
                    'about' = [
                        'name' => 'about',
                        'path' => 'about.php',
                    ]
                    'shop' = [
                        'name' => 'shop',
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