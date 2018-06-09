<?php
include "twitter_oauth.php";

if(mo_openid_is_customer_registered()) {
    /*
    * Login Widget
    *
    */
    class mo_openid_login_wid extends WP_Widget {

        public function __construct() {
            parent::__construct(
                'mo_openid_login_wid',
                'miniOrange Social Login Widget',
                array(
                    'description' => __( 'Login using Social Apps like Google, Facebook, LinkedIn, Microsoft, Instagram.', 'flw' ),
                    'customize_selective_refresh' => true,
                )
            );
        }

        public function widget( $args, $instance ) {
            extract( $args );

            echo $args['before_widget'];
            $this->openidloginForm();

            echo $args['after_widget'];
        }

        public function update( $new_instance, $old_instance ) {
            $instance = array();
            $instance['wid_title'] = strip_tags( $new_instance['wid_title'] );
            return $instance;
        }

        public function openidloginForm(){

            global $post;
            $selected_theme = get_option('mo_openid_login_theme');
            $appsConfigured = get_option('mo_openid_google_enable') | get_option('mo_openid_salesforce_enable') | get_option('mo_openid_facebook_enable') | get_option('mo_openid_linkedin_enable') | get_option('mo_openid_instagram_enable') | get_option('mo_openid_amazon_enable') | get_option('mo_openid_windowslive_enable') | get_option('mo_openid_twitter_enable') | get_option('mo_openid_vkontakte_enable');
            $spacebetweenicons = get_option('mo_login_icon_space');
            $customWidth = get_option('mo_login_icon_custom_width');
            $customHeight = get_option('mo_login_icon_custom_height');
            $customSize = get_option('mo_login_icon_custom_size');
            $customBackground = get_option('mo_login_icon_custom_color');
            $customTheme = get_option('mo_openid_login_custom_theme');
            $customTextofTitle = get_option('mo_openid_login_button_customize_text');
            $customBoundary = get_option('mo_login_icon_custom_boundary');
            $customLogoutName = get_option('mo_openid_login_widget_customize_logout_name_text');
            $customLogoutLink = get_option('mo_openid_login_widget_customize_logout_text');
            $customTextColor=get_option('mo_login_openid_login_widget_customize_textcolor');
            $customText=get_option('mo_openid_login_widget_customize_text');

            $facebook_custom_app = $this->if_custom_app_exists('facebook');
            $google_custom_app = $this->if_custom_app_exists('google');
            $twitter_custom_app = $this->if_custom_app_exists('twitter');
            $salesforce_custom_app = $this->if_custom_app_exists('salesforce');
            $linkedin_custom_app = $this->if_custom_app_exists('linkedin');
            $windowslive_custom_app = $this->if_custom_app_exists('windowslive');
            $vkontakte_custom_app = $this->if_custom_app_exists('vkontakte');
            $amazon_custom_app = $this->if_custom_app_exists('amazon');
            $instagram_custom_app = $this->if_custom_app_exists('instagram');

            if( ! is_user_logged_in() ) {

                if( $appsConfigured ) {
                    $this->mo_openid_load_login_script();
                    ?>

                    <div class="mo-openid-app-icons">

                        <p style="color:#<?php echo $customTextColor ?>"><?php   echo $customText ?>
                        </p>
                        <?php
                        if($customTheme == 'default'){
                            if( get_option('mo_openid_facebook_enable') ) {
                                if($selected_theme == 'longbutton'){
                                    ?>

                                    <a rel='nofollow'  onClick="moOpenIdLogin('facebook','<?php echo $facebook_custom_app?>');" style="width:<?php echo $customWidth ?>px !important;padding-top:<?php echo $customHeight-29 ?>px !important;padding-bottom:<?php echo $customHeight-29 ?>px !important;margin-bottom:<?php echo $spacebetweenicons-5 ?>px !important;border-radius:<?php echo $customBoundary ?>px !important;" class="btn btn-block btn-social btn-facebook  btn-custom-size login-button"  > <i style="padding-top:<?php echo $customHeight-35 ?>px !important" class="fa fa-facebook"></i><?php
                                        echo get_option('mo_openid_login_button_customize_text'); 	?> Facebook</a>
                                    <?php

                                }else{ ?>

                                    <a rel='nofollow'  title="<?php echo $customTextofTitle ?> Facebook" onClick="moOpenIdLogin('facebook','<?php echo $facebook_custom_app?>');"><img alt='Facebook' style="width:<?php echo $customSize?>px !important;height:<?php echo $customSize?>px !important;margin-left:<?php echo $spacebetweenicons-4?>px !important" src="<?php echo plugins_url( 'includes/images/icons/facebook.png', __FILE__ )?>" class="<?php echo $selected_theme; ?> login-button" ></a>

                                <?php }

                            }
                            if( get_option('mo_openid_google_enable') ) {
                                if($selected_theme == 'longbutton'){
                                    ?>

                                    <a  rel='nofollow'  onClick="moOpenIdLogin('google','<?php echo $google_custom_app?>');" style='width:<?php echo $customWidth ?>px !important;padding-top:<?php echo $customHeight-29 ?>px !important;padding-bottom:<?php echo $customHeight-29 ?>px !important;margin-bottom:<?php echo $spacebetweenicons-5 ?>px !important;border-radius:<?php echo $customBoundary ?>px !important;' class='btn btn-block btn-social btn-google btn-custom-size login-button' > <i style='padding-top:<?php echo $customHeight-35 ?>px !important' class='fa fa-google-plus'></i><?php
                                        echo get_option('mo_openid_login_button_customize_text'); 	?> Google</a>
                                <?php }
                                else{ ?>
                                    <a rel='nofollow'  onClick="moOpenIdLogin('google','<?php echo $google_custom_app?>');"  title="<?php echo $customTextofTitle ?> Google" ><img alt='Google' style="width:<?php echo $customSize?>px !important;height:<?php echo $customSize?>px !important;margin-left:<?php echo $spacebetweenicons-4?>px !important" src="<?php echo plugins_url( 'includes/images/icons/google.png', __FILE__ )?>" class="<?php echo $selected_theme; ?> login-button" ></a>
                                    <?php
                                }
                            }

                            if( get_option('mo_openid_vkontakte_enable') ) {
                                if($selected_theme == 'longbutton'){
                                    ?>

                                    <a  rel='nofollow' onClick="moOpenIdLogin('vkontakte','<?php echo $vkontakte_custom_app?>');" style='width:<?php echo $customWidth ?>px !important;padding-top:<?php echo $customHeight-29 ?>px !important;padding-bottom:<?php echo $customHeight-29 ?>px !important;margin-bottom:<?php echo $spacebetweenicons-5 ?>px !important;border-radius:<?php echo $customBoundary ?>px !important;' class='btn btn-block btn-social btn-vk btn-custom-size login-button' > <i style='padding-top:<?php echo $customHeight-35 ?>px !important' class='fa fa-vk'></i><?php
                                        echo get_option('mo_openid_login_button_customize_text'); 	?> Vkontakte</a>
                                <?php }
                                else{ ?>
                                    <a rel='nofollow'  onClick="moOpenIdLogin('vkontakte','<?php echo $vkontakte_custom_app?>');"  title="<?php echo $customTextofTitle ?> Vkontakte" ><img alt='Vkontakte' style="width:<?php echo $customSize?>px !important;height:<?php echo $customSize?>px !important;margin-left:<?php echo $spacebetweenicons-4?>px !important" src="<?php echo plugins_url( 'includes/images/icons/vk.png', __FILE__ )?>" class="<?php echo $selected_theme; ?> login-button" ></a>
                                    <?php
                                }
                            }


                            if( get_option('mo_openid_twitter_enable') ) {
                                if($selected_theme == 'longbutton'){
                                    ?> <a  rel='nofollow'  onClick="moOpenIdLogin('twitter','<?php echo $twitter_custom_app?>');" style="width:<?php echo $customWidth ?>px !important;padding-top:<?php echo $customHeight-29 ?>px !important;padding-bottom:<?php echo $customHeight-29 ?>px !important;margin-bottom:<?php echo $spacebetweenicons-5 ?>px !important;border-radius:<?php echo $customBoundary ?>px !important;" class="btn btn-block btn-social btn-twitter btn-custom-size login-button" > <i style="padding-top:<?php echo $customHeight-35 ?>px !important" class="fa fa-twitter"></i><?php
                                        echo get_option('mo_openid_login_button_customize_text'); 	?> Twitter</a>
                                <?php }
                                else{ ?>


                                    <a rel='nofollow'  title="<?php echo $customTextofTitle ?> Twitter" onClick="moOpenIdLogin('twitter','<?php echo $twitter_custom_app?>');"><img alt='Twitter' style="width:<?php echo $customSize?>px !important;height:<?php echo $customSize?>px !important;margin-left:<?php echo $spacebetweenicons-4?>px !important"  src="<?php echo plugins_url( 'includes/images/icons/twitter.png', __FILE__ )?>" class="<?php echo $selected_theme; ?> login-button"></a>
                                <?php }
                            }

                            if( get_option('mo_openid_linkedin_enable') ) {
                                if($selected_theme == 'longbutton'){ ?>
                                    <a rel='nofollow'  onClick="moOpenIdLogin('linkedin','<?php echo $linkedin_custom_app?>');" style="width:<?php echo $customWidth ?>px !important;padding-top:<?php echo $customHeight-29 ?>px !important;padding-bottom:<?php echo $customHeight-29 ?>px !important;margin-bottom:<?php echo $spacebetweenicons-5 ?>px !important;border-radius:<?php echo $customBoundary ?>px !important;" class="btn btn-block btn-social btn-linkedin btn-custom-size login-button" > <i style="padding-top:<?php echo $customHeight-35 ?>px !important" class="fa fa-linkedin"></i><?php
                                        echo get_option('mo_openid_login_button_customize_text'); 	?> LinkedIn</a>
                                <?php }
                                else{ ?>
                                    <a rel='nofollow' title="<?php echo $customTextofTitle ?> LinkedIn" onClick="moOpenIdLogin('linkedin','<?php echo $linkedin_custom_app?>');"><img alt='LinkedIn' style="width:<?php echo $customSize?>px !important;height:<?php echo $customSize?>px !important;margin-left:<?php echo $spacebetweenicons-4?>px !important" src="<?php echo plugins_url( 'includes/images/icons/linkedin.png', __FILE__ )?>" class="<?php echo $selected_theme; ?> login-button" ></a>
                                <?php }
                            }if( get_option('mo_openid_instagram_enable') ) {
                                if($selected_theme == 'longbutton'){	?>
                                    <a rel='nofollow'  onClick="moOpenIdLogin('instagram','<?php echo $instagram_custom_app?>');" style="width:<?php echo $customWidth ?>px !important;padding-top:<?php echo $customHeight-29 ?>px !important;padding-bottom:<?php echo $customHeight-29 ?>px !important;margin-bottom:<?php echo $spacebetweenicons-5 ?>px !important;border-radius:<?php echo $customBoundary ?>px !important;" class="btn btn-block btn-social btn-instagram btn-custom-size login-button" > <i style="padding-top:<?php echo $customHeight-35 ?>px !important" class="fa fa-instagram"></i><?php
                                        echo get_option('mo_openid_login_button_customize_text'); 	?> Instagram</a>
                                <?php }
                                else{ ?>


                                    <a rel='nofollow' title="<?php echo $customTextofTitle ?> Instagram" onClick="moOpenIdLogin('instagram','<?php echo $instagram_custom_app?>');"><img alt='Instagram' style="width:<?php echo $customSize?>px !important;height:<?php echo $customSize?>px !important;margin-left:<?php echo $spacebetweenicons-4?>px !important"  src="<?php echo plugins_url( 'includes/images/icons/instagram.png', __FILE__ )?>" class="<?php echo $selected_theme; ?> login-button"></a>
                                <?php }
                            }if( get_option('mo_openid_amazon_enable') ) {
                                if($selected_theme == 'longbutton'){
                                    ?> <a rel='nofollow'  onClick="moOpenIdLogin('amazon','<?php echo $amazon_custom_app?>');" style="width:<?php echo $customWidth ?>px !important;padding-top:<?php echo $customHeight-29 ?>px !important;padding-bottom:<?php echo $customHeight-29 ?>px !important;margin-bottom:<?php echo $spacebetweenicons-5 ?>px !important;border-radius:<?php echo $customBoundary ?>px !important;" class="btn btn-block btn-social btn-soundcloud btn-custom-size login-button" > <i style="padding-top:<?php echo $customHeight-35 ?>px !important" class="fa fa-amazon"></i><?php
                                        echo get_option('mo_openid_login_button_customize_text'); 	?> Amazon</a>
                                <?php }
                                else{ ?>

                                    <a rel='nofollow' title="<?php echo $customTextofTitle ?> Amazon" onClick="moOpenIdLogin('amazon','<?php echo $amazon_custom_app?>');"><img alt='Amazon' style="width:<?php echo $customSize?>px !important;height:<?php echo $customSize?>px !important;margin-left:<?php echo $spacebetweenicons-4?>px !important"  src="<?php echo plugins_url( 'includes/images/icons/amazon.png', __FILE__ )?>" class="<?php echo $selected_theme; ?> login-button"></a>
                                <?php }
                            }if( get_option('mo_openid_salesforce_enable') ) {
                                if($selected_theme == 'longbutton'){
                                    ?> <a  rel='nofollow' onClick="moOpenIdLogin('salesforce','<?php echo $salesforce_custom_app?>');" style="width:<?php echo $customWidth ?>px !important;padding-top:<?php echo $customHeight-29 ?>px !important;padding-bottom:<?php echo $customHeight-29 ?>px !important;margin-bottom:<?php echo $spacebetweenicons-5 ?>px !important;border-radius:<?php echo $customBoundary ?>px !important;" class="btn btn-block btn-social btn-vimeo btn-custom-size login-button" > <i style="padding-top:<?php echo $customHeight-35 ?>px !important" class="fa fa-cloud"></i> <?php
                                        echo get_option('mo_openid_login_button_customize_text'); 	?> Salesforce</a>
                                <?php }
                                else{ ?>


                                    <a rel='nofollow' title="<?php echo $customTextofTitle ?> Salesforce" onClick="moOpenIdLogin('salesforce','<?php echo $salesforce_custom_app?>');"><img alt='Salesforce' style="width:<?php echo $customSize?>px !important;height:<?php echo $customSize?>px !important;margin-left:<?php echo $spacebetweenicons-4?>px !important"  src="<?php echo plugins_url( 'includes/images/icons/salesforce.png', __FILE__ )?>" class="<?php echo $selected_theme; ?> login-button" ></a>
                                <?php }
                            }if( get_option('mo_openid_windowslive_enable') ) {
                                if($selected_theme == 'longbutton'){
                                    ?> <a rel='nofollow'  onClick="moOpenIdLogin('windowslive','<?php echo $windowslive_custom_app?>');" style="width:<?php echo $customWidth ?>px !important;padding-top:<?php echo $customHeight-29 ?>px !important;padding-bottom:<?php echo $customHeight-29 ?>px !important;margin-bottom:<?php echo $spacebetweenicons-5 ?>px !important;border-radius:<?php echo $customBoundary ?>px !important;" class="btn btn-block btn-social btn-microsoft btn-custom-size login-button" > <i style="padding-top:<?php echo $customHeight-35 ?>px !important" class="fa fa-windows"></i><?php
                                        echo get_option('mo_openid_login_button_customize_text'); 	?> Microsoft</a>
                                <?php }
                                else{ ?>


                                    <a rel='nofollow' title="<?php echo $customTextofTitle ?> Microsoft" onClick="moOpenIdLogin('windowslive','<?php echo $windowslive_custom_app?>');"><img alt='Windowslive' style="width:<?php echo $customSize?>px !important;height:<?php echo $customSize?>px !important;margin-left:<?php echo $spacebetweenicons-4?>px !important"  src="<?php echo plugins_url( 'includes/images/icons/windowslive.png', __FILE__ )?>" class="<?php echo $selected_theme; ?> login-button"></a>
                                <?php }
                            }

                        }
                        ?>



                        <?php
                        if($customTheme == 'custom'){
                            if( get_option('mo_openid_facebook_enable') ) {
                                if($selected_theme == 'longbutton'){
                                    ?> <a rel='nofollow'  onClick="moOpenIdLogin('facebook','<?php echo $facebook_custom_app?>');" style="width:<?php echo $customWidth ?>px !important;padding-top:<?php echo $customHeight-29 ?>px !important;padding-bottom:<?php echo $customHeight-29 ?>px !important;margin-bottom:<?php echo $spacebetweenicons-5 ?>px !important;background:<?php echo "#".$customBackground?> !important;border-radius:<?php echo $customBoundary ?>px !important;" class="btn btn-block btn-social btn-facebook  btn-custom-size login-button" > <i style="padding-top:<?php echo $customHeight-35 ?>px !important" class="fa fa-facebook"></i><?php
                                        echo get_option('mo_openid_login_button_customize_text'); 	?> Facebook</a>
                                <?php }
                                else{ ?>

                                    <a rel='nofollow'  onClick="moOpenIdLogin('facebook','<?php echo $facebook_custom_app?>');" title="<?php echo $customTextofTitle ?> Facebook"><i style="width:<?php echo $customSize?>px !important;height:<?php echo $customSize?>px !important;margin-left:<?php echo $spacebetweenicons-4?>px !important;background:<?php echo "#".$customBackground?> !important;font-size:<?php echo $customSize-16?>px !important;" class="fa fa-facebook custom-login-button <?php echo $selected_theme; ?>" ></i></a>

                                <?php }

                            }

                            if( get_option('mo_openid_google_enable') ) {
                                if($selected_theme == 'longbutton'){
                                    ?>

                                    <a rel='nofollow'   onClick="moOpenIdLogin('google','<?php echo $google_custom_app?>');" style="width:<?php echo $customWidth ?>px !important;padding-top:<?php echo $customHeight-29 ?>px !important;padding-bottom:<?php echo $customHeight-29 ?>px !important;margin-bottom:<?php echo $spacebetweenicons-5 ?>px !important; background:<?php echo "#".$customBackground?> !important;border-radius:<?php echo $customBoundary ?>px !important;" class="btn btn-block btn-social btn-customtheme btn-custom-size login-button" > <i style="padding-top:<?php echo $customHeight-35 ?>px !important" class="fa fa-google-plus"></i><?php
                                        echo get_option('mo_openid_login_button_customize_text'); 	?> Google</a>
                                <?php }
                                else{ ?>
                                    <a rel='nofollow'  onClick="moOpenIdLogin('google','<?php echo $google_custom_app?>');" title="<?php echo $customTextofTitle ?> Google"><i style="width:<?php echo $customSize?>px !important;height:<?php echo $customSize?>px !important;margin-left:<?php echo $spacebetweenicons-4?>px !important;background:<?php echo "#".$customBackground?> !important;font-size:<?php echo $customSize-16?>px !important;"  class="fa fa-google-plus custom-login-button <?php echo $selected_theme; ?>" ></i></a>
                                    <?php
                                }
                            }

                            if( get_option('mo_openid_vkontakte_enable') ) {
                                if($selected_theme == 'longbutton'){
                                    ?>

                                    <a  rel='nofollow'  onClick="moOpenIdLogin('vkontakte','<?php echo $vkontakte_custom_app?>');" style="width:<?php echo $customWidth ?>px !important;padding-top:<?php echo $customHeight-29 ?>px !important;padding-bottom:<?php echo $customHeight-29 ?>px !important;margin-bottom:<?php echo $spacebetweenicons-5 ?>px !important; background:<?php echo "#".$customBackground?> !important;border-radius:<?php echo $customBoundary ?>px !important;" class="btn btn-block btn-social btn-customtheme btn-custom-size login-button" > <i style="padding-top:<?php echo $customHeight-35 ?>px !important" class="fa fa-vk"></i><?php
                                        echo get_option('mo_openid_login_button_customize_text'); 	?> Vkontakte</a>
                                <?php }
                                else{ ?>
                                    <a rel='nofollow'  onClick="moOpenIdLogin('vkontakte','<?php echo $vkontakte_custom_app?>');" title="<?php echo $customTextofTitle ?> Vkontakte"><i style="width:<?php echo $customSize?>px !important;height:<?php echo $customSize?>px !important;margin-left:<?php echo $spacebetweenicons-4?>px !important;background:<?php echo "#".$customBackground?> !important;font-size:<?php echo $customSize-16?>px !important;"  class="fa fa-vk custom-login-button <?php echo $selected_theme; ?>" ></i></a>
                                    <?php
                                }
                            }

                            if( get_option('mo_openid_twitter_enable') ) {
                                if($selected_theme == 'longbutton'){
                                    ?>

                                    <a rel='nofollow'   onClick="moOpenIdLogin('twitter','<?php echo $twitter_custom_app?>');" style="width:<?php echo $customWidth ?>px !important;padding-top:<?php echo $customHeight-29 ?>px !important;padding-bottom:<?php echo $customHeight-29 ?>px !important;margin-bottom:<?php echo $spacebetweenicons-5 ?>px !important; background:<?php echo "#".$customBackground?> !important;border-radius:<?php echo $customBoundary ?>px !important;" class="btn btn-block btn-social btn-customtheme btn-custom-size login-button" > <i style="padding-top:<?php echo $customHeight-35 ?>px !important" class="fa fa-twitter"></i><?php
                                        echo get_option('mo_openid_login_button_customize_text'); 	?> Twitter</a>
                                <?php }
                                else{ ?>
                                    <a rel='nofollow'  onClick="moOpenIdLogin('twitter','<?php echo $twitter_custom_app?>');" title="<?php echo $customTextofTitle ?> Twitter"><i style="width:<?php echo $customSize?>px !important;height:<?php echo $customSize?>px !important;margin-left:<?php echo $spacebetweenicons-4?>px !important;background:<?php echo "#".$customBackground?> !important;font-size:<?php echo $customSize-16?>px !important;"  class="fa fa-twitter custom-login-button <?php echo $selected_theme; ?>" ></i></a>
                                    <?php
                                }
                            }
                            if( get_option('mo_openid_linkedin_enable') ) {
                                if($selected_theme == 'longbutton'){ ?>
                                    <a rel='nofollow'  onClick="moOpenIdLogin('linkedin','<?php echo $linkedin_custom_app?>');" style="width:<?php echo $customWidth ?>px !important;padding-top:<?php echo $customHeight-29 ?>px !important;padding-bottom:<?php echo $customHeight-29 ?>px !important;margin-bottom:<?php echo $spacebetweenicons-5 ?>px !important;background:<?php echo "#".$customBackground?> !important;border-radius:<?php echo $customBoundary ?>px !important;" class="btn btn-block btn-social btn-linkedin btn-custom-size login-button" > <i style="padding-top:<?php echo $customHeight-35 ?>px !important" class="fa fa-linkedin"></i><?php
                                        echo get_option('mo_openid_login_button_customize_text'); 	?> LinkedIn</a>
                                <?php }
                                else{ ?>
                                    <a rel='nofollow'  onClick="moOpenIdLogin('linkedin','<?php echo $linkedin_custom_app?>');" title="<?php echo $customTextofTitle ?> LinkedIn"><i style="width:<?php echo $customSize?>px !important;height:<?php echo $customSize?>px !important;margin-left:<?php echo $spacebetweenicons-4?>px !important;background:<?php echo "#".$customBackground?> !important;font-size:<?php echo $customSize-16?>px !important;"  class="fa fa-linkedin custom-login-button <?php echo $selected_theme; ?>" ></i></a>
                                <?php }
                            }if( get_option('mo_openid_instagram_enable') ) {
                                if($selected_theme == 'longbutton'){	?>
                                    <a  rel='nofollow' onClick="moOpenIdLogin('instagram','<?php echo $instagram_custom_app?>');" style="width:<?php echo $customWidth ?>px !important;padding-top:<?php echo $customHeight-29 ?>px !important;padding-bottom:<?php echo $customHeight-29 ?>px !important;margin-bottom:<?php echo $spacebetweenicons-5 ?>px !important;background:<?php echo "#".$customBackground?> !important;background:<?php echo "#".$customBackground?> !important;border-radius:<?php echo $customBoundary ?>px !important;" class="btn btn-block btn-social btn-instagram btn-custom-size login-button" > <i style="padding-top:<?php echo $customHeight-35 ?>px !important" class="fa fa-instagram"></i><?php
                                        echo get_option('mo_openid_login_button_customize_text'); 	?> Instagram</a>
                                <?php }
                                else{ ?>


                                    <a  rel='nofollow' onClick="moOpenIdLogin('instagram','<?php echo $instagram_custom_app?>');" title="<?php echo $customTextofTitle ?> Instagram"><i style="width:<?php echo $customSize?>px !important;height:<?php echo $customSize?>px !important;margin-left:<?php echo $spacebetweenicons-4?>px !important;background:<?php echo "#".$customBackground?> !important;font-size:<?php echo $customSize-16?>px !important;"   class="fa fa-instagram custom-login-button <?php echo $selected_theme; ?>"></i></a>
                                <?php }
                            }if( get_option('mo_openid_amazon_enable') ) {
                                if($selected_theme == 'longbutton'){
                                    ?> <a rel='nofollow'   onClick="moOpenIdLogin('amazon','<?php echo $amazon_custom_app?>');" style="width:<?php echo $customWidth ?>px !important;padding-top:<?php echo $customHeight-29 ?>px !important;padding-bottom:<?php echo $customHeight-29 ?>px !important;margin-bottom:<?php echo $spacebetweenicons-5 ?>px !important;background:<?php echo "#".$customBackground?> !important;border-radius:<?php echo $customBoundary ?>px !important;" class="btn btn-block btn-social btn-linkedin btn-custom-size login-button" ><i style="padding-top:<?php echo $customHeight-35 ?>px !important" class="fa fa-amazon"></i><?php
                                        echo get_option('mo_openid_login_button_customize_text'); 	?> Amazon</a>
                                <?php }
                                else{ ?>

                                    <a rel='nofollow'  onClick="moOpenIdLogin('amazon','<?php echo $amazon_custom_app?>');" title="<?php echo $customTextofTitle ?> Amazon"><i style="width:<?php echo $customSize?>px !important;height:<?php echo $customSize?>px !important;margin-left:<?php echo $spacebetweenicons-4?>px !important;background:<?php echo "#".$customBackground?> !important;font-size:<?php echo $customSize-16?>px !important;"   class="fa fa-amazon custom-login-button <?php echo $selected_theme; ?>"></i></a>
                                <?php }
                            }if( get_option('mo_openid_salesforce_enable') ) {
                                if($selected_theme == 'longbutton'){
                                    ?> <a rel='nofollow'  onClick="moOpenIdLogin('salesforce','<?php echo $salesforce_custom_app?>');" style="width:<?php echo $customWidth ?>px !important;padding-top:<?php echo $customHeight-29 ?>px !important;padding-bottom:<?php echo $customHeight-29 ?>px !important;margin-bottom:<?php echo $spacebetweenicons-5 ?>px !important;background:<?php echo "#".$customBackground?> !important;border-radius:<?php echo $customBoundary ?>px !important;" class="btn btn-block btn-social btn-linkedin btn-custom-size login-button" ><i style="padding-top:<?php echo $customHeight-35 ?>px !important" class="fa fa-cloud"></i> <?php
                                        echo get_option('mo_openid_login_button_customize_text'); 	?> Salesforce</a>
                                <?php }
                                else{ ?>


                                    <a  rel='nofollow' onClick="moOpenIdLogin('salesforce','<?php echo $salesforce_custom_app?>');" title="<?php echo $customTextofTitle ?> Salesforce"><i style="width:<?php echo $customSize?>px !important;height:<?php echo $customSize?>px !important;margin-left:<?php echo $spacebetweenicons-4?>px !important;background:<?php echo "#".$customBackground?> !important;font-size:<?php echo $customSize-16?>px " class="fa fa-cloud custom-login-button <?php echo $selected_theme; ?>" ></i></a>
                                <?php }
                            }if( get_option('mo_openid_windowslive_enable') ) {
                                if($selected_theme == 'longbutton'){
                                    ?> <a rel='nofollow'  onClick="moOpenIdLogin('windowslive','<?php echo $windowslive_custom_app?>');" style="width:<?php echo $customWidth ?>px !important;padding-top:<?php echo $customHeight-29 ?>px !important;padding-bottom:<?php echo $customHeight-29 ?>px !important;margin-bottom:<?php echo $spacebetweenicons-5 ?>px !important;background:<?php echo "#".$customBackground?> !important;border-radius:<?php echo $customBoundary ?>px !important;" class="btn btn-block btn-social btn-microsoft btn-custom-size login-button" > <i style="padding-top:<?php echo $customHeight-35 ?>px !important" class="fa fa-windows"></i><?php
                                        echo get_option('mo_openid_login_button_customize_text'); 	?> Microsoft</a>
                                <?php }
                                else{ ?>


                                    <a  rel='nofollow' onClick="moOpenIdLogin('windowslive','<?php echo $windowslive_custom_app?>');" title="<?php echo $customTextofTitle ?> Microsoft"><i style="width:<?php echo $customSize?>px !important;height:<?php echo $customSize?>px !important;margin-left:<?php echo $spacebetweenicons-4?>px !important;background:<?php echo "#".$customBackground?> !important;font-size:<?php echo $customSize-16?>px !important;"   class=" fa fa-windows custom-login-button <?php echo $selected_theme; ?>"></i></a>
                                <?php }
                            }


                        }
                        ?>
                        <br>
                    </div>
                    <?php


                }
                else {
                    ?>
                    <div>No apps configured. Please contact your administrator.</div>
                    <?php
                }
                if(get_option('mo_openid_oauth')=='1' && $appsConfigured && get_option('moopenid_logo_check') == 1){
                    $logo_html = $this->mo_openid_customize_logo();
                    echo $logo_html;
                }
                ?>
                <br />
                <?php
            }else {
                global $current_user;
                $current_user = wp_get_current_user();
                $customLogoutName = str_replace('##username##', $current_user->display_name, $customLogoutName);
                $link_with_username = $customLogoutName;
                if (empty($customLogoutName)  || empty($customLogoutLink)) {
                    ?>
                    <div id="logged_in_user" class="mo_openid_login_wid">
                        <li><?php echo $link_with_username;?> <a href="<?php echo wp_logout_url( site_url() ); ?>" title="<?php _e('Logout','flw');?>"><?php _e($customLogoutLink,'flw');?></a></li>
                    </div>
                    <?php

                }
                else {
                    ?>
                    <div id="logged_in_user" class="mo_openid_login_wid">
                        <li><?php echo $link_with_username;?> <a href="<?php echo wp_logout_url( site_url() ); ?>" title="<?php _e('Logout','flw');?>"><?php _e($customLogoutLink,'flw');?></a></li>
                    </div>
                    <?php
                }
            }
        }

        public function mo_openid_customize_logo(){
            $logo =" <div style='float:left;' class='mo_image_id'>
			<a target='_blank' href='https://www.miniorange.com/'>
			<img alt='logo' src='". plugins_url('/includes/images/miniOrange.png',__FILE__) ."' class='mo_openid_image'>
			</a>
			</div>
			<br/>";
            return $logo;
        }

        public function if_custom_app_exists($app_name){
            if(get_option('mo_openid_apps_list'))
                $appslist = get_option('mo_openid_apps_list');
            else
                $appslist = array();

            foreach( $appslist as $key => $app){
                $option = 'mo_openid_enable_custom_app_' . $key;
                if($app_name == $key && get_option($option) == '1')
                    return 'true';
            }
            return 'false';
        }

        public function openidloginFormShortCode( $atts ){

            global $post;
            $html = '';
            //$this->error_message();
            $selected_theme = isset( $atts['shape'] )? $atts['shape'] : get_option('mo_openid_login_theme');
            $appsConfigured = get_option('mo_openid_google_enable') | get_option('mo_openid_salesforce_enable') | get_option('mo_openid_facebook_enable') | get_option('mo_openid_linkedin_enable') | get_option('mo_openid_instagram_enable') | get_option('mo_openid_amazon_enable') | get_option('mo_openid_windowslive_enable') |get_option('mo_openid_twitter_enable') | get_option('mo_openid_vkontakte_enable');
            $spacebetweenicons = isset( $atts['space'] )? $atts['space'] : get_option('mo_login_icon_space');
            $customWidth = isset( $atts['width'] )? $atts['width'] : get_option('mo_login_icon_custom_width');
            $customHeight = isset( $atts['height'] )? $atts['height'] : get_option('mo_login_icon_custom_height');
            $customSize = isset( $atts['size'] )? $atts['size'] : get_option('mo_login_icon_custom_size');
            $customBackground = isset( $atts['background'] )? $atts['background'] : get_option('mo_login_icon_custom_color');
            $customTheme = isset( $atts['theme'] )? $atts['theme'] : get_option('mo_openid_login_custom_theme');
            $customText = get_option('mo_openid_login_widget_customize_text');
            $buttonText = get_option('mo_openid_login_button_customize_text');
            $customTextofTitle = get_option('mo_openid_login_button_customize_text');
            $logoutUrl = wp_logout_url( site_url() );
            $customBoundary = isset( $atts['edge'] )? $atts['edge'] : get_option('mo_login_icon_custom_boundary');
            $customLogoutName = get_option('mo_openid_login_widget_customize_logout_name_text');
            $customLogoutLink = get_option('mo_openid_login_widget_customize_logout_text');
            $customTextColor= isset( $atts['color'] )? $atts['color'] : get_option('mo_login_openid_login_widget_customize_textcolor');
            $customText=isset( $atts['heading'] )? $atts['heading'] :get_option('mo_openid_login_widget_customize_text');

            $facebook_custom_app = $this->if_custom_app_exists('facebook');
            $google_custom_app = $this->if_custom_app_exists('google');
            $twitter_custom_app = $this->if_custom_app_exists('twitter');
            $salesforce_custom_app = $this->if_custom_app_exists('salesforce');
            $linkedin_custom_app = $this->if_custom_app_exists('linkedin');
            $windowslive_custom_app = $this->if_custom_app_exists('windowslive');
            $vkontakte_custom_app = $this->if_custom_app_exists('vkontakte');
            $amazon_custom_app = $this->if_custom_app_exists('amazon');
            $instagram_custom_app = $this->if_custom_app_exists('instagram');

            if($selected_theme == 'longbuttonwithtext'){
                $selected_theme = 'longbutton';
            }
            if($customTheme == 'custombackground'){
                $customTheme = 'custom';
            }

            if( ! is_user_logged_in() ) {

                if( $appsConfigured ) {
                    $this->mo_openid_load_login_script();
                    $html .= "<div class='mo-openid-app-icons'>

					 
					 <p style='color:#".$customTextColor."'> $customText</p>";

                    if($customTheme == 'default'){

                        if( get_option('mo_openid_facebook_enable') ) {
                            if($selected_theme == 'longbutton'){
                                $html .= "<a  rel='nofollow' style='width: " . $customWidth . "px !important;padding-top:" . ($customHeight-29) . "px !important;padding-bottom:" . ($customHeight-29) . "px !important;margin-bottom: " . ($spacebetweenicons-5)  . "px !important;border-radius: " .$customBoundary. "px !important;' class='btn btn-block btn-social btn-facebook btn-custom-dec login-button' onClick=\"moOpenIdLogin('facebook','" .$facebook_custom_app."');\"> <i style='padding-top:" . ($customHeight-35) . "px !important' class='fa fa-facebook'></i>" . $buttonText . " Facebook</a>"; }
                            else{
                                $html .= "<a rel='nofollow' title= ' ".$customTextofTitle." Facebook' onClick=\"moOpenIdLogin('facebook','" .$facebook_custom_app."');\" ><img alt='Facebook' style='width:" . $customSize ."px !important;height: " . $customSize ."px !important;margin-left: " . ($spacebetweenicons) ."px !important' src='" . plugins_url( 'includes/images/icons/facebook.png', __FILE__ ) . "' class='login-button " .$selected_theme . "' ></a>";
                            }

                        }

                        if( get_option('mo_openid_google_enable') ) {
                            if($selected_theme == 'longbutton'){
                                $html .= "<a  rel='nofollow' style='width: " . $customWidth . "px !important;padding-top:" . ($customHeight-29) . "px !important;padding-bottom:" . ($customHeight-29) . "px !important;margin-bottom: " . ($spacebetweenicons-5)  . "px !important;border-radius: " .$customBoundary ."px !important;' class='btn btn-block btn-social btn-google btn-custom-dec login-button' onClick=\"moOpenIdLogin('google','".$google_custom_app."');\"> <i style='padding-top:" . ($customHeight-35) . "px !important' class='fa fa-google-plus'></i>" . $buttonText . " Google</a>";
                            }
                            else{

                                $html .= "<a rel='nofollow'  onClick=\"moOpenIdLogin('google','".$google_custom_app."');\" title= ' ".$customTextofTitle." Google'><img alt='Google' style='width:" . $customSize ."px !important;height: " . $customSize ."px !important;margin-left: " . ($spacebetweenicons) ."px !important' src='" . plugins_url( 'includes/images/icons/google.png', __FILE__ ) . "' class='login-button " .$selected_theme . "' ></a>";

                            }
                        }

                        if( get_option('mo_openid_vkontakte_enable') ) {
                            if($selected_theme == 'longbutton'){
                                $html .= "<a rel='nofollow'  style='width: " . $customWidth . "px !important;padding-top:" . ($customHeight-29) . "px !important;padding-bottom:" . ($customHeight-29) . "px !important;margin-bottom: " . ($spacebetweenicons-5)  . "px !important;border-radius: " .$customBoundary ."px !important;' class='btn btn-block btn-social btn-vk btn-custom-dec login-button' onClick=\"moOpenIdLogin('vkontakte','" .
                                    $vkontakte_custom_app.
                                    "');\"> <i style='padding-top:" . ($customHeight-35) . "px !important' class='fa fa-vk'></i>" . $buttonText . " Vkontakte</a>";
                            }
                            else{

                                $html .= "<a rel='nofollow'  onClick=\"moOpenIdLogin('vkontakte','" .
                                    $vkontakte_custom_app.
                                    "');\" title= ' ".$customTextofTitle." Vkontakte'><img alt='Vkontakte' style='width:" . $customSize ."px !important;height: " . $customSize ."px !important;margin-left: " . ($spacebetweenicons) ."px !important' src='" . plugins_url( 'includes/images/icons/vk.png', __FILE__ ) . "' class='login-button " .$selected_theme . "' ></a>";

                            }
                        }

                        if( get_option('mo_openid_twitter_enable') ) {
                            if($selected_theme == 'longbutton'){
                                $html .= "<a rel='nofollow'  style='width: " . $customWidth . "px !important;padding-top:" . ($customHeight-29) . "px !important;padding-bottom:" . ($customHeight-29) . "px !important;margin-bottom: " . ($spacebetweenicons-5)  . "px !important;border-radius: " .$customBoundary ."px !important;' class='btn btn-block btn-social btn-twitter btn-custom-dec login-button' onClick=\"moOpenIdLogin('twitter','" .
                                    $twitter_custom_app.
                                    "');\"> <i style='padding-top:" . ($customHeight-35) . "px !important' class='fa fa-twitter'></i>" . $buttonText . " Twitter</a>"; }
                            else{
                                $html .= "<a rel='nofollow' title= ' ".$customTextofTitle." Twitter' onClick=\"moOpenIdLogin('twitter','" .
                                    $twitter_custom_app. "');\" ><img alt='Twitter' style='width:" . $customSize ."px !important;height: " . $customSize ."px !important;margin-left: " . ($spacebetweenicons) ."px !important' src='" . plugins_url( 'includes/images/icons/twitter.png', __FILE__ ) . "' class='login-button " .$selected_theme . "' ></a>";
                            }

                        }
                        if( get_option('mo_openid_linkedin_enable') ) {
                            if($selected_theme == 'longbutton'){
                                $html .= "<a  rel='nofollow' style='width: " . $customWidth . "px !important;padding-top:" . ($customHeight-29) . "px !important;padding-bottom:" . ($customHeight-29) . "px !important;margin-bottom: " . ($spacebetweenicons-5)  . "px !important;border-radius: " .$customBoundary. "px !important;' class='btn btn-block btn-social btn-linkedin btn-custom-dec login-button' onClick=\"moOpenIdLogin('linkedin','" .$twitter_custom_app . "');\"> <i style='padding-top:" . ($customHeight-35) . "px !important' class='fa fa-linkedin'></i>" . $buttonText . " LinkedIn</a>";
                            }
                            else{
                                $html .= "<a rel='nofollow' title= ' ".$customTextofTitle." LinkedIn' onClick=\"moOpenIdLogin('linkedin','" . $linkedin_custom_app . "');\" ><img alt='LinkedIn' style='width:" . $customSize ."px !important;height: " . $customSize ."px !important;margin-left: " . ($spacebetweenicons) ."px !important' src='" . plugins_url( 'includes/images/icons/linkedin.png', __FILE__ ) . "' class='login-button " .$selected_theme . "' ></a>";
                            }
                        }if( get_option('mo_openid_instagram_enable') ) {
                            if($selected_theme == 'longbutton'){
                                $html .= "<a rel='nofollow'  style='width: " . $customWidth . "px !important;padding-top:" . ($customHeight-29) . "px !important;padding-bottom:" . ($customHeight-29) . "px !important;margin-bottom: " . ($spacebetweenicons-5)  . "px !important;border-radius: " .$customBoundary. "px !important;' class='btn btn-block btn-social btn-instagram btn-custom-dec login-button' onClick=\"moOpenIdLogin('instagram','" . $instagram_custom_app . "');\"> <i style='padding-top:" . ($customHeight-35) . "px !important' class='fa fa-instagram'></i>" . $buttonText . " Instagram</a>";
                            }
                            else{
                                $html .= "<a rel='nofollow' title= ' ".$customTextofTitle." Instagram' onClick=\"moOpenIdLogin('instagram','" . $instagram_custom_app . "');\" ><img alt='Instagram' style='width:" . $customSize ."px !important;height: " . $customSize ."px !important;margin-left: " . ($spacebetweenicons) ."px !important' src='" . plugins_url( 'includes/images/icons/instagram.png', __FILE__ ) . "' class='login-button " .$selected_theme . "' ></a>";
                            }
                        }if( get_option('mo_openid_amazon_enable') ) {
                            if($selected_theme == 'longbutton'){
                                $html .= "<a  rel='nofollow' style='width: " . $customWidth . "px !important;padding-top:" . ($customHeight-29) . "px !important;padding-bottom:" . ($customHeight-29) . "px !important;margin-bottom: " . ($spacebetweenicons-5)  . "px !important;border-radius: " .$customBoundary. "px !important;' class='btn btn-block btn-social btn-soundcloud btn-custom-dec login-button' onClick=\"moOpenIdLogin('amazon','" . $amazon_custom_app . "');\"> <i style='padding-top:" . ($customHeight-35) . "px !important' class='fa fa-amazon'></i>" . $buttonText . " Amazon</a>";
                            }
                            else{
                                $html .= "<a rel='nofollow' title= ' ".$customTextofTitle." Amazon' onClick=\"moOpenIdLogin('amazon','" . $amazon_custom_app . "');\" ><img alt='Amazon' style='width:" . $customSize ."px !important;height: " . $customSize ."px !important;margin-left: " . ($spacebetweenicons) ."px !important' src='" . plugins_url( 'includes/images/icons/amazon.png', __FILE__ ) . "' class='login-button " .$selected_theme . "' ></a>";
                            }
                        }if( get_option('mo_openid_salesforce_enable') ) {
                            if($selected_theme == 'longbutton'){
                                $html .= "<a rel='nofollow'  style='width: " . $customWidth . "px !important;padding-top:" . ($customHeight-29) . "px !important;padding-bottom:" . ($customHeight-29) . "px !important;margin-bottom: " . ($spacebetweenicons-5)  . "px !important;border-radius: " .$customBoundary. "px !important;' class='btn btn-block btn-social btn-vimeo btn-custom-dec login-button' onClick=\"moOpenIdLogin('salesforce','" . $salesforce_custom_app . "');\"> <i style='padding-top:" . ($customHeight-35) . "px !important' class='fa fa-cloud'></i>" . $buttonText . " Salesforce</a>";
                            }
                            else{
                                $html .= "<a rel='nofollow' title= ' ".$customTextofTitle." Salesforce' onClick=\"moOpenIdLogin('salesforce','" . $salesforce_custom_app . "');\" ><img alt='Salesforce' style='width:" . $customSize ."px !important;height: " . $customSize ."px !important;margin-left: " . ($spacebetweenicons) ."px !important' src='" . plugins_url( 'includes/images/icons/salesforce.png', __FILE__ ) . "' class='login-button " .$selected_theme . "' ></a>";
                            }
                        }if( get_option('mo_openid_windowslive_enable') ) {
                            if($selected_theme == 'longbutton'){
                                $html .= "<a rel='nofollow'  style='width: " . $customWidth . "px !important;padding-top:" . ($customHeight-29) . "px !important;padding-bottom:" . ($customHeight-29) . "px !important;margin-bottom: " . ($spacebetweenicons-5)  . "px !important;border-radius: " .$customBoundary. "px !important;' class='btn btn-block btn-social btn-microsoft btn-custom-dec login-button' onClick=\"moOpenIdLogin('windowslive','" . $windowslive_custom_app . "');\"> <i style='padding-top:" . ($customHeight-35) . "px !important' class='fa fa-windows'></i>" . $buttonText . " Microsoft</a>";
                            }
                            else{
                                $html .= "<a rel='nofollow' title= ' ".$customTextofTitle." Microsoft' onClick=\"moOpenIdLogin('windowslive','" . $windowslive_custom_app . "');\" ><img alt='Windowslive' style='width:" . $customSize ."px !important;height: " . $customSize ."px !important;margin-left: " . ($spacebetweenicons) ."px !important' src='" . plugins_url( 'includes/images/icons/windowslive.png', __FILE__ ) . "' class='login-button " .$selected_theme . "' ></a>";
                            }
                        }
                    }



                    if($customTheme == 'custom'){
                        if( get_option('mo_openid_facebook_enable') ) {
                            if($selected_theme == 'longbutton'){
                                $html .= "<a rel='nofollow'   onClick=\"moOpenIdLogin('facebook','" . $facebook_custom_app . "');\" style='width:" . ($customWidth) . "px !important;padding-top:" . ($customHeight-29) . "px !important;padding-bottom:" . ($customHeight-29) . "px !important;margin-bottom:" . ($spacebetweenicons-5) . "px !important; background:#" . $customBackground . "!important;border-radius: " .$customBoundary. "px !important;' class='btn btn-block btn-social btn-customtheme btn-custom-dec login-button' > <i style='padding-top:" .($customHeight-35) . "px !important' class='fa fa-facebook'></i> " . $buttonText . " Facebook</a>";
                            }
                            else{
                                $html .= "<a rel='nofollow' title= ' ".$customTextofTitle." Facebook' onClick=\"moOpenIdLogin('facebook','" . $facebook_custom_app . "');\" ><i style='width:" . $customSize . "px !important;height:" . $customSize . "px !important;margin-left:" . ($spacebetweenicons) . "px !important;background:#" . $customBackground . " !important;font-size: " . ($customSize-16) . "px !important;'  class='fa fa-facebook custom-login-button  " . $selected_theme . "' ></i></a>";
                            }

                        }

                        if( get_option('mo_openid_google_enable') ) {
                            if($selected_theme == 'longbutton'){
                                $html .= "<a rel='nofollow'   onClick=\"moOpenIdLogin('google','" .$google_custom_app . "');\" style='width:" . ($customWidth) . "px !important;padding-top:" . ($customHeight-29) . "px !important;padding-bottom:" . ($customHeight-29) . "px !important;margin-bottom:" . ($spacebetweenicons-5) . "px !important; background:#" . $customBackground . "!important;border-radius: " .$customBoundary. "px !important;' class='btn btn-block btn-social btn-customtheme btn-custom-dec login-button' > <i style='padding-top:" .($customHeight-35) . "px !important' class='fa fa-google-plus'></i> " . $buttonText . " Google</a>";
                            }
                            else{
                                $html .= "<a rel='nofollow' title= ' ".$customTextofTitle." Google' onClick=\"moOpenIdLogin('google','" . $google_custom_app . "');\" title= ' ". $customTextofTitle."  Google'><i style='width:" . $customSize . "px !important;height:" . $customSize . "px !important;margin-left:" . ($spacebetweenicons) . "px !important;background:#" . $customBackground . " !important;font-size: " . ($customSize-16) . "px !important;'  class='fa fa-google-plus custom-login-button  " . $selected_theme . "' ></i></a>";

                            }
                        }

                        if( get_option('mo_openid_vkontakte_enable') ) {
                            if($selected_theme == 'longbutton'){
                                $html .= "<a rel='nofollow'   onClick=\"moOpenIdLogin('vkontakte','" . $vkontakte_custom_app . "');\" style='width:" . ($customWidth) . "px !important;padding-top:" . ($customHeight-29) . "px !important;padding-bottom:" . ($customHeight-29) . "px !important;margin-bottom:" . ($spacebetweenicons-5) . "px !important; background:#" . $customBackground . "!important;border-radius: " .$customBoundary. "px !important;' class='btn btn-block btn-social btn-customtheme btn-custom-dec login-button' > <i style='padding-top:" .($customHeight-35) . "px !important' class='fa fa-vk'></i> " . $buttonText . " Vkontakte</a>";
                            }
                            else{
                                $html .= "<a rel='nofollow' title= ' ".$customTextofTitle." Vkontakte' onClick=\"moOpenIdLogin('vkontakte','" . $vkontakte_custom_app. "');\" title= ' ". $customTextofTitle."  Vkontakte'><i style='width:" . $customSize . "px !important;height:" . $customSize . "px !important;margin-left:" . ($spacebetweenicons) . "px !important;background:#" . $customBackground . " !important;font-size: " . ($customSize-16) . "px !important;'  class='fa fa-vk custom-login-button  " . $selected_theme . "' ></i></a>";

                            }
                        }

                        if( get_option('mo_openid_twitter_enable') ) {
                            if($selected_theme == 'longbutton'){
                                $html .= "<a  rel='nofollow'  onClick=\"moOpenIdLogin('twitter','" . $twitter_custom_app . "');\" style='width:" . ($customWidth) . "px !important;padding-top:" . ($customHeight-29) . "px !important;padding-bottom:" . ($customHeight-29) . "px !important;margin-bottom:" . ($spacebetweenicons-5) . "px !important; background:#" . $customBackground . "!important;border-radius: " .$customBoundary. "px !important;' class='btn btn-block btn-social btn-customtheme btn-custom-dec login-button' > <i style='padding-top:" .($customHeight-35) . "px !important' class='fa fa-twitter'></i> " . $buttonText . " Twitter</a>";
                            }
                            else{
                                $html .= "<a rel='nofollow' title= ' ".$customTextofTitle." Twitter' onClick=\"moOpenIdLogin('twitter','" . $twitter_custom_app . "');\" ><i style='width:" . $customSize . "px !important;height:" . $customSize . "px !important;margin-left:" . ($spacebetweenicons) . "px !important;background:#" . $customBackground . " !important;font-size: " . ($customSize-16) . "px !important;'  class='fa fa-twitter custom-login-button  " . $selected_theme . "' ></i></a>";
                            }

                        }
                        if( get_option('mo_openid_linkedin_enable') ) {
                            if($selected_theme == 'longbutton'){
                                $html .= "<a  rel='nofollow'  onClick=\"moOpenIdLogin('linkedin','" . $linkedin . "');\" style='width:" . ($customWidth) . "px !important;padding-top:" . ($customHeight-29) . "px !important;padding-bottom:" . ($customHeight-29) . "px !important;margin-bottom:" . ($spacebetweenicons-5) . "px !important; background:#" . $customBackground . "!important;border-radius: " .$customBoundary. "px !important;' class='btn btn-block btn-social btn-customtheme btn-custom-dec login-button' > <i style='padding-top:" .($customHeight-35) . "px !important' class='fa fa-linkedin'></i> " . $buttonText . " LinkedIn</a>";
                            }
                            else{
                                $html .= "<a rel='nofollow' title= ' ".$customTextofTitle." LinkedIn' onClick=\"moOpenIdLogin('linkedin','" . $linkedin_custom_app . "');\" ><i style='width:" . $customSize . "px !important;height:" . $customSize . "px !important;margin-left:" . ($spacebetweenicons) . "px !important;background:#" . $customBackground . " !important;font-size: " . ($customSize-16) . "px !important;'  class='fa fa-linkedin custom-login-button  " . $selected_theme . "' ></i></a>";
                            }
                        }if( get_option('mo_openid_instagram_enable') ) {
                            if($selected_theme == 'longbutton'){
                                $html .= "<a  rel='nofollow'  onClick=\"moOpenIdLogin('instagram','" . $instagram_custom_app . "');\" style='width:" . ($customWidth) . "px !important;padding-top:" . ($customHeight-29) . "px !important;padding-bottom:" . ($customHeight-29) . "px !important;margin-bottom:" . ($spacebetweenicons-5) . "px !important; background:#" . $customBackground . "!important;border-radius: " .$customBoundary. "px !important;' class='btn btn-block btn-social btn-customtheme btn-custom-dec login-button' > <i style='padding-top:" .($customHeight-35) . "px !important' class='fa fa-instagram'></i> " . $buttonText . " Instagram</a>";
                            }
                            else{
                                $html .= "<a rel='nofollow'  title= ' ".$customTextofTitle." Instagram' onClick=\"moOpenIdLogin('instagram','" . $instagram_custom_app . "');\" ><i style='width:" . $customSize . "px !important;height:" . $customSize . "px !important;margin-left:" . ($spacebetweenicons) . "px !important;background:#" . $customBackground . " !important;font-size: " . ($customSize-16) . "px !important;'  class='fa fa-instagram custom-login-button  " . $selected_theme . "' ></i></a>";
                            }
                        }if( get_option('mo_openid_amazon_enable') ) {
                            if($selected_theme == 'longbutton'){
                                $html .= "<a rel='nofollow'   onClick=\"moOpenIdLogin('amazon','" . $amazon_custom_app . "');\" style='width:" . ($customWidth) . "px !important;padding-top:" . ($customHeight-29) . "px !important;padding-bottom:" . ($customHeight-29) . "px !important;margin-bottom:" . ($spacebetweenicons-5) . "px !important; background:#" . $customBackground . "!important;border-radius: " .$customBoundary. "px !important;' class='btn btn-block btn-social btn-customtheme btn-custom-dec login-button' > <i style='padding-top:" .($customHeight-35) . "px !important' class='fa fa-amazon'></i> " . $buttonText . " Amazon</a>";
                            }
                            else{
                                $html .= "<a rel='nofollow' title= ' ".$customTextofTitle." Amazon'  onClick=\"moOpenIdLogin('amazon','" . $amazon_custom_app . "');\" ><i style='width:" . $customSize . "px !important;height:" . $customSize . "px !important;margin-left:" . ($spacebetweenicons) . "px !important;background:#" . $customBackground . " !important;font-size: " . ($customSize-16) . "px !important;'  class='fa fa-amazon custom-login-button  " . $selected_theme . "' ></i></a>";
                            }
                        }if( get_option('mo_openid_salesforce_enable') ) {
                            if($selected_theme == 'longbutton'){
                                $html .= "<a  rel='nofollow'  onClick=\"moOpenIdLogin('salesforce','" . $salesforce_custom_app . "');\" style='width:" . ($customWidth) . "px !important;padding-top:" . ($customHeight-29) . "px !important;padding-bottom:" . ($customHeight-29) . "px !important;margin-bottom:" . ($spacebetweenicons-5) . "px !important; background:#" . $customBackground . "!important;border-radius: " .$customBoundary. "px !important;' class='btn btn-block btn-social btn-customtheme btn-custom-dec login-button' > <i style='padding-top:" .($customHeight-35) . "px !important' class='fa fa-cloud'></i> " . $buttonText . " Salesforce</a>";
                            }
                            else{
                                $html .= "<a rel='nofollow' title= ' ".$customTextofTitle." Salesforce' onClick=\"moOpenIdLogin('salesforce','" . $salesforce_custom_app . "');\" ><i style='width:" . $customSize . "px !important;height:" . $customSize . "px !important;margin-left:" . ($spacebetweenicons) . "px !important;background:#" . $customBackground . " !important;font-size: " . ($customSize-16) . "px !important;'  class='fa fa-cloud custom-login-button  " . $selected_theme . "' ></i></a>";
                            }
                        }if( get_option('mo_openid_windowslive_enable') ) {
                            if($selected_theme == 'longbutton'){
                                $html .= "<a  rel='nofollow'  onClick=\"moOpenIdLogin('windowslive','" . $windowslive_custom_app . "');\" style='width:" . ($customWidth) . "px !important;padding-top:" . ($customHeight-29) . "px !important;padding-bottom:" . ($customHeight-29) . "px !important;margin-bottom:" . ($spacebetweenicons-5) . "px !important; background:#" . $customBackground . "!important;border-radius: " .$customBoundary. "px !important;' class='btn btn-block btn-social btn-customtheme btn-custom-dec login-button' > <i style='padding-top:" .($customHeight-35) . "px !important' class='fa fa-windows'></i> " . $buttonText . " Microsoft</a>";
                            }
                            else{
                                $html .= "<a rel='nofollow' title= ' ".$customTextofTitle." Microsoft' onClick=\"moOpenIdLogin('windowslive','" . $windowslive_custom_app . "');\" ><i style='width:" . $customSize . "px !important;height:" . $customSize . "px !important;margin-left:" . ($spacebetweenicons) . "px !important;background:#" . $customBackground . " !important;font-size: " . ($customSize-16) . "px !important;'  class='fa fa-windows custom-login-button  " . $selected_theme . "' ></i></a>";
                            }
                        }
                    }
                    $html .= '</div> <br>';

                }
                else {

                    $html .= '<div>No apps configured. Please contact your administrator.</div>';

                }
                if(get_option('mo_openid_oauth')=='1' && $appsConfigured && get_option('moopenid_logo_check') == 1 ){
                    $logo_html=$this->mo_openid_customize_logo();
                    $html .= $logo_html;
                }
                ?>
                <br/>
                <?php
            }else {
                global $current_user;
                $current_user = wp_get_current_user();
                $customLogoutName = str_replace('##username##', $current_user->display_name, $customLogoutName);
                $flw = __($customLogoutLink,"flw");
                if (empty($customLogoutName)  || empty($customLogoutLink)) {
                    $html .= '<div id="logged_in_user" class="mo_openid_login_wid">' . $customLogoutName . ' <a href=' . $logoutUrl .' title=" ' . $flw . '"> ' . $flw . '</a></div>';
                }
                else {
                    $html .= '<div id="logged_in_user" class="mo_openid_login_wid">' . $customLogoutName . ' <a href=' . $logoutUrl .' title=" ' . $flw . '"> ' . $flw . '</a></div>';
                }
            }
            return $html;
        }

        private function mo_openid_load_login_script() {?>
            <script type="text/javascript">
                function moOpenIdLogin(app_name,is_custom_app) {
                    var current_url = window.location.href;
                    var cookie_name = "redirect_current_url";
                    var d = new Date();
                    d.setTime(d.getTime() + (2 * 24 * 60 * 60 * 1000));
                    var expires = "expires="+d.toUTCString();
                    document.cookie = cookie_name + "=" + current_url + ";" + expires + ";path=/";

                    <?php

                    if(isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off'){
                        $http = "https://";
                    } else {
                        $http =  "http://";
                    }
                    ?>
                    var base_url = '<?php echo site_url();?>';
                    var request_uri = '<?php echo $_SERVER['REQUEST_URI'];?>';
                    var http = '<?php echo $http;?>';
                    var http_host = '<?php echo $_SERVER['HTTP_HOST'];?>';

                    if(is_custom_app == 'false'){
                        if ( request_uri.indexOf('wp-login.php') !=-1){
                            var redirect_url = base_url + '/?option=getmosociallogin&app_name=';

                        }else {
                            var redirect_url = http + http_host + request_uri;
                            if(redirect_url.indexOf('?') != -1){
                                redirect_url = redirect_url +'&option=getmosociallogin&app_name=';
                            }
                            else
                            {
                                redirect_url = redirect_url +'?option=getmosociallogin&app_name=';
                            }
                        }
                    }
                    else {

                        if ( request_uri.indexOf('wp-login.php') !=-1){
                            var redirect_url = base_url + '/?option=oauthredirect&app_name=';

                        }else {
                            var redirect_url = http + http_host + request_uri;
                            if(redirect_url.indexOf('?') != -1)
                                redirect_url = redirect_url +'&option=oauthredirect&app_name=';
                            else
                                redirect_url = redirect_url +'?option=oauthredirect&app_name=';
                        }

                    }
                    window.location.href = redirect_url + app_name;
                }
            </script>
            <?php
        }

        /*public function error_message(){
            if(isset($_SESSION['msg']) and $_SESSION['msg']){
                echo '<div class="'.$_SESSION['msg_class'].'">'.$_SESSION['msg'].'</div>';
                unset($_SESSION['msg']);
                unset($_SESSION['msg_class']);
            }
        }*/

    }

    /**
     * Sharing Widget Horizontal
     *
     */
    class mo_openid_sharing_hor_wid extends WP_Widget {

        public function __construct() {
            parent::__construct(
                'mo_openid_sharing_hor_wid',
                'miniOrange Sharing - Horizontal',
                array(
                    'description' => __( 'Share using horizontal widget. Lets you share with Social Apps like Google, Facebook, LinkedIn, Pinterest, Reddit.', 'flw' ),
                    'customize_selective_refresh' => true,
                )
            );
        }

        public function widget( $args, $instance ) {
            extract( $args );

            echo $args['before_widget'];
            $this->show_sharing_buttons_horizontal();

            echo $args['after_widget'];
        }

        public function update( $new_instance, $old_instance ) {
            $instance = array();
            $instance['wid_title'] = strip_tags( $new_instance['wid_title'] );
            return $instance;
        }

        public function show_sharing_buttons_horizontal(){
            global $post;
            $title = str_replace('+', '%20', urlencode($post->post_title));
            $content=strip_shortcodes( strip_tags( get_the_content() ) );
            $post_content=$content;
            $excerpt = '';
            $landscape = 'horizontal';
            include( plugin_dir_path( __FILE__ ) . 'class-mo-openid-social-share.php');
        }

    }


    /**
     * Sharing Vertical Widget
     *
     */
    class mo_openid_sharing_ver_wid extends WP_Widget {

        public function __construct() {
            parent::__construct(
                'mo_openid_sharing_ver_wid',
                'miniOrange Sharing - Vertical',
                array(
                    'description' => __( 'Share using a vertical floating widget. Lets you share with Social Apps like Google, Facebook, LinkedIn, Pinterest, Reddit.', 'flw' ),
                    'customize_selective_refresh' => true,
                )
            );
        }

        public function widget( $args, $instance ) {
            extract( $args );
            extract( $instance );

            $wid_title = apply_filters( 'widget_title', $instance['wid_title'] );
            $alignment = apply_filters( 'alignment', isset($instance['alignment'])? $instance['alignment'] : 'left');
            $left_offset = apply_filters( 'left_offset', isset($instance['left_offset'])? $instance['left_offset'] : '20');
            $right_offset = apply_filters( 'right_offset', isset($instance['right_offset'])? $instance['right_offset'] : '0');
            $top_offset = apply_filters( 'top_offset', isset($instance['top_offset'])? $instance['top_offset'] : '100');
            $space_icons = apply_filters( 'space_icons', isset($instance['space_icons'])? $instance['space_icons'] : '10');

            echo $args['before_widget'];
            if ( ! empty( $wid_title ) )
                echo $args['before_title'] . $wid_title . $args['after_title'];

            echo "<div class='mo_openid_vertical' style='" .(isset($alignment) && $alignment != '' && isset($instance[$alignment.'_offset']) ? $alignment .': '. ( $instance[$alignment.'_offset'] == '' ? 0 : $instance[$alignment.'_offset'] ) .'px;' : '').(isset($top_offset) ? 'top: '. ( $top_offset == '' ? 0 : $top_offset ) .'px;' : '') ."'>";

            $this->show_sharing_buttons_vertical($space_icons);

            echo '</div>';

            echo $args['after_widget'];
        }

        /*Called when user changes configuration in Widget Admin Panel*/
        public function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $instance['wid_title'] = strip_tags( $new_instance['wid_title'] );
            $instance['alignment'] = $new_instance['alignment'];
            $instance['left_offset'] = $new_instance['left_offset'];
            $instance['right_offset'] = $new_instance['right_offset'];
            $instance['top_offset'] = $new_instance['top_offset'];
            $instance['space_icons'] = $new_instance['space_icons'];
            return $instance;
        }


        public function show_sharing_buttons_vertical($space_icons){
            global $post;
            if($post->post_title) {
                $title = str_replace('+', '%20', urlencode($post->post_title));
            } else {
                $title = get_bloginfo( 'name' );
            }
            $content=strip_shortcodes( strip_tags( get_the_content() ) );
            $post_content=$content;
            $excerpt = '';
            $landscape = 'vertical';

            include( plugin_dir_path( __FILE__ ) . 'class-mo-openid-social-share.php');
        }

        /** Widget edit form at admin panel */
        function form( $instance ) {
            /* Set up default widget settings. */
            $defaults = array('alignment' => 'left', 'left_offset' => '20', 'right_offset' => '0', 'top_offset' => '100' , 'space_icons' => '10');

            foreach( $instance as $key => $value ){
                $instance[ $key ] = esc_attr( $value );
            }

            $instance = wp_parse_args( (array)$instance, $defaults );
            ?>
            <p>
                <script>
                    function moOpenIDVerticalSharingOffset(alignment){
                        if(alignment == 'left'){
                            jQuery('.moVerSharingLeftOffset').css('display', 'block');
                            jQuery('.moVerSharingRightOffset').css('display', 'none');
                        }else{
                            jQuery('.moVerSharingLeftOffset').css('display', 'none');
                            jQuery('.moVerSharingRightOffset').css('display', 'block');
                        }
                    }
                </script>
                <label for="<?php echo $this->get_field_id( 'alignment' ); ?>">Alignment</label>
                <select onchange="moOpenIDVerticalSharingOffset(this.value)" style="width: 95%" id="<?php echo $this->get_field_id( 'alignment' ); ?>" name="<?php echo $this->get_field_name( 'alignment' ); ?>">
                    <option value="left" <?php echo $instance['alignment'] == 'left' ? 'selected' : ''; ?>>Left</option>
                    <option value="right" <?php echo $instance['alignment'] == 'right' ? 'selected' : ''; ?>>Right</option>
                </select>
            <div class="moVerSharingLeftOffset" <?php echo $instance['alignment'] == 'right' ? 'style="display: none"' : ''; ?>>
                <label for="<?php echo $this->get_field_id( 'left_offset' ); ?>">Left Offset</label>
                <input style="width: 95%" id="<?php echo $this->get_field_id( 'left_offset' ); ?>" name="<?php echo $this->get_field_name( 'left_offset' ); ?>" type="text" value="<?php echo $instance['left_offset']; ?>" />px<br/>
            </div>
            <div class="moVerSharingRightOffset" <?php echo $instance['alignment'] == 'left' ? 'style="display: none"' : ''; ?>>
                <label for="<?php echo $this->get_field_id( 'right_offset' ); ?>">Right Offset</label>
                <input style="width: 95%" id="<?php echo $this->get_field_id( 'right_offset' ); ?>" name="<?php echo $this->get_field_name( 'right_offset' ); ?>" type="text" value="<?php echo $instance['right_offset']; ?>" />px<br/>
            </div>
            <label for="<?php echo $this->get_field_id( 'top_offset' ); ?>">Top Offset</label>
            <input style="width: 95%" id="<?php echo $this->get_field_id( 'top_offset' ); ?>" name="<?php echo $this->get_field_name( 'top_offset' ); ?>" type="text" value="<?php echo $instance['top_offset']; ?>" />px<br/>
            <label for="<?php echo $this->get_field_id( 'space_icons' ); ?>">Space between icons</label>
            <input style="width: 95%" id="<?php echo $this->get_field_id( 'space_icons' ); ?>" name="<?php echo $this->get_field_name( 'space_icons' ); ?>" type="text" value="<?php echo $instance['space_icons']; ?>" />px<br/>
            </p>
            <?php
        }

    }

    function mo_openid_start_session() {
        if( !session_id() ) {
            session_start();
        }
    }

    function mo_openid_end_session() {

        session_start();
        session_unset(); //unsets all session variables

        /*if( session_id() ) {
           session_destroy();
        }*/
    }

    function encrypt_data($data, $key) {

        return base64_encode(openssl_encrypt($data, 'aes-128-ecb', $key, OPENSSL_RAW_DATA));

    }

    function decrypt_data($data, $key) {

        return openssl_decrypt( base64_decode($data), 'aes-128-ecb', $key, OPENSSL_RAW_DATA);

    }

    function mo_openid_login_validate(){

        // ajax call -  custom app over default app
        if ((isset($_POST['selected_app'])) && (isset($_POST['selected_app_value']))){
            if($_POST['selected_app_value'] == 'true'){
                //if custome app enable
                $option = 'mo_openid_enable_custom_app_' . $_POST['selected_app'];
                update_option( $option, '1');
            }
            else{
                //if custome app Disable
                $option = 'mo_openid_enable_custom_app_' . $_POST['selected_app'];
                update_option( $option, '0');
            }
            exit;
        }

        else if( isset( $_POST['option'] ) and strpos( $_POST['option'], 'mo_openid_show_profile_form' ) !== false ){
            echo mo_openid_profile_completion_form($_POST["last_name"],$_POST["first_name"], $_POST["user_full_name"],$_POST["user_url"], $_POST["user_picture"], $_POST['username_field'], $_POST['email_field'],$_POST["decrypted_app_name"],$_POST["decrypted_user_id"]);
            exit;
        }

        else if( isset( $_POST['option'] ) and strpos( $_POST['option'], 'mo_openid_account_linking' ) !== false ){
            mo_openid_start_session();
            //link account
            if(!isset($_POST['mo_openid_create_new_account'])){
                $url = site_url().'/wp-login.php?option=disable-social-login';
                header('Location:'. $url);
                exit;
            }
            //create new account
            else {
                mo_openid_start_session();
                if(get_option('mo_openid_auto_register_enable')) {
                    $random_password = wp_generate_password( 10, false );
                    global $wpdb;
                    $db_prefix = $wpdb->prefix;
                    $username_user_id = $wpdb->get_var($wpdb->prepare("SELECT ID FROM " .$db_prefix."users where user_login = %s", $_SESSION['username']));

                    if( !empty($username_user_id) ){
                        $email_explode = explode('@',$_SESSION['user_email'] );
                        $username = $email_explode[0];
                        $username_user_id = $wpdb->get_var($wpdb->prepare("SELECT ID FROM " .$db_prefix."users where user_login = %s", $username));
                        if( !empty($username_user_id) ){
                            wp_die('This username already exists. Please ask the administrator to create your account with a unique username');
                        }
                        $_SESSION['username'] = $username;
                    }

                    $user_url = $_SESSION['user_url'] ;

                    if(isset($_SESSION['social_app_name']) && !empty($_SESSION['social_app_name']) && $_SESSION['social_app_name']=='facebook'){
                        $_SESSION['user_url'] = '';
                    }

                    $userdata = array(
                        'user_login'  => $_SESSION['username'],
                        'user_email'    => $_SESSION['user_email'],
                        'user_pass'   =>  $random_password,
                        'display_name' => $_SESSION['user_full_name'],
                        'first_name' => $_SESSION['first_name'],
                        'last_name' => $_SESSION['last_name'],
                        'user_url' => $_SESSION['user_url'],
                    );

                    $user_id 	= wp_insert_user( $userdata);

                    if(is_wp_error( $user_id )) {
                        //print_r($user_id);
                        wp_die('There was an error in registration. Please contact your administrator.');
                    }

                    $user	= get_user_by('email', $_SESSION['user_email'] );

                    if(get_option('moopenid_social_login_avatar') && isset($_SESSION['user_picture'])){
                        update_user_meta($user_id, 'moopenid_user_avatar',$_SESSION['user_picture']);
                    }

                    mo_openid_start_session();
                    $_SESSION['mo_login'] = true;
                    do_action( 'mo_user_register', $user_id, $user_url);
                    do_action( 'miniorange_collect_attributes_for_authenticated_user', $user, mo_openid_get_redirect_url());
                    do_action( 'wp_login', $user->user_login, $user );
                    wp_set_auth_cookie( $user_id, true );
                }
                //end of create account block

                $redirect_url = mo_openid_get_redirect_url();
                wp_redirect($redirect_url);
                exit;
            }
        }

        else if( isset( $_REQUEST['option'] ) and strpos( $_REQUEST['option'], 'getmosociallogin' ) !== false ) {
            $client_name = "wordpress";
            $timestamp = round( microtime(true) * 1000 );
            $api_key = get_option('mo_openid_admin_api_key');
            $token = $client_name . ':' . number_format($timestamp, 0, '', ''). ':' . $api_key;

            $customer_token = get_option('mo_openid_customer_token');
            $encrypted_token = encrypt_data($token,$customer_token);
            $encoded_token = urlencode( $encrypted_token );

            $userdata = get_option('moopenid_user_attributes')?'true':'false';

            $http = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? "https://" : "http://";

            $parts = parse_url($http . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
            parse_str($parts['query'], $query);
            $post = isset( $query['p'] ) ? '?p=' . $query['p'] : '';

            $base_return_url =  $http . $_SERVER["HTTP_HOST"] . strtok($_SERVER["REQUEST_URI"],'?') . $post;

            $return_url = strpos($base_return_url, '?') !== false ? urlencode( $base_return_url . '&option=moopenid' ): urlencode( $base_return_url . '?option=moopenid' );

            $url = get_option('mo_openid_host_name') . '/moas/openid-connect/client-app/authenticate?token=' . $encoded_token . '&userdata=' . $userdata. '&id=' . get_option('mo_openid_admin_customer_key') . '&encrypted=true&app=' . $_REQUEST['app_name'] . '_oauth&returnurl=' . $return_url . '&encrypt_response=true';
            wp_redirect( $url );
            exit;
        }

        else if( isset( $_POST['username_field']) and isset($_POST['email_field']) and $_POST['option'] == 'mo_openid_profile_form_submitted' ){

            $username = $_POST['username_field'];
            $user_email = $_POST['email_field'];
            $user_picture = $_POST["user_picture"];
            $user_url = $_POST["user_url"];
            $last_name = $_POST["last_name"];
            $user_full_name = $_POST["user_full_name"];
            $first_name = $_POST["first_name"];
            $decrypted_app_name = $_POST["decrypted_app_name"];
            $decrypted_user_id = $_POST["decrypted_user_id"];

            if(!isset($_POST['otp_field'])) {
                $user_email = sanitize_email($user_email);
                $username = preg_replace('/[\x00-\x1F][\x7F][\x81][\x8D][\x8F][\x90][\x9D][\xA0][\xAD]/', '', $username);
                $username = strtolower(str_replace(" ","",$username));

                global $wpdb;
                $email_user_id = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->users where user_email = %s", $user_email));
                $username_user_id = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->users where user_login = %s", $username));

                //if email exists, dont check if username is in db or not, send otp and get it over wordpress
                if( isset($email_user_id)){

                    $send_content = send_otp_token($user_email);
                    if($send_content['status']=='FAILURE'){
                        $message = 'Either your SMTP is not configured or you have entered an unmailable email. Please go back and try again.';
                        wp_die($message);
                    }

                    $transaction_id = $send_content['tId'];
                    echo mo_openid_validate_otp_form($username, $user_email, $transaction_id, $user_picture, $user_url,$last_name, $user_full_name,$first_name, $decrypted_app_name, $decrypted_user_id);
                    exit;

                }
                //email doesnt exist, check if username is in db or not, acc show form and proceed further
                else {

                    if( isset($username_user_id) ){
                        echo mo_openid_username_already_exists($last_name, $first_name, $user_full_name, $user_url, $user_picture, $username, $user_email, $decrypted_app_name, $decrypted_user_id);
                        exit;
                    }
                    else {

                        $send_content = send_otp_token($user_email);
                        if($send_content['status']=='FAILURE'){
                            $message = 'Either your SMTP is not configured or you have entered an unmailable email. Please go back and try again.';
                            wp_die($message);
                        }

                        $transaction_id = $send_content['tId'];
                        echo mo_openid_validate_otp_form($username, $user_email, $transaction_id, $user_picture, $user_url,	$last_name, $user_full_name,$first_name, $decrypted_app_name, $decrypted_user_id);
                        exit;
                    }

                }
            }
        }

        else if( isset( $_POST['otp_field']) and $_POST['option'] == 'mo_openid_otp_validation' ){

            $username = $_POST["username_field"];
            $user_email = $_POST["email_field"];
            $transaction_id = $_POST["transaction_id"];
            $otp_token = $_POST['otp_field'];
            $user_picture = $_POST["user_picture"];
            $user_url = $_POST["user_url"];
            $last_name = $_POST["last_name"];
            $user_full_name = $_POST["user_full_name"];
            $first_name = $_POST["first_name"];
            $decrypted_app_name = $_POST["decrypted_app_name"];
            $decrypted_user_id = $_POST["decrypted_user_id"];

            if(isset($_POST['resend_otp']))
            {
                $send_content = send_otp_token($user_email);
                if($send_content['status']=='FAILURE'){
                    $message = 'Either your SMTP is not configured or you have entered an unmailable email. Please register to the <a href="'.get_site_url().'">website</a> manually.';
                    wp_die($message);
                }

                $transaction_id = $send_content['tId'];
                echo mo_openid_validate_otp_form($username, $user_email, $transaction_id, $user_picture, $user_url,  $last_name, $user_full_name,$first_name, $decrypted_app_name, $decrypted_user_id);

                exit;
            }

            $validate_content = validate_otp_token($transaction_id, $otp_token);
            $status = $validate_content['status'];

            //if invalid OTP
            if($status == 'FAILURE'){
                $message = 'You have entered an invalid verification code. Enter a valid code.';
                echo mo_openid_validate_otp_form($username, $user_email, $transaction_id, $user_picture, $user_url,  $last_name, $user_full_name,$first_name, $decrypted_app_name, $decrypted_user_id,$message);
                exit;

            }
            //if OTP is Valid
            else{
                global $wpdb;
                $db_prefix = $wpdb->prefix;
                $email_user_id = $wpdb->get_var($wpdb->prepare("SELECT user_id FROM ".$db_prefix."mo_openid_linked_user where linked_email = %s",$user_email));
                $existing_email_user_id = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->users where user_email = \"%s\"", $user_email));

                // if linked user exists log him in
                mo_openid_start_session();
                if(isset($email_user_id) || isset($existing_email_user_id) )
                {
                    $email_user_id = isset($email_user_id)? $email_user_id:$existing_email_user_id;

                    mo_openid_start_session();
                    $_SESSION['username'] = $username;
                    $_SESSION['user_email'] = $user_email;
                    $_SESSION['user_full_name'] = $user_full_name;
                    $_SESSION['first_name'] = $first_name;
                    $_SESSION['last_name'] = $last_name;
                    $_SESSION['user_url'] = $user_url;
                    $_SESSION['user_picture'] = $user_picture;
                    $_SESSION['social_app_name'] = $decrypted_app_name;
                    $_SESSION['social_user_id'] = $decrypted_user_id;

                    if(get_option('moopenid_social_login_avatar') && isset($user_picture))
                        update_user_meta($email_user_id, 'moopenid_user_avatar', $user_picture);
                    $_SESSION['mo_login'] = true;

                    $user 	= get_user_by('id', $email_user_id );
                    do_action( 'miniorange_collect_attributes_for_authenticated_user', $user, mo_openid_get_redirect_url());
                    do_action( 'wp_login', $user->user_login, $user );
                    wp_set_auth_cookie( $email_user_id, true );
                }
                // if account linking is enable and email is set
                else if ( get_option('mo_openid_account_linking_enable') ){
                    mo_openid_start_session();
                    $_SESSION['username'] = $username;
                    $_SESSION['user_email'] = $user_email;
                    $_SESSION['user_full_name'] = $user_full_name;
                    $_SESSION['first_name'] = $first_name;
                    $_SESSION['last_name'] = $last_name;
                    $_SESSION['user_url'] = $user_url;
                    $_SESSION['user_picture'] = $user_picture;
                    $_SESSION['social_app_name'] = $decrypted_app_name;
                    $_SESSION['social_user_id'] = $decrypted_user_id;

                    echo mo_openid_account_linking_form();
                    exit;
                }
                // else register
                else{
                    //check if auto-registration is enabled
                    if(get_option('mo_openid_auto_register_enable')) {

                        $random_password 	= wp_generate_password( 10, false );
                        $user_profile_url  = $user_url;

                        if(isset($decrypted_app_name) && !empty($decrypted_app_name) && $decrypted_app_name=='facebook'){
                            $user_url = '';
                        }

                        $userdata = array(
                            'user_login'  =>  $username,
                            'user_email'    =>  $user_email,
                            'user_pass'   =>  $random_password,
                            'display_name' => $user_full_name,
                            'first_name' => $first_name,
                            'last_name' => $last_name,
                            'user_url' => $user_url,
                        );

                        $user_id 	= wp_insert_user( $userdata);

                        if(is_wp_error( $user_id )) {
                            //print_r($user_id);
                            wp_die('There was an error in registration. Please contact your administrator.');
                        }

                        $_SESSION['social_app_name'] = $decrypted_app_name;
                        $_SESSION['user_email'] = $user_email;
                        $_SESSION['social_user_id'] = $decrypted_user_id;

                        $user	= get_user_by('email', $user_email );

                        if(get_option('moopenid_social_login_avatar') && isset($user_picture)){
                            update_user_meta($user_id, 'moopenid_user_avatar', $user_picture);
                        }
                        $_SESSION['mo_login'] = true;
                        do_action( 'mo_user_register', $user_id, $user_profile_url);
                        do_action( 'miniorange_collect_attributes_for_authenticated_user', $user, mo_openid_get_redirect_url());
                        do_action( 'wp_login', $user->user_login, $user );
                        wp_set_auth_cookie( $user_id, true );
                    }

                    $redirect_url = mo_openid_get_redirect_url();
                    wp_redirect($redirect_url);
                    exit;
                }
            }
        }

        else if( isset( $_REQUEST['option'] ) and strpos( $_REQUEST['option'], 'moopenid' ) !== false ){

            if( is_user_logged_in()){
                return;
            }

            //Decrypt all entries
            $decrypted_email = isset($_POST['email']) ? mo_openid_decrypt_sanitize($_POST['email']): '';
            $decrypted_user_name = isset($_POST['username']) ? mo_openid_decrypt_sanitize($_POST['username']): '';
            $decrypted_user_picture = isset($_POST['profilePic']) ? mo_openid_decrypt_sanitize($_POST['profilePic']): '';
            $decrypted_user_url = isset($_POST['profileUrl']) ? mo_openid_decrypt_sanitize($_POST['profileUrl']): '';
            $decrypted_first_name = isset($_POST['firstName']) ? mo_openid_decrypt_sanitize($_POST['firstName']): '';
            $decrypted_last_name = isset($_POST['lastName']) ? mo_openid_decrypt_sanitize($_POST['lastName']): '';
            $decrypted_app_name = isset($_POST['appName']) ? mo_openid_decrypt_sanitize($_POST['appName']): '';
            $decrypted_user_id = isset($_POST['userid']) ? mo_openid_decrypt_sanitize($_POST['userid']): '';

            $decrypted_app_name = mo_openid_filter_app_name($decrypted_app_name);

            if(isset( $_POST['firstName'] ) && isset( $_POST['lastName'] )){
                if(strcmp($decrypted_first_name, $decrypted_last_name)!=0)
                    $user_full_name = $decrypted_first_name.' '.$decrypted_last_name;
                else
                    $user_full_name = $decrypted_first_name;
                $first_name = $decrypted_first_name;
                $last_name = $decrypted_last_name;
            }
            else{
                $user_full_name = $decrypted_user_name;
                $first_name = '';
                $last_name = '';
            }
            //Set Display Picture
            $user_picture = $decrypted_user_picture;

            //Set User URL
            $user_url = $decrypted_user_url;

            //if email or username not returned from app
            if ( empty($decrypted_email) || empty($decrypted_user_name) ){

                //check if provider + identifier group exists
                global $wpdb;
                $db_prefix = $wpdb->prefix;
                $id_returning_user = $wpdb->get_var($wpdb->prepare("SELECT user_id FROM ".$db_prefix."mo_openid_linked_user where linked_social_app = \"%s\" AND identifier = %s",$decrypted_app_name,$decrypted_user_id));

                $email_user_id = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->users where user_email = \"%s\"", $decrypted_email));

                mo_openid_start_session();
                // if returning user whose appname + identifier exists, log him in
                if((isset($id_returning_user)) || (isset($email_user_id)) ){
                    if ((!isset($id_returning_user)) && (isset($email_user_id)) ){
                        $id_returning_user = $email_user_id;
                        mo_openid_insert_query($decrypted_app_name,$decrypted_email,$id_returning_user,$decrypted_user_id);
                    }
                    $user 	= get_user_by('id', $id_returning_user );
                    if(get_option('moopenid_social_login_avatar') && isset($user_picture))
                        update_user_meta($id_returning_user, 'moopenid_user_avatar', $user_picture);
                    $_SESSION['mo_login'] = true;
                    $_SESSION['social_app_name'] = $decrypted_app_name;
                    $_SESSION['user_email'] = $decrypted_email;
                    $_SESSION['social_user_id'] = $decrypted_user_id;
                    do_action( 'miniorange_collect_attributes_for_authenticated_user', $user, mo_openid_get_redirect_url());
                    do_action( 'wp_login', $user->user_login, $user );
                    wp_set_auth_cookie( $id_returning_user, true );
                }
                // if new user and profile completion is enabled
                elseif (get_option('mo_openid_enable_profile_completion')){
                    echo mo_openid_profile_completion_form($last_name, $first_name, $user_full_name, $user_url, $user_picture, $decrypted_user_name, $decrypted_email, $decrypted_app_name, $decrypted_user_id);
                    exit;
                }
                // if new user and profile completion and account linking is disabled, auto create dummy data and register user
                else{
                    // auto registration is enabled
                    if(get_option('mo_openid_auto_register_enable')) {

                        if(!empty($decrypted_email))
                        {
                            $split_email  = explode('@',$decrypted_email);
                            $username = $split_email[0];
                            $user_email = $decrypted_email;
                        }
                        else if(!empty($decrypted_user_name))
                        {
                            $split_app_name = explode('_',$decrypted_app_name);
                            $username = $decrypted_user_name;
                            $user_email = $decrypted_user_name.'@'.$split_app_name[0].'.com';
                        }
                        else
                        {
                            $split_app_name = explode('_',$decrypted_app_name);
                            $username = 'user_'.get_option('mo_openid_user_count');
                            $user_email =  'user_'.get_option('mo_openid_user_count').'@'.$split_app_name[0].'.com';
                        }
                        // remove  white space from email
                        $user_email = str_replace(' ', '', $user_email);

                        //account linking
                        if ( get_option('mo_openid_account_linking_enable')){
                            mo_openid_start_session();
                            $_SESSION['username'] = $decrypted_user_name;
                            $_SESSION['user_email'] = $user_email;
                            $_SESSION['user_full_name'] = $user_full_name;
                            $_SESSION['first_name'] = $first_name;
                            $_SESSION['last_name'] = $last_name;
                            $_SESSION['user_url'] = $user_url;
                            $_SESSION['user_picture'] = $user_picture;
                            $_SESSION['social_app_name'] = $decrypted_app_name;
                            $_SESSION['social_user_id'] = $decrypted_user_id;

                            echo mo_openid_account_linking_form();
                            exit;
                        }

                        $random_password 	= wp_generate_password( 10, false );
                        $user_profile_url  = $user_url;

                        if(isset($decrypted_app_name) && !empty($decrypted_app_name) && $decrypted_app_name=='facebook'){
                            $user_url = '';
                        }

                        $userdata = array(
                            'user_login'  =>  $username,
                            'user_email'    =>  $user_email,
                            'user_pass'   =>  $random_password,
                            'display_name' => $user_full_name,
                            'first_name' => $first_name,
                            'last_name' => $last_name,
                            'user_url' => $user_url,
                        );

                        $user_id 	= wp_insert_user( $userdata);
                        if(is_wp_error( $user_id )) {
                            //print_r($user_id);
                            wp_die('There was an error in registration. Please contact your administrator.');
                        }

                        update_option('mo_openid_user_count',get_option('mo_openid_user_count')+1);

                        $_SESSION['social_app_name'] = $decrypted_app_name;
                        $_SESSION['user_email'] = $user_email;
                        $_SESSION['social_user_id'] = $decrypted_user_id;

                        $user	= get_user_by('id', $user_id );

                        if(get_option('moopenid_social_login_avatar') && isset($user_picture)){
                            update_user_meta($user_id, 'moopenid_user_avatar', $user_picture);
                        }
                        $_SESSION['mo_login'] = true;

                        //registration hook
                        do_action( 'mo_user_register', $user_id, $user_profile_url);
                        do_action( 'miniorange_collect_attributes_for_authenticated_user', $user, mo_openid_get_redirect_url());
                        //login hook
                        do_action( 'wp_login', $user->user_login, $user );
                        wp_set_auth_cookie( $user_id, true );
                    }

                    $redirect_url = mo_openid_get_redirect_url();
                    wp_redirect($redirect_url);
                    exit;

                }

            }
            //email and username are both returned..dont show profile completion
            else{

                global $wpdb;
                $user_email = sanitize_email($decrypted_email);
                $username = strtolower(str_replace(" ","",$decrypted_user_name));

                //Checking if email or username already exist
                $username_user_id = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->users where user_login = %s", $username));

                $db_prefix = $wpdb->prefix;
                $linked_email_id = $wpdb->get_var($wpdb->prepare("SELECT user_id FROM ".$db_prefix."mo_openid_linked_user where linked_social_app = \"%s\" AND identifier = %s",$decrypted_app_name,$decrypted_user_id));

                $email_user_id = $wpdb->get_var($wpdb->prepare("SELECT user_id FROM ".$db_prefix."mo_openid_linked_user where linked_email = \"%s\"",$decrypted_email));

                $existing_email_user_id = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->users where user_email = \"%s\"", $decrypted_email));

                mo_openid_start_session();
                if((isset($linked_email_id)) || (isset($email_user_id)) || isset($existing_email_user_id)) { // user is a member

                    if ((!isset($linked_email_id)) && (isset($email_user_id)) ){
                        $linked_email_id = $email_user_id;
                        mo_openid_insert_query($decrypted_app_name,$user_email,$linked_email_id,$decrypted_user_id);
                    }

                    if(isset($linked_email_id)){
                        $user = get_user_by('id', $linked_email_id );
                        $user_id = $user->ID;
                    }
                    else if(isset($email_user_id)){
                        $user = get_user_by('id', $email_user_id );
                        $user_id = $user->ID;
                    }
                    else{
                        $user = get_user_by('id', $existing_email_user_id );
                        $user_id = $user->ID;
                    }

                    if(get_option('moopenid_social_login_avatar') && isset($user_picture))
                        update_user_meta($user_id, 'moopenid_user_avatar', $user_picture);
                    $_SESSION['mo_login'] = true;
                    $_SESSION['social_app_name'] = $decrypted_app_name;
                    $_SESSION['social_user_id'] = $decrypted_user_id;
                    $_SESSION['user_email'] = $user_email;
                    do_action( 'miniorange_collect_attributes_for_authenticated_user', $user, mo_openid_get_redirect_url());
                    do_action( 'wp_login', $user->user_login, $user );
                    wp_set_auth_cookie( $user_id, true );
                }
                else if ( get_option('mo_openid_account_linking_enable')){
                    mo_openid_start_session();
                    $_SESSION['username'] = $decrypted_user_name;
                    $_SESSION['user_email'] = $user_email;
                    $_SESSION['user_full_name'] = $user_full_name;
                    $_SESSION['first_name'] = $first_name;
                    $_SESSION['last_name'] = $last_name;
                    $_SESSION['user_url'] = $user_url;
                    $_SESSION['user_picture'] = $user_picture;
                    $_SESSION['social_app_name'] = $decrypted_app_name;
                    $_SESSION['social_user_id'] = $decrypted_user_id;
                    echo mo_openid_account_linking_form();
                    exit;
                }
                else {
                    // this user is a guest
                    // auto registration is enabled
                    if(get_option('mo_openid_auto_register_enable')) {
                        $random_password 	= wp_generate_password( 10, false );

                        if( isset($username_user_id) ){
                            $email = explode('@', $user_email);
                            $username = $email[0];
                            $username_user_id = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->users where user_login = %s", $username));
                            if( isset($username_user_id) ){
                                echo '<br/>This username already exists. Please ask the administrator to create your account with a unique username';
                                exit();
                            }
                        }

                        $user_profile_url  = $user_url;

                        if(isset($decrypted_app_name) && !empty($decrypted_app_name) && $decrypted_app_name=='facebook'){
                            $user_url = '';
                        }

                        $userdata = array(
                            'user_login'  =>  $username,
                            'user_email'    =>  $user_email,
                            'user_pass'   =>  $random_password,
                            'display_name' => $user_full_name,
                            'first_name' => $first_name,
                            'last_name' => $last_name,
                            'user_url' => $user_url
                        );


                        $user_id 	= wp_insert_user( $userdata);

                        if(is_wp_error( $user_id )) {
                            //print_r($user_id);
                            wp_die('There was an error in registration. Please contact your administrator.');
                        }

                        $_SESSION['social_app_name'] = $decrypted_app_name;
                        $_SESSION['user_email'] = $user_email;
                        $_SESSION['social_user_id'] = $decrypted_user_id;

                        $user	= get_user_by('email', $user_email );

                        if(get_option('moopenid_social_login_avatar') && isset($user_picture)){
                            update_user_meta($user_id, 'moopenid_user_avatar', $user_picture);
                        }
                        $_SESSION['mo_login'] = true;

                        //registration hook
                        do_action( 'mo_user_register', $user_id,$user_profile_url);
                        do_action( 'miniorange_collect_attributes_for_authenticated_user', $user, mo_openid_get_redirect_url());
                        //login hook
                        do_action( 'wp_login', $user->user_login, $user );
                        wp_set_auth_cookie( $user_id, true );
                    }
                    $redirect_url = mo_openid_get_redirect_url();
                    wp_redirect($redirect_url);
                    exit;
                }
            }
        }

        else if( isset( $_REQUEST['autoregister'] ) and strpos( $_REQUEST['autoregister'],'false') !== false ) {
            if(!is_user_logged_in()) {
                mo_openid_disabled_register_message();
            }
        }

        else if( isset( $_REQUEST['option'] ) and strpos( $_REQUEST['option'], 'oauthredirect' ) !== false ) {

            $appname = $_REQUEST['app_name'];

            if(isset($_REQUEST['test']))
                setcookie("mo_oauth_test", true);
            else
                setcookie("mo_oauth_test", false);

            // NEW
            if(get_option('mo_openid_apps_list'))	{
                $appslist = get_option('mo_openid_apps_list');
            }
            else{
                $appslist = array();
            }

            mo_openid_start_session();

            foreach($appslist as $key=>$currentapp){

                if($key == "facebook" && $appname == "facebook"){
                    $_SESSION["appname"] = "facebook";
                    $social_app_redirect_uri   = site_url().'/openidcallback';
                    $client_id = $currentapp['clientid'];
                    $scope = $currentapp['scope'];
                    $login_dialog_url = "https://www.facebook.com/v2.11/dialog/oauth?client_id=".$client_id. '&redirect_uri='. $social_app_redirect_uri .'&response_type=code&scope='.$scope;
                    break;
                }
                else if($key == "google" && $appname == "google"){
                    $_SESSION["appname"] = "google";
                    $social_app_redirect_uri   = site_url().'/openidcallback';
                    $client_id = $currentapp['clientid'];
                    $scope = $currentapp['scope'];
                    $login_dialog_url = 'https://accounts.google.com/o/oauth2/auth?redirect_uri=' .$social_app_redirect_uri .'&response_type=code&client_id=' .$client_id .'&scope='.$scope.'&access_type=offline';
                    break;
                }
                else if($key == "twitter" && $appname == "twitter")
                {	$_SESSION['appname'] = "twitter";
                    $client_id			 = $currentapp['clientid'];
                    $client_secret		 = $currentapp['clientsecret'];
                    $twiter_getrequest_object = new twitter_oauth($client_id,$client_secret);	//creating the object of twitter_oauth class
                    $oauth_token = $twiter_getrequest_object->getRequestToken();			//function call
                    $login_dialog_url = "https://api.twitter.com/oauth/authenticate?oauth_token=" . $oauth_token;
                    break;
                }
            }

            header('Location:'. $login_dialog_url);
            exit;
        }

        else if( strpos( $_SERVER['REQUEST_URI'], "/openidcallback") !== false ) {

            if( is_user_logged_in()){
                return;
            }

            $code = $profile_url = $client_id = $current_url = $client_secret = $access_token_uri = $postData = $oauth_token = $user_url = $username = $email = '';
            $oauth_access_token = $redirect_url = $option = $oauth_token_secret = $screen_name = $profile_json_output = $oauth_verifier = $twitter_oauth_token = $access_token_json_output =[];

            mo_openid_start_session();
            if(strpos( $_SERVER['REQUEST_URI'], "oauth_verifier") !== false) {
                $_SESSION['appname'] = "twitter";
            }

            $appname = $_SESSION['appname'];

            if($appname == "twitter"){
                $dirs = explode('&', $_SERVER['REQUEST_URI']);
                $oauth_verifier = explode('=', $dirs[1]);
                $twitter_oauth_token = explode('=', $dirs[0]);
            }
            else{
                if(isset($_REQUEST['code'] )){
                    $code = $_REQUEST['code'];
                }
                else if(isset( $_REQUEST['error_reason'] )){
                    echo 'Error: ' . $_REQUEST['error_reason'] . "<br>";
                    echo $_REQUEST['error'] . "<br>";
                    echo $_REQUEST['error_description'] . "<br>";
                }
            }

            if(get_option('mo_openid_apps_list')){
                $appslist = get_option('mo_openid_apps_list');
            }
            else{
                $appslist = array();
            }
            $social_app_redirect_uri   = site_url().'/openidcallback';

            foreach($appslist as $key=>$currentapp){
                if($key == "facebook" && $appname == "facebook"){
                    $client_id = $currentapp['clientid'];
                    $client_secret = $currentapp['clientsecret'];
                    $access_token_uri = 'https://graph.facebook.com/v2.11/oauth/access_token';
                    $postData = 'client_id=' .$client_id .'&redirect_uri=' . $social_app_redirect_uri . '&client_secret=' . $client_secret . '&code=' .$code;
                    break;
                }
                else if($key == "google" && $appname == "google"){
                    $client_id = $currentapp['clientid'];
                    $client_secret = $currentapp['clientsecret'];
                    $access_token_uri = 'https://accounts.google.com/o/oauth2/token';
                    $postData = 'code=' .$code .'&client_id=' .$client_id .'&client_secret=' . $client_secret . '&redirect_uri=' . $social_app_redirect_uri . '&grant_type=authorization_code';
                    break;
                }
                else if($key == "twitter" && $appname == "twitter")
                {
                    $client_id = $currentapp['clientid'];
                    $client_secret = $currentapp['clientsecret'];
                    $twitter_getaccesstoken_object = new twitter_oauth($client_id,$client_secret);
                    $oauth_token = $twitter_getaccesstoken_object->getAccessToken($oauth_verifier[1],$twitter_oauth_token[1]);
                    break;
                }
            }

            if($appname != "twitter")
            {
                $ch = curl_init();                    // Initiate cURL
                curl_setopt($ch, CURLOPT_URL,$access_token_uri);
                curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
                curl_setopt( $ch, CURLOPT_ENCODING, "" );
                curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
                curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
                curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
                curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
                curl_setopt( $ch, CURLOPT_MAXREDIRS, 10 );
                curl_setopt($ch, CURLOPT_POST, 1);  // Tell cURL you want to post something
                curl_setopt($ch, CURLOPT_HEADER, 0);
                if($appname == "google")
                {
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
                }
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postData); // Define what you want to post
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the output in string format

                $result = curl_exec($ch);

                if( curl_errno( $ch ) ){
                    echo 'Request Error:' . curl_error( $ch );
                    exit();
                }
                $access_token_json_output = json_decode($result, true);
            }
            else
            {
                $oauth_token_array = explode('&', $oauth_token);
                $oauth_access_token = isset($oauth_token_array[0]) ? $oauth_token_array[0] : null;
                $oauth_access_token = explode('=', $oauth_access_token);
                $oauth_token_secret = isset($oauth_token_array[1]) ? $oauth_token_array[1] : null;
                $oauth_token_secret = explode('=', $oauth_token_secret);
                $screen_name = isset($oauth_token_array[3]) ? $oauth_token_array[3] : null;
                $screen_name = explode('=', $screen_name);
            }

            mo_openid_start_session();
            foreach($appslist as $key=>$currentapp){
                if($key == "facebook" && $appname == "facebook"){
                    $profile_url ='https://graph.facebook.com/me/?fields=id,name,email,picture,age_range,first_name,gender,last_name,link&access_token=' .$access_token_json_output['access_token'];
                    break;
                }
                else if($key == "google" && $appname == "google"){
                    $profile_url = 'https://www.googleapis.com/plus/v1/people/me?access_token=' .$access_token_json_output['access_token'];
                    break;
                }
                else if($key == "twitter" && $appname == "twitter"){
                    $twitter_getprofile_signature_object = new twitter_oauth($client_id,$client_secret);
                    $oauth_access_token1 =     isset($oauth_access_token[1]) ? $oauth_access_token[1] : '';
                    $oauth_token_secret1 =    isset($oauth_token_secret[1]) ? $oauth_token_secret[1] : '';
                    $screen_name1    =   isset($screen_name[1]) ? $screen_name[1] : '';
                    $profile_json_output = $twitter_getprofile_signature_object->getprofile_signature($oauth_access_token1,$oauth_token_secret1,$screen_name1);
                    break;
                }
            }

            if($appname != "twitter")
            {
                $churl = curl_init($profile_url);
                curl_setopt( $churl, CURLOPT_FOLLOWLOCATION, true );
                curl_setopt( $churl, CURLOPT_ENCODING, "" );
                curl_setopt( $churl, CURLOPT_RETURNTRANSFER, true );
                curl_setopt( $churl, CURLOPT_AUTOREFERER, true );
                curl_setopt( $churl, CURLOPT_SSL_VERIFYPEER, false );
                curl_setopt( $churl, CURLOPT_SSL_VERIFYHOST, 0 );
                curl_setopt( $churl, CURLOPT_MAXREDIRS, 10 );
                curl_setopt( $churl, CURLOPT_POST, false);
                curl_setopt($churl, CURLOPT_HTTPHEADER, array(
                    'Authorization: Bearer '.$access_token_json_output['access_token']
                ));

                $output = curl_exec($churl);

                if( curl_errno( $churl ) ){
                    echo 'Request Error:' . curl_error( $churl );
                    exit();
                }

                $profile_json_output = json_decode($output, true);
            }

            $social_app_name = $appname;
            $first_name = $last_name  = $email = $user_name  =  $user_url  = $user_picture  = $social_user_id = '';

            if ($appname == "facebook"){
                if(isset($profile_json_output['first_name'])){
                    $first_name = isset( $profile_json_output['first_name']) ?  $profile_json_output['first_name'] : '';
                }
                if(isset($profile_json_output['last_name'])){
                    $last_name = isset( $profile_json_output['last_name']) ?  $profile_json_output['last_name'] : '';
                }
                if(isset($profile_json_output['email'])){
                    $email = isset( $profile_json_output['email']) ?  $profile_json_output['email'] : '';
                }
                if(isset($profile_json_output['name'])){
                    $user_name = isset( $profile_json_output['name']) ?  $profile_json_output['name'] : '';
                }
                if(isset($profile_json_output['link'])){
                    $user_url = isset( $profile_json_output['link']) ?  $profile_json_output['link'] : '';
                }
                if(isset($profile_json_output['picture']['data']['url'])){
                    $user_picture = isset( $profile_json_output['picture']['data']['url']) ?  $profile_json_output['picture']['data']['url'] : '';
                }
                if(isset($profile_json_output['id'])){
                    $social_user_id = isset( $profile_json_output['id']) ?  $profile_json_output['id'] : '';
                }
            }
            else if ($appname == "google"){
                if(isset($profile_json_output['name']['givenName'])){
                    $first_name = isset( $profile_json_output['name']['givenName']) ?  $profile_json_output['name']['givenName'] : '';
                }
                if(isset($profile_json_output['displayName'])){
                    $user_name = isset( $profile_json_output['displayName']) ?  $profile_json_output['displayName'] : '';
                }
                if(isset($profile_json_output['name']['familyName'])){
                    $last_name = isset( $profile_json_output['name']['familyName']) ?  $profile_json_output['name']['familyName'] : '';
                }
                if(isset($profile_json_output['emails'])){
                    foreach($profile_json_output['emails'] as $entry){
                        $email = isset( $entry['value']) ?  $entry['value'] : '';
                    }
                }
                if(isset($profile_json_output['url'])){
                    $user_url = isset( $profile_json_output['url']) ?  $profile_json_output['url'] : '';
                }
                if(isset($profile_json_output['image']['url'])){
                    $user_picture = isset( $profile_json_output['image']['url']) ?  $profile_json_output['image']['url'] : '';
                }
                if(isset($profile_json_output['id'])){
                    $social_user_id = isset( $profile_json_output['id']) ?  $profile_json_output['id'] : '';
                }
            }
            else if($appname == "twitter") {
                if (isset($profile_json_output['name'])) {
                    $full_name = explode(" ", $profile_json_output['name']);
                    $first_name = isset( $full_name[0]) ?  $full_name[0] : '';
                    $last_name = isset( $full_name[1]) ?  $full_name[1] : '';
                }
                if (isset($profile_json_output['screen_name'])) {
                    $user_name = isset( $profile_json_output['screen_name']) ?  $profile_json_output['screen_name'] : '';
                }
                if (isset($profile_json_output['email'])) {
                    $email = isset( $profile_json_output['email']) ?  $profile_json_output['email'] : '';
                }
                if (isset($profile_json_output['url'])) {
                    $user_url = isset( $profile_json_output['url']) ?  $profile_json_output['url'] : '';
                }
                if (isset($profile_json_output['profile_image_url'])) {
                    $user_picture = isset( $profile_json_output['profile_image_url']) ?  $profile_json_output['profile_image_url'] : '';
                }
                if (isset($profile_json_output['id_str'])) {
                    $social_user_id = isset( $profile_json_output['id_str']) ?  $profile_json_output['id_str'] : '';
                }
            }

            //Set User Full Name
            if(isset( $first_name ) && isset( $last_name )){
                if(strcmp($first_name, $last_name)!=0)
                    $user_full_name = $first_name.' '.$last_name;
                else
                    $user_full_name = $first_name;
            }
            else{
                $user_full_name = $user_name;
                $first_name = '';
                $last_name = '';
            }

            // if email and user name is empty
            if ( empty($email) || empty($user_name) ){
                global $wpdb;
                $db_prefix = $wpdb->prefix;
                $id_returning_user = $wpdb->get_var($wpdb->prepare("SELECT user_id FROM ".$db_prefix."mo_openid_linked_user where linked_social_app = \"%s\" AND identifier = %s",$social_app_name,$social_user_id));

                $email_user_id = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->users where user_email = \"%s\"", $email));

                mo_openid_start_session();

                // if returning user whose appname + identifier exists, log him in
                if((isset($id_returning_user)) || (isset($email_user_id))){
                    if ((!isset($id_returning_user)) && (isset($email_user_id)) ){
                        $id_returning_user = $email_user_id;
                        mo_openid_insert_query($social_app_name,$email,$id_returning_user,$social_user_id);
                    }
                    $user 	= get_user_by('id', $id_returning_user );
                    if(get_option('moopenid_social_login_avatar') && isset($user_picture))
                        update_user_meta($id_returning_user, 'moopenid_user_avatar', $user_picture);

                    $_SESSION['mo_login'] = true;
                    $_SESSION['social_app_name'] = $social_app_name;
                    $_SESSION['user_email'] = $email;
                    $_SESSION['social_user_id'] = $social_user_id;

                    do_action( 'miniorange_collect_attributes_for_authenticated_user', $user, mo_openid_get_redirect_url());
                    do_action( 'wp_login', $user->user_login, $user );
                    wp_set_auth_cookie( $id_returning_user, true );
                }
                // if new user and profile completion is enabled
                elseif (get_option('mo_openid_enable_profile_completion')){
                    echo mo_openid_profile_completion_form($last_name, $first_name, $user_full_name, $user_url, $user_picture, $user_name, $email, $social_app_name, $social_user_id);
                    exit;
                }
                // if new user and profile completion is disabled, auto create dummy data and register user
                else{
                    // auto registration is enabled
                    if(get_option('mo_openid_auto_register_enable')) {

                        if(!empty($email))
                        {
                            $split_email  = explode('@',$email);
                            $username = $split_email[0];
                            $user_email = $email;
                        }
                        else if(!empty($user_name))
                        {
                            $split_app_name = explode('_',$social_app_name);
                            $username = $user_name;
                            $user_email = $user_name.'@'.$split_app_name[0].'.com';
                        }
                        else
                        {
                            $split_app_name = explode('_',$social_app_name);
                            $username = 'user_'.get_option('mo_openid_user_count');
                            $user_email =  'user_'.get_option('mo_openid_user_count').'@'.$split_app_name[0].'.com';
                        }
                        $user_email = str_replace(' ', '', $user_email);

                        if ( get_option('mo_openid_account_linking_enable')){
                            mo_openid_start_session();
                            $_SESSION['username'] = $username;
                            $_SESSION['user_email'] = $user_email;
                            $_SESSION['user_full_name'] = $user_full_name;
                            $_SESSION['first_name'] = $first_name;
                            $_SESSION['last_name'] = $last_name;
                            $_SESSION['user_url'] = $user_url;
                            $_SESSION['user_picture'] = $user_picture;
                            $_SESSION['social_app_name'] = $social_app_name;
                            $_SESSION['social_user_id'] = $social_user_id;
                            echo mo_openid_account_linking_form();
                            exit;
                        }

                        $random_password 	= wp_generate_password( 10, false );

                        $user_profile_url  = $user_url;

                        if(isset($social_app_name) && !empty($social_app_name) && $social_app_name=='facebook'){
                            $user_url = '';
                        }

                        $userdata = array(
                            'user_login'  =>  $username,
                            'user_email'    =>  $user_email,
                            'user_pass'   =>  $random_password,
                            'display_name' => $user_full_name,
                            'first_name' => $first_name,
                            'last_name' => $last_name,
                            'user_url' => $user_url,
                        );

                        $user_id 	= wp_insert_user( $userdata);

                        if(is_wp_error( $user_id )) {
                            //print_r($user_id);
                            wp_die('There was an error in registration. Please contact your administrator.');
                        }

                        update_option('mo_openid_user_count',get_option('mo_openid_user_count')+1);
                        $_SESSION['mo_login'] = true;
                        $_SESSION['social_app_name'] = $social_app_name;
                        $_SESSION['user_email'] = $user_email;
                        $_SESSION['social_user_id'] = $social_user_id;

                        $user	= get_user_by('email', $user_email );

                        if(get_option('moopenid_social_login_avatar') && isset($user_picture)){
                            update_user_meta($user_id, 'moopenid_user_avatar', $user_picture);
                        }

                        //registration hook
                        do_action( 'mo_user_register', $user_id, $user_profile_url);
                        do_action( 'miniorange_collect_attributes_for_authenticated_user', $user, mo_openid_get_redirect_url());
                        //login hook
                        do_action( 'wp_login', $user->user_login, $user );
                        wp_set_auth_cookie( $user_id, true );
                    }
                    $redirect_url = mo_openid_get_redirect_url();
                    wp_redirect($redirect_url);
                    exit;
                }
            }
            //email and username are both returned..dont show profile completion
            else{
                global $wpdb;
                $user_email = sanitize_email($email);
                $username = strtolower(str_replace(" ","",$user_name));

                //Checking if username already exist
                $username_user_id = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->users where user_login = %s", $username));

                $db_prefix = $wpdb->prefix;
                $linked_email_id = $wpdb->get_var($wpdb->prepare("SELECT user_id FROM ".$db_prefix."mo_openid_linked_user where linked_social_app = \"%s\" AND identifier = %s",$social_app_name,$social_user_id));

                $email_user_id = $wpdb->get_var($wpdb->prepare("SELECT user_id FROM ".$db_prefix."mo_openid_linked_user where linked_email = \"%s\"",$user_email));

                $existing_email_user_id = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->users where user_email = \"%s\"", $user_email));

                mo_openid_start_session();
                if((isset($linked_email_id)) || (isset($email_user_id)) || (isset($existing_email_user_id)) ) { // user is a member
                    if ((!isset($linked_email_id)) && (isset($email_user_id)) ){

                        $linked_email_id = $email_user_id;
                        mo_openid_insert_query($social_app_name,$user_email,$linked_email_id,$social_user_id);
                    }

                    if(isset($linked_email_id)){
                        $user = get_user_by('id', $linked_email_id );
                        $user_id = $user->ID;
                    }
                    else if(isset($email_user_id)){
                        $user = get_user_by('id', $email_user_id );
                        $user_id = $user->ID;
                    }
                    else{
                        $user = get_user_by('id', $existing_email_user_id );
                        $user_id = $user->ID;
                    }

                    if(get_option('moopenid_social_login_avatar') && isset($user_picture))
                        update_user_meta($user_id, 'moopenid_user_avatar', $user_picture);
                    $_SESSION['mo_login'] = true;
                    $_SESSION['social_app_name'] = $social_app_name;
                    $_SESSION['social_user_id'] = $social_user_id;
                    $_SESSION['user_email'] = $user_email;
                    do_action( 'miniorange_collect_attributes_for_authenticated_user', $user, mo_openid_get_redirect_url());
                    do_action( 'wp_login', $user->user_login, $user );
                    wp_set_auth_cookie( $user_id, true );

                }
                //if account linking is enable
                else if ( get_option('mo_openid_account_linking_enable')){
                    mo_openid_start_session();
                    $_SESSION['username'] = $user_name;
                    $_SESSION['user_email'] = $user_email;
                    $_SESSION['user_full_name'] = $user_full_name;
                    $_SESSION['first_name'] = $first_name;
                    $_SESSION['last_name'] = $last_name;
                    $_SESSION['user_url'] = $user_url;
                    $_SESSION['user_picture'] = $user_picture;
                    $_SESSION['social_app_name'] = $social_app_name;
                    $_SESSION['social_user_id'] = $social_user_id;
                    echo mo_openid_account_linking_form();
                    exit;
                }
                else {
                    // this user is a guest
                    // auto registration is enabled
                    if(get_option('mo_openid_auto_register_enable')) {
                        $random_password 	= wp_generate_password( 10, false );

                        if( isset($username_user_id) ){
                            $email_array = explode('@', $user_email);
                            $username = $email_array[0];
                            $username_user_id = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->users where user_login = %s", $username));
                            if( isset($username_user_id) ){
                                echo '<br/>This username already exists. Please ask the administrator to create your account with a unique username';
                                exit();
                            }
                        }

                        $user_profile_url  = $user_url;

                        if(isset($social_app_name) && !empty($social_app_name) && $social_app_name=='facebook'){
                            $user_url = '';
                        }

                        $userdata = array(
                            'user_login'  =>  $username,
                            'user_email'    =>  $user_email,
                            'user_pass'   =>  $random_password,
                            'display_name' => $user_full_name,
                            'first_name' => $first_name,
                            'last_name' => $last_name,
                            'user_url' => $user_url,
                        );

                        $user_id 	= wp_insert_user( $userdata);
                        if(is_wp_error( $user_id )) {
                            //print_r($user_id);
                            wp_die('There was an error in registration. Please contact your administrator.');
                        }

                        mo_openid_start_session();
                        $_SESSION['username'] = $user_name;
                        $_SESSION['user_email'] = $user_email;
                        $_SESSION['user_full_name'] = $user_full_name;
                        $_SESSION['first_name'] = $first_name;
                        $_SESSION['last_name'] = $last_name;
                        $_SESSION['user_url'] = $user_url;
                        $_SESSION['user_picture'] = $user_picture;
                        $_SESSION['social_app_name'] = $social_app_name;
                        $_SESSION['social_user_id'] = $social_user_id;

                        $user	= get_user_by('id', $user_id );
                        if(get_option('moopenid_social_login_avatar') && isset($user_picture)){
                            update_user_meta($user_id, 'moopenid_user_avatar', $user_picture);
                        }
                        $_SESSION['mo_login'] = true;

                        //registration hook
                        do_action( 'mo_user_register', $user_id, $user_profile_url);
                        do_action( 'miniorange_collect_attributes_for_authenticated_user', $user, mo_openid_get_redirect_url());
                        //login hook

                        do_action( 'wp_login', $user->user_login, $user );
                        wp_set_auth_cookie( $user_id, true );
                    }
                    $redirect_url = mo_openid_get_redirect_url();
                    wp_redirect($redirect_url);
                    exit;
                }
            }
        }
    }

    function mo_openid_validate_otp_form($username, $user_email, $transaction_id, $user_picture, $user_url, $last_name, $user_full_name ,$first_name, $decrypted_app_name, $decrypted_user_id,$message = 'We have sent a verification code to given email. Please verify your account with it.'){
        $path = mo_openid_get_wp_style();
        $html =         '<head><link rel="stylesheet" href='.$path.' type="text/css" media="all" /></head>
          
                        <body class="login login-action-login wp-core-ui  locale-en-us">
                        <div style="position:fixed;background:#f1f1f1;"></div>
                        <div id="add_field" style="position:fixed;top: 0;right: 0;bottom: 0;left: 0;z-index: 1;padding-top:130px;">
                        <div style="width: 500px; margin: 30px auto;">   
                        <form name="f" method="post" action="">
                        <div style="background: white;margin-top:-15px;padding: 15px;">
                       
                        <span style="margin:120px;font-size: 24px;font-family: Arial">Verify your email</span><br>
                        <div style="padding: 12px;"></div>
                        <div style=" padding: 16px;background-color:rgba(1, 145, 191, 0.117647);color: black;">
                        <span style=" margin-left: 15px;color: black;font-weight: bold;float: right;font-size: 22px;line-height: 20px;cursor: pointer;font-family: Arial;transition: 0.3s"></span>'.$message.'</div>	<br>					
                        <p>
                        <label for="user_login">Enter your verification code<br/>
                        <input type="text" pattern="\d{4,5}" class="input" name="otp_field" value=""  size="20" /></label>
                        </p>
                        <input type="hidden" name="username_field" value='.$username.'>
                        <input type="hidden" name="email_field" value='.$user_email.'>						
                        <input type="hidden" name="first_name" value='.$first_name.'>
                        <input type="hidden" name="last_name" value='.$last_name.'>
                        <input type="hidden" name="user_full_name" value='.$user_full_name.'>
                        <input type="hidden" name="user_url" value='.$user_url.'>
                        <input type="hidden" name="user_picture" value='.$user_picture.'>
                        <input type="hidden" name="transaction_id" value='.$transaction_id.'>
                        <input type="hidden" name="decrypted_app_name" value='.$decrypted_app_name.'>
                        <input type="hidden" name="decrypted_user_id" value='.$decrypted_user_id.'>						
                        <input type="hidden" name="option" value="mo_openid_otp_validation">
                        </div>
                        <div style="float: right;margin-right: 11px;">  
                        <input type="button"  onclick="show_profile_completion_form()" name="otp_back" id="back" class="button button-primary button-large" value="Back"/>&emsp;
                        </div>
                        <div style="float: right">
                            <input type="submit" style="margin-left:10px" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Submit"/>
                            <input type="submit" name="resend_otp" id="resend_otp" class="button button-primary button-large" value="Resend OTP"/>
                        </div>';

        if(get_option('mo_openid_oauth')=='1' && get_option('moopenid_logo_check') == 1) {
            $html .= mo_openid_customize_logo();
        }

        $html.=    '</form>
                    <form style="display:none;" name="go_back_form" id="go_back_form" method="post">
                    <input hidden name="option" value="mo_openid_show_profile_form"/>
                    <input type="hidden" name="username_field" value='.$username.'>
                    <input type="hidden" name="email_field" value='.$user_email.'>						
                    <input type="hidden" name="first_name" value='.$first_name.'>
                    <input type="hidden" name="last_name" value='.$last_name.'>
                    <input type="hidden" name="user_full_name" value='.$user_full_name.'>
                    <input type="hidden" name="user_url" value='.$user_url.'>
                    <input type="hidden" name="user_picture" value='.$user_picture.'>
                    <input type="hidden" name="transaction_id" value='.$transaction_id.'>
                    <input type="hidden" name="decrypted_app_name" value='.$decrypted_app_name.'>
                    <input type="hidden" name="decrypted_user_id" value='.$decrypted_user_id.'>
                    </form>
                    </div>
                    </div>
                    </body>
                    <script>
                    function show_profile_completion_form(){
                        document.getElementById("go_back_form").submit(); 
                    }     
                    </script>';
        return $html;
    }

    function mo_openid_username_already_exists($last_name,$first_name,$user_full_name,$user_url,$user_picture,$username,$user_email, $decrypted_app_name, $decrypted_user_id){
        $path = mo_openid_get_wp_style();
        $html = '<style>.form-input-validation.is-error {color: #d94f4f;}</style><head><link rel="stylesheet" href='.$path.' type="text/css" media="all" /></head>
          
                <body class="login login-action-login wp-core-ui  locale-en-us">
                <div style="position:fixed;background:#f1f1f1;"></div>
                <div id="add_field" style="position:fixed;top: 0;right: 0;bottom: 0;left: 0;z-index: 1;padding-top:130px;">
                <div style="width: 500px; margin: 30px auto;">   
                <form name="f" method="post" action="">
                <div style="background: white;margin-top:-15px;padding: 15px;">
               
                <span style="margin:120px;font-size: 24px;font-family: Arial">Profile Completion</span>
                <p>
                <label for="user_login">Username<br/>
                <input type="text" class="input" name="username_field" value='.$username.'  size="20" required>
                <span align="center" class="form-input-validation is-error">Entered username already exists. Try some other username.</span>
                </label>
                </p>
                <br>
                <p>
                <label for="user_pass">Email<br />
                <input type="email"  name="email_field" class="input" value='.$user_email.' size="20" required></label>						
                </p>
                <input type="hidden" name="first_name" value='.$first_name.'>
                <input type="hidden" name="last_name" value='.$last_name.'>
                <input type="hidden" name="user_full_name" value='.$user_full_name.'>
                <input type="hidden" name="user_url" value='.$user_url.'>
                <input type="hidden" name="user_picture" value='.$user_picture.'>
                <input type="hidden" name="decrypted_app_name" value='.$decrypted_app_name.'>
                <input type="hidden" name="decrypted_user_id" value='.$decrypted_user_id.'>						
                <input type="hidden" name="option" value="mo_openid_profile_form_submitted">
                </div>
                <p class="submit">
                <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Submit"/>
                </p> ';

        if(get_option('mo_openid_oauth')=='1' && get_option('moopenid_logo_check') == 1) {
            $html .= mo_openid_customize_logo();
        }

        $html.=    '</form>
                    </div>
                    </div>
                    </body>';
        return $html;

    }

    function mo_openid_profile_completion_form($last_name,$first_name,$user_full_name,$user_url,$user_picture, $decrypted_user_name, $decrypted_email, $decrypted_app_name, $decrypted_user_id){
        $path = mo_openid_get_wp_style();
        $html =     '<style>.form-input-validation.note {color: #d94f4f;}</style>
                    <head><link rel="stylesheet" href='.$path.' type="text/css" media="all" /></head>      
                    <body class="login login-action-login wp-core-ui  locale-en-us">
                    <div style="position:fixed;background:#f1f1f1;"></div>
                    <div id="add_field" style="position:fixed;top: 0;right: 0;bottom: 0;left: 0;z-index: 1;padding-top:70px;">
                    <div style="width: 500px; margin: 30px auto;">   
                    <form name="f" method="post" action="">
                    <div style="background: white;margin-top:-15px;padding: 15px;">
                   
                    <span style="margin:100px;font-size: 24px;font-family: Arial">Profile Completion</span><br>
                    <div style="padding: 12px;"></div>
                    <div style=" padding: 16px;background-color:rgba(1, 145, 191, 0.117647);color: black;">
                    <span style=" margin-left: 15px;color: black;font-weight: bold;float: right;font-size: 22px;line-height: 20px;cursor: pointer;font-family: Arial;transition: 0.3s"></span>If you are an existing user on this site, enter your registered email and username. If you are a new user, please edit/fill the details</div>	<br>					
                    <p>
                    <label for="user_login">Username<br/>
                    <input type="text" class="input" name="username_field"  size="20" required value='.$decrypted_user_name.'></label>
                    </p>
                    <p>
                    <label for="user_pass">Email<br />
                    <input type="email"  class="input" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]+$" name="email_field"  size="20"  required value='.$decrypted_email.'></label>
                    <span align="center" class="form-input-validation note">We will be sending a verification code to this email to verify it. Please enter a valid email address.</span>
                    </p>
                    <input type="hidden" name="first_name" value='.$first_name.'>
                    <input type="hidden" name="last_name" value='.$last_name.'>
                    <input type="hidden" name="user_full_name" value='.$user_full_name.'>
                    <input type="hidden" name="user_url" value='.$user_url.'>
                    <input type="hidden" name="user_picture" value='.$user_picture.'>
                    <input type="hidden" name="decrypted_app_name" value='.$decrypted_app_name.'>
                    <input type="hidden" name="decrypted_user_id" value='.$decrypted_user_id.'>
                    <input type="hidden" name="option" value="mo_openid_profile_form_submitted">
                    </div>
                    <p class="submit">
                    <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Submit"/>
                    </p> ';

        if(get_option('mo_openid_oauth')=='1' && get_option('moopenid_logo_check') == 1) {
            $html .=    mo_openid_customize_logo();
        }

        $html.=     '</form>
                    </div>
                    </div>
                    </body>';
        return $html;
    }

    function mo_openid_account_linking_form(){
        $path = mo_openid_get_wp_style();
        $html =	"<head><link rel=\"stylesheet\" href=".$path. " type='text/css' media='all' /><head>
                <body class='login login-action-login wp-core-ui  locale-en-us'>
                <div style=\"position:fixed;background:#f1f1f1;\"></div>
                <div id=\"add_field\" style=\"position:fixed;top: 0;right: 0;bottom: 0;left: 0;z-index: 1;padding-top:130px;\">
                <div style=\"width: 500px; margin: 30px auto;\">
                <form name = 'f' method = 'post' action=''>
                <input type = 'hidden' name = 'option' value = 'mo_openid_account_linking'/>
                <div  style = 'background-color:white; padding:12px; position:fixed; top:100px; right: 350px; padding-bottom: 20px;left:350px; overflow:hidden; outline:1px black;border-radius: 5px;'>	
                
                <br>
                <span style='margin:230px;font-size: 24px;font-family: Arial'>Account Linking</span><br>
                <div style='padding: 12px;'></div>
                <div style=' padding: 16px;background-color:rgba(1, 145, 191, 0.117647);color: black;'>
                    If you do not have an existing account with a different email address, click on <b>Create a new account</b>.
                    <br><br> 
                    If you already have an existing account with a different email adddress and want to link this account with that, click on <b>Link to an existing account</b>. You will be redirected to login page to login to your existing account.
                </div>                   
                <br><br>

                <input type = 'submit' value = 'Link to an existing account?' name = 'mo_openid_link_account' class='button button-primary button-large' style = 'margin-left: 13%;margin-right: 17%;'/>
                    
                <input type = 'submit' value = 'Create a new account?' name = 'mo_openid_create_new_account' class='button button-primary button-large'/>";

        if(get_option('mo_openid_oauth')=='1' && get_option('moopenid_logo_check') == 1) {
            $html .= mo_openid_customize_logo();
        }

        $html .=   "</div>
                    </form>
                    </div>
                    </div>
                    </body>";
        return $html;
    }

    function mo_openid_decrypt_sanitize($param) {
        if(strcmp($param,'null')!=0 && strcmp($param,'')!=0){
            $customer_token = get_option('mo_openid_customer_token');
            $decrypted_token = decrypt_data($param,$customer_token);
            // removes control characters and some blank characters
            $decrypted_token_sanitise = preg_replace('/[\x00-\x1F][\x7F][\x81][\x8D][\x8F][\x90][\x9D][\xA0][\xAD]/', '', $decrypted_token);
            //strips space,tab,newline,carriage return,NUL-byte,vertical tab.
            return trim($decrypted_token_sanitise);
        }else{
            return '';
        }
    }

    function mo_openid_link_account( $username, $user ){

        if($user){
            $userid = $user->ID;
        }
        mo_openid_start_session();

        $user_email =  isset($_SESSION['user_email']) ? $_SESSION['user_email']:'';
        $social_app_identifier = isset($_SESSION['social_user_id']) ? $_SESSION['social_user_id']:'';
        $social_app_name = isset($_SESSION['social_app_name']) ? $_SESSION['social_app_name']:'';

        //if user is coming through default wordpress login, do not proceed further and return
        if(isset($userid) && empty($social_app_identifier) && empty($social_app_name) ) {
            return;
        }
        elseif(!isset($userid)){
            return;
            //wp_die('No user is returned.');
        }

        global $wpdb;
        $db_prefix = $wpdb->prefix;
        $linked_email_id = $wpdb->get_var($wpdb->prepare("SELECT user_id FROM ".$db_prefix."mo_openid_linked_user where linked_email = \"%s\" AND linked_social_app = \"%s\"",$user_email,$social_app_name));

        // if a user with given email and social app name doesn't already exist in the mo_openid_linked_user table
        if(!isset($linked_email_id)){
            mo_openid_insert_query($social_app_name,$user_email,$userid,$social_app_identifier);
        }
    }

    function mo_openid_insert_query($social_app_name,$user_email,$userid,$social_app_identifier){

        // check if none of the column values are empty
        if(!empty($social_app_name) && !empty($user_email) && !empty($userid) && !empty($social_app_identifier)){

            date_default_timezone_set('Asia/Kolkata');
            $date = date('Y-m-d H:i:s');

            global $wpdb;
            $db_prefix = $wpdb->prefix;
            $table_name = $db_prefix. 'mo_openid_linked_user';

            $result = $wpdb->insert(
                $table_name,
                array(
                    'linked_social_app' => $social_app_name,
                    'linked_email' => $user_email,
                    'user_id' =>  $userid,
                    'identifier' => $social_app_identifier,
                    'timestamp' => $date,
                ),
                array(
                    '%s',
                    '%s',
                    '%d',
                    '%s',
                    '%s'
                )
            );
            if($result === false){
/*                $wpdb->show_errors();
                $wpdb->print_error();
                exit;*/
                wp_die('Error in insert query');
            }
        }
    }

    function mo_openid_send_email($user_id='', $user_url=''){
        if( get_option('mo_openid_email_enable') == 1) {
            global $wpdb;
            $admin_mail = get_option('mo_openid_admin_email');
            $user_name = ($user_id == '') ? "##UserName##" : ($wpdb->get_var($wpdb->prepare("SELECT user_login FROM {$wpdb->users} WHERE ID = %d", $user_id)));
            $content = get_option('mo_openid_register_email_message');
            $subject = "[" . get_bloginfo('name') . "] New User Registration - Social Login";
            $content = str_replace('##User Name##', $user_name, $content);
            $headers = "Content-Type: text/html";
            wp_mail($admin_mail, $subject, $content, $headers);
        }
    }

    function mo_openid_disabled_register_message() {
        $message = get_option('mo_openid_register_disabled_message').' Go to <a href="' . site_url() .'">Home Page</a>';
        wp_die($message);
    }

    function mo_openid_get_redirect_url() {

        $current_url = isset($_COOKIE["redirect_current_url"]) ? $_COOKIE["redirect_current_url"]:'';
        $pos = strpos($_SERVER['REQUEST_URI'], '/openidcallback');

        if ($pos === false) {
            $url = str_replace('?option=moopenid','',$_SERVER['REQUEST_URI']);
            $current_url = str_replace('?option=moopenid','',$current_url);

        } else {
            $temp_array1 = explode('/openidcallback',$_SERVER['REQUEST_URI']);
            $url = $temp_array1[0];
            $temp_array2 = explode('/openidcallback',$current_url);
            $current_url = $temp_array2[0];
        }

        $option = get_option( 'mo_openid_login_redirect' );
        $redirect_url = site_url();

        if( $option == 'same' ) {
            if(!is_null($current_url)){
                $redirect_url = $current_url;
            }
            else{
                if(isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off'){
                    $http = "https://";
                } else {
                    $http =  "http://";
                }
                $redirect_url = urldecode(html_entity_decode(esc_url($http . $_SERVER["HTTP_HOST"] . $url)));
                if(html_entity_decode(esc_url(remove_query_arg('ss_message', $redirect_url))) == wp_login_url() || strpos($_SERVER['REQUEST_URI'],'wp-login.php') !== FALSE || strpos($_SERVER['REQUEST_URI'],'wp-admin') !== FALSE){
                    $redirect_url = site_url().'/';
                }
            }
        } else if( $option == 'homepage' ) {
            $redirect_url = site_url();
        } else if( $option == 'dashboard' ) {
            $redirect_url = admin_url();
        } else if( $option == 'custom' ) {
            $redirect_url = get_option('mo_openid_login_redirect_url');
        }else if($option == 'relative') {
            $redirect_url =  site_url() . (null !== get_option('mo_openid_relative_login_redirect_url')?get_option('mo_openid_relative_login_redirect_url'):'');
        }

        if(strpos($redirect_url,'?') !== FALSE) {
            $redirect_url .= get_option('mo_openid_auto_register_enable') ? '' : '&autoregister=false';
        } else{
            $redirect_url .= get_option('mo_openid_auto_register_enable') ? '' : '?autoregister=false';
        }
        return $redirect_url;
    }

    function mo_openid_redirect_after_logout($logout_url) {
        if(get_option('mo_openid_logout_redirection_enable')){
            $logout_redirect_option = get_option( 'mo_openid_logout_redirect' );
            $redirect_url = site_url();
            if( $logout_redirect_option == 'homepage' ) {
                $redirect_url = $logout_url . '&redirect_to=' .home_url()  ;
            }
            else if($logout_redirect_option == 'currentpage'){
                if(isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off'){
                    $http = "https://";
                } else {
                    $http =  "http://";
                }
                $redirect_url = $logout_url . '&redirect_to=' . $http . $_SERVER["HTTP_HOST"] . $_SERVER['REQUEST_URI'];
            }
            else if($logout_redirect_option == 'login') {
                $redirect_url = $logout_url . '&redirect_to=' . site_url() . '/wp-admin' ;
            }
            else if($logout_redirect_option == 'custom') {
                $redirect_url = $logout_url . '&redirect_to=' . site_url() . (null !== get_option('mo_openid_logout_redirect_url')?get_option('mo_openid_logout_redirect_url'):'');
            }
            return $redirect_url;
        }else{
            return $logout_url;
        }

    }

    function mo_openid_login_redirect($username = '', $user = NULL){
        mo_openid_start_session();
        if(is_string($username) && $username && is_object($user) && !empty($user->ID) && ($user_id = $user->ID) && isset($_SESSION['mo_login']) && $_SESSION['mo_login']){
            $_SESSION['mo_login'] = false;
            wp_set_auth_cookie( $user_id, true );
            $redirect_url = mo_openid_get_redirect_url();
            wp_redirect($redirect_url);
            exit;
        }
    }

    function send_otp_token($email){
        $otp = wp_rand(1000,99999);
        $customerKey = get_option('mo_openid_admin_customer_key');
        $stringToHash = $customerKey . $otp;
        $transactionId = hash("sha512", $stringToHash);
        //wp_email function will come here
        $subject= '['.get_bloginfo('name').'] Verify your email';
        $message='Dear User,

Your verification code for completing your profile is: '.$otp.'

Please use this code to complete your profile. Do not share this code with anyone.

Thank you.';

        $response = wp_mail($email, $subject, $message);
        if($response){
            mo_openid_start_session();
            $_SESSION['mo_otptoken'] = true;
            $_SESSION['sent_on'] = time();
            $content = array('status' => 'SUCCESS','tId' => $transactionId);
        }
        else
            $content = array('status' => 'FAILURE');
        return $content;
    }

    function validate_otp_token($transactionId,$otpToken){
        mo_openid_start_session();
        $customerKey = get_option('mo_openid_admin_customer_key');
        if($_SESSION['mo_otptoken']){
            $pass =	checkTimeStamp($_SESSION['sent_on'],time());
            $pass = checkTransactionId($customerKey, $otpToken, $transactionId, $pass);
            if($pass)
                $content = array('status' => 'SUCCESS');
            else
                $content = array('status' => 'FAILURE');
            unset($_SESSION['$mo_otptoken']);
        }
        else
            $content = array('status' =>'FAILURE');

        return $content;
    }

    /*
    * This function checks the time otp was sent to and the time
         * user is validating the otp. The time difference shouldn't be
    * more that 60 seconds.
    *
    * @param $sentTime - the time otp was sent to
    * @param $validatedTime - the time otp was validated
    */

    function checkTimeStamp($sentTime,$validatedTime){
        $diff 		= round(abs($validatedTime - $sentTime) / 60,2);
        if($diff>5)
            return false;
        else
            return true;
    }

    /**
     * This function checks and compares the transaction set in session
     * and one generated during validation. Both need to match for the
     * otp to be validated.
     *
     * @param $customerKey - the customer key of the user
     * @param $otpToken - otp token entered by the user
     * @param $transactionId - the transaction id in session
     * @param $pass - the boolean value passed after the time check
     */

    function checkTransactionId($customerKey,$otpToken,$transactionId,$pass){
        if(!$pass){
            return false;
        }
        $stringToHash 	= $customerKey . $otpToken;
        $txtID 		= hash("sha512", $stringToHash);
        if($txtID == $transactionId)
            return true;
    }

    function mo_openid_filter_app_name($decrypted_app_name)
    {
        $decrypted_app_name = strtolower($decrypted_app_name);
        $split_app_name = explode('_', $decrypted_app_name);
        //check to ensure login starts at the click of social login button
        if(empty($split_app_name[0])){
            wp_die('There was an error during login. Please try to login/register manually. <a href='.site_url().'>Go back to site</a>');
        }
        else {
            return $split_app_name[0];
        }
    }

    function mo_openid_account_linking($messages) {
        if(isset( $_GET['option']) && $_GET['option'] == 'disable-social-login' ){
            $messages = '<p class="message">Link your social account to existing WordPress account by entering username and password.</p>';
        }
        return $messages;
    }

    function mo_openid_customize_logo(){
        $logo =" <div style='float:left;' class='mo_image_id'>
			<a target='_blank' href='https://www.miniorange.com/'>
			<img alt='logo' src='". plugins_url('/includes/images/miniOrange.png',__FILE__) ."' class='mo_openid_image'>
			</a>
			</div>
			<br/>";
        return $logo;
    }

    //delete rows from account linking table that correspond to deleted user
    function mo_openid_delete_account_linking_rows($user_id){
        global $wpdb;
        $db_prefix = $wpdb->prefix;
        $result = $wpdb->get_var($wpdb->prepare("DELETE from ".$db_prefix."mo_openid_linked_user where user_id = %s ",$user_id));
        if($result === false){
            /*$wpdb->show_errors();
            $wpdb->print_error();
            exit;*/
            wp_die('Error deleting user from account linking table');
        }
    }

    function mo_openid_update_role($user_id='', $user_url=''){
        // save the profile url in user meta // this was added to save facebook url in user meta as it is more than 100 chars
        update_user_meta($user_id, 'moopenid_user_profile_url',$user_url);
        if(get_option('mo_openid_login_role_mapping') ){
            $user = get_user_by('ID',$user_id);
            $user->set_role( get_option('mo_openid_login_role_mapping') );
        }
    }

    function mo_openid_get_wp_style(){
        $path = site_url();
        $path .= '/wp-admin/load-styles.php?c=1&amp;dir=ltr&amp;load%5B%5D=dashicons,buttons,forms,l10n,login&amp;ver=4.8.1';
        return $path;
    }

    if(get_option('mo_openid_logout_redirection_enable') == 1){
        add_filter( 'logout_url', 'mo_openid_redirect_after_logout',0,1);
    }

    add_action( 'widgets_init', function(){register_widget( "mo_openid_login_wid" );});
    add_action( 'widgets_init', function(){register_widget( "mo_openid_sharing_ver_wid" );});
    add_action( 'widgets_init', function(){register_widget( "mo_openid_sharing_hor_wid" );});

    add_action( 'init', 'mo_openid_login_validate' );
    //add_action( 'init', 'mo_openid_start_session' );
    add_action( 'wp_logout', 'mo_openid_end_session',1 );
    add_action( 'mo_user_register', 'mo_openid_update_role', 1, 2);
    add_action( 'wp_login', 'mo_openid_login_redirect', 10, 2);
    add_action( 'wp_login', 'mo_openid_link_account', 9, 2);
    add_filter( 'login_message', 'mo_openid_account_linking');
    add_action( 'delete_user', 'mo_openid_delete_account_linking_rows' );
    add_action( 'mo_user_register','mo_openid_send_email',1, 2 );

    //compatibility with international characters
    add_filter('sanitize_user', 'mo_openid_sanitize_user', 10, 3);
    remove_filter('sanitize_title','sanitize_title_with_dashes', 10);
    add_filter( 'sanitize_title', 'mo_openid_sanitize_title_with_dashes', 10, 3 );

    function mo_openid_sanitize_user($username, $raw_username, $strict) {

        $username = wp_strip_all_tags( $raw_username );
        $username = remove_accents( $username );
        // Kill octets
        $username = preg_replace( '|%([a-fA-F0-9][a-fA-F0-9])|', '', $username );
        $username = preg_replace( '/&.+?;/', '', $username ); // Kill entities
        // If strict, reduce to ASCII and Cyrillic characters for max portability.
        if ( $strict )
            $username = preg_replace( '|[^a-zあ-ん\p{Han}а-я0-9ㅂㅈㄷㄱ쇼ㅕㅑㅐㅔㅁㄴㅇㄹ호ㅓㅏㅣㅋㅌㅊ퓨ㅜㅡㅃㅉㄸㄲ썌ㅖ _.\-@]|iu', '', $username );
        $username = trim( $username );
        // Consolidate contiguous whitespace
        $username = preg_replace( '|\s+|', ' ', $username );
        return $username;
    }

    function mo_openid_sanitize_title_with_dashes( $title, $raw_title = '', $context = 'display' ) {

        $title = strip_tags($raw_title);
        // Preserve escaped octets.
        $title = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $title);
        // Remove percent signs that are not part of an octet.
        $title = str_replace('%', '', $title);
        // Restore octets.
        $title = preg_replace('|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $title);
        if (seems_utf8($title)) {
            if (function_exists('mb_strtolower')) {
                $title = mb_strtolower($title, 'UTF-8');
            }
        }

        $title = strtolower($title);

        if ( 'save' == $context ) {
            // Convert nbsp, ndash and mdash to hyphens
            $title = str_replace( array( '%c2%a0', '%e2%80%93', '%e2%80%94' ), '-', $title );
            // Convert nbsp, ndash and mdash HTML entities to hyphens
            $title = str_replace( array( '&nbsp;', '&#160;', '&ndash;', '&#8211;', '&mdash;', '&#8212;' ), '-', $title );
            // Convert forward slash to hyphen
            $title = str_replace( '/', '-', $title );

            // Strip these characters entirely
            $title = str_replace( array(
                // iexcl and iquest
                '%c2%a1', '%c2%bf',
                // angle quotes
                '%c2%ab', '%c2%bb', '%e2%80%b9', '%e2%80%ba',
                // curly quotes
                '%e2%80%98', '%e2%80%99', '%e2%80%9c', '%e2%80%9d',
                '%e2%80%9a', '%e2%80%9b', '%e2%80%9e', '%e2%80%9f',
                // copy, reg, deg, hellip and trade
                '%c2%a9', '%c2%ae', '%c2%b0', '%e2%80%a6', '%e2%84%a2',
                // acute accents
                '%c2%b4', '%cb%8a', '%cc%81', '%cd%81',
                // grave accent, macron, caron
                '%cc%80', '%cc%84', '%cc%8c',
            ), '', $title );
            // Convert times to x
            $title = str_replace( '%c3%97', 'x', $title );
        }

        $title = preg_replace('/&.+?;/', '', $title); // kill entities
        $title = str_replace('.', '-', $title);

        //Do not replace special characters for post
        if (!( 'query' == $context) ) {
            $title = preg_replace('|[^a-zあ-ん\p{Han}а-я0-9ㅂㅈㄷㄱ쇼ㅕㅑㅐㅔㅁㄴㅇㄹ호ㅓㅏㅣㅋㅌㅊ퓨ㅜㅡㅃㅉㄸㄲ썌ㅖ _.\-@]|iu', '', $title);
        }
        $title = preg_replace('/\s+/', '-', $title);
        $title = preg_replace('|-+|', '-', $title);
        $title = trim($title, '-');

        return $title;
    }
}
?>