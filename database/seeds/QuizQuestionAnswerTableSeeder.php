<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Quiz;
use App\Option;
use App\TypeQuiz;

class QuizQuestionAnswerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //TypeQuiz::create(['name' => 'ข้อสอบตัวเลือก']);
        //TypeQuiz::create(['name' => 'ข้อสอบจับคู่']);
        $math_category = Category::create([
            'name' => 'วิชาคณิตศาสตร์'
        ]);

        Category::create([
            'name' => 'วิชาวิทยาศาสตร์'
        ]);

        $quiz_math = $math_category->quizzes()->create([
            'name' => 'แบบทดสอบชั้น ป 1',
            'detail' => 'เป็นแบบทดสอบ.......',
            'count' => 50,
            'type' => 'C'
        ]);

        $quiz_math->questions()->createMany([
            ['name' => 'ข้อใด...'],
            ['name' => 'ข้อใด...2'],
            ['name' => 'ข้อใด...3'],
        ]);
        for ($i = 1; $i <= 3; $i++) {
            Option::create([
                'name' => 'ช้อย 1',
                'score' => 0,
                'question_id' => $i
            ]);
            Option::create([
                'name' => 'ช้อย 2',
                'score' => 0,
                'question_id' => $i
            ]);

            Option::create([
                'name' => 'ช้อย 1',
                'score' => 1,
                'question_id' => $i
            ]);
        }

        \App\Status::create([
            'name' => 'ใช้งาน'
        ]);
        \App\Status::create([
            'name' => 'ไม่ใช้งาน'
        ]);
    }
}
