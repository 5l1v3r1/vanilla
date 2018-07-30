<?php
/**
 * @author Todd Burry <todd@vanillaforums.com>
 * @copyright 2009-2018 Vanilla Forums Inc.
 * @license GPLv2
 */

namespace VanillaTests\APIv2;

use PHPUnit\Framework\TestCase;
use VanillaTests\Fixtures\TestApiController;

/**
 * Test some basic functionality of the **AbstractApiController**.
 */
class AbstractApiControllerTest extends TestCase {
    /**
     * @var TestApiController
     */
    private $controller;

    /**
     * Include the abstract controller because it's in an addon.
     */
    public static function setUpBeforeClass() {
        parent::setUpBeforeClass();
        require_once __DIR__.'/../../applications/dashboard/controllers/api/AbstractApiController.php';
    }

    /**
     * Create a new controller instance for testing.
     *
     * This can be modified later if injection is required.
     */
    public function setUp() {
        parent::setUp();
        $this->controller = new TestApiController();
    }

    /**
     * Test **isExpandedField**.
     *
     * @param string[]|bool $expand The expand parameter.
     * @param bool $expected The expected result of **isExpandedField**.
     * @dataProvider provideIsExpandedFieldTests
     */
    public function testIsExpandedField($expand, bool $expected) {
        $actual = $this->controller->isExpandField('foo', $expand);
        $this->assertSame($expected, $actual);
    }

    /**
     * Test data for **isExpandedField**.
     *
     * @return array Returns a data provider.
     */
    public function provideIsExpandedFieldTests() {
        $r = [
            'bool true' => [true, true],
            'field set' => [['foo'], true],
            'field not set' => [['bar'], false],
            'all' => [['all'], true],
            'string "true"' => [['true'], true],
            '1' => [['1'], true],
            'empty expand' => [[], false],
        ];

        return $r;
    }


    /**
     * Test **resolveExpandFields()**
     *
     * @param bool|string[] $expand The expand argument.
     * @param array $expected The expected result of **resolveExpandFields()**.
     * @dataProvider provideResolveExpandFieldsData
     */
    public function testResolveExpandedFields($expand, array $expected) {
        $map = ['foo' => 'fooID', 'bar' => 'barID'];
        $request = ['expand' => $expand];

        $arr = get_class_methods($this->controller);
//        throw new \Exception(implode(", ", $arr));

        $actual = $this->controller->resolveExpandFieldsPublic($request, $map);
        $this->assertEquals($expected, $actual);
    }

    /**
     * Test data for **testResolveExpandedFields()**.
     *
     * @return array Returns a data provider array.
     */
    public function provideResolveExpandFieldsData() {
        $r = [
            'true' => [true, ['fooID', 'barID']]
        ];

        return $r;
    }
}
