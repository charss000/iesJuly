<?php
/**
* 
* @package tx
* @author theme_x
* 
* 
* Ajax Login
*
*/

function tx_ajax_login_init(){
global $wp;
    wp_register_script('ajax-login-script', TX_JS . 'login.min.js', array('jquery'), TX_THEME_VERSION, true ); 
    wp_enqueue_script('ajax-login-script');
    wp_localize_script( 'ajax-login-script', 'ajax_login_object', array( 
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'redirecturl' =>  home_url(add_query_arg(array(),$wp->request)),
       // 'redirecturl' => $_SERVER['REQUEST_URI'],
        'loadingmessage' => esc_html__('Sending user info, please wait...','education-pro')
    ));
    // Enable the user with no privileges to run ajax_login() in AJAX
    add_action( 'wp_ajax_nopriv_ajaxlogin', 'tx_ajax_login' );
}
// Execute the action only if the user isn't logged in
if (!is_user_logged_in()) {
    add_action('init', 'tx_ajax_login_init');
}
function tx_ajax_login(){
    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-login-nonce', 'security' );
    // Nonce is checked, get the POST data and sign user on
    $info = array();
    $info['user_login'] = sanitize_text_field($_POST['username']);
    $info['user_password'] = sanitize_text_field($_POST['password']);
    $info['remember'] = true;
   // $user_signon = wp_signon( $info, false );
    $user_signon = wp_signon($info);
    if ( is_wp_error($user_signon) ){
        echo json_encode(array('loggedin' => false, 'message' => esc_html__('Wrong username or password.','education-pro')));
    } else {
        echo json_encode(array('loggedin' => true, 'message' => esc_html__('Login successful, redirecting...','education-pro')));
    }
    wp_die();
}               add_action( 'tx_login_register', 'tx_login_register' );
                function tx_login_register() {
                    global $tx;
                    if (is_user_logged_in()) { ?>
                        <a class="login_button" href="<?php echo wp_logout_url( home_url() ); ?>"><?php esc_html_e('Logout', 'education-pro'); ?></a>
                    <?php } else { ?>
                        <a class="login_button" id="show_login" href=""><?php echo esc_html_e($tx['login-register'],'education-pro'); ?></a>
                    <?php } ?>
                    
                <?php }