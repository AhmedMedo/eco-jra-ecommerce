<?php

namespace Plugin\Multivendor\Models;

use Illuminate\Database\Eloquent\Model;
use Core\Models\User;
use Core\Models\UploadedFile;

class BuyerKycDocument extends Model
{
    protected $table = 'tl_buyer_kyc_documents';

    protected $fillable = [
        'user_id',
        'file_id',
        'document_type',
        'status',
        'notes'
    ];

    /**
     * Get the user that owns the KYC document.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the uploaded file associated with the KYC document.
     */
    public function file()
    {
        return $this->belongsTo(UploadedFile::class, 'file_id');
    }
}



