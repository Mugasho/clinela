<?php


namespace clinela\template;



use ArrayObject;

class Master
{
    public $pageTitle;
    public $copyright;
    public $metaAuthor;
    public $metaViewport;
    public $metaKeywords;
    public $metaDescription;
    public $pageVars;
    public $pageVars2;
    public $scripts;
    public $headerScripts;
    public $FooterScripts;
    public $pageContent;
    public $menu;
    public $hasError = false;
    public $hasHeader = true;
    public $hasTitle = true;
    public $pageError = null;
    public $hasFooter = true;
    public $hasSidebar=true;
    public $hasContent=true;
    public $hasNavbar=true;
    public $hasBreadcrumb = true;
    public $hasBreadcrumbNav=false;
    public $hasMenu = true;
    public $hasSetting = false;
    public $routes = null;
    public $styles;
    public $company;
    public $sidebarClass;
    public $bodyClass;
    public $dateFounded;
    public $header_code;
    public $footer_code;
    public $above_footer_code;




    /**
     * master constructor.
     * @param $pageTitle
     */
    public function __construct($pageTitle)
    {
        $this->pageTitle = $pageTitle;
    }


    /**
     * @return mixed
     */
    public function getStyles()
    {
        return $this->styles;

    }

    /**
     * @param ArrayObject $styles
     */
    public function setStyles($styles)
    {

        if (empty($styles)) {
            $this->styles = $styles;
        }
        $this->styles = $styles;
    }


    function addStyle($name, $path)
    {
        if (!empty($name)) {
            $this->styles[$name] = $path;
        }
    }

    public function makeStyles()
    {
        if ($this->getStyles() != null) {
            foreach ($this->getStyles() as $key => $value) {
                echo '<link href="' . $value . $key . '" rel="stylesheet" media="all">' . PHP_EOL;
            }
        }
    }

    public function makeScripts()
    {
        if ($this->getScripts() != null) {
            foreach ($this->getScripts() as $key => $value) {
                echo '<script src="' . $value . $key . '"></script>' . PHP_EOL;
            }
        }
    }

    public function makeHeaderScripts()
    {
        if ($this->getHeaderScripts() != null) {
            foreach ($this->getHeaderScripts() as $key => $value) {
                echo '<script src="' . $value . $key . '"></script>' . PHP_EOL;
            }
        }
    }


