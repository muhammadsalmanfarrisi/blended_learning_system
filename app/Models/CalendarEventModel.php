<?php namespace App\Models;

use CodeIgniter\Model;

class CalendarEventModel extends Model
{
    protected $table = 'calendar_events';
    protected $primaryKey = 'id';
    protected $allowedFields = ['event_date', 'event_description'];
}
