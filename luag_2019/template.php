<?php

/**
 * @file
 * Process theme data.
 *
 * Use this file to run your theme specific implimentations of theme functions,
 * such preprocess, process, alters, and theme function overrides.
 *
 * Preprocess and process functions are used to modify or create variables for
 * templates and theme functions. They are a common theming tool in Drupal, often
 * used as an alternative to directly editing or adding code to templates. Its
 * worth spending some time to learn more about these functions - they are a
 * powerful way to easily modify the output of any template variable.
 *
 * Preprocess and Process Functions SEE: http://drupal.org/node/254940#variables-processor
 * 1. Rename each function and instance of "adaptivetheme_subtheme" to match
 *    your subthemes name, e.g. if your theme name is "footheme" then the function
 *    name will be "footheme_preprocess_hook". Tip - you can search/replace
 *    on "adaptivetheme_subtheme".
 * 2. Uncomment the required function to use.
 */


/**
 * Preprocess variables for the html template.
 */
/*
function dunsel_7_preprocess_html(&$vars) {
  global $theme_key;
  // Two examples of adding custom classes to the body.

  // Add a body class for the active theme name.
  // $vars['classes_array'][] = drupal_html_class($theme_key);

  // Browser/platform sniff - adds body classes such as ipad, webkit, chrome etc.
  // $vars['classes_array'][] = css_browser_selector();

}
// */


/**
 * Process variables for the html template.
 */
/* -- Delete this line if you want to use this function
function adaptivetheme_subtheme_process_html(&$vars) {
}
// */

/**
 * Override or insert variables for the page templates.
*/


function luag_2019_preprocess_page(&$vars){
    dpm($vars);
    //let's finish this stuff!
    $menu_parent = '';
    foreach($vars['main_menu'] as $menu => $menu_atts){
        if(strpos($menu,'active-trail')){
            $menu_parent = $menu_atts['title'];
        }
    }
    //page is not in the main menu
    //the 'menu_block_2' needs to be the name of the menu block that is creating the sidebar second

   if(empty($menu_parent)){
        if(!empty($vars['page']['sidebar_second']['menu_block_1'])){
            $parent_menu_key = array_keys($vars['page']['sidebar_second']['menu_block_1']['#content'])[0];
            $menu_parent = $vars['page']['sidebar_second']['menu_block_1']['#content'][$parent_menu_key]['#title'];
        }
    }

   
     
    if(empty($menu_parent)){
        //default behaviour.  We need an image here to not break anything
        $menu_parent='LUAG';
    }
    // Here we need to do something if the menu parent doesn't exist or whatever
    
    if($menu_parent != strip_tags($menu_parent)){
        //This means that this is the search page because the menu contains html and thus the strip_tags is different than the string
        $menu_parent = 'Search';
    }

    
    if(!empty($vars['page']['content']['system_main']['nodes'])){
        $nodenums = array_keys($vars['page']['content']['system_main']['nodes']);

        if(!empty($vars['page']['content']['system_main']['nodes'][$nodenums[0]]['#bundle'])){
            if($vars['page']['content']['system_main']['nodes'][$nodenums[0]]['#bundle'] == 'exhibition'){
                $menu_parent = 'exception';
            }
        }
    }
 

    //some exceptions where we don't need this header image
    if($vars['is_front']){
        $menu_parent = 'exception';
    }
    
    $vars['page']['luag_vars']['header_menu_parent'] = $menu_parent;
    
}


function luag_2019_process_page(&$vars) {
}


/**
 * Override or insert variables into the node templates.
 */
/* -- Delete this line if you want to use these functions
function adaptivetheme_subtheme_preprocess_node(&$vars) {
}
function adaptivetheme_subtheme_process_node(&$vars) {
}
// */


/**
 * Override or insert variables into the comment templates.
 */
/* -- Delete this line if you want to use these functions
function adaptivetheme_subtheme_preprocess_comment(&$vars) {
}
function adaptivetheme_subtheme_process_comment(&$vars) {
}
// */


/**
 * Override or insert variables into the block templates.
 */
/* -- Delete this line if you want to use these functions
function adaptivetheme_subtheme_preprocess_block(&$vars) {
}
function adaptivetheme_subtheme_process_block(&$vars) {
}
// */


function luag_header_images($luag_vars){

//outline of what to do:
//videos

    
    $menu_parent = $luag_vars['header_menu_parent'];
    
    if($menu_parent == 'exception'){
        return '';
    }
    $head_tax_img = new EntityFieldQuery();
    $head_tax_img->entityCondition('entity_type','taxonomy_term')
                 ->entityCondition('bundle','header_images')
                 ->propertyCondition('name',$menu_parent,'=');

    $tax_term = $head_tax_img->execute();

    if(!empty($tax_term['taxonomy_term'])){
        $tax_item = entity_load('taxonomy_term',array(array_keys($tax_term['taxonomy_term'])[0]));
        $head_key = array_keys($tax_item)[0];
        $head_title = $tax_item[$head_key]->name;
        $head_image = $tax_item[$head_key]->field_header_image['und'][0]['filename'];            
    }
    
    //we will start with the simple 'html' way of displaying the image, then move to the drupal-y way of doing things.
    
    $head_string = '<div id="internal-hero-img"><img src="/files/luag/'.$head_image.'"></div>';

    

//don't forget that we will need a fallback header image, maybe the same one as search. not sure yet. 
    return $head_string;

}

function luag_header_title($luag_vars){
    $menu_parent = $luag_vars['header_menu_parent'];
    
    if($menu_parent == 'exception'){
        return '';
    }
    else{
        return '<h2 id="internal-hero-title">'.$menu_parent.'</h2>';
    }
}