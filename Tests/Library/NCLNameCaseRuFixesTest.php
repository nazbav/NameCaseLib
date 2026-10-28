<?php

require_once dirname(__FILE__) . '/../../Library/NCLNameCaseRu.php';


class NCLNameCaseRuFixesTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var NCLNameCaseRu
     */
    protected $object;

    protected function setUp()
    {
        $this->object = new NCLNameCaseRu;
    }

    protected function tearDown()
    {

    }

    private function manSecondName($word)
    {
        return $this->object->qSecondName($word, null, 1);
    }

    public function testManSirnameConsonantInstrumentalOm()
    {
        $this->assertEquals(explode(',', 'Брезун,Брезуна,Брезуну,Брезуна,Брезуном,Брезуне'), $this->manSecondName('Брезун'));
        $this->assertEquals(explode(',', 'Тевалян,Теваляна,Теваляну,Теваляна,Теваляном,Теваляне'), $this->manSecondName('Тевалян'));
        $this->assertEquals(explode(',', 'Борхел,Борхела,Борхелу,Борхела,Борхелом,Борхеле'), $this->manSecondName('Борхел'));
        $this->assertEquals(explode(',', 'Ким,Кима,Киму,Кима,Кимом,Киме'), $this->manSecondName('Ким'));
    }

    public function testManSirnameOvInInstrumentalYm()
    {
        $this->assertEquals(explode(',', 'Петров,Петрова,Петрову,Петрова,Петровым,Петрове'), $this->manSecondName('Петров'));
        $this->assertEquals(explode(',', 'Кузьмин,Кузьмина,Кузьмину,Кузьмина,Кузьминым,Кузьмине'), $this->manSecondName('Кузьмин'));
        $this->assertEquals(explode(',', 'Синицын,Синицына,Синицыну,Синицына,Синицыным,Синицыне'), $this->manSecondName('Синицын'));
        $this->assertEquals(explode(',', 'Воробьёв,Воробьёва,Воробьёву,Воробьёва,Воробьёвым,Воробьёве'), $this->manSecondName('Воробьёв'));
    }

    public function testManSirnameYa()
    {
        $this->assertEquals(explode(',', 'Гамуля,Гамули,Гамуле,Гамулю,Гамулей,Гамуле'), $this->manSecondName('Гамуля'));
        $this->assertEquals(explode(',', 'Гугая,Гугаи,Гугае,Гугаю,Гугаей,Гугае'), $this->manSecondName('Гугая'));
        $this->assertEquals(explode(',', 'Гвазелия,Гвазелии,Гвазелии,Гвазелию,Гвазелией,Гвазелии'), $this->manSecondName('Гвазелия'));
    }

    public function testManSirnameAi()
    {
        $this->assertEquals(explode(',', 'Бардай,Бардая,Бардаю,Бардая,Бардаем,Бардае'), $this->manSecondName('Бардай'));
        $this->assertEquals(explode(',', 'Тугай,Тугая,Тугаю,Тугая,Тугаем,Тугае'), $this->manSecondName('Тугай'));
    }

    public function testManSirnameOi()
    {
        $this->assertEquals(explode(',', 'Береговой,Берегового,Береговому,Берегового,Береговым,Береговом'), $this->manSecondName('Береговой'));
        $this->assertEquals(explode(',', 'Сухой,Сухого,Сухому,Сухого,Сухим,Сухом'), $this->manSecondName('Сухой'));
        $this->assertEquals(explode(',', 'Толстой,Толстого,Толстому,Толстого,Толстым,Толстом'), $this->manSecondName('Толстой'));
    }

    public function testWomanSirnameAiNotDeclined()
    {
        $this->assertEquals(array_fill(0, 6, 'Тугай'), $this->object->qSecondName('Тугай', null, 2));
    }

    public function testWomanNameIya()
    {
        $this->assertEquals(explode(',', 'Ия,Ии,Ии,Ию,Ией,Ии'), $this->object->qFirstName('Ия', null, 2));
        $this->assertEquals(explode(',', 'Мария,Марии,Марии,Марию,Марией,Марии'), $this->object->qFirstName('Мария', null, 2));
    }

    public function testFullNameInstrumental()
    {
        $this->assertEquals('Брезуном Олегом Петровичем', $this->object->q('Брезун Олег Петрович', 4));
    }

    public function testGenderDetectKyzyOgly()
    {
        $this->assertEquals(2, $this->object->genderDetect('Бекет Алия Сериккызы'));
        $this->assertEquals(1, $this->object->genderDetect('Гусейнов Тимур Ахмедоглы'));
        $this->assertEquals(2, $this->object->genderDetect('Касумова Лейла Эльдар кызы'));
    }
}
