<?php
namespace App\Transformers;

use App\Models\Subject;
use League\Fractal\TransformerAbstract;
use App\Transformers\ScoreTransformer;
use App\Transformers\QuarterTransformer;
use App\Models\Quarter;
use App\Models\Student;

class SubjectTransformer extends TransformerAbstract
{

  public function transform(Subject $subject)
  {
    return [
        'name' => $subject->name,
        'class' => $subject->class,
        'slug' => $subject->slug,
        'quarters' => [
          fractal()
          ->collection(Quarter::isLive()->get())
          ->includeScore()
          ->transformWith(new QuarterTransformer)
          ->toArray()
        ],
    ];
  }

}
