<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Product::factory(4)->create();

        \App\Models\User::create([
            'name' => 'Админ',
            'surname' => 'Админ',
            'email' => 'admin@mail.ru',
            'password' => Hash::make('99327810257'),
            'role' => 1
        ]);

        \App\Models\User::create([
            'name' => 'Менеджер',
            'surname' => 'Менеджер',
            'email' => 'manager@mail.ru',
            'password' => Hash::make('99327810257'),
            'role' => 2
        ]);

        \App\Models\Type::factory()->create([
            'id' => 1,
            'type' => 'Напитки',
        ]);
        \App\Models\Type::factory()->create([
            'id' => 2,
            'type' => 'Закуски',
        ]);
        \App\Models\Type::factory()->create([
            'id' => 3,
            'type' => 'Дессерты',
        ]);

        \App\Models\Menu::factory()->create([
            'name' => 'Холодные кофейные напитки',
            'price' => 200,
            'discription' => 'Кофе – всем известный напиток, имеющий огромное количество поклонников во всем мире. С каждым годом его популярность только набирает обороты, а вариации приготовления становятся все более разнообразными. Утро без кофе для истинного ценителя – серьезное испытание. Многие признаются, что пока не выпьют чашечку этого поистине живительного напитка, не могут собраться с силами, сосредоточиться и окончательно избавиться от сонливости и аморфного состояния.
            В летнее время года особенной популярностью пользуется охлажденный кофе. Ароматный кофе со льдом — прекрасное начало жаркого дня. Такой набор ингредиентов и взбодрит, и утолит жажду одновременно. Этот напиток еще называют фраппе или айс-кофе. Название «фраппе» произошло от французского frappé – «бить, колотить», а второе название содержит английское слово ice, которое переводится как «лед». Одна порция - 150мл',
            // 'img' => '../menu/kholodnye-kofeynye-napitki-2.jpg',
            'type' => 1,
        ]);
        \App\Models\Image::factory()->create([
            'id_menus' => 1,
            'img' => '../menu/ae856cfd6cfa2539a29e2e97845b42cc.jpeg'
        ]);
        \App\Models\Image::factory()->create([
            'id_menus' => 1,
            'img' => '../menu/cb7d61db81ba7edcd43f40e5a8f1e848.jpeg'
        ]);

        \App\Models\Menu::factory()->create([
            'name' => 'Черничный терамису',
            'price' => 300,
            'discription' => 'Классической версией кофейного тирамису давно никого не удивить. К тому же летняя пора дает нам возможность наслаждаться легкими ягодными десертами. Вот мы решили использовать это время с пользой и приготовить черничный тирамису. Освежающий вкус ягод как нельзя кстати подходит для жарких летних дней.
            Вместо крепкого кофе печенье пропитуется сладким черничным сиропом. Разложите тирамису с черникой по порционным пиалам для угощения друзей.
            В летнее время года особенной популярностью пользуется охлажденный кофе. Ароматный кофе со льдом — прекрасное начало жаркого дня. Такой набор ингредиентов и взбодрит, и утолит жажду одновременно. Этот напиток еще называют фраппе или айс-кофе. Название «фраппе» произошло от французского frappé – «бить, колотить», а второе название содержит английское слово ice, которое переводится как «лед». Одна порция - 150мл',
            // 'img' => '../menu/cher_tiramisu_1_gl_karinka.jpg',
            'type' => 1,
        ]);
        \App\Models\Image::factory()->create([
            'id_menus' => 2,
            'img' => '../menu/cher_tiramisu_1_gl_karinka.jpg'
        ]);
        \App\Models\Image::factory()->create([
            'id_menus' => 2,
            'img' => '../menu/tort-desert-iagody-chernika-krem-ukrashenie.jpg'
        ]);
        \App\Models\Image::factory()->create([
            'id_menus' => 2,
            'img' => '../menu/desert-krem-iagody-chernika.jpg'
        ]);

        \App\Models\Menu::factory()->create([
            'name' => 'Тонкие блины с сыром и зеленью',
            'price' => 600,
            'discription' => 'Это блюдо нравится многим не только из-за своей простоты, но и универсальности. Ведь подавать его можно на завтрак, обед и ужин, со сладкой или несладкой начинкой. Кроме того, приготовить тонкие лепешки можно из самых простых ингредиентов. Но среди остальных многим больше всего нравятся блины с сыром и зеленью.
            Сперва может показаться, что это обычные блины с начинкой, но это не так. Дело в том, что мы не заворачиваем сыр и зелень в тонкие блинчики, а вмешиваем эти ингредиенты прямо в тесто. В итоге мы делаем привычное блюдо более вкусным, ароматным и интересным. В одной порции 5шт.',
            // 'img' => '../menu/0cbfc6756285fe708a3fc6e937d02473.jpg',
            'type' => 2,
        ]);
        \App\Models\Image::factory()->create([
            'id_menus' => 3,
            'img' => '../menu/62357712-palacinke.jpg'
        ]);
        \App\Models\Image::factory()->create([
            'id_menus' => 3,
            'img' => '../menu/orig.jpg'
        ]);
        \App\Models\Image::factory()->create([
            'id_menus' => 3,
            'img' => '../menu/0cbfc6756285fe708a3fc6e937d02473.jpg'
        ]);

        \App\Models\Menu::factory()->create([
            'name' => 'Закусочные блинчики с красной рыбой',
            'price' => 470,
            'discription' => 'В этом году Пасха выпадает на 16 апреля, соответственно, Масленая неделя начнется 20 февраля, а закончится 26 числа. Потому уже сейчас стоит начинать подыскивать идеальные блинчики. Встретить Масленицу подобающе вам поможет кафе "ТЕСНОТА". Сегодня мы расскажем о наших бесподобных закусочных блинчиках с красной рыбой.
            Такое блюдо послужит отменным выбором не только в этот праздник. Аппетитные рулетики из блинов актуальны целый год. Потому такую закуску вы можете готовить как на каждый день, так и на любой праздник. Она будет всегда актуальна! В одной порции 5шт.',
            // 'img' => '../menu/thumb-840x440 (1).jpg',
            'type' => 2,
        ]);
        \App\Models\Image::factory()->create([
            'id_menus' => 4,
            'img' => '../menu/fish-images-1920x1080-12.jpg'
        ]);
        \App\Models\Image::factory()->create([
            'id_menus' => 4,
            'img' => '../menu/eda-bliny--oladi-1307525.jpg'
        ]);

        \App\Models\Menu::factory()->create([
            'name' => 'Пончики шоколадные',
            'price' => 80,
            'discription' => 'Пончики — один из самых вкусных и сытных десертов. И необязательно десертов, ведь начинять их можно чем угодно. Обычно они готовятся с молоком и маслом, иногда с яйцами. Но когда вы держите пост, можно приготовить пончики на воде без всех этих ингредиентов.',
            // 'img' => '../menu/2019Food___Cakes_and_Sweet_Two_sweet_donuts_with_chocolate_on_a_gray_background_138328_23.jpg',
            'type' => 3,
        ]);
        \App\Models\Image::factory()->create([
            'id_menus' => 5,
            'img' => '../menu/2019Food___Cakes_and_Sweet_Two_sweet_donuts_with_chocolate_on_a_gray_background_138328_23.jpg'
        ]);
        \App\Models\Image::factory()->create([
            'id_menus' => 5,
            'img' => '../menu/1670994278_57-podacha-blud-com-p-foto-shokoladnikh-ponchikov-58.jpg'
        ]);

        \App\Models\Menu::factory()->create([
            'name' => 'Молочное суфле с карамельной прослойкой',
            'price' => 230,
            'discription' => 'Трудно подобрать слова, чтобы описать истинный вкус этого лакомства. Нежное, словно крем, воздушное до невозможности молочное суфле с карамельной прослойкой покоряет сердца всех без исключения (не только сладкоежек!). Мы настоятельно рекомендуем попробовать это суфле в ближайшее время, а так же угостить своих близких.',
            'type' => 3,
        ]);
        \App\Models\Image::factory()->create([
            'id_menus' => 6,
            'img' => '../menu/N90-poza-Youtube.jpg'
        ]);
        \App\Models\Image::factory()->create([
            'id_menus' => 6,
            'img' => '../menu/5bd8ada185600a6bb71cc2e4.jpg'
        ]);
    }
}
