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
        \Bitrix\Main\Application::getConnection()->queryExexute("DROP TABLE IF EXISTS draw_pictures");
    }

    function InstallEvents(){
        return true;
    }

    function UnInstallEvents(){
        return true;
    }

    // здесь содержится установка компонентов, административных скриптов и прочих файлов
    function InstallFiles($arParams = array()){
        // административные скрипты
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

        // компоненты
        if (is_dir($p = $this->getPath().'/install/components')){
            if ($dir = opendir($p)){
                while (false !== $item = readdir($dir)){
                    if ($item == '..' || $item == '.')
                        continue;
                    CopyDirFiles($p.'/'.$item, $_SERVER['DOCUMENT_ROOT'].'/bitrix/components/'.$item, $ReWrite = True, $Recursive = True);
                }
                closedir($dir);
            }
        }
        return true;
    }

    // здесь все установленные в систему файлы модуля удаляются
    function UnInstallFiles(){
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
        if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/components')){
            if ($dir = opendir($p)){
                while (false !== $item = readdir($dir)){
                    if ($item == '..' || $item == '.' || !is_dir($p0 = $p.'/'.$item))
                        continue;

                    $dir0 = opendir($p0);
                    while (false !== $item0 = readdir($dir0))
                    {
                        if ($item0 == '..' || $item0 == '.')
                            continue;
                        DeleteDirFilesEx('/bitrix/components/'.$item.'/'.$item0);
                    }
                    closedir($dir0);
                }
                closedir($dir);
            }
        }
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
        $context = Application::getInstance()->getContext();
        $request = $context->getRequest();

        \Bitrix\Main\ModuleManager::unRegisterModule($this->MODULE_ID);

        $this->UnInstallDB();
        $this->UnInstallEvents();
        $this->UnInstallFiles();

        if($request['savedata']!='Y'){
            $this->UnInstallDB();
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