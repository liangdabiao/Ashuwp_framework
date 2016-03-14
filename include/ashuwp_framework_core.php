<?php
/**
*Ashuwp_framework
*Author: Ashuwp
*Author url: http://www.ashuwp.com
*Version: 4.2
**/

function ashuwp_get_option($option_name, $field, $default = ''){
  $ashuwp_option = get_option($option_name);
  if( isset( $ashuwp_option[$field] ) )
    return $ashuwp_option[$field];
  elseif( $default == '' )
    return $default;
  else
    return false;
}

class ashuwp_framework_core {
  
  public $tab_active = 'active';
  public $file_png=array(
    'archive' => 'images/media/archive.png',
    'audio' => 'images/media/audio.png',
    'code' =>  'images/media/code.png',
    '_default' =>  'images/media/default.png',
    '_document' =>  'images/media/document.png',
    'interactive' =>  'images/media/interactive.png',
    'spreadsheet' => 'images/media/spreadsheet.png',
    '_text' => 'images/media/text.png',
    'video' => 'images/media/video.png'
  );
 
  public function enqueue_css_js() {
    wp_enqueue_media();
    wp_enqueue_style('ashuwp_framework_css', get_template_directory_uri(). '/css/ashuwp_framework.css');
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker' );
    wp_enqueue_script('ashuwp_framework_js', get_template_directory_uri(). '/js/ashuwp_framework.js','','',true);

    wp_localize_script( 'ashuwp_framework_js', 'ashu_file_preview', array('img_base'=>includes_url(),'img_path'=>$this->file_png,'ajaxurl' => admin_url( 'admin-ajax.php' )));
  }
  
  /**tab toggle**/
  public function tab_toggle($arr){
    if(!$arr)
      return;
    
    $active = 'class="active"';
    $output = '';
    
    foreach($arr as $values){
     if( !isset($values['id']) )
        continue;
      
      if( $values['type']=='open' ){
        if( !isset($values['name']) || $values['name']=='' )
          $values['name'] = $values['id'];
        
        $output .= '<li '.$active.'><a href="#tab_'.$values['id'].'" data-toggle="tab">'.$values['name'].'</a></li>';
        $active = '';
      }
    }
    if( $output != '' )
      echo '<ul class="nav-tabs">'.$output.'</ul>';
  }
  
  /**tab open**/
  public function open($values) {
    if(!isset($values['id']))
      return;
    
    $group_class = 'class="widefat field_groups tab-pane '.$this->tab_active.'"';
    $group_id = 'tab_'.$values['id'];
    $this->tab_active = '';

    if(!isset($values['name']))
        $values['name'] = "";
    
    echo '<div id="'.$group_id.'" '.$group_class .'>';
      
    if( !isset($values['name']) && $values['name']!='' )
      echo '<div class="groups_title">'.$values['name'].'</div>';
  }
  
  /**tab close**/
  public function close($values) {
    if( isset($values['name']) && $values['name']!='' )
      echo '<div class="groups_footer_title">'.$values['name'].'</div>';
    
    echo '</div>';
  }
  
  /**title**/
  public function title($values) {
    echo '<div class="ashuwp_field">';
    
      if( isset($values['name']) )
        echo '<label class="ashuwp_field_label">'.$values['name'].'</label>';
      
      if( isset($values['desc']) )
        echo '<div class="ashuwp_field_area"><p>'.$values['desc'].'</p></div>';
      
    echo '</div>';
  }
  
  /**input type=text**/
  public function text($values) {
    if( !isset($values['id']) )
      return;
    
    if( !isset($values['std']) )
      $values['std'] = '';
    if( !isset($values['class']) )
      $values['class'] = '';
    
    echo '<div class="ashuwp_field '.$values['class'].'">';
    
      echo '<label class="ashuwp_field_label" for="'.$values['id'].'">';
    
      if( isset($values['name']) )
        echo $values['name'];
    
      echo '</label>';

      echo '<div class="ashuwp_field_area">';
    
        if( isset($values['desc']) && $values['desc']!='')
          echo '<p>'.$values['desc'].'</p>';
        
        echo '<input type="text" value="'.$values['std'].'" class="ashuwp_field_input" id="'.$values['id'].'" name="'.$values['id'].'"/>';
      
      echo '</div>';
    
    echo '</div>';
  }
  
