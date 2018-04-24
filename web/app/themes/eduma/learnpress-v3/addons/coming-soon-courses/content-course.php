<?php
/**
 * Template for displaying course content within the loop
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 1.0
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$message   = '';
$course    = learn_press_get_course();
$course_id = $course->get_id();
//echo get_post_meta( $course_id, '_lp_coming_soon_msg', true );
if ( learn_press_is_coming_soon( $course_id ) && '' !== get_post_meta( $course_id, '_lp_coming_soon_msg', true ) ) {
    $message = strip_tags( get_post_meta( $course_id, '_lp_coming_soon_msg', true ) );
}else{
    $message = '';
}
$theme_options_data = get_theme_mods();
$class = isset($theme_options_data['thim_learnpress_cate_grid_column']) && $theme_options_data['thim_learnpress_cate_grid_column'] ? 'course-grid-'.$theme_options_data['thim_learnpress_cate_grid_column'] : 'course-grid-3';
$class .= ' lpr_course';
?>
<div id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
	<div class="course-item">
        <?php
        // @since 3.0.0
        do_action( 'learn-press/before-courses-loop-item' );
        ?>
        <?php
        // @thim
        do_action( 'thim_courses_loop_item_thumb' );
        ?>
		<div class="thim-course-content">
            <?php if ( $message ) { ?>
                <div class="message message-warning learn-press-message coming-soon-message"> <?php echo $message; ?></div>
            <?php } ?>
		</div>
	</div>
</div>