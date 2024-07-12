<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MenuItem;
use App\Models\Topping;
use App\Models\MenuItemPrice;
class MenuItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'MARGHERITA ', 'menu_category_id' => 1, 'description' => 'Sesame Seeds, Mozzarella Cheese, Pizza Sauce'],
            ['name' => 'Double Cheese ', 'menu_category_id' => 2, 'description' => 'Sesame Seeds, Mozzarella Cheese, Red Paprika, Cheddar Cheese'],
            ['name' => 'Spicy Onion Treat', 'menu_category_id' => 2, 'description' => 'Sesame Seeds, Mozzarella Cheese, Onion, Red Paprika, Jalapeno, Pizza Sauce'],
            ['name' => 'Cheese Corn', 'menu_category_id' => 2, 'description' => 'Sesame Seeds, Sweet Corn, Pizza Sauce, Jalapeno, Mozzarella Cheese'],
            ['name' => 'Cheesy Mushroom Paprika', 'menu_category_id' => 2, 'description' => 'Sesame Seeds, Mozzarella Cheese, Mushroom, Red Paprika ,Jalapeno, Pizza Sauce'],
            ['name' => 'CheeseTomato', 'menu_category_id' => 2, 'description' => 'Sesame Seeds, Mozzarella Cheese, Tomato, Pizza Sauce'],
            ['name' => 'Cheese Capsicum', 'menu_category_id' => 2, 'description' => 'Sesame Seeds, Mozzarella Cheese,Capsicum, Pizza Sauce'],
            ['name' => 'Paneer / Chicken Veg Topper', 'menu_category_id' => 3, 'description' => 'Sesame Seeds, Marinated Paneer / Chicken, Pizza Sauce,  Mozzarella Cheese, Choose One Any Veg Topping'],
            ['name' => 'Mushroom Bacon Cheese', 'menu_category_id' => 3, 'description' => 'Sesame Seeds, Pizza Sauce, Mozzarella Cheese, Mushroom, Bacon (Pork), Jalapeno'],
            ['name' => 'Hot Pepperoni', 'menu_category_id' => 3, 'description' => 'Sesame Seeds, Chicken Pepperoni, Red Paprika, Mozzarella Cheese, Pizza Sauce, Parmesan Cheese'],
            ['name' => 'Veg Delight', 'menu_category_id' => 3, 'description' => 'Sesame Seeds, Mushroom, Onion, Sweet Corn, Red Paprika, Pizza Sauce, Mozzarella Cheese'],
            ['name' => 'Veg Hawaiian', 'menu_category_id' => 3, 'description' => 'Sesame Seeds, Pineapple, Sweet Corn, Mozzarella Cheese, Pizza Sauce,Jalapeno'],
            ['name' => 'Veg Flight', 'menu_category_id' => 3, 'description' => 'Sesame Seeds, Onion, Capsicum, Tomato, Pizza Sauce, Mozzarella Cheese'],
            ['name' => 'Veggie Fans', 'menu_category_id' => 3, 'description' => 'Sesame Seeds, Onion, Capsicum, Mushroom, Pizza Sauce, Mozzarella Cheese'],
            ['name' => 'Four Cheese', 'menu_category_id' => 3, 'description' => 'Sesame Seeds, Pizza Sauce, Mozzarella Cheese, Cheddar Cheese, Feta Cheese, Parmesan Cheese'],
            ['name' => 'Cilantro Paneer', 'menu_category_id' => 3, 'description' => 'Sesame Seeds, Pizza Sauce, Mozzarella Cheese, Jalapeno, Cajun Spice Paneer, Fresh Coriander'],
            ['name' => 'Pepperoni Mushroom', 'menu_category_id' => 3, 'description' => 'Sesame Seeds, Chicken Pepperoni, Mushroom, Pizza Sauce, Mozzarella Cheese'],
            ['name' => 'Chicken & Bacon', 'menu_category_id' => 3, 'description' => 'Sesame Seeds, Marinated Chicken, Pizza Sauce, Mozzarella Cheese, Onion, Capsicum, Bacon (Pork)'],
            ['name' => 'Ghost Of Chilli', 'menu_category_id' => 3, 'description' => 'Sesame Seeds, Pizza Sauce, Mozzarella Cheese,Onion, Peri-Peri Chicken, Jalapeno,  Red Paprika, Black Olive'],
            ['name' => 'Hawaiian', 'menu_category_id' => 3, 'description' => 'Sesame Seeds, Pizza Sauce, Mozzarella Cheese, Ham (Pork) , Pineapple'],
            ['name' => 'Butter Paneer', 'menu_category_id' => 4, 'description' => 'Sesame Seeds, Pizza Sauce, Butter Sauce,  Mozzarella Cheese,Onion, Capsicum, Fresh Coriander, Butter Paneer'],
            ['name' => 'Shashlik Paneer', 'menu_category_id' => 4, 'description' => 'Sesame Seeds, Americano Sauce, Pizza Sauce, Mozzarella Cheese, Onion, Marinated Paneer, Fresh Coriander'],
            ['name' => 'Jamaican Jerk', 'menu_category_id' => 4, 'description' => 'Sesame Seeds, Pizza Sauce, Mozzarella Cheese, Onion, Capsicum, Marinated Paneer, Fresh Coriander, Tomato'],
            ['name' => 'BBQ Paneer', 'menu_category_id' => 4, 'description' => 'Sesame Seeds, Pizza Sauce, BBQ Sauce, Mozzarella Cheese, Onion, Capsicum, BBQ Paneer, Jalapeno'],
            ['name' => 'Tandoori Chicken', 'menu_category_id' => 4, 'description' => 'Sesame Seeds, Pizza Sauce, Tandoori Sauce, Mozzarella Cheese, Tomato, Onion, Capsicum, Tandoori Chicken, Fresh Coriander'],
            ['name' => 'Creamy Chicken', 'menu_category_id' => 4, 'description' => 'Sesame Seeds, Pizza Sauce,Mozzarella Cheese, Butter Sauce, Onion, Capsicum, Creamy Chicken, Fresh Coriander'],
            ['name' => 'Chicken Tikka', 'menu_category_id' => 4, 'description' => 'Sesame Seeds, Pizza Sauce,Mozzarella Cheese, Onion, Capsicum, Chicken Tikka, Fresh Coriander'],
            ['name' => 'Lamb Seekh', 'menu_category_id' => 4, 'description' => 'Sesame Seeds, Pizza Sauce,Mozzarella Cheese, Onion, Capsicum, Tomato, Lamb Seekh, Fresh Coriander'],
            ['name' => 'Chicken Seekh', 'menu_category_id' => 4, 'description' => 'Sesame Seeds, Pizza Sauce,Mozzarella Cheese, Onion, Capsicum, Tomato, Chicken Seekh, Fresh Coriander'],
            ['name' => 'BBQ Chicken', 'menu_category_id' => 4, 'description' => 'Sesame Seeds, Pizza Sauce, BBQ Sauce, Mozzarella Cheese, Onion, Capsicum, BBQ Chicken'],
            ['name' => 'Chicken Supreme', 'menu_category_id' => 4, 'description' => 'Sesame Seeds, Pizza Sauce,Mozzarella Cheese, Onion, Capsicum, Mushroom, Cajun Chicken, Pineapple, Jalapeno'],
            ['name' => 'Spicy Ginger & Cilantro', 'menu_category_id' => 5, 'description' => 'Sesame Seeds, Pizza Sauce,Mozzarella Cheese, Onion, Tomato, Jalapeno, Black Olive, Ginger, Fresh Coriander'],
            ['name' => 'Spicy Perogy', 'menu_category_id' => 5, 'description' => 'Sesame Seeds, Sour Cream, Cheddar Cheese, Mozzarella Cheese, Onion, Black Olive, Jalapeno, Roasted Potato'],
            ['name' => 'House Special', 'menu_category_id' => 5, 'description' => 'Sesame Seeds, Pizza Sauce, Spinach,  Ginger, Mushroom, Onion, Capsicum, Red Paprika, Tomato, Black Olive, Jalapeno'],
            ['name' => 'Fully Loaded', 'menu_category_id' => 5, 'description' => 'Sesame Seeds, Pizza Sauce,Mozzarella Cheese, Chicken Ham, Chicken Pepperoni, Lamb Seekh, Chicken Seekh, Black olive, Tomato, Onion, Jalapeno'],
            ['name' => 'Classic Roman', 'menu_category_id' => 5, 'description' => 'Sesame Seeds, Pizza Sauce,Mozzarella Cheese, Chicken Pepperoni, Mushroom, Onion, Bacon (Pork), Jalapeno'],
            ['name' => 'Greek', 'menu_category_id' => 5, 'description' => 'Sesame Seeds, Pizza Sauce,Mozzarella Cheese, Feta Cheese, Spinach, Onion, Black Olive, Tomato, Capsicum'],
            ['name' => 'Canadian Classic', 'menu_category_id' => 5, 'description' => 'Sesame Seeds, Pizza Sauce,Mozzarella Cheese, Cajun Chicken, Chicken Ham, Chicken Pepperoni, Mushroom, Red Paprika, Cheddar Cheese'],
            ['name' => 'Tuscan', 'menu_category_id' => 5, 'description' => 'Sesame Seeds, Pizza Sauce,Mozzarella Cheese, Spinach, Garlic, Hot Chicken, Chicken Ham, Onion, Cheddar Cheese, Feta Cheese'],
            ['name' => 'All Meat', 'menu_category_id' => 5, 'description' => 'Sesame Seeds, Pizza Sauce,Mozzarella Cheese, Chicken Pepperoni, Chicken Ham, Lamb Seekh, Chicken Seekh, Ham (Pork), Bacon (Pork)'],
            ['name' => 'All Dressed', 'menu_category_id' => 5, 'description' => 'Sesame Seeds, Pizza Sauce,Mozzarella Cheese, Chicken Pepperoni, Chicken Ham, Chicken Seekh, Ham (Pork), Bacon (Pork), Onion, Capsicum, Black Olive'],
        ];

        $prices = [
            [99, 249, 339, 425],
            [135, 299, 359, 455],
            [199, 449, 549, 685],
            [235, 449, 599, 739],
            [275, 599, 699, 849],
        ];
        
        foreach ($data as $value) {
            $menuItem = MenuItem::firstOrCreate($value);

            foreach ($prices as $key => $basePrices) {
                if($menuItem['menu_category_id'] == $key + 1) {
                    foreach ($basePrices as $baseKey => $price) {
                        MenuItemPrice::firstOrCreate(['base_id' => $baseKey + 1, 'menu_item_id' => $menuItem['id'], 'price' => $price]);
                    }
                }
            }
            
            // $toppings = explode(',', $menuItem->description);
            // $toppingIds = [];
            // foreach ($toppings as $value) {
            //     $toppingIds[] = Topping::firstOrCreate(['name' => $value, 'topping_category_id' => 1])->id;
            // }

            // $menuItem->toppings()->sync($toppingIds);
        }
    }
}
