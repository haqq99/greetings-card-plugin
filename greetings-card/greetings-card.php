<?php
/**
 * Plugin name: Greetings Card Display by Haqq
 * Description: A wordpress plugin to send greetings to your website visitors. This will improve your User Experience and reduce Bounce rate
 * Version: 0.1
 * Author: Haqq
 * Author URL: haqq.dreamoptimum.com
 * License: GPLV2 or later
*/

/*
This program is a free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of 
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth FLoor, Boston, MA 02110-1301, USA.

Copyright 2005-2022 Automattic, Inc.

*/
if (!defined('ABSPATH')){
    exit;
}
class greetingsCard{
    
    public function __construct(){
        //Create Custom Post
        add_action('init',array($this,'create_custom_post'));

        //Load JS & CSS Scripts
        add_action('wp_enqueue_scripts',array($this,'load_scripts'));

        //Add Shortcode
        add_shortcode('greetings-card',array($this,'load_shortcode'));

        //Add Menu
        add_action('admin_menu',array($this,'admin_pages'));

        //Add Settings Menu
        add_filter('plugin_action_links_'.plugin_basename(__FILE__),array($this,'settings_link'));

        //register admin page settings
        add_action('admin_init',array($this,'register_admin_settings'));
    }

    public function create_custom_post(){

    }

    public function load_scripts(){
        //enqueue attached files
        //wp_enqueue_style("the name you're assigning",plugins_url("stack location",__FILE__))
        wp_enqueue_style('pluginstyle',plugins_url('css/style.css',__FILE__));
        wp_enqueue_script('pluginscript',plugins_url('js/script.js',__FILE__));
    }

    public function load_shortcode(){
    
    $webName=get_option('webName');

    (date('w'));
if (date('w')==0){
    echo "<h2 style='font-size:24px;'>".'Sunday, ';}
if (date('w')==1){
    echo "<h2 style='font-size:24px;'>".'Monday, ';}
if (date('w')==2){
    echo "<h2 style='font-size:24px;'>".'Tuesday, ';}
if (date('w')==3){
    echo "<h2 style='font-size:24px;'>".'Wednesday, ';}
if (date('w')==4){
    echo "<h2 style='font-size:24px;'>".'Thursday, ';}
if (date('w')==5){
    echo "<h2 style='font-size:24px;'>".'Friday, ';}
if (date('w')==6){
    echo "<h2 style='font-size:24px;'>".'Saturday, ';}

//echo date("Y-m-d"), "\n";
echo date('F jS')."</h2>";

$timeOfDay = date('a');
if($timeOfDay == 'am'){
    echo "<h1 style='font-size:30px;'>" .'Good Morning, Welcome to '. $webName.'.</h1>';
    }else{
    echo "<h1 style='font-size:30px;'>" .'Good Afternoon, Welcome to '.$webName.'.</h1>';
    }
    }

    public function admin_pages(){
        add_menu_page('Greeting Card', 'Greetings Card', 'manage_options', 'Greetings_Card', array($this,'admin_index'), 'dashicons-calendar', 55);
    }

    public function settings_link($links){
        //add custom settings link
	    $settings_link_1="<a href='mailto:abubakriibrahim19@gmail.com'>Support</a>";
	    $settings_link_2="<a href='admin.php?page=Greetings+Card'>Settings</a>";
        array_push($links,$settings_link_1,$settings_link_2);
	    return $links;
    }

    public function register_admin_settings(){
        register_setting('formSettings','webName');}

    public function admin_index(){
    ?>
      <table width = "100%" border = "0">     
         <tr>
            <td colspan = "2" bgcolor = "#b5dcb3">
			<center>
			<h1 style="text-align:center;">Greetings Card Settings</h1>
			<b>1. Enter your website name and submit</b><br/>
			<b>2. Copy the display Shortcode</b><br/>
			<b>3. Paste the Shortcode into your post, page, or text widget content</b><br/><br/>
			</center>
		</td>
         </tr>
		<tr valign = "top">
            <td bgcolor = "#aaa" width = "50%">
  <form style='padding: 1em;' method='post' action='options.php'>
  <br/><br/>
  <?php
    settings_fields('formSettings');
    do_settings_sections('formSettings');
    ?>
  <div class="form-group1">
    <label for="webName"><text style="font-size:21px; font-weight:bold;">Website/Company Name:</text></label>
    <input type='text' name='webName' value='<?php echo get_option('webName');?>' class='form-control' id='webName' style="font-size:19px; width:300px; height:40px; border-radius:15px;" required>
  </div>
	<br/>
    <button type="submit" class='btn button-primary' style="font-size:19px; border:none; border-radius:30px; padding-right:1.2em; padding-left:1.2em; text-align:center; display: inline-block; text-decoration: none; background-color: #4CAF50; cursor: pointer;">Submit Settings</button>
</form>
</td>

<td bgcolor = "#eee" width = "100" height = "200">
<form style='padding: 1em;'>
  <br/><br/>
  <div class="form-group2">
    <label for="name"><text style="font-size:22px; font-weight:bold;">Shortcode:</text></label>
    <text><code style="background-color:#ffffff; font-weight:bold; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; color:#4CAF50; font-size:24px;">[greetings-card]</code></text>
  </div>
  <br/>
  <text style="font-size:13.5px">*Upon Submission of the form, Copy the shortcode above and paste it into your post or page content</text>
	<br/>
</form>
         </td>
         </tr>
         
      </table>
    <?php
    }

}

new greetingsCard;
