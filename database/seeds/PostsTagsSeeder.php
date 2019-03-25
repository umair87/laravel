<?php

use Illuminate\Database\Seeder;

class PostsTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\PostTag::class, 20)->create()->each(function($u){
            $u->make();
        });
    }
}
