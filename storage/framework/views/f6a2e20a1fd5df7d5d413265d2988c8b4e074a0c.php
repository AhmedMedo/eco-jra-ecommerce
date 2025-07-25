<?php
    $themeOption = [];
    // body typography css
    if(isset($body_typography['css']) && count($body_typography['css']) > 0){
            foreach ($body_typography['css'] as $key => $values) {
                foreach ($values as $property => $value) {
                    if($key == 'body_font'){
                        $themeOption['body'][$property] = $value.' !important;';
                    }
                    else {
                        $themeOption[$key][$property] = $value.' !important;';
                    }
                }
            }
        }
    // body typography css

    // paragraph typography css
        if(isset($paragraph_typography['css']) && count($paragraph_typography['css']) > 0){
            foreach ($paragraph_typography['css'] as $key => $values) {
                foreach ($values as $property => $value) {
                    if($key == 'paragraph_font'){
                        $themeOption['p'][$property] = $value.' !important;';
                    }
                    else {
                        $themeOption[$key][$property] = $value.' !important;';
                    }
                }
            }
        }
    // paragraph typography css

    // heading typography css
        $all_heading = ['all_heading_font'];
        $h1_heading = ['h1_heading_font'];
        $h2_heading = ['h2_heading_font'];
        $h3_heading = ['h3_heading_font'];
        $h4_heading = ['h4_heading_font'];
        $h5_heading = ['h5_heading_font'];
        $h6_heading = ['h6_heading_font'];
        
        if(isset($heading_typography['css']) && count($heading_typography['css']) > 0){
            foreach ($heading_typography['css'] as $key => $values) {
                foreach ($values as $property => $value) {
                    if(in_array($key,$all_heading)){
                        $themeOption['h1,h2,h3,h4,h5,h6'][$property] = $value.' !important;';
                    }
                    elseif (in_array($key,$h1_heading)) {
                        $themeOption['h1'][$property] = $value.' !important;';
                    }
                    elseif (in_array($key,$h2_heading)) {
                        $themeOption['h2'][$property] = $value.' !important;';
                    }
                    elseif (in_array($key,$h3_heading)) {
                        $themeOption['h3'][$property] = $value.' !important;';
                    }
                    elseif (in_array($key,$h4_heading)) {
                        $themeOption['h4'][$property] = $value.' !important;';
                    }
                    elseif (in_array($key,$h5_heading)) {
                        $themeOption['h5'][$property] = $value.' !important;';
                    }
                    elseif (in_array($key,$h6_heading)) {
                        $themeOption['h6'][$property] = $value.' !important;';
                    }
                    else {
                        $themeOption[$key][$property] = $value.' !important;';
                    }
                }
            }
        }
    // heading typography css

    // menu typography css
        if(isset($menu_typography['css']) && count($menu_typography['css']) > 0){
            foreach ($menu_typography['css'] as $key => $values) {
                foreach ($values as $property => $value) {
                    if($key == 'menu_font'){
                        $themeOption['.header-bottom'][$property] = $value.' !important;';
                        $themeOption['.header-top-bar'][$property] = $value.' !important;';
                    }
                    elseif ($key == 'sub_menu_font') {
                        $themeOption['.header-bottom .submenu'][$property] = $value.' !important;';
                    }
                    else {
                        $themeOption[$key][$property] = $value.' !important;';
                    }
                }
            }
        }
    // menu typography css

    // button typography css
        if(isset($button_typography['css']) && count($button_typography['css']) > 0){
            foreach ($button_typography['css'] as $key => $values) {
                foreach ($values as $property => $value) {
                    if($key == 'button_font'){
                        $themeOption['.btn'][$property] = $value.' !important;';
                    }
                    else {
                        $themeOption[$key][$property] = $value.' !important;';
                    }
                }
            }
        }
    // button typography css
    $style = '<style>' . "\n" . makeCssProperties($themeOption) . "\n" . '</style>';

?>

<?php echo $style; ?>

<?php /**PATH /home/medo/work/eco-jara/fashly/themes/fashion-theme/resources/views/frontend/blog/includes/custom/tl-dynamic-css.blade.php ENDPATH**/ ?>