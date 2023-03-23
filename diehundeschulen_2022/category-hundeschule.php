<?php

$queried = get_queried_object();

if($queried->post_type && $queried->post_type=='page' )
{
    $title = get_the_title();
    $title = str_replace(' in ', '', $title);
    $title = str_replace('Hundeschule', '', $title);
    $title = trim($title);
    
    $_GET['s'] = $title;
    global $wp_query;
 
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $wp_query = new WP_Query([
        's'=>$title,
        'posts_per_page'=>5,
        'paged'      => $paged,
        'tax_query'=>[
            [
                'taxonomy'=>'category',            
            'terms'=>[2]
            ]
        ]
    ]);
}
//var_dump(is_search());
if(is_search())
{
    global $wp_query;
    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
    $wp_query = new WP_Query([
       's'=>$_GET['s'],
         'paged' => $paged,
        'tax_query'=>[
            [
                'taxonomy'=>'category',
            'terms'=>[2]
            ]
           
        ]
    ]);
}

get_header();

 

$flexible_content = get_field('flexible_content','term_2');


if(!empty($flexible_content))
{
    global $section;
    foreach($flexible_content as $s)
    {
        $section = $s;
        
        get_template_part('blocks/'.$section['acf_fc_layout']);
    }
}


get_footer();