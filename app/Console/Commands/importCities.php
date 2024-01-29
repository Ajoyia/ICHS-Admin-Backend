<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class importCities extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'import:cities';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Using this command to populate Cities Table in the Database';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return int
	 */
	public function handle() {
		try {
			exec("mysql -h " . env('DB_HOST') . " -u " . env('DB_USERNAME') . " -p "
				. env('DB_PASSWORD') . " "
				. env('DB_DATABASE') . " < data/cities.sql");
			$this->info("Successfully imported tables ");
		} catch (\Exception $e) {
			dd($e);
			$msg = "Could not read table structure for tables";
			$this->error($msg);
		}
	}
}