  /**input type=password**/
  public function password($values) {
    if( !isset($values['id']) )
      return;
    
    if( !isset($values['std']) )
      $values['std'] = '';
    
    echo '<div class="ashuwp_field">';
    
      echo '<label class="ashuwp_field_label" for="'.$values['id'].'">';
    
      if( isset($values['name']) )
        echo $values['name'];
    
      echo '</label>';

      echo '<div class="ashuwp_field_area">';
    
        if( isset($values['desc'])  && $values['desc']!='' )
          echo '<p>'.$values['desc'].'</p>';
      
        echo '<input type="password" value="'.$values['std'].'" class="ashuwp_field_input" id="'.$values['id'].'" name="'.$values['id'].'"/>';
      
      echo '</div>';
    
    echo '</div>';
  }
  
  /**input type=numbers_array**/
  public function numbers_array($values) {
    if( !isset($values['id']) )
      return;
    
    if( isset($values['std']) && is_array($values['std']) )
      $nums = implode( ',', $values['std'] );
    else
      $nums = '';
    
    echo '<div class="ashuwp_field">';
    
      echo '<label class="ashuwp_field_label" for="'.$values['id'].'">';
    
      if( isset($values['name']) )
        echo $values['name'];
    
      echo '</label>';

      echo '<div class="ashuwp_field_area">';
    
        if( isset($values['desc'])  && $values['desc']!='' )
          echo '<p>'.$values['desc'].'</p>';
      
        echo '<input type="text" value="'.$nums.'" class="ashuwp_field_input" id="'.$values['id'].'" name="'.$values['id'].'"/>';
      
      echo '</div>';
    
    echo '</div>';
  }
  
  /**coloricker**/
  public function color($values) {
    if( !isset($values['id']) )
      return;
    
    if( !isset($values['std']) )
      $values['std'] = '';
    
    echo '<div class="ashuwp_field">';
    
      echo '<label class="ashuwp_field_label" for="'.$values['id'].'">';
    
      if( isset($values['name']) )
        echo $values['name'];
    
      echo '</label>';

      echo '<div class="ashuwp_field_area">';
    
        if( isset($values['desc'])  && $values['desc']!='' )
          echo '<p>'.$values['desc'].'</p>';
      
        echo '<input type="text" value="'.$values['std'].'" class="ashuwp_color_picker ashuwp_field_input" id="'.$values['id'].'" name="'.$values['id'].'"/>';
      
      echo '</div>';
    
    echo '</div>';
  }
  
  /*input type=radio*/
  public function radio($values) {
    if( !isset($values['id']) )
      return;
    
    if( !isset($values['std']) )
      $values['std'] = '';
    
    echo '<div class="ashuwp_field">';
    
      echo '<div class="ashuwp_field_label">';
    
      if( isset($values['name']) )
        echo $values['name'];
    
      echo '</div>';

      echo '<div class="ashuwp_field_area">';
    
        if( isset($values['desc'])  && $values['desc']!='' )
          echo '<p>'.$values['desc'].'</p>';
        
        if( isset($values['buttons']) && is_array($values['buttons']) ){
          foreach($values['buttons'] as $key=>$value) {
            $checked = '';
            if( $values['std'] == $key ) {
              $checked = 'checked = "checked"';
            }
            echo '<label for="'.$values['id'].'_'.$key.'"><input '.$checked.' type="radio" class="ashuwp_field_radio" value="'.$key.'" id="'.$values['id'].'_'.$key.'" name="'.$values['id'].'"/>'.$value.'</label>';
          }
        }
        
      echo '</div>';
    
    echo '</div>';
  }
  
  /*input type=checkbox*/
  public function checkbox($values) {
    if( !isset($values['id']) )
      return;
    
    if( !isset($values['std']) || !is_array($values['std']) )
      $values['std'] = array();
    
    echo '<div class="ashuwp_field">';
    
      echo '<div class="ashuwp_field_label">';
    
      if( isset($values['name']) )
        echo $values['name'];
    
      echo '</div>';
      
      echo '<div class="ashuwp_field_area">';
    
        if( isset($values['desc'])  && $values['desc']!='' )
          echo '<p>'.$values['desc'].'</p>';
        
        if( isset($values['buttons']) && is_array($values['buttons']) ){
          foreach( $values['buttons'] as $key=>$value ) {
            $checked ="";
            if( in_array($key,$values['std']) ) {
              $checked = 'checked = "checked"';
            }
            echo '<label for="'.$values['id'].'_'.$key.'"><input '.$checked.' type="checkbox" class="ashuwp_field_checkbox" value="'.$key.'" id="'.$values['id'].'_'.$key.'" name="'.$values['id'].'[]"/>'.$value.'</label>';
          }
        }
      
      echo '</div>';
      
    echo '</div>';
  }
  
