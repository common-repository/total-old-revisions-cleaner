<?php
abstract class TextResource
{
    protected $texts;  
    
    public function GetCaption()
    {
        return $this->texts['Caption'];
    }
    public function GetButtonText()
    {
        return $this->texts['ButtonText'];
    } 
    public function GetConfirmText()
    {
        return $this->texts['ConfirmText'];
    } 
	public function GetConsoleWidgetText()
	{
		return $this->texts['ConsoleWidgetTitle'];
	}
	public function GetSuccessTitle()
	{
		return $this->texts['SuccessTitle'];
	}
}
class TextResource_RU extends TextResource
{  
   protected $texts= Array('Caption'=>'Удалить все старые редакции записей и страниц','ButtonText'=>'Выполнить','ConfirmText'=>'Вы уверены?',
   'ConsoleWidgetTitle'=>'Удаление старых редакций','SuccessTitle'=>'Выполнено!');    
}
class TextResource_EN extends TextResource
{
    protected $texts=Array('Caption'=>'Delete all old revisions of posts and pages','ButtonText'=>'Do','ConfirmText'=>'Are you sure?','ConsoleWidgetTitle'=>'Deleting old revisions',
    'SuccessTitle'=>'Success!');    
}
class TextResource_DE extends TextResource
{  
   protected $texts= Array('Caption'=>'Entfernen Sie alle alten Fassung Einträge und Seiten','ButtonText'=>'Ausführen','ConfirmText'=>'Sind Sie sicher?','ConsoleWidgetTitle'=>'Löschen Alter Revisionen'
,'SuccessTitle'=>'Erfolg!');    
}
class TextResource_FR extends TextResource
{  
   protected $texts= Array('Caption'=>'Supprimer tous les anciens de la rédaction des enregistrements et des pages','ButtonText'=>'Effectuer','ConfirmText'=>'Êtes-vous sûr?',
   'ConsoleWidgetTitle'=>'La suppression des anciennes éditions','SuccessTitle'=>'Succès!');    
}
class TextResource_UA extends TextResource
{  
   protected $texts= Array('Caption'=>'Видалити всі старі редакції записів та сторінок','ButtonText'=>'Виконати','ConfirmText'=>'Ви впевнені?','ConsoleWidgetTitle'=>'Видалення старих редакцій',
   'SuccessTitle'=>'Успіх!');    
}

?>