<?php

use Carbon\Carbon;

$factory->define(App\ContactData::class, function(Faker\Generator $faker){


    return [
        'mobile_no' => $faker->phoneNumber,
        'tel_no' => $faker->e164PhoneNumber,
        'messenger_acct' => $faker->safeEmail
    ];

});

$factory->define(App\ContactAddress::class, function(Faker\Generator $faker){

    $contactData = factory(App\ContactData::class)->create();

    return [
        'contact_data_id' => $contactData->id,
        'country_id' => 173,
        'province_id' => 5025,
        'city_id' => rand(48013, 48065),
        'brgy_id' => null,
        'street_lot_blk' => $faker->streetAddress ,
        'longitude' => $faker->longitude($min = -180, $max = 180),
        'latitude' => $faker->latitude($min = -90, $max = 90),
    ];

});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

     $personal_data = factory(App\PersonalData::class)->create();

     $contactData = factory(App\ContactAddress::class)->create();

    return [
        'contact_data_id' => $contactData->id,
        'personal_data_id' => $personal_data->id,
        'member_id' => $faker->swiftBicNumber ,
        'account_no' => $faker->swiftBicNumber,
        'email' => $faker->unique()->safeEmail,
        'status' => rand(0,1),
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\PersonalData::class, function (Faker\Generator $faker) {


    $name = explode(' ', $faker->name);

    return [
        'gender_id' => rand(1, 3) ,
        'firstname' => $name[0],
        'lastname' => $name[1],
        'middlename' => 'MiddleName',
        'mothers_maiden_name' => $name[1],
        'nationality' => 'Filipino',
        'birthdate' => $faker->dateTimeThisCentury->format('Y-m-d'),
        'birthplace' => $faker->city,
        'marital_status' => rand(1, 5)
    ];
});



$factory->define(App\CardNo::class, function (Faker\Generator $faker) {


    $user = factory(App\User::class)->create();

    return [

        'user_id' => $user->id,
        'card_no' => $faker->creditCardNumber,
        
    ];
});



$factory->define(App\Branch::class, function(Faker\Generator $faker){

    $merchant = factory(App\Merchant::class)->create();

    return [

            'branch_name' => $faker->company,
            'merchant_id' => $merchant->id,
            'created_by' => rand(1, 30),
            'phone_no' => $faker->tollFreePhoneNumber,
            'mobile_no' => $faker->e164PhoneNumber,
            'email' => $faker->unique()->safeEmail,
            'status' => rand(0, 1)
    ];
});

$factory->define(App\MainCategory::class, function(Faker\Generator $faker){

    $user = factory(App\User::class)->create();

    return [

        'user_id' => $user->id,
        'name' => $faker->word . ' ' . $faker->word,
        'desc' => $faker->sentence($nbWords = 6, $variableNbWords = true)

    ];
});


$factory->define(App\MerchantCategory::class, function(Faker\Generator $faker){

       
        $mainCat = factory(App\MainCategory::class)->create();


    return [

        'user_id' => $mainCat->user_id,
        'maincategory_id' => $mainCat->id,
        'name' => $faker->word . ' ' . $faker->word,
        'desc' => $faker->sentence($nbWords = 6, $variableNbWords = true)
    ];

});


$factory->define(App\MerchantSubcategory::class, function(Faker\Generator $faker){

     $merchantcategory = factory(App\MerchantCategory::class)->create();

    return [
         'user_id' => rand(1, 30),
         'merchant_category_id' => $merchantcategory->id,
         'name' => $faker->sentence($nbWords = 3, $variableNbWords = true),
         'desc' => $faker->sentence($nbWords = 6, $variableNbWords = true)
    ];
});


$factory->define(App\Product::class, function(Faker\Generator $faker){

     $merchantSub = factory(App\MerchantSubcategory::class)->create();
     $merchantCat = App\MerchantCategory::find($merchantSub->merchant_category_id);
    $productableType = ['App\User', 'App\Merchant', 'App\Branch'];
    
     return [
         'user_id' => $merchantSub->user_id,
         'productable_id' => rand(1, 30),
         'productable_type' => $productableType[rand(0, 2)],
         'brand_id' => rand(1, 30),
         'unit_id' => rand(1, 4),
         'maincategory_id' => $merchantCat->maincategory_id,
         'merchant_category_id' => $merchantSub->merchant_category_id,
         'merchant_subcategory_id' => $merchantSub->id,
         'name' => $faker->word . ' ' . $faker->word . ' ' . $faker->word,
         'SKU' => $faker->isbn13,
         'short_desc' => $faker->text($maxNbChars = 20),
         'long_desc' => $faker->text($maxNbChars = 100)


     ];
});

$factory->define(App\Photo::class, function(Faker\Generator $faker){

    $product = factory(App\Product::class)->create();
    return [

        'path' => 'images/uploads/' . rand(1,67) . '.jpg',
        'imageable_id' => $product->id,
        'imageable_type' => 'App\Product',
        'is_primary' => 1
    ];
});



$factory->define(App\Merchant::class, function(Faker\Generator $faker){

    $user = factory(App\User::class)->create();

    return [
        'created_by' => $user->id,
        'merchant_id' => rand(20, 200) . '-' . rand(20, 10000),
        'name' => $faker->company,
        'email' => $faker->email,
        'website' => 'http://www.'.$faker->domainName,
        'status' => rand(0, 1),
        'contact_person' => $faker->name,
        'registered_by_id' => rand(1,4),
        'ownership_type_id' => rand(1, 5),
        'trade_id' => rand(1, 28),
        'for_franchise' => rand(0, 1),
        'phone_no' => $faker->tollFreePhoneNumber,
        'mobile_no' => $faker->e164PhoneNumber
    ];
});


$factory->define(App\Discount::class, function(Faker\Generator $faker){

     $discountableType = ['App\Merchant', 'App\Branch'];

    return [
        'created_by' => rand(1, 30),
        'discountable_id' => rand(1, 30),
        'discountable_type' => $discountableType[rand(0, 1)],
        'name' => $faker->name,
        'percent' => rand(1, 99),
        'desc' => $faker->text($maxNbChars = 20),
        'start' => Carbon::now(),
        'end' => Carbon::tomorrow()
    ];

});