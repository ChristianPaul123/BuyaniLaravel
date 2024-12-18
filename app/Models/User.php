<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'user_type',
        'profile_pic',
        'phone_number',
        'status',
        'last_online',
        'deactivated_status',
        'deactivated_date',
        'deactivated_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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

    // Define a relationship with the ShippingAddress model
    public function shippingAddresses() {
        return $this->hasMany(ShippingAddress::class);
    }

    // Define a relationship with the PaymentMethod model
    public function payments() {
        return $this->hasMany(Payment::class);
    }

    public function farmerforms() {

        return $this->hasMany(FarmerForm::class); // 'user_id' is the foreign key in the farmerforms table
    }

    // Define a relationship with the Cart model
    public function cart() {
        return $this->hasOne(Cart::class); // 'user_id' is the foreign key in the cart table
    }

    // Define a relationship with the Order model
    public function orders() {
        return $this->hasMany(Order::class);
    }

    // Define a relationship with the Favorite model
    public function favorites() {
        return $this->hasMany(Favorite::class);
    }

    public function otp_verifies() {
        return $this->hasMany(OtpVerify::class);
    }

    // Define a relationship with the OrderRating model
    public function orderRatings() {
        return $this->hasMany(OrderRating::class);
    }

    public function productRatings() {
        return $this->hasMany(ProductRating::class);
    }

    public function farmerProduces(){
        return $this->hasMany(FarmerProduce::class);
    }

    public function messages() {
        return $this->hasMany(Messages::class);
    }

    public function chat() {
        return $this->hasOne(Chat::class);
    }

    public function votedProducts() {
        return $this->hasMany(Votedproducts::class);
    }

    public function votingCounts() {
        return $this->hasMany(VotingCount::class);
    }

    public function suggestProduct() {
        return $this->hasOne(SuggestProduct::class);
    }




    public function getUserStatusAttribute()
    {
        $statuses = [
            1 => 'Online',
            0 => 'Offline'
        ];

        return $statuses[$this->status] ?? 'Unknown Status';
    }

    public function getUserTypeLabelAttribute()
{
    $types = [
        1 => 'Regular User',
        2 => 'Farmer',
        // Add more user types as needed
    ];

    return $types[$this->user_type] ?? 'Guest';
}

}
