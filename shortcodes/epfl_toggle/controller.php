<?php

/** 
 * 3rd argument is the priority, higher means executed first
 * 4rth argument is number of arguments the function can accept
 **/

add_action('epfl_toggle_action', 'renderToggle', 10, 3);

function renderToggle ($title, $state, $content) {

  if (is_admin()) {

    // render placeholder for backend editor
    set_query_var('epfl_placeholder_title', 'Toggle');
    get_template_part('shortcodes/placeholder');

  } else {

    set_query_var('epfl_toggle_title', $title);
    set_query_var('epfl_toggle_state', $state);
    set_query_var('epfl_toggle_content', $content);
    get_template_part('shortcodes/epfl_toggle/view');
  }
}
