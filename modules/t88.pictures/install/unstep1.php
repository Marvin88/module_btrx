<?

use \Bitrix\Main\Localization\Loc;

if(!check_bitrix_sessid())
    return;

Loc::loadMessages(__FILE__);
?>

<form action="<?= $APPLICATION->GetCurPage()?>">
    <?=bitrix_sessid_post()?>
    <input type="hidden" name="lang" value="<?echo LANGUAGE_ID?>">
    <input type="hidden" name="id" value="t88.pictures">
    <input type="hidden" name="uninstall" value="Y">
    <input type="hidden" name="step" value="2">
    <?= CAdminMessage::ShowMessage(Loc::getMessage("MOD_UNINST_WARN"))?>
    <p><?echo Loc::getMessage("MOD_UNINST_DEL_TABLES")?></p>
    <p><input type="checkbox" name="deldata" id="deldata" value="Y" checked>
        <label for="deldata" > <?echo Loc::getMessage("MOD_UNINST_DEL_YES")?></lanel>
    </p>
    <input type="submit" name="" value="<?echo Loc::getMessage("MOD_UNINST_DEL")?>">
</form>
