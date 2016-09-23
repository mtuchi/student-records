<?php
namespace App\Transformers;

use App\Models\Score;
use App\Transformers\StudentTransformer;
use App\Transformers\QuarterTransformer;
use App\Transformers\SubjectTransformer;
use League\Fractal\TransformerAbstract;

class ScoreTransformer extends TransformerAbstract
{
  protected $availableIncludes = [
    'quarter','subject','student'
  ];
  public function transform(Score $score)
  {
    return [
      'id' => $score->id,
      'name' =>  $score->student->name,
      'gender' => $score->student->gender,
      'first_month' => $score->first_month,
      'second_month' => $score->second_month,
      'third_month' => $score->third_month,
      'diffForHumans' => $score->created_at->diffForHumans(),
    ];
  }

  public function includeStudent(Score $score)
  {
    return $this->item($score->student, new StudentTransformer);
  }

  public function includeQuarter(Score $score)
  {
    return $this->item($score->quarter, new QuarterTransformer);
  }

  public function includeSubject(Score $score)
  {
    return $this->item($score->subject, new SubjectTransformer);
  }
}
