<?php
class RGB {
    private $color;
    private $red;
    private $green;
    private $blue;

    public function __construct( $colorCode = '' ) {
        $this->color = ltrim( $colorCode, "#" );
        $this->parseColor();
    }

    public function getColor() {
        return $this->color;
    }

    public function getRGBColor() {
        return array( $this->red, $this->green, $this->blue );
    }

    public function readRGBColor() {
        echo "Red = {$this->red}\nGreen = {$this->green}\nBlue = {$this->blue}";
    }

    public function setColor( $colorCode ) {
        $this->color = ltrim( $colorCode, "#" );
        $this->parseColor();
    }

    private function parseColor() {
        // $colors = sscanf( $this->color, "%02x%02x%02x");
        // print_r( $colors );
        if ( $this->color ) {
            list( $this->red, $this->green, $this->blue ) = sscanf( $this->color, "%02x%02x%02x" );
            // echo $this->red . "\n";
            // echo $this->green . "\n";
            // echo $this->blue . "\n";

        } else {
            list( $this->red, $this->green, $this->blue ) = array( 0, 0, 0 );
        }

    }

    /**
     * Test
     */
    public function getRed() {
        return $this->red;
    }

    public function getGreen() {
        return $this->green;
    }

    public function getBlue() {
        return $this->blue;
    }
}

$myColor = new RGB( "#ff00ff" );
$myColor->readRGBColor();
echo PHP_EOL;
echo $myColor->getRed();
echo PHP_EOL;
echo $myColor->getGreen();
echo PHP_EOL;
echo $myColor->getBlue();
