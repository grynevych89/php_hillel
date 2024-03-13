<?php

class CalcController
{
    use Validator;

    public function showForm(): void
    {
        render('form.php');
    }

    public function showResult(): void
    {
        render('form.php');
        $data = array_map('strToInt',$_POST);
        $schema = [
            'firstNumber' => 'int|required',
            'secondNumber' => 'int|required',
        ];
        $this->validate($data, $schema);

        extract($data);
        $result = $firstNumber + $secondNumber;

        render('calculateResult.php', ["result" => $result]);
    }
}