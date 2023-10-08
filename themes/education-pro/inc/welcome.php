<?php
/**
* 
* @package tx
* @author theme_x
* 
*
* Welcome Screen
*
*/

if( !class_exists('tx_Welcome_Screen') ) {
  class tx_Welcome_Screen {
    public $is_activated;
    function __construct() {
      $this->tx_init();
    }

    public function tx_init() {
      $this->is_activated = get_option('is_valid');
      add_action('admin_menu', array($this, 'tx_welcome_menu'));
      add_action('admin_init', array($this, 'tx_theme_redirect'));
    }

    public function tx_welcome_menu() {
      call_user_func('add_'. 'menu' .'_page', 'Welcome Menu', 'Education Pro', 'edit_posts', 'Welcome', array($this, 'tx_welcome_msg'), null, 60);
      if( !is_plugin_active('education-pro-core/education-pro-core.php') || !is_plugin_active('one-click-demo-import/one-click-demo-import.php') ) :
      add_submenu_page( 'Welcome', 'Manage Plugins', 'Manage Plugins', 'manage_options', 'admin.php?page=ep-install-plugins' );
    endif;

    if(class_exists('OCDI_Plugin')) :
      add_submenu_page( 'Welcome', 'Import Demo', 'Import Demo', 'manage_options', 'admin.php?page=one-click-demo-import' );
    endif;
    
    if(class_exists('ReduxFramework')) :
      if( is_child_theme() ) :
        add_submenu_page( 'Welcome', 'Theme Options', 'Theme Options', 'manage_options', 'admin.php?page=EducationProChild' );
      else:
        add_submenu_page( 'Welcome', 'Theme Options', 'Theme Options', 'manage_options', 'admin.php?page=EducationPro' );
      endif;
    endif;
    }

    public function tx_welcome_msg() { 
      $theme = wp_get_theme();
    ?>

      <div class="tx-wel-wrap">
        <h1><?php esc_html_e( 'Welcome to Education Pro', 'education-pro'); ?><span class="tx-wel-ver"><?php echo esc_html__('v','education-pro'); ?><?php echo wp_sprintf( $theme->get( 'Version' ) ); ?></span></h1>
        
        <div class="tx-wel-txt">
          <?php echo '<p>'.wp_kses_post('Thanks for choosing Education Pro theme!','education-pro').'</p>';
          if( !is_plugin_active('education-pro-core/education-pro-core.php') || !is_plugin_active('one-click-demo-import/one-click-demo-import.php') ) :
            echo '<p>'.wp_kses_post('This theme requires the following plugins installed: <strong>Education Pro Core, One Click Demo Import.</strong>','education-pro').'</p>';
           ?>
          <h3><a class="button-primary" href="<?php echo esc_url(admin_url('themes.php?page=ep-install-plugins')); ?>"><?php esc_html_e('Manage Plugins','education-pro'); ?></a></h3>
          
          <?php endif;
            if( is_plugin_active('education-pro-core/education-pro-core.php') && is_plugin_active('one-click-demo-import/one-click-demo-import.php') ) : ?>
            <p><?php echo esc_html__('To import demo data please go to Dashboard > Education Pro > Import Demo or click the button below','education-pro');?></p>
            <a href="<?php echo esc_url(admin_url('admin.php?page=one-click-demo-import')); ?>" class="button button-primary"><?php echo esc_html_e('Import Demo','education-pro');?> </a>
        <?php endif; 

          echo '<p>'.wp_kses_post('For any issue please contact us via our support section <a href="'.esc_url('https://account.templatemonster.com/?lang=en#/support').'" target="_blank">here.</a>','education-pro').'<br><span style="font-style:italic;font-size:82%">'.esc_html__('Please note: Our support does not include any customization or installation.', 'education-pro'). '</span></p>'; ?>
        </div>
        <div class="tx_welcome_video">
          <?php echo '<p style="border-bottom:1px solid #e6e6e6;margin-top: 30px; margin-bottom: 35px;"></p>'; ?>
          <iframe width="860" height="520" src="https://www.youtube.com/embed/01r_PsFWZlw" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        </div>
      </div>
    <?php
        }
  
    public function tx_theme_redirect() {
      global $pagenow;
      if ( is_admin() && isset( $_GET['activated'] ) && 'themes.php' == $pagenow ) {
        wp_redirect(admin_url('admin.php?page=Welcome')); 
      }
    }

  }

  new tx_Welcome_Screen();
}

