<?php
/*
  Plugin Name:  total-old-revisions-cleaner
  Description: Удаление устаревших редакций страниц и записей из базы данных в 1 клик
  Version: 4.1.1
  Author: Стрелец Coder
  Author URI: http://streletzcoder.cf
  Plugin URI: http://streletzcoder.cf/category/programs/totaloldrevisioncleaner/
 */
?>
<?php
/*  Copyright 2015-2020  Стрелец Coder  (email: soft-streletzcoder@yandex.ru)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details. Total Old Revision Cleaner

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */
?>
<?php
define('PLUGIN_DIR', plugin_dir_path(__FILE__));
require_once(PLUGIN_DIR . '/includes/engine.php');
require_once(PLUGIN_DIR . '/includes/langs.php');

class TotalOldRevCleaner {

    private $textRes;

    public function TotalOldRevCleaner() {
        $this->textRes = GetTextResource();
    }

    private function actionCleaningJs() {
        ?>	
        <script type="text/javascript">
            function SendTRCData()
            {
                var chb = document.getElementById('TRC_checkbox');
                var check = true;
                if (chb.checked)
                {
                    if (!confirm('<?php echo $this->textRes->GetConfirmText(); ?>'))
                    {
                        check = false;
                    }
                } else
                {
                    check = false;
                }
                if (check)
                {
                    var caNonce = document.getElementById('ca_nonce').value;
                    jQuery.post(ajaxurl, {'action': 'torcaction', 'clean': true, 'ca_nonce': caNonce}, function (data) {
                        var chb1 = document.getElementById('trc_result');
                        chb1.innerHTML = "<?php echo $this->textRes->GetSuccessTitle(); ?>";
                        jQuery("#TRC_checkbox").attr("checked", false);
                    });
                }
            }
        </script>
        <?php
    }

    public function admin_form() {
        $this->actionCleaningJs();
        ?>
        <div class="wrap">
            <h2><?php echo $this->textRes->GetConsoleWidgetText();?></h2>
            <hr />
            <form method="post" onsubmit="return false;" >
                <input id="TRC_checkbox" type="checkbox" name="clean" />
                <label><?php echo $this->textRes->GetCaption(); ?></label>
                <br />
        <?php wp_nonce_field('cleaning-action', 'ca_nonce'); ?>
                <br />
                <input type="submit" class="button button-primary" name="ok" value="<?php echo $this->textRes->GetButtonText(); ?>" onclick="SendTRCData()" />
            </form>
            <p id="trc_result"></p>
        </div>
        <?php
    }

//Конец admin_form
//Widget
public function dashboard_widget_content() {
        $this->actionCleaningJs();
        ?>
        <div class="wrap"> 
            <form method="post" onsubmit="return false;" >
                <input id="TRC_checkbox" type="checkbox" name="clean" />
                <label><?php echo $this->textRes->GetCaption(); ?></label>
                <br />
        <?php wp_nonce_field('cleaning-action', 'ca_nonce'); ?>
                <br />
                <input type="submit" class="button button-primary" name="ok" value="<?php echo $this->textRes->GetButtonText(); ?>" onclick="SendTRCData()" />
            </form>
            <p id="trc_result"></p>
        </div>
        <?php
    }
//End Widget    

    public function plugin_admin_menu() {
        add_options_page('total-old-revisions-cleaner', $this->textRes->GetConsoleWidgetText(), 8, basename(__FILE__), array($this, 'admin_form'));
    }

    public function add_plugin_admin_menu() {
        add_action('admin_menu', array($this, 'plugin_admin_menu'));
    }

    /* Виджет консоли */

    public function dashboard_control() {
        $this->dashboard_widget_content();
    }

    public function dashboard_widget() {
        global $wp_meta_boxes;
        wp_add_dashboard_widget('TRC_dashboard_widget', $this->textRes->GetConsoleWidgetText(), array($this, 'dashboard_control'));
    }

    public function add_dashboard_widget() {
        add_action('wp_dashboard_setup', array($this, 'dashboard_widget'));
    }

    public function add_ajax_action() {
        //add_action('admin_footer',array(this,'torcJs'));
        add_action('wp_ajax_torcaction', array(&$this, 'cleaning_action'));
    }

    public function cleaning_action() {
        ClearRevisions();
    }

}

$cleaner = new TotalOldRevCleaner();
$cleaner->add_plugin_admin_menu();
$cleaner->add_dashboard_widget();
$cleaner->add_ajax_action();
?>
