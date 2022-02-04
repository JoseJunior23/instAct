<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;

class PostTest extends TestCase
{
    use DatabaseTransactions;
    use withFaker;
    //  Entrar na pagina inicial e ver a frase 'Instact'
    //  @return void

    public function testOpenIndexAndSeeInstact()
    {
        $response = $this->get('/');

        $response->assertSee('Instact');
    }

    /**
     * Entrar na rota inicial e não ver a palavra Dashboard
     *
     * @return void
     */

    public function testOpenIndexAndDontSeeDashboard()
    {
        $response = $this->get('/');

        $response->assertDontSee('Dashboard');
    }

    /**
     * Tentar acessar a rota dashboard sem autenticação e retornar erro
     *
     * @return void
     */

    public function testShouldNotOpenDashboardWithAuth()
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/');
    }

    /**
     * entrna rota dashboard com autenticação
     *
     * @return void
     */

    public function testShouldOpenDashboardWithAuth()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/dashboard');

        $response->assertOk();
        $response->assertSee('Dashboard');
    }

    /**
     * Acessar rota /posts/store e criar um post
     *
     * @return void
     *
     * verificando se foi alterado no banco de dados
     */

    public function testShouldStorePost()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $input = [
            'description' => $this->faker->sentence(4),
            'photo' => UploadedFile::fake()->image('img.jpg')
        ];

        $response = $this->post('/posts/store', $input);

        $this->assertDatabaseHas('posts', [
            'description' => $input['description'],
            'user_id' => $user->id
        ]);
    }
}
