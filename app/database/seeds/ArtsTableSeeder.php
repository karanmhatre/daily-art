<?php

class ArtsTableSeeder extends Seeder {

  public function run()
  {
    // Uncomment the below to wipe the table clean before populating
    DB::table('arts')->truncate();

    $arts = array(
      array(
        'user_id' => '1',
        'likes' => '1',
        'caption' => 'Lorem ipsum something someone. This is a caption text.',
        'theme_id' => '1',
        'image' => 'img/test/1.jpg',
        'created_at' => date('Y-m-d H:i:s')
      ),
      array(
        'user_id' => '2',
        'likes' => '2',
        'caption' => null,
        'theme_id' => '1',
        'image' => 'img/test/2.jpg',
        'created_at' => date('Y-m-d H:i:s', strtotime("+1 hours"))
      ),
      array(
        'user_id' => '3',
        'likes' => '3',
        'caption' => 'Lorem ipsum something someone. This is a caption text.',
        'theme_id' => '1',
        'image' => 'img/test/3.jpg',
        'created_at' => date('Y-m-d H:i:s', strtotime("+2 hours"))
      ),
      array(
        'user_id' => '4',
        'likes' => '4',
        'caption' => 'Lorem ipsum something someone. This is a caption text.',
        'theme_id' => '1',
        'image' => 'img/test/4.jpg',
        'created_at' => date('Y-m-d H:i:s', strtotime("+3 hours"))
      ),
      array(
        'user_id' => '1',
        'likes' => '1',
        'caption' => 'Lorem ipsum something someone. This is a caption text.',
        'theme_id' => '2',
        'image' => 'img/test/2.jpg',
        'created_at' => date('Y-m-d H:i:s', strtotime("+4 hours"))
      ),
      array(
        'user_id' => '2',
        'likes' => '2',
        'caption' => 'Lorem ipsum something someone. This is a caption text.',
        'theme_id' => '2',
        'image' => 'img/test/5.jpg',
        'created_at' => date('Y-m-d H:i:s', strtotime("+5 hours"))
      ),
      array(
        'user_id' => '3',
        'likes' => '3',
        'caption' => 'Lorem ipsum something someone. This is a caption text.',
        'theme_id' => '2',
        'image' => 'img/test/6.jpg',
        'created_at' => date('Y-m-d H:i:s', strtotime("+6 hours"))
      ),
      array(
        'user_id' => '4',
        'likes' => '4',
        'caption' => 'Lorem ipsum something someone. This is a caption text.',
        'theme_id' => '2',
        'image' => 'img/test/7.jpg',
        'created_at' => date('Y-m-d H:i:s', strtotime("+7 hours"))
      ),
      array(
        'user_id' => '1',
        'likes' => '1',
        'caption' => 'Lorem ipsum something someone. This is a caption text.',
        'theme_id' => '3',
        'image' => 'img/test/2.jpg',
        'created_at' => date('Y-m-d H:i:s', strtotime("+8 hours"))
      ),
      array(
        'user_id' => '2',
        'likes' => '2',
        'caption' => 'Lorem ipsum something someone. This is a caption text.',
        'theme_id' => '3',
        'image' => 'img/test/1.jpg',
        'created_at' => date('Y-m-d H:i:s', strtotime("+9 hours"))
      ),
      array(
        'user_id' => '3',
        'likes' => '3',
        'caption' => 'Lorem ipsum something someone. This is a caption text.',
        'theme_id' => '3',
        'image' => 'img/test/3.jpg',
        'created_at' => date('Y-m-d H:i:s', strtotime("+10 hours"))
      ),
      array(
        'user_id' => '4',
        'likes' => '4',
        'caption' => 'Lorem ipsum something someone. This is a caption text.',
        'theme_id' => '3',
        'image' => 'img/test/7.jpg',
        'created_at' => date('Y-m-d H:i:s', strtotime("+11 hours"))
      ),
      array(
        'user_id' => '1',
        'likes' => '1',
        'caption' => 'Lorem ipsum something someone. This is a caption text.',
        'theme_id' => '4',
        'image' => 'img/test/8.jpg',
        'created_at' => date('Y-m-d H:i:s', strtotime("+12 hours"))
      ),
      array(
        'user_id' => '2',
        'likes' => '2',
        'caption' => 'Lorem ipsum something someone. This is a caption text.',
        'theme_id' => '4',
        'image' => 'img/test/5.jpg',
        'created_at' => date('Y-m-d H:i:s', strtotime("+13 hours"))
      ),
      array(
        'user_id' => '3',
        'likes' => '3',
        'caption' => 'Lorem ipsum something someone. This is a caption text.',
        'theme_id' => '4',
        'image' => 'img/test/6.jpg',
        'created_at' => date('Y-m-d H:i:s', strtotime("+14 hours"))
      ),
      array(
        'user_id' => '4',
        'likes' => '4',
        'caption' => 'Lorem ipsum something someone. This is a caption text.',
        'theme_id' => '4',
        'image' => 'img/test/4.jpg',
        'created_at' => date('Y-m-d H:i:s', strtotime("+15 hours"))
      ),
    );

    // Uncomment the below to run the seeder
    DB::table('arts')->insert($arts);
  }

}
