<?php
/**
 * Testimonials Shortcode
 */

if (!defined('ABSPATH')) exit;

function gigabit_testimonial_shortcode($atts)
{
    // Default attributes
    $atts = shortcode_atts([
        'count'      => 3,
        'layout'     => 'grid',
        'limit_text' => 150,
    ], $atts);

    // Query Testimonials
    $args = [
        'post_type'      => 'testimonial',
        'posts_per_page' => intval($atts['count']),
        'post_status'    => 'publish',
    ];

    $query = new WP_Query($args);

    // Placeholder image (inside plugin)
    $placeholder = plugin_dir_url(__FILE__) . '../assets/user_placeholder.webp';

    ob_start();

    if ($query->have_posts()) : ?>

        <div class="gigabit-testimonials-wrapper gigabit-layout-<?php echo esc_attr($atts['layout']); ?>">
            <div class="gigabit-testimonials-grid">

                <?php while ($query->have_posts()) : $query->the_post(); ?>

                    <?php
                        $rating = get_post_meta(get_the_ID(), 'rating', true);
                        $img    = get_the_post_thumbnail_url(get_the_ID(), 'medium') ?: $placeholder;
                        $raw_text = get_post_meta(get_the_ID(), 'testimonial_text', true);
                        $text = wp_trim_words($raw_text, $atts['limit_text'] / 5, '...');

                    ?>

                    <div class="testimonial-card">
                        <div class="testimonial-image">
                            <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                        </div>

                        <div class="testimonial-content">
                            <h3 class="client-name"><?php echo esc_html(get_the_title()); ?></h3>

                            <p class="client-text"><?php echo esc_html($text); ?></p>

                            <?php if ($rating) : ?>
                                <div class="testimonial-rating">
                                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                                        <?php if ($i <= $rating) : ?>
                                            <span class="star filled">★</span>
                                        <?php else : ?>
                                            <span class="star">★</span>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                <?php endwhile; ?>

            </div>
        </div>

    <?php else :
        echo "<p>No testimonials found.</p>";
    endif;

    wp_reset_postdata();

    return ob_get_clean();
}

add_shortcode('testimonials', 'gigabit_testimonial_shortcode');