  /*textarea*/
  public function textarea($values) {
    if( !isset($values['id']) )
      return;
    
    if( !isset($values['std']) )
      $values['std'] = '';

    echo '<div class="ashuwp_field">';
    
      echo '<label class="ashuwp_field_label" for="'.$values['id'].'">';
    
      if( isset($values['name']) )
        echo $values['name'];
    
      echo '</label>';

      echo '<div class="ashuwp_field_area">';
    
        if( isset($values['desc'])  && $values['desc']!='' )
          echo '<p>'.$values['desc'].'</p>';
        
        echo '<textarea class="ashuwp_field_textarea" id="'.$values['id'].'" name="'.$values['id'].'">'.$values['std'].'</textarea>';
        
      echo '</div>';
    
    echo '</div>';
  }
  
  /*select*/
  public function select($values) {
    if( !isset($values['id']) )
      return;
    
    if( !isset($values['std']) )
      $values['std'] = '';
    
    if( !isset($values['subtype']))
      $values['subtype'] = '';
    
    $taxonomies_names = get_taxonomies( array("show_ui" => true, "_builtin" => false), 'names' );

    if($values['subtype'] == 'page') {
      $select = 'Select page';
      $entries = get_pages('title_li=&orderby=name');
    }elseif($values['subtype'] == 'sidebar'){
      global $wp_registered_sidebars;
      $select = 'Select a special sidebar';
      $entries = $wp_registered_sidebars;
    }elseif($values['subtype'] == 'menu'){
      $select = 'Select...';
      $entries = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
    }elseif( $values['subtype'] == 'category' ){
      $select = 'Select...';
      $entries = get_terms( 'category', array( 'hide_empty' => false ) );
    }elseif( $values['subtype'] == 'post_tag' ){
      $select = 'Select...';
      $entries = get_terms( 'post_tag', array( 'hide_empty' => false ) );
    }elseif( in_array($values['subtype'],$taxonomies_names) ){
      $select = 'Select category';
      $entries = get_terms($values['subtype'],array('hide_empty' => false));
    }else{
      $select = 'Select...';
      $entries = $values['subtype'];
    }
    
    if( !isset($values['class']) )
      $values['class'] = '';
    
    echo '<div class="ashuwp_field '.$values['class'].'">';
    
      echo '<label class="ashuwp_field_label">';
    
      if( isset($values['name']) )
        echo $values['name'];
    
      echo '</label>';
      
      echo '<div class="ashuwp_field_area">';
      
        if( isset($values['desc'])  && $values['desc']!='' )
          echo '<p>'.$values['desc'].'</p>';
        
        echo '<select class="ashuwp_field_textarea" id="'. $values['id'] .'" name="'. $values['id'] .'"> ';
        
          echo '<option value="">'.$select .'</option>';
          
          foreach ($entries as $key => $entry) {
            if($values['subtype'] == 'page') {
              $id = $entry->ID;
              $title = $entry->post_title;
            }elseif($values['subtype'] == 'menu'){
              $id = $entry->term_id;
              $title = $entry->name;
            }elseif($values['subtype'] == 'sidebar'){
              $id = $entry['id'];
              $title = $entry['name'];
            }elseif($values['subtype'] == 'category' || $values['subtype'] == 'post_tag'){
              $id = $entry->term_id;
              $title = $entry->name;
            }elseif( in_array($values['subtype'],$taxonomies_names) ){
              $id = $entry->term_id;
              $title = $entry->name;
            }else{
              $id = $key;
              $title = $entry;
            }
            
            if ($values['std'] == $id ) {
              $selected = "selected='selected'";
            }else{
              $selected = "";
            }
            
            echo '<option '.$selected.' value="'. $id.'">'. $title.'</option>';
          }
        echo '</select>';
        
      echo '</div>';
      
    echo '</div>';
  }
  
