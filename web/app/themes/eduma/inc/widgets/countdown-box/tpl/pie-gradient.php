<?php

$text_days    = ( isset( $instance['text_days'] ) && '' != $instance['text_days'] ) ? $instance['text_days'] : 'days';
$text_hours   = ( isset( $instance['text_hours'] ) && '' != $instance['text_hours'] ) ? $instance['text_hours'] : 'hours';
$text_minutes = ( isset( $instance['text_minutes'] ) && '' != $instance['text_minutes'] ) ? $instance['text_minutes'] : 'minutes';
$text_seconds = ( isset( $instance['text_seconds'] ) && '' != $instance['text_seconds'] ) ? $instance['text_seconds'] : 'seconds';

if ( $instance['time_year'] != '' ) {
	$year = ( (int) ( $instance['time_year'] ) != '' ) ? (int) ( $instance['time_year'] ) : date( "Y", time() );
}
if ( $instance['time_month'] != '' ) {
	$month = ( (int) ( $instance['time_month'] ) != '' ) ? (int) ( $instance['time_month'] ) : date( "m", time() );
}
if ( $instance['time_day'] != '' ) {
	$day = ( (int) ( $instance['time_day'] ) != '' ) ? (int) ( $instance['time_day'] ) : date( "d", time() );
}
if ( $instance['time_hour'] != '' ) {
	$hour = ( (int) ( $instance['time_hour'] ) != '' ) ? (int) ( $instance['time_hour'] ) : date( "G", time() );
}
$style_color = 'color-white';
if ( $instance['style_color'] != '' ) {
	$style_color = 'color-' . $instance['style_color'];
}
$text_align = '';
if ( $instance['text_align'] != '' ) {
	$text_align = $instance['text_align'];
}
?>

<?php
wp_enqueue_script( 'jquery-classycountdown', THIM_URI . 'inc/widgets/countdown-box/js/jquery.classycountdown.js', array( 'jquery' ), true );
wp_enqueue_script( 'jquery-throttle', THIM_URI . 'inc/widgets/countdown-box/js/jquery.throttle.js', array( 'jquery' ), true );
wp_enqueue_script( 'jquery-knob', THIM_URI . 'inc/widgets/countdown-box/js/jquery.knob.js', array( 'jquery' ), true );
?>
<div id="countdown" class="thim_countdown_pie style_black_wide"></div>
<script type="text/javascript">
jQuery(function () {
	jQuery(document).ready(function () {
        jQuery('#countdown').ClassyCountdown({
            theme: "black-wide-gradient",
            now: '<?php echo strtotime("now");?>',
            end: '<?php echo strtotime($year . "/" . $month . "/" . $day . " " . $hour . ":00");?>'
        });
	});
});
</script>