<?php

use Illuminate\Database\Migrations\Migration;

class CompressExistsImages extends Migration
{
  public function up()
  {
    if (config('app.environment') === 'production') {
      $files = \Illuminate\Support\Facades\Storage::allFiles('public/question-images');

      foreach ($files as $file) {
        $fullPath = storage_path('app/'.$file);

        ImageOptimizer::optimize($fullPath);
      }
    }
  }
}
