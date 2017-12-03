<?

use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Config as Conf;
use \Bitrix\Main\Config\Option;
use \Birix\Main\Loader;
use \Bitrix\Main\Entity\Base;
use \Bitrix\Main\Application;

Loc::loadMessages(__FILE__);


Class t88_pictures extends CModule{
    const MODULE_ID = 't88.pictures';
    var $MODULE_ID = 't88.pictures';
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_CSS;
    var $strError = '';

    function __construct(){
        $arModuleVersion = array();
        include(dirname(__FILE__)."/version.php");
        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        $this->MODULE_NAME = Loc::getMessage("T88.PICTURES_MODULE_NAME");
        $this->MODULE_DESCRIPTION = Loc::getMessage("T88.PICTURES_MODULE_DESC");

        $this->PARTNER_NAME = Loc::getMessage("T88.PICTURES_PARTNER_NAME"); //

        //$p =  __FILE__."./lang" ;
        //$this->PARTNER_NAME = $p; //
        $this->PARTNER_URI =  Loc::getMessage("T88.PICTURES_PARTNER_URI"); //
    }

    function InstallDB($arParams = array()){

        \Bitrix\Main\Application::getConnection()->queryExecute("CREATE TABLE IF NOT EXISTS `draw_pictures` (
            `ID` int NOT NULL AUTO_INCREMENT,
            `FILEID` varchar(255) NOT NULL,
            `PASSWORD` varchar(255) NOT NULL,
            PRIMARY KEY(`ID`))"
        );

    }

    function UnInstallDB($arParams = array()){
        \Bitrix\Main\Application::getConnection()->queryExecute("DROP TABLE IF EXISTS draw_pictures");
    }

    function InstallEvents(){
        return true;
    }

    function UnInstallEvents(){
        return true;
    }
    function UnInstallUploadDir(){
        // Удаление файлов - картинок модуля
        \Bitrix\Main\IO\Directory::deleteDirectory($_SERVER['DOCUMENT_ROOT'] . '/upload/t88');
    }

    // здесь содержится установка компонентов, административных скриптов и прочих файлов
    function InstallFiles($arParams = array()){
        // Административные скрипты
        if (is_dir($p = $this->getPath().'/admin')){
            if ($dir = opendir($p)){
                while (false !== $item = readdir($dir)){
                    if ($item == '..' || $item == '.' || $item == 'menu.php')
                        continue;
                    file_put_contents($file = $_SERVER["DOCUMENT_ROOT"].'/admin/'.self::MODULE_ID.'_'.$item,
                        '<'.'? require($_SERVER["DOCUMENT_ROOT"]."'.$this->getPath(true).'/admin/'.$item.'");?'.'>');
                }
                closedir($dir);
            }
        }

        // Компоненты
        CopyDirFiles($this->GetPath()."/install/components", $_SERVER['DOCUMENT_ROOT']."/bitrix/components", true, true);

        return true;
    }

    // здесь все установленные в систему файлы модуля удаляются
    function UnInstallFiles(){
        // Удаление административных скриптов
        if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/admin')){
            if ($dir = opendir($p)){
                while (false !== $item = readdir($dir)){
                    if ($item == '..' || $item == '.')
                        continue;
                    unlink($_SERVER['DOCUMENT_ROOT'].'/bitrix/admin/'.self::MODULE_ID.'_'.$item);
                }
                closedir($dir);
            }
        }

        // Удаление компонентов
        \Bitrix\Main\IO\Directory::deleteDirectory($_SERVER['DOCUMENT_ROOT'] . '/bitrix/components/t88');

        return true;
    }

    // точка входа при установке
    function DoInstall(){
        global $APPLICATION;

        if($this->isVersionD7()){
            $this->InstallDB();
            $this->InstallEvents();
            $this->InstallFiles();
            \Bitrix\Main\ModuleManager::registerModule($this->MODULE_ID);
        }
        else{
            $APPLICATION->ThrowException(Loc::getMessage("T88.PICTURES_INSTALL_VERSION_ERROR"));
        }

    }

    // точка входа при удалении
    function DoUninstall(){
        global $APPLICATION;
        $context = Application::getInstance()->getContext();
        $request = $context->getRequest();

        if($request['step']<2){
            $APPLICATION->IncludeAdminFile(Loc::getMessage("T88.UNINSTALL_TITLE"),$this->GetPath()."/install/unstep1.php");
        }
        elseif($request['step']==2){
            $this->UnInstallFiles();
            $this->UnInstallEvents();

            // Удаляем таблицу и файлы
            if($request['deldata'] == 'Y'){
                $this->UnInstallDB();
                $this->UnInstallUploadDir();
            }

            \Bitrix\Main\ModuleManager::unRegisterModule($this->MODULE_ID);

            $APPLICATION->IncludeAdminFile(Loc::getMessage("T88.UNINSTALL_TITLE"), $this->GetPath()."/install/unstep2.php");
        }

    }

    function isVersionD7(){

        return CheckVersion(\Bitrix\Main\ModuleManager::getVersion('main'), '14.00.00');
    }
    // получаем путь от корня сайта или корня сервера до папки модуля
    function getPath($notDocumentRoot = false){
        if($notDocumentRoot)
            return str_ireplace(Application::getDocumentRoot(), '', dirname(__DIR__));
        else
            return dirname(__DIR__);
    }
}

?>