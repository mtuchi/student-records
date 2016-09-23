<?php
namespace App\Transformers;

use App\Models\Quarter;
use App\Transformers\ScoreTransformer;
use App\Transformers\StudentTransformer;

use League\Fractal\TransformerAbstract;

class QuarterTransformer extends TransformerAbstract
{
  protected $availableIncludes = [
    'score','student','subject'
  ];

  public function transform(Quarter $quarter)
  {
    return [
        'name' => $quarter->name,
        'slug' => $quarter->slug
    ];
  }

  public function includeScore(Quarter $quarter)
  {
    return $this->collection($quarter->score, new ScoreTransformer);
  }

  public function includeStudent(Quarter $quarter)
  {
    return $this->collection($quarter->student, new ScoreTransformer);
  }

  public function includeSubject(Quarter $quarter)
  {
    return $this->collection($quarter->subject, new ScoreTransformer);
  }
}
