<?php/***Author: Ashuwp*Author url: http://www.ashuwp.com*Version: 4.5**/class ashuwp_options_feild extends ashuwp_framework_core {  private $options;  private $pageinfo;  private $saved_optionname;    function __construct($ashu_option_conf, $pageinfo) {    global $ashu_option;        $this->options = $ashu_option_conf;    $this->pageinfo = $pageinfo;    $this->saved_optionname = 'ashu_'.$this->pageinfo['optionname'];    //$this->make_data_available();    $ashu_option[$this->pageinfo['optionname']] = get_option($this->saved_optionname);    $ashu_option[$this->pageinfo['optionname']] = $this->htmlspecialchars_deep($ashu_option[$this->pageinfo['optionname']],ENT_QUOTES);        add_action( 'admin_menu', array(&$this, 'add_admin_menu') );	    if( isset($_GET['page']) && ($_GET['page'] == $this->pageinfo['filename']) ) {      add_action('admin_enqueue_scripts', array(&$this, 'enqueue_css_js'));    }  }    function add_admin_menu() {    if($this->pageinfo['child']) {      $parent_slug = $this->pageinfo['parent_slug'];      add_submenu_page($parent_slug, $this->pageinfo['full_name'], $this->pageinfo['full_name'], 'manage_options', $this->pageinfo['filename'], array(&$this, 'initialize'));    }else{      add_menu_page($this->pageinfo['full_name'], $this->pageinfo['full_name'], 'manage_options', $this->pageinfo['filename'], array(&$this, 'initialize'),'',26);    }  }    function make_data_available() {    global $ashu_option;    $ashu_option[$this->pageinfo['optionname']] = get_option($this->saved_optionname);    $option_conf = $this->options;        $ashu_option[$this->pageinfo['optionname']] = $this->htmlspecialchars_deep($ashu_option[$this->pageinfo['optionname']],ENT_QUOTES);    foreach ($option_conf as $key => $option) {            if( isset($option['id']) && isset($ashu_option[$this->pageinfo['optionname']][$option['id']])){        $this->options[$key]['std'] = $ashu_option[$this->pageinfo['optionname']][$option['id']];      }    }      }    function htmlspecialchars_deep ($mixed, $quote_style=ENT_QUOTES, $charset='UTF-8') {    if (is_array($mixed)) {      foreach ($mixed as $key => $value) {        $mixed[$key] = $this->htmlspecialchars_deep($value, $quote_style, $charset);      }    } elseif (is_string($mixed)) {      $mixed = htmlspecialchars_decode($mixed, $quote_style);      //$mixed = htmlspecialchars(htmlspecialchars_decode($mixed, $quote_style),$quote_style,$charset);    }    return $mixed;  }  function initialize() {    $this->get_save_options();    $this->make_data_available();    $this->display();  }    function display() {    $saveoption = false;    echo '<div class="wrap">';    echo '<h2 class="page_title">'.$this->pageinfo['full_name'].'</h2>';    echo '<form method="post" action="">';    echo '<div class="tab-content ashuwp_feild_tabs clearfix">';    $this->tab_toggle($this->options);        foreach ($this->options as $option) {      if( ( $option['type']=='open' || $option['type']=='close' || $option['type']=='title') || ( isset($option['id']) && method_exists($this, $option['type']) ) ) {                if( !isset($option['std']) )          $option['std'] = '';                if(in_array($option['type'],array('text','textarea',)))          $option['std'] = htmlspecialchars($option['std']);                $this->{$option['type']}($option);        $saveoption = true;      }    }        if($saveoption) {      echo '<div class="ashuwp_field"><div class="ashuwp_field_area">';      wp_nonce_field( 'ashuwp_framework_action','ashuwp_framework_field' );      echo '<input type="submit" name="ashuwp_framework_submit" class="button-primary autowidth" value="Save Changes" /><input type="submit" name="ashuwp_framework_reset" class="button-secondary autowidth" value="Clear" /></div></div>';    }        echo '</div></form></div>';  }    function get_save_options() {        $oldoption = $newoptions  = get_option($this->saved_optionname);        if( isset($_REQUEST['ashuwp_framework_field']) && check_admin_referer('ashuwp_framework_action', 'ashuwp_framework_field') ) {      if(!empty($_POST['ashuwp_framework_reset'])){        echo '<div class="updated fade" id="message" style=""><p><strong>Option reseted.</strong></p></div>';                delete_option( $this->saved_optionname );                $ashu_option[$this->pageinfo['optionname']] = '';              }            if(!empty($_POST['ashuwp_framework_submit'])){        echo '<div class="updated fade" id="message" style=""><p><strong>Settings saved.</strong></p></div>';                foreach($this->options as $option) {                    if( $option['type'] == 'tinymce' ){            $value = stripslashes( $_POST[$option['id']] );            $newoptions[$option['id']] = $value;          }elseif( in_array( $option['type'], array('text','textarea') ) ){            $value = stripslashes( $_POST[$option['id']] );            $value = htmlspecialchars($value);            $newoptions[$option['id']] = $value;          }elseif($option['type'] == 'checkbox'){            $newoptions[$option['id']] = empty($_POST[$option['id']]) ? array(): $_POST[$option['id']];          }elseif( $option['type'] == 'numbers_array' || $option['type'] == 'gallery' ){            $value = explode( ',', $_POST[$option['id']] );            $value = array_filter($value);            $newoptions[$option['id']] = $value;          }elseif( in_array( $option['type'], array('open','close','title') ) ){            continue;          }else{            $value = htmlspecialchars($_POST[$option['id']], ENT_QUOTES,"UTF-8");            $newoptions[$option['id']] = $value;          }        }                if ( $oldoption != $newoptions ) {          $oldoption = $newoptions;          update_option($this->saved_optionname, $newoptions);                  }              }          }     }}