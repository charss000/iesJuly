<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
* ======================================================================
*   Updates 
* ======================================================================
*/

require_once TX_THEME_DIR . 'inc/class-updates.php';
class EducationPro {
  public $plugin_file=__FILE__;
  public $responseObj;
  public $licenseMessage;
  public $showMessage=false;
  public $slug="Welcome";
  function __construct() {
    $licenseKey=get_option("EducationPro_lic_Key","");
    $liceEmail=get_option( "EducationPro_lic_email","");
    $templateDir=get_template_directory(); //or dirname(__FILE__);
    if(EducationProBase::CheckWPPlugin($licenseKey,$liceEmail,$this->licenseMessage,$this->responseObj,$templateDir."/style.css")){
      add_action( 'admin_menu', [$this,'ActiveAdminMenu'],99999);
     // add_action( 'after_setup_theme', 'tx_theme_setup' );
      add_action( 'admin_post_EducationPro_el_deactivate_license', [ $this, 'action_deactivate_license' ] );
     // add_action( 'tx_logo', 'tx_logo' );
      add_action('admin_head', 'tx_welcome_js');
      function tx_welcome_js() { ?>
        <script>
          jQuery(document).ready(function($){'use strict';      
            $('.tx-wel-wrap').css('opacity', '1');
          });
        </script>
<?php }

      // require_once TX_THEME_DIR . 'inc/mega-menu.php'; // mega menu
      // require_once TX_THEME_DIR . 'inc/tgm.php'; // TGM plugin activation
      // require_once TX_THEME_DIR . 'inc/custom-sidebars.php'; // Widgets Sidebars
      // require_once TX_THEME_DIR . 'inc/login.php'; // ajax login

    }else{
      if(!empty($licenseKey) && !empty($this->licenseMessage)){
        $this->showMessage=true;
      }
      update_option("EducationPro_lic_Key","") || add_option("EducationPro_lic_Key","");
      add_action( 'admin_post_EducationPro_el_activate_license', [ $this, 'action_activate_license' ] );
      add_action( 'admin_menu', [$this,'InactiveMenu']);
    }
        }
  function ActiveAdminMenu(){
     
   add_menu_page (  "EducationPro", "Education Pro", "activate_plugins", $this->slug, [$this,"Activated"], null, 60);

  }
  function InactiveMenu() {
    add_menu_page( "EducationPro", "Education Pro", 'activate_plugins', $this->slug,  [$this,"LicenseForm"], null, 60);
    
  }
  function action_activate_license(){
    check_admin_referer( 'el-license' );
    $licenseKey=!empty($_POST['el_license_key'])?sanitize_text_field($_POST['el_license_key']):"";
    $licenseEmail=!empty($_POST['el_license_email'])?sanitize_email($_POST['el_license_email']):"";
    update_option("EducationPro_lic_Key",$licenseKey) || add_option("EducationPro_lic_Key",$licenseKey);
    update_option("EducationPro_lic_email",$licenseEmail) || add_option("EducationPro_lic_email",$licenseEmail);
    update_option('_site_transient_update_themes','');
    wp_safe_redirect(admin_url( 'admin.php?page='.$this->slug));
  }
  function action_deactivate_license() {
    check_admin_referer( 'el-license' );
    $message="";
    if(EducationProBase::RemoveLicenseKey(__FILE__,$message)){
      update_option("EducationPro_lic_Key","") || add_option("EducationPro_lic_Key","");
      update_option('_site_transient_update_themes','');
    }
      wp_safe_redirect(admin_url( 'admin.php?page='.$this->slug));
    }
  function Activated(){
    ?>
        <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
            <input type="hidden" name="action" value="EducationPro_el_deactivate_license"/>
            <div class="el-license-container">
                <h3 class="el-license-title"><?php esc_html_e("Your License Info","education-pro");?> </h3>
                <hr>
                <ul class="el-license-info">
                <li>
                    <div>
                        <span class="el-license-info-title"><?php _e("Status","education-pro");?></span>

                        <?php if ( $this->responseObj->is_valid ) : ?>
                            <span class="el-license-valid"><?php _e("Valid","education-pro");?></span>
                        <?php else : ?>
                            <span class="el-license-valid"><?php _e("Invalid","education-pro");?></span>
                        <?php endif; ?>
                    </div>
                </li>

                <li>
                    <div>
                        <span class="el-license-info-title"><?php _e("License Type","education-pro");?></span>
                        <?php echo esc_html($this->responseObj->license_title); ?>
                    </div>
                </li>

                <li>
                    <div>
                        <span class="el-license-info-title"><?php _e("Your License Key","education-pro");?></span>
                        <span class="el-license-key"><?php echo esc_attr( substr($this->responseObj->license_key,0,9)."XXXXXXXX-XXXXXXXX".substr($this->responseObj->license_key,-9) ); ?></span>
                    </div>
                </li>
                </ul>
                <div class="el-license-active-btn">
                    <?php wp_nonce_field( 'el-license' ); ?>
                    <?php submit_button('Deactivate'); ?>
                </div>
            </div>
        </form>
    <?php
  }
  
  function LicenseForm() {
    ?>
        <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
            <input type="hidden" name="action" value="EducationPro_el_activate_license"/>
            <div class="el-license-container">
                <h3 class="el-license-title"><?php esc_html_e('Theme Registration', 'education-pro');?></h3>
                <h3><?php esc_html_e('Please register the theme to unlock all features and get regular updates.', 'education-pro'); ?></h3>
                <hr>
        <?php
          if(!empty($this->showMessage) && !empty($this->licenseMessage)){
            ?>
                        <div class="notice notice-error is-dismissible">
                            <p><?php echo esc_html($this->licenseMessage); ?></p>
                        </div>
            <?php
          }
        ?>
            <div class="el-license-field">
              <label for="el_license_key"><?php _e("Order ID","education-pro");?></label>
              <input type="text" class="regular-text code" name="el_license_key" size="50" placeholder="xxxxxxxxxxxxxxxxxxxx" required="required">
            </div>
                <div class="el-license-field">
                    <label for="el_license_key"><?php _e("Email Address","education-pro");?></label>
                    <?php
                        $purchaseEmail   = get_option( "EducationPro_lic_email", get_bloginfo( 'admin_email' ));
                    ?>
                    <input type="text" class="regular-text code" name="el_license_email" size="50" placeholder="<?php esc_html_e('TemplateMonster account email address', 'education-pro'); ?>" required="required">
                    
                </div>
                <div class="el-license-active-btn">
          <?php wp_nonce_field( 'el-license' ); ?>
          <?php submit_button('Activate'); ?>
                </div>
            </div>
        </form>
    <?php
  }
}

new EducationPro();