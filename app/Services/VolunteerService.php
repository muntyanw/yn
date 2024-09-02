<?php

namespace App\Services;

use App\Models\Volunteer;

class VolunteerService
{
   public function fetchVolunteers(int $offset, int $limit, bool $isEmployee, bool $publicAccess)
   {
      $volunteers = Volunteer::where('public_access', $publicAccess)
         ->where('is_employee', $isEmployee)
         ->offset($offset)
         ->limit($limit)
         ->get();

      return $volunteers;
   }

   public function searchVolunteers($query)
   {
      return Volunteer::where('first_name', 'like', "%{$query}%")
         ->orWhere('last_name', 'like', "%{$query}%")
         ->get();
   }

   // Добавляйте другие методы по мере необходимости
}
