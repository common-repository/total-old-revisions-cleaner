<?php
require_once(ABSPATH.'wp-includes/pluggable.php');
require_once('langs.php');
function ClearRevisions()
{
  if (isset($_POST['clean']))
  {   
    if ( isset( $_POST['ca_nonce'] ) && check_admin_referer( 'cleaning-action', 'ca_nonce' )) 
    {           
      global $wpdb;
      $sql=  "DELETE posts,rel_ships,meta FROM $wpdb->posts posts LEFT JOIN $wpdb->term_relationships rel_ships ON (posts.ID = rel_ships.object_id) LEFT JOIN $wpdb->postmeta meta ON (posts.ID = meta.post_id) WHERE posts.post_type = 'revision'"; 
      $wpdb->query($sql);          
    }
  } 
}
function GetTextResource()
{
    if (get_bloginfo('language')=='ru-RU')
    {
        return new TextResource_RU();
    }
    elseif(get_bloginfo('language')=='de-DE')
    {
        return new TextResource_DE();
    }
    elseif(get_bloginfo('language')=='fr-FR')
    {
        return new TextResource_FR();
    }
    elseif(get_bloginfo('language')=='uk')
    {
        return new TextResource_UA();
    }
    else
    {
        return new TextResource_EN();
    }
}
?>