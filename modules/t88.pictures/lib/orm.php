<?
namespace T88\Pictures;
use Bitrix\Main\Entity;

class OrmTable extends Entity\DataManager{

    public static function getTableName(){
        return "draw_pictures";
    }

    public static function getMap(){
        return array(
            new Entity\IntegerField('ID', array(
                'primary' => true,
                'autocomplete' => true
            )),
            new Entity\StringField('FILEID', array(
                'required'=> true,
            )),

            new Entity\StringField('PASSWORD', array(
                'required'=> true,
            ))
        );
    }
}
?>