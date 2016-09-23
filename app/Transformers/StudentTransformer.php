<?php
namespace App\Transformers;

use App\Models\Student;
use League\Fractal\TransformerAbstract;

class StudentTransformer extends TransformerAbstract
{

  public function transform(Student $student)
  {
    return [
        'name' => $student->name,
        'gender' => $student->gender,
    ];
  }

}
