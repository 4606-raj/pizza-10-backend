<?php

namespace Database\Seeders;

use App\Models\Topping;
use App\Models\ToppingCategory;
use Illuminate\Database\Seeder;

class ToppingsSeeder extends Seeder
{
    public function run()
    {
        $vegCategory = ToppingCategory::firstOrCreate([
            'name' => 'Veg',
        ]);

        $nonVegCategory = ToppingCategory::firstOrCreate([
            'name' => 'Non-Veg',
        ]);

        $cheeseCategory = ToppingCategory::firstOrCreate([
            'name' => 'Cheese',
        ]);

        $freeCategory = ToppingCategory::firstOrCreate([
            'name' => 'Free',
        ]);

        $vegToppings = [
            'Red Onion',
            'Sweet Corn',
            'Mushroom',
            'Roasted Potato',
            'Spicy Paneer',
            'Capsicum',
            'Black Olive',
            'Paneer Tikka',
            'Tomato',
            'Jalapeno Pepper',
            'Butter Paneer',
            'Spinach',
            'Red Paprika',
            'Pineapple',
        ];

        $nonVegToppings = [
            'Chicken Pepperoni',
            'Hot Chicken',
            'BBQ Chicken',
            'Bacon (Pork)',
            'Ranch Chicken',
            'Chicken Tikka',
            'Chicken',
            'Spicy Chicken',
            'Chicken Seekh',
            'Ham (Pork)',
            'LambSeekh',
            'Butter Chicken',
            'Tandoori Chicken',
        ];

        $cheeseToppings = [
            'Cheddar Cheese',
            'Parmesan Cheese',
            'Mozzarella Cheese',
            'Feta Cheese',
        ];

        $freeToppings = [
            'Fresh Coriander',
            'Chilli Flakes',
            'Garlic',
            'Ginger',
        ];

        foreach ($vegToppings as $toppingName) {
            Topping::firstOrCreate([
                'name' => $toppingName,
                'topping_category_id' => $vegCategory->id,
            ]);
        }

        foreach ($nonVegToppings as $toppingName) {
            Topping::firstOrCreate([
                'name' => $toppingName,
                'topping_category_id' => $nonVegCategory->id,
            ]);
        }

        foreach ($cheeseToppings as $toppingName) {
            Topping::firstOrCreate([
                'name' => $toppingName,
                'topping_category_id' => $cheeseCategory->id,
            ]);
        }

        foreach ($freeToppings as $toppingName) {
            Topping::firstOrCreate([
                'name' => $toppingName,
                'topping_category_id' => $freeCategory->id,
            ]);
        }
    }
}
