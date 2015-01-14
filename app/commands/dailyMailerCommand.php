<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class dailyMailerCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'command:dailyTopic';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command to send the daily topic of the day';

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
		$theme = Theme::today()->theme;
		$arts = Art::where('theme_id', Theme::today()->id - 1)->get();
		$users = User::where('email','sidharath@genii.in')->get();
		foreach ($users as $key => $user) {
			$data['arts'] = $arts;
			$data['name'] = $user->name;
			$data['email'] = $user->email;
			$data['theme'] = $theme;
			Mail::send('emails.reminder', $data, function($message) use ($data){
	      $message->to($data['email'], $data['name'])->subject($data['theme'] . ': Topic for today');
	    });					
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
