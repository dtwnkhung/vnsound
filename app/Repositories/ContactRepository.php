<?php

namespace App\Repositories;

use App\Models\Contact;
use Czim\Repository\BaseRepository;

class ContactRepository extends SourceRepository
{
    /**
     * Returns specified model class name.
     *
     * @return string
     */
    public function model()
    {
        return Contact::class;
    }

    public function getModel()
    {
        return new Contact();
    }
    public function getListDataContact($take= PHP_INT_MAX)
    {
        $list = $this->getListquery('type', '=', 1, $take);
        return $list;
    }
    public function getListDataRegis($take = PHP_INT_MAX)
    {
        $list = $this->getListquery('type', '=', 2, $take);
        return $list;
    }

}
