<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call(LeaveTypeSeeder::class);
      $this->call(PaymentMethodSeeder::class);
      $this->call(SelectionOptionSeeder::class);
      $this->call(StudentTypeSeeder::class);

      $this->call(AttributeSeeder::class);
      $this->call(AttributeValueSeeder::class);
      $this->call(CategorySeeder::class);
      $this->call(SettingSeeder::class);
      $this->call(ProgramSeeder::class);
      $this->call(TextBookSeeder::class);
      $this->call(ServiceSeeder::class);
      
      // $this->call(UsersTableSeeder::class);
      // $this->call(PaymentMethodSeeder::class);
      // $this->call(SelectionOptionSeeder::class);
      // $this->call(ClassSeeder::class);
      // $this->call(ProductSeeder::class);
      // $this->call(UserSeeder::class);
      // $this->call(StudentTypeSeeder::class);
      // $this->call(CountrySeeder::class);
    }
}
