<?php
namespace app\services;

class Files {
    private function createNewFileName($fileName, $dirImage) {
        $pos = strrpos($fileName, '.');
        $fileNameShort = substr($fileName, 0, $pos);
        $fileExtension = substr($fileName, $pos);
    
        $dirFile = scandir($dirImage);
    
        $count = 0;
        foreach ($dirFile as $value) {
            if (preg_match("/^{$fileNameShort}[0-9]*{$fileExtension}$/", $value, $matches)) {
                $count++;
            };
        }
    
        $fileName = $fileNameShort . $count . $fileExtension;
        return $fileName;
    }

    
    public function uploadFile($pathToDir, &$error, $attributeName = 'file') {
        if (isset($_FILES[$attributeName])) {
            $fileName = $pathToDir . $_FILES[$attributeName]['name'];
            $error = '';
            if ($_FILES[$attributeName]['size'] >= 1048576) {
                $error .= "Файл не был загружен, т.к. размер превышает максимальный размер - 1 Мб <br>";
            }
            if (strripos($_FILES[$attributeName]['type'],'image') === false){
                $error .= "Файл не был загружен, т.к. необходимо загрузить картинку <br>";
            }
            if (!$error) {
                if (file_exists($fileName)) {
                    $fileNameShort = $this->createNewFileName($_FILES[$attributeName]['name'], $pathToDir);
                    $fileName = $pathToDir . $fileNameShort;
                }
    
                $fileNameShort = $_FILES[$attributeName]['name'];
                move_uploaded_file($_FILES[$attributeName]['tmp_name'], $fileName);
            }
        }
    
        return $fileNameShort;
    }
}
?>