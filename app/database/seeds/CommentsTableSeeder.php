<?php

class CommentsTableSeeder extends Seeder {

  public function run()
  {
    // Uncomment the below to wipe the table clean before populating
    DB::table('comments')->truncate();

    $comments = array(
      array(
        'user_id' => '1',
        'art_id' => '1',
        'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur odit vel, deleniti voluptatum inventore explicabo.',
        'created_at' => date('Y-m-d H:i:s')
      ),
      array(
        'user_id' => '2',
        'art_id' => '1',
        'body' => 'Nice work!',
        'created_at' => date('Y-m-d H:i:s')
      ),
      array(
        'user_id' => '3',
        'art_id' => '1',
        'body' => 'Great Job!',
        'created_at' => date('Y-m-d H:i:s')
      ),
      array(
        'user_id' => '1',
        'art_id' => '1',
        'body' => 'This is really good! How did you do it?',
        'created_at' => date('Y-m-d H:i:s')
      ),
    );

    // Uncomment the below to run the seeder
    DB::table('comments')->insert($comments);
  }

}
