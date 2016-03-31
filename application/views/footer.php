<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    $asset_url = str_replace('index.php/','assets',base_url());
    $cscript = array();
    
    switch($module) {
        case 'users':
            array_push($cscript, '<script src="'.$asset_url.'/users/users.js" type="text/javascript"></script>');    
            break;
        
        case 'client':
            array_push($cscript, '<script src="'.$asset_url.'/client/clients.js" type="text/javascript"></script>');
            break;
        
        case 'contacts':
            array_push($cscript, '<script src="'.$asset_url.'/client/clientcontacts.js" type="text/javascript"></script>');
            break;
        
        case 'notice':
            array_push($cscript, '<script src="'.$asset_url.'/billing/billingnotice.js" type="text/javascript"></script>');
            break;
        
        case 'noticemain':
            array_push($cscript, '<script src="'.$asset_url.'/billing/noticemain.js" type="text/javascript"></script>');
            break;            
        
        default:
            array_push($cscript,'');
            break;
    }
?>

    </body>
    <script src="<?php echo $asset_url.'/lib/jquery/jquery-1.11.3.min.js'; ?>" type="text/javascript"></script>
    <script src="<?php echo $asset_url.'/lib/jquery/jquery-migrate-1.2.1.min.js'; ?>" type="text/javascript"></script>
    <script src="<?php echo $asset_url.'/lib/moment/moment-with-locales.min.js'; ?>" type="text/javascript"></script>
    <script src="<?php echo $asset_url.'/lib/bootstrap/js/bootstrap.min.js'; ?>" type="text/javascript"></script>
    <script src="<?php echo $asset_url.'/lib/bootstrap/js/bootstrap-datetimepicker.min.js'; ?>" type="text/javascript"></script>
    <script src="<?php echo $asset_url.'/lib/bootstrap/js/effects/collapse.js'; ?>" type="text/javascript"></script>
    <script src="<?php echo $asset_url.'/lib/bootstrap/js/effects/transition.js'; ?>" type="text/javascript"></script>
    <script src="<?php echo $asset_url.'/lib/accounting.min.js' ?>" type="text/javascript"></script>
    <script src="<?php echo $asset_url.'/config.js'; ?>" type="text/javascript"></script>
    <script src="<?php echo $asset_url.'/auth.js'; ?>" type="text/javascript"></script>
    <?php echo $cscript[0]; ?>
</html>