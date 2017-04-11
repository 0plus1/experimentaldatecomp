<?php namespace Tests\Console;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Console\Application;

class CreateUserCommandTest extends TestCase
{
    public function testExecute()
    {
        $application = new Application();

        $application->add(new \App\Console\DateDiff());

        $command = $application->find('app:date-diff');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),
            'date_one' => '11 04 2017',
            'date_two' => '01 01 1970',
        ));

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertContains('01 01 1970, 11 04 2017, 17267', $output);
    }
}