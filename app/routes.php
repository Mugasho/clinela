<?php
$router=new AltoRouter();
$router->setBasePath( '');
$router->map( 'GET|POST', '/', 'views/public/index.view.php', 'home' );
$router->map( 'GET|POST', '/login/', 'views/public/login.view.php', 'login' );
$router->map( 'GET|POST', '/register/', 'views/patient/register.view.php', 'register' );
$router->map( 'GET|POST', '/user/verified/', 'views/public/verified.view.php', 'verified' );
$router->map( 'GET|POST', '/user/verify/[*:id]/', 'views/public/verify.view.php', 'verify' );

$router->map( 'GET|POST', '/forgot/', 'views/public/forgot.view.php', 'forgot' );
$router->map( 'GET|POST', '/logout/', 'views/public/logout.view.php', 'logout' );
$router->map( 'GET|POST', '/registered/', 'views/public/registered.view.php', 'registered' );

$router->map( 'GET|POST', '/setup/', 'views/admin/setup.php', 'setup' );
$router->map( 'GET|POST', '/doctors/', 'views/public/doctors.view.php', 'search' );
$router->map( 'GET|POST', '/blog/', 'views/public/blog.view.php', 'blog' );
$router->map( 'GET|POST', '/blog/[*:id]/', 'views/public/blog-detail.view.php', 'blog-detail' );
$router->map( 'GET|POST', '/doctors/[*:id]/', 'views/public/doctor-detail.view.php', 'doctor-detail' );
$router->map( 'GET|POST', '/clinics/', 'views/public/clinics.view.php', 'clinics' );
$router->map( 'GET|POST', '/clinics/[*:id]/', 'views/public/clinic-detail.view.php', 'clinic-detail' );
$router->map( 'GET|POST', '/booking/[*:id]/', 'views/public/booking.view.php', 'booking' );
$router->map( 'GET|POST', '/checkout/[*:id]/', 'views/public/checkout.view.php', 'checkout' );
$router->map( 'GET|POST', '/booked/[*:id]/', 'views/public/booked.view.php', 'booked' );
$router->map( 'GET|POST', '/book-fail/', 'views/public/book-fail.view.php', 'book-failed' );
$router->map( 'GET|POST', '/invoices/[*:id]/', 'views/public/invoice-detail.view.php', 'patient-invoice' );
$router->map( 'GET|POST', '/payment/[*:id]/', 'views/api/payment.view.php', 'payment' );
$router->map( 'GET|POST', '/chat/[*:id]/', 'views/public/chat.view.php', 'chat' );
$router->map( 'GET|POST', '/chat-api/[*:id]/', 'views/api/chat.view.php', 'chat-api' );

$router->map( 'GET|POST', '/patient/', 'views/admin/patients.php', 'patients' );
$router->map( 'GET|POST', '/patient/dashboard/', 'views/patient/dashboard.view.php', 'patient-dashboard' );
$router->map( 'GET|POST', '/patient/profile/', 'views/patient/profile.view.php', 'patient-profile' );
$router->map( 'GET|POST', '/patient/change-password/', 'views/patient/pass-change.view.php', 'patient-pass' );
$router->map( 'GET|POST', '/patient/favourites/', 'views/patient/favourites.view.php', 'patient-favourites' );
$router->map( 'GET|POST', '/patient/invoices/', 'views/patient/favourites.view.php', 'patient-invoices' );



$router->map( 'GET|POST', '/doctor/dashboard/', 'views/doctor/dashboard.view.php', 'doctor-dashboard' );
$router->map( 'GET|POST', '/doctor/profile/', 'views/doctor/profile.view.php', 'doctor-profile' );
$router->map( 'GET|POST', '/doctor/change-password/', 'views/doctor/pass-change.view.php', 'doctor-pass' );
$router->map( 'GET|POST', '/doctor/reviews/', 'views/doctor/reviews.view.php', 'doctor-reviews' );
$router->map( 'GET|POST', '/doctor/schedule/', 'views/doctor/schedule.view.php', 'doctor-schedule' );
$router->map( 'GET|POST', '/doctor/appointments/', 'views/doctor/appointments.view.php', 'doctor-appointments' );
$router->map( 'GET|POST', '/doctor/my-patients/', 'views/doctor/my-patients.view.php', 'my-patients' );
$router->map( 'GET|POST', '/doctor/social-media/', 'views/doctor/social.view.php', 'doctor-social' );
$router->map( 'GET|POST', '/doctor/invoices/', 'views/doctor/invoices.view.php', 'doctor-invoices' );
$router->map( 'GET|POST', '/doctor/patient/[*:id]/', 'views/doctor/patient-profile.view.php', 'doctor-patient' );


$router->map( 'GET|POST', '/admin/', 'views/admin/dashboard.view.php', 'admin-dashboard' );
$router->map( 'GET|POST', '/admin/speciality/', 'views/admin/speciality.view.php', 'admin-speciality' );
$router->map( 'GET|POST', '/admin/doctor/', 'views/admin/doctor.view.php', 'admin-doctors' );
$router->map( 'GET|POST', '/admin/patient/', 'views/admin/patient.view.php', 'admin-patients' );
$router->map( 'GET|POST', '/admin/features/', 'views/admin/features.view.php', 'admin-features' );
$router->map( 'GET|POST', '/admin/settings/', 'views/admin/settings.view.php', 'admin-settings' );
$router->map( 'GET|POST', '/admin/add-post/', 'views/admin/add-post.view.php', 'admin-add-post' );
$router->map( 'GET|POST', '/admin/posts/', 'views/admin/posts.view.php', 'admin-posts' );
$router->map( 'GET|POST', '/admin/posts/category/', 'views/admin/post-category.view.php', 'admin-posts-categories' );
$router->map( 'GET|POST', '/admin/posts/comments/', 'views/admin/post-comments.view.php', 'admin-posts-comments' );
$router->map( 'GET|POST', '/admin/edit-post/[*:id]/', 'views/admin/edit-post.view.php', 'admin-edit-post' );
$router->map( 'GET|POST', '/admin/clinics/', 'views/admin/clinics.view.php', 'admin-clinics' );
$router->map( 'GET|POST', '/admin/users/', 'views/admin/users.view.php', 'admin-users' );
$router->map( 'GET|POST', '/admin/users/[*:id]/', 'views/admin/profile.view.php', 'admin-users-profile' );
$router->map( 'GET|POST', '/admin/endpoint/', 'views/api/endpoint.php', 'admin-endpoint' );

$router->map( 'GET|POST', '/request/[*:id]/', 'views/api/request.php', 'request' );


/* Match the current request */
$match = $router->match();
if ( $match ) {
    if(!file_exists('app/config/database.php')){
        require 'views/admin/setup.php';
    }else{
        require $match['target'];
    }

} else {
    header( "HTTP/1.0 404 Not Found" );
    require 'utils/404.php';
}