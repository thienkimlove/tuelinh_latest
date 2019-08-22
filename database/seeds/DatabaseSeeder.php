<?php

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        //$this->call(TracuuFaker::class);
        //$this->call(SanphamFaker::class);
        //$this->call(DeliveryFaker::class);
        $this->call(updateImages::class);

        Model::reguard();
    }
}

class UserTableSeeder extends Seeder
{
    public function run()
    {
        factory('App\User', 1)->create();
    }
}

class ImportCategories extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::statement('ALTER TABLE categories CHANGE  id  id INT( 10 ) UNSIGNED NOT NULL ;');
        DB::table('categories')->truncate();
        DB::table('category_translations')->truncate();

        $query = "SELECT t1 . * , t2.parent
                    FROM  tu81_terms t1, tu81_term_taxonomy t2
                    WHERE t1.term_id = t2.term_id
                    AND taxonomy =  'category'";
        $categories = DB::connection('mysql2')->select($query);
        $maxId = 0;
        foreach ($categories as $cate) {
            if ($cate->term_id > $maxId) {
                $maxId = $cate->term_id;
            }
            DB::insert('insert into categories (id, parent_id, slug) values (?, ?, ?)', [$cate->term_id, ($cate->parent) ? $cate->parent : null, $cate->slug]);

            $category = Category::find($cate->term_id);
            $category->translateOrNew('vi')->title = $cate->name;
            $category->save();
        }


        DB::statement('ALTER TABLE categories CHANGE  id  id INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT ;');
        DB::statement('ALTER TABLE categories AUTO_INCREMENT = ' . $maxId . ';');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

class TracuuFaker extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create('vi_VN');
        for ($i = 0; $i < 60; $i++) {
            $insert = [
                'category_id' => $faker->randomElement([1, 3, 43]),
                'status' => true,
                'image' => '0ca1f3d3ef0f455ddec7d078693eae00.jpg'
            ];

            foreach (['vi', 'en', 'fr'] as $lang) {
                foreach (['title', 'content', 'desc'] as $field) {
                    $insert[$lang][$field] = $faker->sentence();
                }
            }
            Post::create($insert);
        }
    }
}

class SanphamFaker extends Seeder
{
    public function run()
    {
        $tagIds = [];
        foreach (array('Tiêu hóa', 'Xương khớp', 'Trẻ em', 'Thuốc thảo dược') as $tag) {
            $tagCount = Tag::where('title', $tag)->first();
            if ($tagCount) {
                $tagIds[] = $tagCount->id;
            } else {
                $slug = Str::slug($tag);
                $slugCount = Tag::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
                $slug = ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
                $tagIds[] = Tag::create(['title' => $tag, 'slug' => $slug])->id;
            }
        }
        $faker = Faker\Factory::create('vi_VN');
        for ($i = 0; $i < 60; $i++) {
            $insert = [
                'category_id' => 15,
                'status' => true,
                'image' => '0ca1f3d3ef0f455ddec7d078693eae00.jpg'
            ];

            foreach (['vi', 'en', 'fr'] as $lang) {
                foreach (['title', 'content', 'desc'] as $field) {
                    $insert[$lang][$field] = $faker->sentence();
                }
            }
            $post = Post::create($insert);
            $post->tags()->sync($faker->randomElements($tagIds));
        }

    }
}

class DeliveryFaker extends Seeder
{
    public function run()
    {
        DB::table('deliveries')->truncate();
        $faker = Faker\Factory::create('vi_VN');
        for ($i = 0; $i < 40; $i++) {
            $data = [
                'city' => $faker->city,
                'title' => $faker->name,
                'address' => $faker->wardName,
                'phone' => $faker->phoneNumber,
                'area' => $faker->randomElement(array('Miền Bắc', 'Miền Trung', 'Miền Nam'))
            ];
            $data['slug'] = Str::slug($data['city']);
            \App\Delivery::create($data);
        }
    }
}

class updateImages extends Seeder
{
    /**
     *
     */
    public function run()
    {
        $posts = Post::all();
        foreach ($posts as $post) {

            $avatar = DB::connection('mysql2')
                ->table('tu81_posts')
                ->where('post_type', 'attachment')
                ->where('post_parent', $post->id)
                ->first();

            $image = !empty($avatar) ? $avatar->guid : '';
            if ($image) {
                $filename = md5(time()) . '.' . pathinfo(parse_url($image)['path'], PATHINFO_EXTENSION);
                if (file_exists(str_replace('http://tuelinh.vn/', '/var/www/html/', $image))) {
                    copy($image, public_path('files/tuelinh/' . $filename));
                    $post->image = $filename;
                    $post->save();
                }
            }
        }
    }
}

class ImportPosts extends Seeder
{
    public function run()
    {
        //posts
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::statement('ALTER TABLE posts CHANGE  id  id INT( 10 ) UNSIGNED NOT NULL ;');
        DB::table('posts')->truncate();
        DB::table('post_translations')->truncate();

        $maxId = 0;

        DB::connection('mysql2')->enableQueryLog();
        $posts = DB::connection('mysql2')
            ->table('tu81_posts')
            ->where('post_type', 'post')
            ->where('post_status', 'publish')
            ->get();
        foreach ($posts as $post) {

            if ($maxId < $post->ID) {
                $maxId = $post->ID;
            }
            $data = [];
            $data['id'] = $post->ID;
            $data['title'] = $post->post_title;
            $data['content'] = $post->post_content;
            $data['created_at'] = $post->post_date;
            $data['updated_at'] = $post->post_modified;

            $avatar = DB::connection('mysql2')
                ->table('tu81_posts')
                ->where('post_type', 'attachment')
                ->where('post_parent', $post->ID)
                ->first();

            $data['image'] = !empty($avatar) ? $avatar->guid : $post->ID;

            $meta = DB::connection('mysql2')
                ->table('tu81_postmeta')
                ->where('post_id', $post->ID)
                ->get();

            foreach ($meta as $tag) {
                if ($tag->meta_key == '_yoast_wpseo_metadesc') {
                    $data['desc'] = $tag->meta_value;
                }
            }

            $terms = DB::connection('mysql2')->table('tu81_term_relationships')
                ->join('tu81_term_taxonomy', 'tu81_term_relationships.term_taxonomy_id', '=', 'tu81_term_taxonomy.term_taxonomy_id')
                ->select('tu81_term_taxonomy.*')
                ->where('tu81_term_relationships.object_id', $post->ID)
                ->where('tu81_term_taxonomy.taxonomy', 'category')->first();
            if ($terms) {
                $data['category_id'] = $terms->term_id;
            }


            DB::insert('insert into posts (id, category_id, image, status) values (?, ?, ?, ?)', [$data['id'], $data['category_id'], $data['image'], true]);

            $postLoad = Post::find($data['id']);

            $postLoad->translateOrNew('vi')->title = $data['title'];
            if (!empty($data['desc'])) {
                $postLoad->translateOrNew('vi')->desc = $data['desc'];
            }

            $postLoad->translateOrNew('vi')->content = $data['content'];

            $postLoad->save();
        }

        DB::statement('ALTER TABLE posts CHANGE  id  id INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT ;');

        DB::statement('ALTER TABLE posts AUTO_INCREMENT = ' . $maxId . ';');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
