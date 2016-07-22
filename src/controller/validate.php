<?php
use Symfony\Component\Validator\Constraints as Assert;

$book = [
    'title' => 'My book',
    'author' => [
        'first_name' => 'Fabien',
        'last_name' => 'Potencier'
    ]
];
$constraints = new Assert\Collection(array(
    'title' => new Assert\Length(array('min' => 10)),
    'author' => new Assert\Collection(array(
        'first_name' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 10))),
        'last_name' => new Assert\Length(array('min' => 10))
    ))
));

$errors = $app['validator']->validate($book, $constraints);
if(count($errors) > 0){
   foreach ($errors as $error){
       echo $error->getPropertyPath() . ' ' . $error->getMessage() ."\n";
   } 
}else{
    echo 'The book is valid';
}