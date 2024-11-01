<?php 
function wpfb_set_defaults($defaults){
  foreach ($defaults as $key => $value)
    {
    if (get_option($key)==="" || (!get_option($key)&&get_option($key)!=='0'))
      {
      //echo $key.':'.get_option($key).'<br />';
      update_option($key, $value);
      }
    }
}
function wpfb_update_options($update_message,$cache_message){
  $updates=0;
  foreach ($_POST as $param_name => $param_val) 
    {
    if($param_name=='wpflybox_delete_cache' && $param_val=='1')
      {
      delete_transient('wpfb_d_'.get_option('wpflybox_deviant_username'));
      delete_option('wpfb_d_'.get_option('wpflybox_deviant_username'));
      delete_transient('wpfb_t_'.get_option('wpflybox_twitter'));
      delete_option('wpfb_t_'.get_option('wpflybox_twitter'));
      delete_transient('wpfb_v_'.get_option('wpflybox_vimeo_username'));
      delete_option('wpfb_v_'.get_option('wpflybox_vimeo_username'));
      delete_transient('wpfb_i_'.get_option('wpflybox_instagram_id'));
      delete_option('wpfb_i_'.get_option('wpflybox_instagram_id'));
      delete_transient('wpfb_tu_'.str_replace('.','',get_option('wpflybox_tumblr')));
      delete_option('wpfb_tu_'.str_replace('.','',get_option('wpflybox_tumblr')));      
      echo '<div class="updated"><p><strong>'.$cache_message.'</strong></p></div>';
      update_option($param_name, '0');      
      } else {
      update_option($param_name, $param_val);
      }
    $updates++;
    }
  if($updates>0)
    {
    echo '<div class="updated"><p><strong>'.$update_message.'</strong></p></div>';
    }
}
function wpfb_show_header(){
  if( isset( $_GET[ 'tab' ] ) )
    {
    $active_tab = $_GET[ 'tab' ];
    } else {
    $active_tab = 'general';
    }  
  ?>
  <div class="wrap">
    <div id="icon-themes" class="icon32"></div>
    <h2>WP-FlyBox</h2>
    <h2 class="nav-tab-wrapper">
      <a href="?page=WP-FlyBox&tab=general" class="nav-tab <?php echo $active_tab == 'general' ? 'nav-tab-active' : ''; ?>">General Options</a>
      <a href="?page=WP-FlyBox&tab=display" class="nav-tab <?php echo $active_tab == 'display' ? 'nav-tab-active' : ''; ?>">Display Options</a>
      <a href="?page=WP-FlyBox&tab=tabs" class="nav-tab <?php echo $active_tab == 'tabs' ? 'nav-tab-active' : ''; ?>">Edit Tabs</a>
      <a href="?page=WP-FlyBox&tab=other" class="nav-tab <?php echo $active_tab == 'other' ? 'nav-tab-active' : ''; ?>">Other Options</a>
      <a href="?page=WP-FlyBox&tab=help" class="nav-tab <?php echo $active_tab == 'help' ? 'nav-tab-active' : ''; ?>">Help/More Info</a>
    </h2>
  <?php
  return $active_tab;
}
function wpfb_form_option($name,$pre,$post,$choices){
  ?>
  <tr>			
		<td style="text-align:right;" width="190px">
      <?php echo '<b>'.$pre.':</b>'; ?>
    </td>
    <td>
      <select name="<?php echo $name; ?>">
        <?php
        foreach ($choices as $key => $value)
          {
          echo '<option value="'.$value.'"';
          if(get_option($name)==$value)
            {
            echo 'selected';
            }
          echo '>'.$key.'</option>';
          }
        ?>
      </select> <?php echo $post; ?>
    </td>
  </tr>
<?php
}
function wpfb_form_input($name,$size,$pre,$post){
  ?>
  <tr>
    <td style="text-align:right;" width="190px">
      <?php echo '<b>'.$pre.':</b>'; ?>
    </td>
    <td>
      <?php
      echo '<input type="text" name="'.$name.'" value="'.get_option($name).'" size="'.$size.'" /> '.$post;
      ?>
    </td>
  </tr>
<?php
}
function wpfb_form_checkbox($name,$pre,$post){
  echo $pre.'<input type="hidden" value="0" name="'.$name.'" /><input type="checkbox" name="'.$name.'" value="1"';
  if(get_option($name)=='1')
    {
    echo 'checked';
    }
  echo ' />'.$post;
}
function wpfb_form_textarea($name,$rows, $cols, $pre,$post){
?>
<tr>
    <td style="text-align:right;" width="190px">
<?php
  echo '<b>'.$pre.':</b></td><td><textarea name="'.$name.'" rows="'.$rows.'" cols="'.$cols.'">'.stripslashes(get_option($name)).'</textarea> '.$post.'</td></tr>';
}
?>