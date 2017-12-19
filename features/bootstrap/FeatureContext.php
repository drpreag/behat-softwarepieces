<?php

use Behat\Behat\Context\ClosuredContextInterface;
use Behat\Behat\Context\TranslatedContextInterface;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\BehatContext;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Exception\PendingException;

use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

use Behat\MinkExtension\Context\MinkContext;
use Behat\MinkExtension\Context\RawMinkContext;

use Behat\Mink\Driver\Selenium2Driver;
use Behat\Behat\Hook\Scope\AfterStepScope;
use Goutte\Client;

/**
 * Features context.
 */
class FeatureContext extends MinkContext
{
     /**
     * Since not all Session drivers support base urls this is a wrapper to help
     * 
     * @param  string $path The path of the file you want
     * @param  string $base The base of the url
     * @return  string
     */
    protected function uri($path, $base = null) {
        // Get default value
        $base = is_null($base) ? $this->base : $base;

        // Add trailing slash to $base
        if(substr($base, -1, 1) !== '/') {
            $base .= '/';
        }

        // Remoev it from $path
        if(substr($path, -1, 1) === '/') {
            $path = substr($path, 0, -1);
        }

        // Return
        return $base . $path;
    }

    /** @Given /^I am in a directory "([^"]*)"$/ */
    public function iAmInADirectory($dir)
    {
        if (!file_exists($dir)) {
            mkdir($dir);
        }
        chdir($dir);
    }

    /** @Given /^I have a file named "([^"]*)"$/ */
    public function iHaveAFileNamed($file)
    {
        touch($file);
    }

    /** @When /^I run "([^"]*)"$/ */
    public function iRun($command)
    {
        exec($command, $output);
        $this->output = trim(implode("\n", $output));
    }

    /** @Then /^I should get:$/ */
    public function iShouldGet(PyStringNode $string)
    {
        if ((string) $string !== $this->output) {
            throw new Exception(
                "Actual output is:\n" . $this->output
            );
        }
    }
}