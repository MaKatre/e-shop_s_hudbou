<?php
class Menu {

    private $menu_items;
    
    public function __construct($menu_items = []) {
        if(empty($menu_items)) {
            $menu_items = [
                ['label' => 'Home', 'link' => 'index.php'],
                ['label' => 'About', 'link' => 'about.php'],
                ['label' => 'Shop', 'link' => 'shop.php'],
                ['label' => 'Contact', 'link' => 'contact.php']
            ];
        }
        $this->menu_items = $menu_items;
    }

    public function getMenuItems() {
        return $this->menu_items;
    }
    
    //Metóda na generovanie html pre menu (Môžete poďakovať contact.php)
    public function generateMenu($current_page = '') {
        $html = '';
        foreach($this->menu_items as $item) {
            $active_class = '';
            
            // Add active class if this is the current page
            if($current_page && $current_page === $item['link']) {
                $active_class = ' active';
            }
            
            $html .= '<li class="nav-item">';
            $html .= '<a class="nav-link' . $active_class . '" href="' . htmlspecialchars($item['link']) . '">';
            $html .= htmlspecialchars($item['label']);
            $html .= '</a>';
            $html .= '</li>';
        }
        return $html;
    }
    
    //alternatívna metóda na vytvorenie custome css
    public function generateCustomMenu($css_classes = 'nav-link', $current_page = '') {
        $html = '';
        foreach($this->menu_items as $item) {
            $active_class = '';
            if($current_page && $current_page === $item['link']) {
                $active_class = ' active';
            }
            
            $html .= '<li class="nav-item">';
            $html .= '<a class="' . $css_classes . $active_class . '" href="' . htmlspecialchars($item['link']) . '">';
            $html .= htmlspecialchars($item['label']);
            $html .= '</a>';
            $html .= '</li>';
        }
        return $html;
    }
}
?>