    public function makeFooterScripts()
    {
        if ($this->getFooterScripts() != null) {
            foreach ($this->getFooterScripts() as $key => $value) {
                echo '<script src="' . $value . $key . '"></script>' . PHP_EOL;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getHeaderScripts() {
        return $this->headerScripts;
    }

    public function getFooterScripts() {
        return $this->FooterScripts;
    }
    /**
     * @param mixed $headerScripts
     */
    public function setHeaderScripts( $headerScripts ) {
        $this->headerScripts = $headerScripts;
    }

    public function setFooterScripts( $FooterScripts ) {
        $this->FooterScripts = $FooterScripts;
    }

    function addHeaderScripts($name, $path)
    {
        $this->headerScripts[$name] = $path;
    }
    function addFooterScripts($name, $path)
    {
        $this->FooterScripts[$name] = $path;
    }

    /**
     * @return null
     */
    public function getCompany() {
        return $this->company;
    }

    /**
     * @param null $company
     */
    public function setCompany( $company ) {
        $this->company = $company;
    }

    /**
     * @return mixed
     */
    public function getDateFounded() {
        return $this->dateFounded;
    }

    /**
     * @param mixed $dateFounded
     */
    public function setDateFounded( $dateFounded ) {
        $this->dateFounded = $dateFounded;
    }



    /**
     * @param $pageContent
     */
    function addPageContent($pageContent)
    {
        if(!empty($pageContent)) {
            if ( file_exists( 'app/content/' . $pageContent ) ) {
                require 'app/content/' . $pageContent;
            }
        }

    }

    function getFooter()
    {
        require 'footer.php';
    }


    /**Add an item to the menus array
     * @param $name
     * @param $path
     * @param $icon
     * @param $items
     */
    function addMenu($name, $path, $icon, $items)
    {
        $this->menu[$name] = array('path' => $path, 'icon' => $icon);
        if ($items != null) {
            $this->menu[$name]['items'] = $items;
        } else {
            $this->menu[$name]['items'] = null;
        }
    }

    function addScripts($name, $path)
    {
        $this->scripts[$name] = $path;
    }

    /**
     * @return bool
     */
    public function isHasSetting()
    {
        return $this->hasSetting;
    }

    /**
     * @param bool $hasSetting
     */
    public function setHasSetting($hasSetting)
    {
        $this->hasSetting = $hasSetting;
    }

    /**
     * @return mixed
     */
    public function getPageTitle()
    {
        return $this->pageTitle;
    }

    /**
     * @param mixed $pageTitle
     */
    public function setPageTitle($pageTitle)
    {
        $this->pageTitle = $pageTitle;
    }

    public function setPageError($message, $title, $type)
    {
        $this->hasError = true;
        $this->pageError['message'] = $message;
        $this->pageError['title'] = $title;
        $this->pageError['type'] = $type;
    }

    function showPageError() {
        if ( ! empty( $this->pageError ) ) {

            echo '<script>
        Swal.fire({
            title: "'.$this->pageError['title'].'",
            text: "'.$this->pageError['message'].'",
            icon: "' . $this->pageError['type'].'",
        });
       
</script>';
        }
    }

    function setTitle()
    {
        echo '<title>' . $this->getPageTitle() .' | '.$this->getCompany().'</title>' . PHP_EOL;
    }

    /**
     * @return mixed
     */
    public function getPageContent()
    {
        return $this->pageContent;
    }

    /**
     * @param mixed $pageContent
     */
    public function setPageContent($pageContent)
    {
        $this->pageContent = $pageContent;
    }

    /**
     * @return bool
     */
    public function isHasMenu()
    {
        return $this->hasMenu;
    }

    /**
     * @return bool
     */
    public function isHasHeader()
    {
        return $this->hasHeader;
    }

    /**
     * @param bool $hasHeader
     */
    public function setHasHeader($hasHeader)
    {
        $this->hasHeader = $hasHeader;
    }

    /**
     * @return mixed
     */
    public function getPageVars2()
    {
        return $this->pageVars2;
    }

    /**
     * @param mixed $pageVars2
     */
    public function setPageVars2($pageVars2)
    {
        $this->pageVars2 = $pageVars2;
    }

    /**
     * @param bool $hasMenu
     */
    public function setHasMenu($hasMenu)
    {
        $this->hasMenu = $hasMenu;
    }

    /**
     * @return bool
     */
    public function isHasBreadcrumb()
    {
        return $this->hasBreadcrumb;
    }

    /**
     * @param bool $hasBreadcrumb
     */
    public function setHasBreadcrumb($hasBreadcrumb)
    {
        $this->hasBreadcrumb = $hasBreadcrumb;
    }


    /**
     * @return mixed
     */
    public function getMetaAuthor()
    {
        return $this->metaAuthor;
    }

    /**
     * @param mixed $metaAuthor
     */
    public function setMetaAuthor($metaAuthor)
    {
        $this->metaAuthor = $metaAuthor;
    }

    /**
     * @return mixed
     */
    public function getMetaViewport()
    {
        return $this->metaViewport;
    }

    /**
     * @return mixed
     */
    public function getScripts()
    {
        return $this->scripts;
    }

    /**
     * @param mixed $scripts
     */
    public function setScripts($scripts)
    {
        $this->scripts = $scripts;
    }


    /**
     * @param mixed $metaViewport
     */
    public function setMetaViewport($metaViewport)
    {
        $this->metaViewport = $metaViewport;
    }

    /**
     * @return mixed
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }

    /**
     * @param mixed $metaKeywords
     */
    public function setMetaKeywords($metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;
    }

    /**
     * @return mixed
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * @param mixed $menu
     */
    public function setMenu($menu)
    {
        $this->menu = $menu;
    }

    /**
     * @return mixed
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * @param mixed $metaDescription
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;
    }

    /**
     * @return bool
     */
    public function isHasFooter()
    {
        return $this->hasFooter;
    }

    /**
     * @param bool $hasFooter
     */
    public function setHasFooter($hasFooter)
    {
        $this->hasFooter = $hasFooter;
    }

    /**
     * @return bool
     */
    public function isHasTitle()
    {
        return $this->hasTitle;
    }

    /**
     * @return bool
     */
    public function isHasSidebar(): bool {
        return $this->hasSidebar;
    }

    /**
     * @param bool $hasSidebar
     */
    public function setHasSidebar( bool $hasSidebar ) {
        $this->hasSidebar = $hasSidebar;
    }

    /**
     * @return bool
     */
    public function isHasNavbar(): bool {
        return $this->hasNavbar;
    }

    public function setHasNavbar( bool $hasNavbar ) {
        $this->hasNavbar = $hasNavbar;
    }


    /**
     * @param bool $hasTitle
     */
    public function setHasTitle($hasTitle)
    {
        $this->hasTitle = $hasTitle;
    }

    /**
     * @return mixed
     */
    public function getPageVars()
    {
        return $this->pageVars;
    }

    /**
     * @param mixed $pageVars
     */
    public function setPageVars($pageVars)
    {
        $this->pageVars = $pageVars;
    }

    /**
     * @return mixed
     */
    public function getCopyright()
    {
        return $this->copyright;
    }

    /**
     * @param mixed $copyright
     */
    public function setCopyright($copyright)
    {
        $this->copyright = $copyright;
    }

    /**
     * @return bool
     */
    public function isHasError()
    {
        return $this->hasError;
    }

    /**
     * @param bool $hasError
     */
    public function setHasError($hasError)
    {
        $this->hasError = $hasError;
    }


    function getSelected($option,$value){
        return $option==$value?' selected':'';
    }

    function getTab($option,$value){
        return $option==$value?' active show':'';
    }
    function getTabMenu($option,$value){
        return $option==$value?' active':'';
    }
    /**
     * @return bool
     */
    public function isHasBreadcrumbNav(): bool {
        return $this->hasBreadcrumbNav;
    }

    /**
     * @return bool
     */
    public function isHasContent(): bool {
        return $this->hasContent;
    }

    /**
     * @param bool $hasContent
     */
    public function setHasContent( bool $hasContent ) {
        $this->hasContent = $hasContent;
    }

    /**
     * @return mixed
     */
    public function getSidebarClass() {
        return $this->sidebarClass;
    }

    /**
     * @param mixed $sidebarClass
     */
    public function setSidebarClass( $sidebarClass ) {
        $this->sidebarClass = $sidebarClass;
    }

    /**
     * @return mixed
     */
    public function getBodyClass()
    {
        return $this->bodyClass;
    }

    /**
     * @param mixed $bodyClass
     */
    public function setBodyClass($bodyClass)
    {
        $this->bodyClass = $bodyClass;
    }


    /**
     * @param bool $hasBreadcrumbNav
     */
    public function setHasBreadcrumbNav( bool $hasBreadcrumbNav ) {
        $this->hasBreadcrumbNav = $hasBreadcrumbNav;
    }

    /**
     * @return null
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * @param null $routes
     */
    public function setRoutes($routes)
    {

        $this->routes = $routes;
    }

    /**
     * @return mixed
     */
    public function getHeaderCode() {
        return $this->header_code;
    }

    /**
     * @param mixed $header_code
     */
    public function setHeaderCode( $header_code ) {
        $this->header_code = $header_code;
    }

    /**
     * @return mixed
     */
    public function getFooterCode() {
        return $this->footer_code;
    }

    /**
     * @param mixed $footer_code
     */
    public function setFooterCode( $footer_code ) {
        $this->footer_code = $footer_code;
    }

    /**
     * @return mixed
     */
    public function getAboveFooterCode()
    {
        return $this->above_footer_code;
    }

    /**
     * @param mixed $above_footer_code
     */
    public function setAboveFooterCode($above_footer_code)
    {
        $this->above_footer_code = $above_footer_code;
    }


    function makeMeta()
    {
        echo
            '<link rel="shortcut icon" href="'.CONTENT_PATH.'assets/public/img/favicon.png">'.
            '<meta charset="UTF-8">' . PHP_EOL .
            '<meta name="viewport" content="' . $this->getMetaViewport() . '">' . PHP_EOL .
            '<meta name="description" content="' . $this->getMetaDescription() . '">' . PHP_EOL .
            '<meta name="author" content="' . $this->getMetaAuthor() . '">' . PHP_EOL .
            '<meta name="keywords" content="' . $this->getMetaKeywords() . '">' . PHP_EOL;
    }


}