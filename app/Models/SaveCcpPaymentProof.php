<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaveCcpPaymentProof extends Model
{

    use HasFactory;
    protected $table = 'ccp_payment';
    protected $fillable = [
        'user_id' , 'image_path' , 'status' , 'duration' , 'credit'
    ];
}
