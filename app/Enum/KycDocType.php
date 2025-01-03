<?php

namespace App\Enum;

enum KycDocType: string
{
   case PASSPORT = 'Passport';
   case DRIVING_LICENSE = 'Driving License';
   case NATIONAL_ID = 'National ID';
}
