<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Accounts extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'currency_id',
        'last_login_date',
        'last_ip',
        'address1',
        'address2',
        'city',
        'state',
        'postal_code',
        'country_id',
        'is_active',
        'is_banned'
    ];

    public function edit($data)
    {
        $this->first_name = $data['first_name'];
        $this->last_name = $data['last_name'];
        $this->email = $data['email'];
        $this->save();
    }

    public function get($id)
    {
        return Accounts::find($id);
    }

    public function getAccountByEmail($email)
    {
        return Accounts::where('email', $email)->first();
    }

}
