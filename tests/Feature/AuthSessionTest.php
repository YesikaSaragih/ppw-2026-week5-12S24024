<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthSessionTest extends TestCase
{
    use RefreshDatabase;

    public function test_halaman_login_dapat_diakses_oleh_guest(): void
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
        $response->assertSee('Portal Pustakawan Del');
        $response->assertSee('pustakawan@del.ac.id');
    }

    public function test_login_berhasil_meregenerasi_sesi_dan_mengantrekan_cookie_email(): void
    {
        $user = User::factory()->create([
            'email' => 'pustakawan@del.ac.id',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post(route('login.attempt'), [
            'email' => 'pustakawan@del.ac.id',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($user);

        // Verifikasi metadata timestamp sesi tersimpan
        $this->assertNotNull(session('login_timestamp'));

        // Verifikasi cookie email terantre untuk prefill
        $response->assertCookie('del_last_librarian_email', 'pustakawan@del.ac.id');
    }

    public function test_login_gagal_dengan_kredensial_salah(): void
    {
        User::factory()->create([
            'email' => 'pustakawan@del.ac.id',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->from(route('login'))->post(route('login.attempt'), [
            'email' => 'pustakawan@del.ac.id',
            'password' => 'passwordsalah',
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_logout_membatalkan_sesi_pustakawan(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('logout'));

        $response->assertRedirect(route('login'));
        $response->assertSessionHas('success');
        $this->assertGuest();
    }

    public function test_pustakawan_yang_sudah_login_dialihkan_jika_mengunjungi_halaman_login(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('login'));

        $response->assertRedirect();
    }
}
