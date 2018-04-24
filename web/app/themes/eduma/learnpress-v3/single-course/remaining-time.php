<?php
/**
 * Template for displaying the remaining time for course.
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 3.0.4
 */

defined( 'ABSPATH' ) or die();

$course = LP_Global::course();
if ( isset( $remaining_time ) && $course->get_duration() ) {
?>
<div class="course-remaining-time message message-warning learn-press-message">
    <p>
		<?php echo sprintf( __( 'You have %s remaining for the course', 'eduma' ), $remaining_time );?>
    </p>
</div>
<?php }?>