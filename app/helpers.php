<?php

use App\Models\AddsPage;

if (!function_exists('get_additions')) {
   function get_additions()
   {
      $addsPages = AddsPage::where('enabled', true)->get();

      $headerAdditions = '';
      $bodyAdditions = '';
      $scriptAdditions = '';

      foreach ($addsPages as $addsPage) {
         $headerAdditions .= $addsPage->header_additions ?? '';
         $bodyAdditions .= $addsPage->body_additions ?? '';
         $scriptAdditions .= $addsPage->script_additions ?? '';
      }

      return [
         'header_additions' => $headerAdditions,
         'body_additions' => $bodyAdditions,
         'script_additions' => $scriptAdditions,
      ];
   }
}
