<?php
$db=new \clinela\database\DB();
$page=new \clinela\template\admin\AdminPage('Settings');
$db->hasAccess('admin/settings',3);

if ( isset( $_POST['type'] ) && $_POST['type'] == 'site_info' ) {
    $site_name = filter_input( INPUT_POST, 'site_name', FILTER_SANITIZE_STRIPPED );
    $site_email = filter_input( INPUT_POST, 'site_email', FILTER_SANITIZE_EMAIL );
    $site_copyright = filter_input( INPUT_POST, 'site_copyright', FILTER_SANITIZE_STRIPPED );
    $site_support_address = filter_input( INPUT_POST, 'site_support_address', FILTER_SANITIZE_STRIPPED );
    $site_support_phone = filter_input( INPUT_POST, 'site_support_phone', FILTER_SANITIZE_STRIPPED );
    $site_support_email = filter_input( INPUT_POST, 'site_support_email', FILTER_SANITIZE_EMAIL );
    $booking_fee = filter_input( INPUT_POST, 'booking_fee', FILTER_SANITIZE_NUMBER_INT );
    $tax = filter_input( INPUT_POST, 'tax', FILTER_SANITIZE_NUMBER_INT );
    $flutterwave_public_key = filter_input( INPUT_POST, 'flutterwave_public_key', FILTER_SANITIZE_STRIPPED );
    $flutterwave_secret_key = filter_input( INPUT_POST, 'flutterwave_secret_key', FILTER_SANITIZE_STRIPPED );
    $flutterwave_encryption_key = filter_input( INPUT_POST, 'flutterwave_encryption_key', FILTER_SANITIZE_STRIPPED );

    $db->updateOptions( 'site_name', $site_name );
    $db->updateOptions( 'site_email', $site_email );
    $db->updateOptions( 'site_copyright', $site_copyright );
    $db->updateOptions( 'site_support_address', $site_support_address );
    $db->updateOptions( 'site_support_phone', $site_support_phone );
    $db->updateOptions( 'site_support_email', $site_support_email );
    $db->updateOptions( 'booking_fee', $booking_fee );
    $db->updateOptions( 'tax', $tax );
    $db->updateOptions( 'flutterwave_public_key', $flutterwave_public_key );
    $db->updateOptions( 'flutterwave_secret_key', $flutterwave_secret_key );
    $db->updateOptions( 'flutterwave_encryption_key', $flutterwave_encryption_key );

    $header_color = filter_input( INPUT_POST, 'header_color', FILTER_SANITIZE_STRIPPED );
    $footer_color = filter_input( INPUT_POST, 'footer_color', FILTER_SANITIZE_STRIPPED );
    $sidebar_color = filter_input( INPUT_POST, 'sidebar_color', FILTER_SANITIZE_STRIPPED );
    $sidebar_color = filter_input( INPUT_POST, 'admin_sidebar_color', FILTER_SANITIZE_STRIPPED );
    $page_color = filter_input( INPUT_POST, 'page_color', FILTER_SANITIZE_STRIPPED );
    $section_1_color = filter_input( INPUT_POST, 'section_1_color', FILTER_SANITIZE_STRIPPED );
    $section_2_color = filter_input( INPUT_POST, 'section_2_color', FILTER_SANITIZE_STRIPPED );
    $section_3_color = filter_input( INPUT_POST, 'section_3_color', FILTER_SANITIZE_STRIPPED );
    $section_4_color = filter_input( INPUT_POST, 'section_4_color', FILTER_SANITIZE_STRIPPED );
    $section_5_color = filter_input( INPUT_POST, 'section_5_color', FILTER_SANITIZE_STRIPPED );

    $db->updateOptions( 'header_color', $header_color );
    $db->updateOptions( 'footer_color', $footer_color );
    $db->updateOptions( 'sidebar_color', $sidebar_color );
    $db->updateOptions( 'admin_sidebar_color', $sidebar_color );
    $db->updateOptions( 'page_color', $page_color );

    $db->updateOptions( 'section_1_color', $section_1_color );
    $db->updateOptions( 'section_2_color', $section_2_color );
    $db->updateOptions( 'section_3_color', $section_3_color );
    $db->updateOptions( 'section_4_color', $section_4_color );
    $db->updateOptions( 'section_5_color', $section_5_color );


    $image=new \clinela\utils\Upload(null,$_FILES['header_logo']);
    $header_logo=$image->startUpload();
    $header_logo_name=!empty($header_logo['name'])?$header_logo['name']:$db->getOptions('header_logo');

    $image=new \clinela\utils\Upload(null,$_FILES['footer_logo']);
    $footer_logo=$image->startUpload();
    $footer_logo_name=!empty($footer_logo['name'])?$footer_logo['name']:$db->getOptions('footer_logo');

    $footer_text = filter_input( INPUT_POST, 'footer_text', FILTER_SANITIZE_STRIPPED );
    $db->updateOptions( 'header_logo', $header_logo_name );
    $db->updateOptions( 'footer_text', $footer_text );
    $db->updateOptions( 'footer_logo', $footer_logo_name );

    $title1 = filter_input( INPUT_POST, 'section_1_title', FILTER_SANITIZE_STRIPPED );
    $subtitle1 = filter_input( INPUT_POST, 'section_1_subtitle', FILTER_SANITIZE_STRIPPED );
    $image=new \clinela\utils\Upload(null,$_FILES['section_1_banner']);
    $section_1_banner=$image->startUpload();
    $section_1_banner_name=!empty($section_1_banner['name'])?$section_1_banner['name']:$db->getOptions('section_1_banner');

    $db->updateOptions( 'section_1_title', $title1 );
    $db->updateOptions( 'section_1_subtitle', $subtitle1 );
    $db->updateOptions( 'section_1_banner', $section_1_banner_name );
    $db->updateOptions( 'section_1_show', true );

    $title2 = filter_input( INPUT_POST, 'section_2_title', FILTER_SANITIZE_STRIPPED );
    $subtitle2 = filter_input( INPUT_POST, 'section_2_subtitle', FILTER_SANITIZE_STRIPPED );
    $count2 = filter_input( INPUT_POST, 'section_2_count', FILTER_SANITIZE_NUMBER_INT);
    $db->updateOptions( 'section_2_title', $title2 );
    $db->updateOptions( 'section_2_subtitle', $subtitle2 );
    $db->updateOptions( 'section_2_count', $count2 );
    $db->updateOptions( 'section_2_show', true );

    $title3 = filter_input( INPUT_POST, 'section_3_title', FILTER_SANITIZE_STRIPPED );
    $subtitle3 = filter_input( INPUT_POST, 'section_3_subtitle', FILTER_SANITIZE_STRIPPED );
    $content3 = filter_input( INPUT_POST, 'section_3_content', FILTER_SANITIZE_STRIPPED );
    $count3 = filter_input( INPUT_POST, 'section_3_count', FILTER_SANITIZE_NUMBER_INT);
    $db->updateOptions( 'section_3_title', $title3 );
    $db->updateOptions( 'section_3_subtitle', $subtitle3);
    $db->updateOptions( 'section_3_content', $content3 );
    $db->updateOptions( 'section_3_count', $count3);
    $db->updateOptions( 'section_3_show', true );

    $title4 = filter_input( INPUT_POST, 'section_4_title', FILTER_SANITIZE_STRIPPED );
    $subtitle4 = filter_input( INPUT_POST, 'section_4_subtitle', FILTER_SANITIZE_STRIPPED );
    $count4 = filter_input( INPUT_POST, 'section_4_count', FILTER_SANITIZE_NUMBER_INT);

    $image=new \clinela\utils\Upload(null,$_FILES['section_4_banner']);
    $section_4_banner=$image->startUpload();
    $section_4_banner_name=!empty($section_4_banner['name'])?$section_4_banner['name']:$db->getOptions('section_4_banner');

    $db->updateOptions( 'section_4_title', $title4 );
    $db->updateOptions( 'section_4_subtitle', $subtitle4 );
    $db->updateOptions( 'section_4_banner', $section_4_banner_name );
    $db->updateOptions( 'section_4_count', $count4 );
    $db->updateOptions( 'section_4_show', true );


    $facebook = filter_input( INPUT_POST, 'social_facebook', FILTER_SANITIZE_URL );
    $twitter = filter_input( INPUT_POST, 'social_twitter', FILTER_SANITIZE_URL );
    $instagram = filter_input( INPUT_POST, 'social_instagram', FILTER_SANITIZE_URL );
    $linkedin = filter_input( INPUT_POST, 'social_linkedin', FILTER_SANITIZE_URL );
    $telegram = filter_input( INPUT_POST, 'social_telegram', FILTER_SANITIZE_URL );
    $whatsapp = filter_input( INPUT_POST, 'social_whatsapp', FILTER_SANITIZE_URL );
    $db->updateOptions( 'social_facebook', $facebook );
    $db->updateOptions( 'social_twitter', $twitter );
    $db->updateOptions( 'social_linkedin', $linkedin );
    $db->updateOptions( 'social_instagram', $instagram );
    $db->updateOptions( 'social_telegram', $telegram);
    $db->updateOptions( 'social_whatsapp', $whatsapp );

    $header_code = $db->htmlXSpecialChars( $_POST['site_header_code'] );
    $footer_code = $db->htmlXSpecialChars( $_POST['site_footer_code'] );
    $db->updateOptions( 'site_header_code', $header_code );
    $db->updateOptions( 'site_footer_code', $footer_code );
}


$page->setPageContent('admin/settings.blade.php');
$page->makePage();