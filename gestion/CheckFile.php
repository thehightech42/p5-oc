<?php
namespace P5\Gestion; 

class CheckFile 
{
    private $_type = [];
    private $_maxSize = 0;
    private $_file = []; 

    /**
     * Class for add a simple file. 
     * $type = String with liste of extension accepted -> ex : ".jpg,.jped,.pdf" . Use "," for séparate extension et write extension like ".jpg"
     * $maxSize = Size max for the file : number in octet .
     * This array of the file.
     */
    function __construct(string $type, int $maxSize, $file)
    {
        if(!$file['error'] === 0)
        {
            return "Erreur de chagement du fichier"; 
        }
        $this->_file = (array) $file; 
        $this->_maxSize = (int) $maxSize; 
        $this->_type = $this->addType($type);
 
    }

    /**
     * $type = String with liste of extension accepted -> ex : ".jpg,.jped,.pdf" 
     */
    private function addType (string $type) : array
    {
        $arrayExtension = explode("," , $type); 
        return $arrayExtension; 

    }

    /**
     * Return a bool if is true. 
     * Return string with information of error if is false
     */
    private function checkSize()
    {
        if($this->_file['size'] >= $this->_maxSize){
            return "Fichier trop lourd. Merci d'en ajouter un autre"; 
        }
        else
        {
            return true; 
        }
    }

    /**
     * Return a bool if is true. 
     * Return string with information of error if is false
     */
    private function checkExtension()
    {
        $regex = "([\w\W]+)";
        foreach($this->_type as $possibilite )
        {
            $realRegex = "#$regex.$possibilite#";
            $match = preg_match($realRegex, $this->_file['name']);
            if($match === 1)
            {
                return true; 
            }
        }
        return "L'extension du fichier n'est pas bonne";
    }

    /**
     * Return a bool if is true. 
     * Return string with information of error if is false
     */
    public function check() 
    {
        $extension = $this->checkExtension();
        if(is_string($extension))
        {
            return $extension;
        }
        
        $size = $this->checkSize();
        if(is_string($size))
        {
            return $size;
        }

        if($extension === true && $size === true)
        {
            return true;
        }
    }

    /**
     * Create an unique name for upload files
     */
    public function uniqueName() : string
    {
        $extFile = ".".substr(strrchr($this->_file['name'], '.'), 1);
        $simpleName = md5(uniqid($this->_file['name']));
        $name = $simpleName.$extFile;
        return $name; 
    }
}