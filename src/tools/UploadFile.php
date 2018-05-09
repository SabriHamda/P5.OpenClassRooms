<?php
namespace blog\src\tools;

/**
 * GoogleTranslate.class.php
 *
 * This Class talk with Google Translator for free.
 */

/**
 * Main class GoogleTranslate
 *
 */
Class UploadFile
{
	/**
     * [uploadFile this function upload file in folder after verifications]
     * @param  [string]  $index    [the file to upload]
     * @param  [string]  $destination [path to the destination folder]
     * @param  boolean or int $maxsize     [the size of the file]
     * @param  boolean or array $extensions  [the accepted extensions of the file]
     * @return [type]               [description]
     */
    public static function uploadFile($index,$destination,$maxsize=FALSE,$extensions=FALSE)

    {
     if (!isset($_FILES[$index]) OR $_FILES[$index]['error'] > 0) return FALSE; //Test1: fille correctly uploaded
     if ($maxsize !== FALSE AND $_FILES[$index]['size'] > $maxsize) return FALSE; //Test2: limit size of the file
     $ext = substr(strrchr($_FILES[$index]['name'],'.'),1); //Test3: accepted extensions
     if ($extensions !== FALSE AND !in_array($ext,$extensions)) return FALSE;
     return move_uploaded_file($_FILES[$index]['tmp_name'],$destination); //Move the file in the folder
    }
}
