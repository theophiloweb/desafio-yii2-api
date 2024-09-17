<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\models\Cliente;
use app\models\Book;
use Faker\Factory;

class SeedController extends Controller
{
    public function actionIndex()
    {
        $this->seedClientes();
        $this->seedBooks();
    }

    protected function seedClientes()
    {
        $faker = Factory::create('pt_BR');

        for ($i = 0; $i < 10; $i++) {
            $cliente = new Cliente();
            $cliente->nome = $faker->name;
            $cliente->cpf = $faker->numerify('###########');
            $cliente->cep = $faker->numerify('########');
            $cliente->logradouro = $faker->streetName;
            $cliente->numero = $faker->buildingNumber;
            $cliente->cidade = $faker->city;
            $cliente->estado = $faker->stateAbbr;
            $cliente->complemento = $faker->optional()->secondaryAddress;
            $cliente->sexo = $faker->randomElement(['M', 'F']);

            if (!$cliente->save()) {
                echo "Erro ao salvar cliente: " . print_r($cliente->errors, true) . "\n";
            } else {
                echo "Cliente '{$cliente->nome}' salvo com sucesso.\n";
            }
        }
    }

    protected function seedBooks()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $book = new Book();
            $book->isbn = $faker->isbn13;
            $book->title = $faker->sentence(3);
            $book->author = $faker->name;
            $book->price = $faker->randomFloat(2, 10, 100);
            $book->stock = $faker->numberBetween(1, 100);

            if (!$book->save()) {
                echo "Erro ao salvar livro: " . print_r($book->errors, true) . "\n";
            } else {
                echo "Livro '{$book->title}' salvo com sucesso.\n";
            }
        }
    }
}