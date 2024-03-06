<?php

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    // This method runs before each test method
    protected function setUp(): void
    {
        // Any setup code goes here
    }

    // This method runs after each test method
    protected function tearDown(): void
    {
        // Any cleanup code goes here
    }

    // This is a test method without any assertions
    public function testNothing()
    {
        $this->assertTrue(true);
    }

    // This is a test method with assertions
    public function testSomething()
    {
        // Arrange
        $value1 = 2;
        $value2 = 3;

        // Act
        $result = $value1 + $value2;

        // Assert
        $this->assertEquals(5, $result);
    }

    // This is a test method with data provider
    /**
     * @dataProvider additionProvider
     */
    public function testAddition($a, $b, $expected)
    {
        $result = $a + $b;
        $this->assertEquals($expected, $result);
    }

    // Data provider for the testAddition method
    public function additionProvider()
    {
        return [
            [1, 1, 2],
            [0, 1, 1],
            [1, 0, 1],
            [2, 3, 5],
        ];
    }

    // This is a test method with expected exception
    public function testException()
    {
        $this->expectException(Exception::class);
        throw new Exception('This is an exception');
    }

    // This is a test method with mock objects
    public function testMock()
    {
        // Create a mock object
        $mock = $this->getMockBuilder('ClassName')
                     ->setMethods(['methodName'])
                     ->getMock();

        // Set expectations on the mock object
        $mock->expects($this->once())
             ->method('methodName')
             ->with($this->equalTo('expectedArgument'))
             ->willReturn('returnValue');

        // Call the method being tested
        $result = $mock->methodName('expectedArgument');

        // Assert the result
        $this->assertEquals('returnValue', $result);
    }
}
