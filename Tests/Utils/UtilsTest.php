<?php
namespace Lpi\KernelBundle\Tests\Utils;

use Lpi\KernelBundle\Utils\Utils;

class UtilsTests extends \PHPUnit_Framework_TestCase {

    public function testSlugify(){
        
        $slugify = Utils::slugify("c'est un test a slugifier");
        $this->assertEquals('c-est-un-test-a-slugifier', $slugify);

        $slugify = Utils::slugify("Proximité");
        $this->assertEquals('proximite', $slugify);
    }
}