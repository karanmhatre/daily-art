<?php

class ThemesTableSeeder extends Seeder {

  public function run()
  {
    // Uncomment the below to wipe the table clean before populating
    DB::table('themes')->truncate();

    $themes = array(
      array(
        'theme' => 'Cat',
        'date' => date('Y-m-d')
        ),
      array(
        'theme' => 'Dog',
        'date' => date('Y-m-d', strtotime("-1 days"))
        ),
      array(
        'theme' => 'House',
        'date' => date('Y-m-d', strtotime("-2 days"))
        ),
      array(
        'theme' => 'Nature',
        'date' => date('Y-m-d', strtotime("-3 days"))
        ),
      array(
        'theme' => 'Flowers',
        'date' => date('Y-m-d', strtotime("-4 days"))
        ),
      array(
        'theme' => 'Color',
        'date' => date('Y-m-d', strtotime("-5 days"))
        ),
      array(
        'theme' => 'Rebel',
        'date' => date('Y-m-d', strtotime("-6 days"))
        ),
    );

    // Uncomment the below to run the seeder
    DB::table('themes')->insert($themes);
  }

}
