<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client_company extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id', 'company_name', 'company_phone', 'no_of_employees',
        'company_address', 'company_zip', 'company_country'];

    protected $table = 'client_company';
}
