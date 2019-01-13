<?php
/**
 * @author Adam Charron <adam.c@vanillaforums.com>
 * @copyright 2009-2019 Vanilla Forums Inc.
 * @license GPL-2.0-only
 */

namespace VanillaTests\Library\Vanilla\Formatting\Quill;

use VanillaTests\Library\Vanilla\Formatting\FixtureRenderingTest;

class GdnFormatTest extends FixtureRenderingTest {

    const FIXTURE_DIR = self::FIXTURE_ROOT . '/formats';

    /**
     * @param string $fixtureDir
     * @throws \Exception
     * @dataProvider provideBBCode
     */
    public function testBBCodeToHtml(string $fixtureDir) {
        list($input, $expectedOutput) = $this->getFixture(self::FIXTURE_DIR . '/bbcode/html/' . $fixtureDir);
        $output = \Gdn_Format::to($input, "bbcode");
        $this->assertHtmlStringEqualsHtmlString(
            $expectedOutput, // Needed so code blocks are equivalently decoded
            $output, // Gdn_Format does htmlspecialchars
            "Expected html outputs for fixture $fixtureDir did not match."
        );
    }

    public function provideBBCode() {
        return $this->createFixtureDataProvider('/formats/bbcode/html');
    }

    /**
     * @param string $fixtureDir
     * @throws \Exception
     * @dataProvider provideMarkdown
     */
    public function testMarkdownToHtml(string $fixtureDir) {
        list($input, $expectedOutput) = $this->getFixture(self::FIXTURE_DIR . '/markdown/html/' . $fixtureDir);
        $output = \Gdn_Format::to($input, "markdown");
        $this->assertHtmlStringEqualsHtmlString(
            $expectedOutput, // Needed so code blocks are equivalently decoded
            $output, // Gdn_Format does htmlspecialchars
            "Expected html outputs for fixture $fixtureDir did not match."
        );
    }

    public function provideMarkdown() {
        return $this->createFixtureDataProvider('/formats/markdown/html');
    }

    /**
     * @param string $fixtureDir
     * @throws \Exception
     * @dataProvider provideText
     */
    public function testTextToHtml(string $fixtureDir) {
        list($input, $expectedOutput) = $this->getFixture(self::FIXTURE_DIR . '/text/html/' . $fixtureDir);
        $output = \Gdn_Format::to($input, "text");
        $this->assertHtmlStringEqualsHtmlString(
            $expectedOutput, // Needed so code blocks are equivalently decoded
            $output, // Gdn_Format does htmlspecialchars
            "Expected html outputs for fixture $fixtureDir did not match."
        );
    }

    public function provideText() {
        return $this->createFixtureDataProvider('/formats/text/html');
    }

    /**
     * @param string $fixtureDir
     * @throws \Exception
     * @dataProvider provideTextEx
     */
    public function testTextExToHtml(string $fixtureDir) {
        list($input, $expectedOutput) = $this->getFixture(self::FIXTURE_DIR . '/textex/html/' . $fixtureDir);
        $output = \Gdn_Format::to($input, "textex");
        $this->assertHtmlStringEqualsHtmlString(
            $expectedOutput, // Needed so code blocks are equivalently decoded
            $output, // Gdn_Format does htmlspecialchars
            "Expected html outputs for fixture $fixtureDir did not match."
        );
    }

    public function provideTextEx() {
        return $this->createFixtureDataProvider('/formats/textex/html');
    }

    /**
     * @param string $fixtureDir
     * @throws \Exception
     * @dataProvider provideHtmlToHtml
     */
    public function testHtmlToHtml(string $fixtureDir) {
        list($input, $expectedOutput) = $this->getFixture(self::FIXTURE_DIR . '/html/html/' . $fixtureDir);
        $output = \Gdn_Format::to($input, "html");
        $this->assertHtmlStringEqualsHtmlString(
            $expectedOutput, // Needed so code blocks are equivalently decoded
            $output, // Gdn_Format does htmlspecialchars
            "Expected html outputs for fixture $fixtureDir did not match."
        );
    }

    public function provideHtmlToHtml() {
        return $this->createFixtureDataProvider('/formats/html/html');
    }

    /**
     * @param string $fixtureDir
     * @throws \Exception
     * @dataProvider provideWysiwyg
     */
    public function testWysiwygToHtml(string $fixtureDir) {
        list($input, $expectedOutput) = $this->getFixture(self::FIXTURE_DIR . '/wysiwyg/html/' . $fixtureDir);
        $output = \Gdn_Format::to($input, "wysiwyg");
        $this->assertHtmlStringEqualsHtmlString(
            $expectedOutput, // Needed so code blocks are equivalently decoded
            $output, // Gdn_Format does htmlspecialchars
            "Expected html outputs for fixture $fixtureDir did not match."
        );
    }

    public function provideWysiwyg() {
        return $this->createFixtureDataProvider('/formats/wysiwyg/html');
    }
}