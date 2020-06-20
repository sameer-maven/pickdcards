<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
			'name'                         => "Pickd Cards",
			'email'                        => "admin@pickdcards.com",
			'email_verified_at'            => NULL,
			'password'                     => "$2y$10$1yMZYjhRpLFPCyYEAVhS.OPn5a9v1CZSTwsNALVUyFdntDvpvDq7e",
			'is_admin'                     => 1,
			'remember_token'               => NULL,
			'status'                       => "1",
			'avatar'                       => "default.jpg",
			'is_business_profile_complete' => "1",
			'created_at'                   => Carbon::now()->format('Y-m-d H:i:s'),
			'updated_at'                   => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('businessinfos')->insert([
			'business_name'               => "Admin",
			'user_id'                     => 1,
			'address'                     => "admin",
			'city'                        => "admin",
			'state'                       => "admin",
			'pincode'                     => 123445,
			'about_business'              => "admin",
			'phone_number'                => "9876543210",
			'business_email'              => "admin@pickdcards.com",
			'url'                         => "https://pickdcards.com",
			'industry_id'                 => 2,
			'type_id'                     => 3,
			'status'                      => 0,
			'is_verify'                   => 0,
			'tax_id_number'               => "12-3456789",
			'connected_stripe_account_id' => NULL,
			'customer_charge'             => 3.75,
			'customer_cent_charge'        => 0.75,
			'business_charge'             => 0.00,
			'business_cent_charge'        => 0.00,
			'created_at'                  => Carbon::now()->format('Y-m-d H:i:s'),
			'updated_at'                  => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('generalsettings')->insert([
			'customer_charge' => "3",
			'business_charge' => "3",
			'facebook'        => "https://www.facebook.com/pickdcards",
			'twitter'         => "https://twitter.com/pickdcards",
			'linkedin'        => "https://www.linkedin.com/company/pickd-cards",
			'instagram'       => "https://www.instagram.com/pickdcards",
			'youtube'         => "https://www.youtube.com/channel/UCpE5RVIwHNKLDl4zIbGYCYg",
			'pinterest'       => "https://www.pinterest.com/pickdcards",
			'created_at'      => Carbon::now()->format('Y-m-d H:i:s'),
			'updated_at'      => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        
        DB::table('industries')->insert([
        	['industry' => "Experiences and Entertainment",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
        	['industry' => "Food and Drink",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
        	['industry' => "Health and Beauty",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
        	['industry' => "Hospitality",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
        	['industry' => "Retail",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
        	['industry' => "Services",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
        	['industry' => "Other",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ]);

        DB::table('types')->insert([
        	['type' => "Sole Proprietorship",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
        	['type' => "General Partnership",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
        	['type' => "LLC",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
        	['type' => "S Corporation",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
        	['type' => "C Corporation",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ]);

        DB::table('states')->insert([
        	['state_name' => "Alabama",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Alaska",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Arizona",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Arkansas",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "California",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Colorado",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Connecticut",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Delaware",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "District of Columbia",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Florida",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Georgia",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Hawaii",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Idaho",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Illinois",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Indiana",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Iowa",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Kansas",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Kentucky",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Louisiana",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Maine",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Maryland",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Massachusetts",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Michigan",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Minnesota",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Mississippi",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Missouri",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Montana",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Nebraska",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Nevada",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "New Hampshire",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "New Jersey",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "New Mexico",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "New York",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "North Carolina",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "North Dakota",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Ohio",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Oklahoma",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Oregon",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Pennsylvania",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Rhode Island",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "South Carolina",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "South Dakota",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Tennessee",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Texas",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Utah",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Vermont",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Virginia",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Washington",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "West Virginia",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Wisconsin",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
			['state_name' => "Wyoming",'status' => "1",'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ]);

    }
}
