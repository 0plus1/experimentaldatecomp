<?php namespace App\Console;

use App\Libraries\DateComparer;
use App\Libraries\NotTheDateLibrary;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class DateDiff
 * @package App\Console
 */
class DateDiff extends Command
{
    protected function configure()
    {
        $this
            ->setName('app:date-diff')
            ->setDescription('Compares two dates.')
            ->addArgument('date_one', InputArgument::REQUIRED, 'First date to compare in DD MM YYYY format.')
            ->addArgument('date_two', InputArgument::REQUIRED, 'Second date to compare in DD MM YYYY format.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Create two new NotTheDateLibrary objects
        $date_one = new NotTheDateLibrary($input->getArgument('date_one'));
        $date_two = new NotTheDateLibrary($input->getArgument('date_two'));

        // Validate dates
        if (!$date_one->isDateValid()) {
            throw new \InvalidArgumentException('date_one is not a valid date ['.$input->getArgument('date_one').']');
        }
        if (!$date_two->isDateValid()) {
            throw new \InvalidArgumentException('date_two is not a valid date ['.$input->getArgument('date_two').']');
        }

        // Assign to nicely name variables the ordered array coming back from DateComparer
        list($earliest_date, $latest_date) =  DateComparer::orderDatesAsc($date_one, $date_two);

        // Write outputs as DD MM YYYY, DD MM YYYY, X (earliest_date, latest_date, days_diff)
        $output->writeln($earliest_date->getDateString().', '.$latest_date->getDateString().', '.DateComparer::getDaysDiffBetweenDates($date_one, $date_two));
    }
}