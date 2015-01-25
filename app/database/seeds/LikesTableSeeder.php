<?php

class LikesTableSeeder extends Seeder {

  public function run()
  {
    // Uncomment the below to wipe the table clean before populating
    DB::table('like_user')->truncate();

    $like_user = array(
      array(
        'user_id' => '1',
        'art_id' => '1'
      ),
      array(
        'user_id' => '2',
        'art_id' => '1'
      ),
      array(
        'user_id' => '3',
        'art_id' => '1'
      ),
      array(
        'user_id' => '1',
        'art_id' => '2'
      ),
      array(
        'user_id' => '1',
        'art_id' => '3'
      ),
      array(
        'user_id' => '1',
        'art_id' => '4'
      ),
    );

    // Uncomment the below to run the seeder
    DB::table('like_user')->insert($like_user);
  }

}
