<?php

namespace Database\Seeders;
use App\Models\Restaurant;
use App\Models\User;
use App\Models\Valoration;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ValorationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $users = User::all();
        $restaurants = Restaurant::all();
        $comentarios = [
            "¡Comida excelente y servicio impecable!",
            "El ambiente era perfecto. ¡Muy recomendado!",
            "Platos deliciosos. ¡Volveré sin duda!",
            "¡Experiencia increíble. Me encantó cada bocado!",
            "Calidad de primera. ¡Un restaurante que hay que visitar!",
            "Sabores sobresalientes. ¡No se puede pedir más!",
            "Selección de menú impresionante. ¡Algo para todos!",
            "Personal amable y ambiente acogedor.",
            "Lugar perfecto para una ocasión especial.",
            "Cocina auténtica. ¡Realmente una joya escondida!",
            "Servicio excepcional. Vale cada centavo.",
            "Platos que hacen la boca agua. ¡No puedo esperar para volver!",
            "Presentación impecable. ¡Digno de Instagram!",
            "Experiencia gastronómica inolvidable. ¡Muy impresionante!",
            "Atención increíble a los detalles. El paraíso de los amantes de la comida.",
            "Sabores exquisitos que bailan en el paladar.",
            "Una obra maestra culinaria. ¡Bravo!",
            "Ambiente encantador y servicio impecable.",
            "Un deleite gastronómico. ¡Pura perfección!",
            "El mejor restaurante de la ciudad. ¡Sin competencia!"
        ];

        $comentariosNegativos = [
            "Comida decepcionante. No cumplió con las expectativas.",
            "Servicio lento y descuidado. No volveré.",
            "Platos sin sabor. Una experiencia muy pobre.",
            "Ambiente ruidoso y poco agradable.",
            "Precios excesivos para la calidad de la comida.",
            "Personal poco amable y poco profesional.",
            "Lugar sucio y descuidado. No lo recomendaría.",
            "Selección de menú limitada y poco inspiradora.",
            "Presentación de los platos descuidada. No se veía apetitoso.",
            "Una experiencia decepcionante en general.",
            "Comida fría y mal cocinada. No lo recomendaría.",
            "Servicio desorganizado y poco atento.",
            "Platos mal presentados y sin creatividad.",
            "Ambiente incómodo y poco acogedor.",
            "Precios exorbitantes para la calidad ofrecida.",
            "Personal poco capacitado y poco amigable.",
            "Lugar sucio y con mal olor. No volveré.",
            "Selección de menú aburrida y sin variedad.",
            "Platos mal elaborados y sin sabor.",
            "Una experiencia terrible en todos los aspectos."
        ];

        foreach ($restaurants as $restaurant) {
            $algo = rand(1, 10);
            $good = false;
            if ($algo > 8) {
                $good = true;
            }
            foreach ($users as $user) {
                $score = rand(1, 10);
                if ($good == true) {
                    $score = rand(8, 10);
                }
                if ($good == true || $score >= 5) {
                    $randomComment = $comentarios[array_rand($comentarios)];
                } else {
                    $randomComment = $comentariosNegativos[array_rand($comentariosNegativos)];
                }
                Valoration::create([
                    'user_id' => $user->id,
                    'restaurant_id' => $restaurant->id,
                    'comment' => $randomComment,
                    'score' => $score,
                ]);
            }
        }
    }
}