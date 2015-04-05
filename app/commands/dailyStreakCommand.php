<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class dailyStreakCommand extends Command {

  /**
   * The console command name.
   *
   * @var string
   */
  protected $name = 'command:dailyStreak';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Command to the streak everyday';

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Execute the console command.
   *
   * @return mixed
   */
  public function fire()
  {
    $users = User::get();

    foreach ($users as $key => $user) {
      if(!$user->hasArtToday())
      {
        $user->current_streak = 0;
        $user->save();
      }
    }
  }

  /**
   * Get the console command arguments.
   *
   * @return array
   */
  protected function getArguments()
  {
    return array(
      array('example', InputArgument::OPTIONAL, 'An example argument.'),
    );
  }


  /**
   * Get the console command options.
   *
   * @return array
   */
  protected function getOptions()
  {
    return array(
      array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
    );
  }

}
