<?php
class Menu {

    /*error_reporting(E_ALL);
    ini_set('display_errors', 1);*/

    private $menu_items;
    
    public function __construct($menu_items = []) {
        if(empty($menu_items)) {
            $menu_items = [
                ['label' => 'Home', 'link' => 'index.php'],
                ['label' => 'About', 'link' => 'about.php'],
                ['label' => 'Shop', 'link' => 'shop.php'],
                ['label' => 'Contact', 'link' => 'contact.php']
            ]; // Fixed: Added missing semicolon
        }
        $this->menu_items = $menu_items;
    }
    
    // Fixed: Return the menu items properly
    public function getMenuItems() {
        return $this->menu_items;
    }
    
    // New method: Generate HTML for the menu
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
    
    // Alternative method: Generate menu with custom CSS classes
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