  /**upload**/
  public function upload($values) {
    if( !isset($values['id']) )
      return;
    
    if( !isset($values['std']) )
      $values['std'] = '';
    
    $button_text = (isset($values['button_text'])) ? $values['button_text'] : 'Upload';

    $file_view = '';
    
    if($values['std'] != ''){
      $file_type = substr($values['std'], strrpos($values['std'] , '.') + 1);
      if( in_array($file_type,array('png','jpg','gif','bmp')) ){
        $file_view = '<img src="'.$values['std'].'" />';
      }elseif( in_array($file_type,array('zip','rar','7z','gz','tar','bz','bz2')) ){
        $file_view = '<img src="'.includes_url().$this->file_png['archive'].'" />';
      }elseif( in_array($file_type,array('mp3','wma','wav','mod','ogg','au')) ){
        $file_view = '<img src="'.includes_url().$this->file_png['audio'].'" />';
      }elseif( in_array($file_type,array('avi','mov','wmv','mp4','flv','mkv')) ){
        $file_view = '<img src="'.includes_url().$this->file_png['video'].'" />';
      }elseif( in_array($file_type,array('swf')) ){
        $file_view = '<img src="'.includes_url().$this->file_png['interactive'].'" />';
      }elseif( in_array($file_type,array('php','js','css','json','html','xml')) ){
        $file_view = '<img src="'.includes_url().$this->file_png['code'].'" />';
      }elseif( in_array($file_type,array('doc','docx','pdf','wps')) ){
        $file_view = '<img src="'.includes_url().$this->file_png['_document'].'" />';
      }elseif( in_array($file_type,array('xls','xlsx','csv','et','ett')) ){
        $file_view = '<img src="'.includes_url().$this->file_png['spreadsheet'].'" />';
      }elseif( in_array($file_type,array('txt','rtf')) ){
        $file_view = '<img src="'.includes_url().$this->file_png['_text'].'" />';
      }else{
        $file_view = '<img src="'.includes_url().$this->file_png['_default'].'" />';
      }
    }
    
    echo '<div class="ashuwp_field">';
    
      echo '<label class="ashuwp_field_label">';
    
      if( isset($values['name']) )
        echo $values['name'];
    
      echo '</label>';

      echo '<div class="ashuwp_field_area">';
      
      echo '<div class="ashu_file_preview" id="'.$values['id'].'_preview">'.$file_view.'</div>';
        
        if( isset($values['desc'])  && $values['desc']!='' )
          echo '<p>'.$values['desc'].'</p>';
        
        echo '<input type="text" class="ashuwp_field_upload" value="'.$values['std'].'" name="'.$values['id'].'" id="'.$values['id'].'_upload"/><a id="'.$values['id'].'" class="ashu_upload_button button" href="#">'.$button_text.'</a>';
        
      echo '</div>';
    
    echo '</div>';
  }
  
  /*gallery*/
  public function gallery($values){
    if( !isset($values['id']) )
      return;
    
    if( isset($values['std']) && is_array($values['std']) )
      $image_ids = implode( ',', $values['std'] );
    else
      $image_ids = '';
    
    $button_text = (isset($values['button_text'])) ? $values['button_text'] : 'Upload';
    
    echo '<div class="ashuwp_field">';
    
      echo '<label class="ashuwp_field_label">';
    
      if( isset($values['name']) )
        echo $values['name'];
    
      echo '</label>';

      echo '<div class="ashuwp_field_area">';
        
        if( isset($values['desc'])  && $values['desc']!='' )
          echo '<p>'.$values['desc'].'</p>';
        
         echo '<div class="gallery_container"><ul class="gallery_view">';
         
         if ( $values['std'] )
           foreach ( $values['std'] as $attachment_id ) {
             echo '<li class="image" data-attachment_id="' . $attachment_id . '">' . wp_get_attachment_image( $attachment_id, 'thumbnail' ) . '<ul class="actions"><li><a href="#" class="delete" title="Delete image">Delete</a></li></ul></li>';
           }
           
         echo '</ul><div class="clear"></div>';
         
         echo '<input type="hidden" id="'.$values['id'].'_input" class="gallery_input" name="'.$values['id'].'" value="'.$image_ids.'" />';
         
         echo '<a href="#" class="add_gallery button">'.$button_text.'</a>';
         
         echo '</div>';
        
      echo '</div>';
      
    echo '</div>';
  }
  
  /*tinymce*/
  public function tinymce($values){
    if( !isset($values['id']) )
      return;
    
    if( !isset($values['std']) )
      $values['std'] = '';
    
	  echo '<div class="ashuwp_field">';
    
      echo '<label class="ashuwp_field_label">';
    
      if( isset($values['name']) )
        echo $values['name'];
    
      echo '</label>';

      echo '<div class="ashuwp_field_area">';
    
        if( isset($values['desc'])  && $values['desc']!='' )
          echo '<p>'.$values['desc'].'</p>';
        
        $settings = array('tinymce'=>1);
        
        if(isset($values['style']) && $values['style']!='')
          $settings['tinymce'] = array(
            'content_css' => $values['style']
          );
        
        if( isset($values['media']) && !$values['media'] )
          $settings['media_buttons'] = 0;
        else
          $settings['media_buttons'] = 1;
        
        wp_editor( $values['std'], $values['id'],$settings );
    
      echo '</div>';
      
    echo '</div>';
  }
}