<?php


namespace clinela\template;


use clinela\database\DB;

class Page extends Master
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

        $this->setHeaderCode($db->htmlDecode($db->getOptions('site_header_code')));
        $this->setFooterCode($db->htmlDecode($db->getOptions('site_footer_code')));

        $this->setCompany($db->getOptions('site_name'));
        $this->setBodyClass('');
        $this->setPageTitle($pageTitle);
        $this->setMetaAuthor('Lincoln Mugasho');
        $this->setMetaDescription('Doctor booking');
        $this->setMetaViewport('width=device-width, initial-scale=1, shrink-to-fit=no');
        $this->setMetaKeywords('doctor,patient,booking');

        $this->addStyle('bootstrap.min.css', CONTENT_PATH . 'public/css/');
        $this->addStyle('fontawesome.min.css', CONTENT_PATH . 'public/plugins/fontawesome/css/');
        $this->addStyle('all.min.css', CONTENT_PATH . 'public/plugins/fontawesome/css/');
        $this->addStyle('sweetalert.min.css', CONTENT_PATH . 'public/plugins/sweet-alert/');
        $this->addStyle('select2.min.css', CONTENT_PATH . 'public/plugins/select2/css/');
        $this->addStyle('dropzone.min.css', CONTENT_PATH . 'public/plugins/dropzone/');
        $this->addStyle('clocklet.min.css', CONTENT_PATH . 'public/plugins/clocklet/');
        $this->addStyle('style.css', CONTENT_PATH . 'public/css/');


        $this->addScripts('jquery.min.js', CONTENT_PATH . 'public/js/');
        $this->addScripts('popper.min.js', CONTENT_PATH . 'public/js/');
        $this->addScripts('bootstrap.min.js', CONTENT_PATH . 'public/js/');
        $this->addScripts('select2.min.js', CONTENT_PATH . 'public/plugins/select2/js/');
        $this->addScripts('sweetalert.min.js', CONTENT_PATH . 'public/plugins/sweet-alert/');
        $this->addScripts('circle-progress.min.js', CONTENT_PATH . 'public/js/');
        $this->addFooterScripts('slick.js', CONTENT_PATH . 'public/js/');
        $this->addFooterScripts('script.js', CONTENT_PATH . 'public/js/');
        $this->addHeaderScripts('clocklet.min.js', CONTENT_PATH . 'public/plugins/clocklet/');

        $this->setCopyright($db->getOptions('site_copyright'));

        $this->addMenu('Home', '', null, null);
        $this->addMenu('Doctors', 'doctors/', null, null);
        $this->addMenu('Clinics', 'clinics/', null, null);
        $this->addMenu('Blog', 'blog/', null, null);
    }

    /**
     *Render the page in browser
     */
    public function makePage()
    {
        $db = new DB();
        $page_color = !empty($db->getOptions('page_color')) ? 'style="background-color:' . $db->getOptions('page_color') . ';"' : '';
        $footer_color = !empty($db->getOptions('footer_color')) ? 'style="background-color:' . $db->getOptions('footer_color') . ';"' : '';
        echo '<!DOCTYPE html>
<html lang="en">
<head>';

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

		<body class="' . $this->getbodyClass() . '" ' . $page_color . '>';

        echo '<div class="main-wrapper" >';
        if ($this->hasHeader) {
            echo '<header class="header" >';
            if ($this->hasNavbar) {
                require_once 'Navbar.php';
            }
            echo '</header>';
        }


//--main content---
        if ($this->hasBreadcrumb) {
            $routes = explode("/", $_SERVER['REQUEST_URI']);
            echo '
<div class="breadcrumb-bar d-print-none" ' . $footer_color . '>
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-md-12 col-12">
							<nav aria-label="breadcrumb" class="page-breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="' . BASE_PATH . $routes[1] . '/"><i class="bx bx-home-alt"></i></a></li>';

            for ($i = 1; $i < count($routes) - 1; $i++) {
                if ($i != count($routes) - 1) {
                    echo '<li class="breadcrumb-item"><a href="' . BASE_PATH . $routes[1] . '/' . $routes[$i] . '/">' . $routes[$i] . '</a></li>';
                } else {
                    echo '<li class="breadcrumb-item active">' . $routes[$i] . '</li>';
                }
            }
            echo '
								</ol>
							</nav>
							<h2 class="breadcrumb-title">' . $this->getPageTitle() . '</h2>
						</div>
					</div>
				</div>
			</div>';
        }
        echo '<div class="content">';
        echo '<div class="container-fluid">';
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