<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/2/2018
 * Time: 2:45 PM
 */

namespace Faqs\Model;

use Illuminate\Database\Eloquent\Model;
use Users\Models\Users;

class FaqsItem extends Model
{
    protected $table = 'faqs_item';

    protected $fillable = [
        'question', 'answer', 'group', 'status', 'created_at', 'updated_at', 'sort', 'created_by', 'edited_by'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getFaqs()
    {
        return $this->belongsTo(Faqs::class, 'group', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getCreatedBy()
    {
        return $this->belongsTo(Users::class, 'created_by', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getEditedBy()
    {
        return $this->belongsTo(Users::class, 'edited_by', 'id');
    }
}