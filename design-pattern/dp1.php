<?php 
namespace DesignPatternExample;

class MediaFactory {
    public static function factory( $type ) {
        $className = __NAMESPACE__ . '\\' . ucfirst($type);
        if( !class_exists($className)) {
            throw new \Exception('Class does not exist!');
        }
        
        $object = new $className();
        
        if( $object  instanceof Media ) {
            return $object;
        } else {
            throw new \Exception('The request type is not a valid media type!');    
        }
    }
}

interface Media {
    public function getType();
}

class Video implements Media {
    public function getType() {
        return "Video";
    }
}

class Audio implements Media {
    public function getType() {
        return "Audio";
    }
}


class Photo implements Media {
    public function getType() {
        return "Photo";
    }
}