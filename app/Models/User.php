<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Services\AmplificaService; 

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    private static $amplificaService;

    public function __construct()
    {
        self::$amplificaService = new AmplificaService();
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    
    public static function initAmplificaService()
    {
        if (self::$amplificaService === null) {
            self::$amplificaService = new AmplificaService();
        }
    }

   
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //////////////////////////////////////////////////////////////////////

   

    /**
     * Obtiene el token JWT y lo renueva si expiró.
     *
     * @return string
     * @throws \Exception
     */
    public static function getJwtToken()
    {
        if (self::$amplificaService === null) {
            self::initAmplificaService();
        }
        // Verifica si hay un token válido en caché
        if (Cache::has('jwt_token')) {
            return Cache::get('jwt_token');
        }

        $token = self::$amplificaService->authenticate();

        // Almacenar el token en caché por 55 segundos
        Cache::put('jwt_token', $token, now()->addSeconds(55));

        return $token;
    }
}
