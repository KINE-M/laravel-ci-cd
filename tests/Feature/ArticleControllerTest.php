<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $response = $this->get(route('articles.index'));

        $response->assertStatus(400)->assertViewIs('articles.index');
    }

    public function testGuestCreate()
    {
        $response = $this->get(route('articles.create'));

        $response->assertRedirect(route('login'));
    }

    public function testAuthCreate(){
        // Arrange-Act-Assert(準備・実行・検証)
        // Testに必要なUserモデルを準備
        $user = factory(User::class)->create();

        // ログインして、記事投稿画面にアクセスすることを実行
        $response = $this->actingAs($user)->get(route('articles.create'));

        // レスポンスを検証
        $response->assertStatus(200)->assertViewIs('articles.create');
    }
}
