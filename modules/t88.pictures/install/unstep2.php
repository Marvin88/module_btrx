<?

use \Bitrix\Main\Localization\Loc;

if(!check_bitrix_sessid())
    return;

Loc::loadMessages(__FILE__);



if($ex = $APPLICATION->GetException())
    echo CAdminMessage::ShowMessage(array(
        "TYPE" =>"ERROR",
        "MESSAGE" => Loc::getMessage("MOD_UNINST_ERR"),
        "DETAILS" => $ex->GetString(),
        "HTML" => true,
    ));
else
    echo CAdminMessage::ShowNote( Loc::getMessage("MOD_UNINST_OK"));


?>

<form action="<?= $APPLICATION->GetCurPage()?>">
    <?=bitrix_sessid_post()?>
    <input type="hidden" name="lang" value="<?echo LANGUAGE_ID?>">
    <input type="submit" name="" value="<?echo Loc::getMessage("MOD_BACK")?>">
</form>
