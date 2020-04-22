<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/21/2019
 * Time: 5:04 PM
 */

namespace Contact\Repositories;


use Contact\Models\Contact;
use Prettus\Repository\Eloquent\BaseRepository;

class ContactRepository extends BaseRepository
{
    public function model()
    {
        return Contact::class;
    }
}