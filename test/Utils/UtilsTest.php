<?php
namespace Lpi\KernelBundle\Tests\Utils;

use Lpi\KernelBundle\Utils\Text;

class UtilsTests extends \PHPUnit_Framework_TestCase {

    public function testSlugify(){
        
        $slugify = Text::slugify("c'est un test a slugifier");
        $this->assertEquals('c-est-un-test-a-slugifier', $slugify);

        $slugify = Text::slugify("Proximité");
        $this->assertEquals('proximite', $slugify);
    }
}