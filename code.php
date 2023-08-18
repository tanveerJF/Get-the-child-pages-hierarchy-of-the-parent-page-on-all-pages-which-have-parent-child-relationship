<?php
    // Get the current page ID
    $current_page_id = get_the_ID();

    // Get the parent page ID, if any
    $parent_page_id = wp_get_post_parent_id($current_page_id);

    // If the current page has a parent, use the parent page as the current page
    if ( $parent_page_id != 0 ) {
        $current_page_id = $parent_page_id;
    }

    // Get the top-level parent page ID (the first parent page)
    $top_parent_page_id = $current_page_id;
    while ( wp_get_post_parent_id($top_parent_page_id) != 0 ) {
        $top_parent_page_id = wp_get_post_parent_id($top_parent_page_id);
    }

    // Get the current page title and link
    $current_page_title = get_the_title($current_page_id);
    $current_page_link = get_the_permalink($current_page_id);

    // Get all child pages of the top-level parent page
    $sub_pages = get_pages( array( 'child_of' => $top_parent_page_id ) );

    // Check if the current page or its child pages have child pages
    $has_child_pages = false;
    if ( ! empty( $sub_pages ) ) {
        $has_child_pages = true;
    } else {
        foreach ( $sub_pages as $sub_page ) {
            if ( count( get_pages( array( 'child_of' => $sub_page->ID ) ) ) > 0 ) {
                $has_child_pages = true;
                break;
            }
        }
    }

    // If the current page or its child pages have child pages, display the side navigation
    if ( $has_child_pages ) {
?>
    <div class="side-nav">
        <div class="page-nav__title ">
            <a href="<?php echo get_the_permalink($top_parent_page_id); ?>" class="page-nav__link current_page_item">
                <span><?php echo get_the_title($top_parent_page_id); ?></span>
            </a>
        </div>
        <?php
            // Function to get child pages recursively
            function get_child_pages_recursive($parent_id) {
                $args = array(
                    'post_type'      => 'page',
                    'posts_per_page' => -1,
                    'post_parent'    => $parent_id,
                    'order'          => 'ASC',
                    'orderby'        => 'menu_order'
                );
                $child_pages = new WP_Query($args);
                if ($child_pages->have_posts()) {
                    echo '<ul class="sidebar-list page-nav-links js-PageNav-links">';
                    while ($child_pages->have_posts()) {
                        $child_pages->the_post();
                        echo '<li class="page_item"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a>';
                        get_child_pages_recursive(get_the_ID()); // Call the function recursively
                        echo '</li>';
                    }
                    echo '</ul>';
                }
                wp_reset_postdata();
            }
            // Get the child pages of the top-level parent page
            get_child_pages_recursive($top_parent_page_id);
        ?>
    </div>
<?php
    } else {
        // Do not display the current page
    }
?>
