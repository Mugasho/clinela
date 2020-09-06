<?php


namespace clinela\template\admin;


use clinela\database\DB;

class AdminPage extends \clinela\template\Master
{
    /**
     * Page constructor.
     *
     * @param $pageTitle
     */
    public function __construct($pageTitle)
    {
        $db = new DB();
        $db->start_session();
        $this->setCompany($db->getOptions('site_name'));
        $this->setHeaderCode($db->htmlDecode($db->getOptions('site_header_code')));
        $this->setFooterCode($db->htmlDecode($db->getOptions('site_footer_code')));
        $this->setBodyClass('');
        $this->setPageTitle($pageTitle);
        $this->setMetaAuthor('Lincoln Mugasho');
        $this->setMetaDescription('Doctor booking');
        $this->setMetaViewport('width=device-width, initial-scale=1, shrink-to-fit=no');
        $this->setMetaKeywords('doctor,patient,booking');

        $this->addStyle('bootstrap.min.css', CONTENT_PATH . 'admin/css/');
        $this->addStyle('font-awesome.min.css', CONTENT_PATH . 'admin/css/');
        $this->addStyle('feathericon.min.css', CONTENT_PATH . 'admin/css/');
        $this->addStyle('sweetalert.min.css', CONTENT_PATH . 'public/plugins/sweet-alert/');
        $this->addStyle('style.css', CONTENT_PATH . 'admin/css/');


        $this->addScripts('jquery-3.2.1.min.js', CONTENT_PATH . 'admin/js/');
        $this->addScripts('popper.min.js', CONTENT_PATH . 'admin/js/');
        $this->addScripts('bootstrap.min.js', CONTENT_PATH . 'admin/js/');
        $this->addScripts('jquery.slimscroll.min.js', CONTENT_PATH . 'admin/plugins/slimscroll/');
        $this->addScripts('sweetalert.min.js', CONTENT_PATH . 'public/plugins/sweet-alert/');
        $this->addFooterScripts('script.js', CONTENT_PATH . 'admin/js/');

        $this->addStyle('datatables.css', CONTENT_PATH . 'admin/plugins/datatables/');
        $this->addScripts('datatables.js', CONTENT_PATH.'admin/plugins/datatables/');

        $this->setCopyright($db->getOptions('site_copyright'));

        $this->addMenu('Home', 'admin/', 'fe fe-home', null);
        $this->addMenu('Doctors', 'admin/doctor/', 'fe fe-user-plus', null);
        $this->addMenu('Patients', 'admin/patient/', 'fe fe-umbrella', null);
        $this->addMenu('Specialities', 'admin/speciality/', 'fe fe-star', null);
        $this->addMenu('Features', 'admin/features/', 'fe fe-vector', null);
        $this->addMenu('Posts', 'admin/posts/', 'fe fe-document', array(
            'Posts'=>'admin/posts/',
            'Add post'=>'admin/add-post/',
            'Categories'=>'admin/posts/category/',
            'Comments'=>'admin/posts/comments/'
        ));
        $this->addMenu('Clinics', 'admin/clinics/', 'fe fe-building', null);
        $this->addMenu('Users', 'admin/users/', 'fe fe-users', null);
        $this->addMenu('Settings', 'admin/settings/', 'fe fe-gear', null);
    }

    /**
     *Render the page in browser
     */
    public function makePage()
    {
        echo '<!DOCTYPE html>
<html lang="en">
<head>';
        $db=new DB();
        $header_color=!empty($db->getOptions('header_color'))?'style="background-color:'.$db->getOptions('header_color').';"':'';
        $this->makeMeta();
        $this->setTitle();
        $this->makeStyles();
        $this->makeHeaderScripts();
        echo '<!-- header code -->' . PHP_EOL;
        if (!empty($this->getHeaderCode())) {
            echo $this->getHeaderCode() . PHP_EOL;
        }
        echo '<!-- header code -->' . PHP_EOL;
        echo '</head>

		<body class="' . $this->getbodyClass() . '">';

        echo '<div class="main-wrapper">';
        if ($this->hasHeader) {
            echo '<div class="header" '.$header_color.'>';
            if ($this->hasNavbar) {
                require_once 'Navbar.php';
            }
            if ($this->hasSidebar) {
                require_once 'sidebar.php';
            }
            echo '</div>';
        }


//--main content---
        $db=new DB();
        $color=!empty($db->getOptions('page_color'))?'style="background-color:'.$db->getOptions('page_color').';"':'';
        echo '<div class="page-wrapper" '.$color.'>';
        echo '<div class="content container-fluid">';
        if ($this->hasBreadcrumb) {
            $routes = explode("/", $_SERVER['REQUEST_URI']);
            echo '
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">' . $this->getPageTitle() . '</h3>
								<ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="' . BASE_PATH . $routes[1] . '/"><i class="bx bx-home-alt"></i></a></li>';

            for ($i = 1; $i < count($routes) - 1; $i++) {
                if ($i != count($routes) - 1) {
                    echo '<li class="breadcrumb-item"><a href="' . BASE_PATH . $routes[1] . '/' . $routes[$i] . '/">' . $routes[$i] . '</a></li>';
                } else {
                    echo '<li class="breadcrumb-item active">' . $routes[$i] . '</li>';
                }
            }
            echo '
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->';
        }

        if ($this->isHasContent()) {
            $this->addPageContent($this->getPageContent());
        }

        echo '</div></div>';

        /*--footer---*/
        if ($this->hasFooter) {
            require_once 'footer.php';
        }
        echo '</div>';
        $this->makeScripts();
        $this->makeFooterScripts();
        if ($this->ishasError()) {
            $this->showPageError();
        }

        echo '<!-- footer code -->' . PHP_EOL;
        if (!empty($this->getFooterCode())) {
            echo $this->getFooterCode() . PHP_EOL;
        }
        echo '<!-- footer code -->' . PHP_EOL;
        echo '</body>
</html>';
    }


}