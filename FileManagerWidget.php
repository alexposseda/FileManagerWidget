<?php
    namespace common\widgets\FileManagerWidget;
    use Yii;
    use yii\alexposseda\fileManager\FileManager;
    use yii\base\Widget;
    use yii\web\View;

    class FileManagerWidget extends Widget{
        public $uploadUrl;
        public $removeUrl;
        public $files;
        public $targetInputId;
        public $maxFiles;

        public function init(){
            parent::init();
        }

        public function run(){

            $notSaveFiles = FileManager::getFilesFromSession();


            $script = <<<JS
var fileManagerWidgetSetting = {
    uploadUrl: "{$this->uploadUrl}",
    removeUrl: "{$this->removeUrl}",
    targetInputId: "{$this->targetInputId}",
    maxFiles: "{$this->maxFiles}"
}
JS;
            Yii::$app->getView()->registerJs($script, View::POS_END);
            FileManagerWidgetAsset::register(Yii::$app->getView());

            return $this->render('baseWidget', [
                'notSavedFiles' => $notSaveFiles,
                'savedFiles' => $this->files,
            ]);
        }
    }