<?php
/**
 * Template for displaying message for course content protected.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/single-course/content-protected.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();
$login = add_query_arg( 'redirect_to', learn_press_get_current_url(), thim_get_login_page_url() );
?>

<div class="message message-warning">

	<span class="icon"></span>

	<?php echo sprintf( __( 'You need to enroll the course to access this content. Login <a href="%s">here</a>.', 'eduma' ), $login );?>

</div>