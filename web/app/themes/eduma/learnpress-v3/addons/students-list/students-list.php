<?php
/**
 * Template for displaying students list tab in single course page.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/addons/students-list/student-list.php.
 *
 * @author ThimPress
 * @package LearnPress/Students-List/Templates
 * @version 3.0.0
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;
?>

<?php if ( $course ) { ?>
	<?php do_action( 'learn_press_before_students_list' ); ?>

    <div class="course-students-list">

		<?php
		$curd  = new LP_Course_CURD();
		$limit = isset( $limit ) ? $limit : - 1;
		?>

		<?php if ( $students = $curd->get_user_enrolled( $course->get_ID(), $limit ) ) { ?>
			<?php
            $students_list_heading     = apply_filters( 'learn_press_students_list_heading', __( 'Students Enrolled', 'eduma' ) );
			$show_avatar               = apply_filters( 'learn_press_students_list_avatar', true );
			$students_list_avatar_size = apply_filters( 'learn_press_students_list_avatar_size', 70 );
			$passing_condition         = round( $course->passing_condition, 0 );
			?>
            <?php if ( $students_list_heading ): ?>
                <h3 class="students-list-title"><?php echo $students_list_heading ?></h3>
            <?php endif; ?>
            <div class="filter-students">
                <label for="students-list-filter"><?php echo esc_html__( 'Filter', 'eduma' ); ?></label>
                <select id="students-list-filter">
                    <?php
                    $filters = array(
                        'all'         => esc_html__( 'All', 'eduma' ),
                        'in-progress' => esc_html__( 'In Progress', 'eduma' ),
                        'finished'    => esc_html__( 'Finished', 'eduma' )
                    );
                    foreach ( $filters as $key => $filter ) {
                        echo '<option value="' . esc_attr( $key ) . '">' . esc_html( $filter ) . '</option>';
                    }
                    ?>
                </select>
            </div>
            <ul class="students">
				<?php foreach ( $students as $student ) {
					$process = '';
                    $result = 0;
                    $student = learn_press_get_user( $student->ID );
                    $data = $student->get_course_data($course->get_id());
                    $status = $student->get_course_status($course->get_id());
                    $result = $data->get_results();
					?>

					<?php if ( $status ) {
						$process = ( $status == 'finished' ) ? 'finished' : 'in-progress';
					} ?>

                    <li class="students-enrolled user-login <?php echo $process;?>">
                        <div class="user-info">
                            <div class="avatar">
                                <?php if ( $show_avatar ): ?>
                                    <?php echo get_avatar( $student->get_id(), $students_list_avatar_size, '', $student->get_data( 'display_name' ), array( 'class' => 'students_list_avatar' ) ); ?>
                                <?php endif; ?>
                            </div>
                            <div class="right-info">
                                <a class="name" href="<?php echo learn_press_user_profile_link( $student->get_id() ) ?>"
                                   title="<?php echo $student->get_data( 'display_name' ) . ' profile'; ?>">
                                    <?php echo $student->get_data( 'display_name' ); ?>
                                </a>
                                <div class="course-progress">
                                    <span class="course-result"><?php echo esc_html__( 'Learning', 'eduma' );?></span><?php echo $result; ?>%
                                </div>
                            </div>
                        </div>
                    </li>

				<?php } ?>
            </ul>
			<?php
			$other_student = $course->students;
			if ( $other_student && $limit == - 1 ) {
				echo '<p class="additional-students">and ' . sprintf( _n( 'one student enrolled.', '%s students enrolled.', $other_student, 'learnpress-students-list' ), $other_student ) . '</p>';
			}
			?>
		<?php } else { ?>
            <div class="students empty">
				<?php if ( $course->students ) {
					echo apply_filters( 'learn_press_course_count_student', sprintf( _n( 'One student enrolled.', '%s students enrolled.', $course->students, 'learnpress-students-list' ), $course->students ) );
				} else {
					echo apply_filters( 'learn_press_course_no_student', __( 'No student enrolled.', 'learnpress-students-list' ) );
				} ?>
            </div>
		<?php } ?>
    </div>
	<?php do_action( 'learn_press_after_students_list' );
} else {
	echo __( 'Course ID invalid, please check it again.', 'learnpress-students-list' );
}