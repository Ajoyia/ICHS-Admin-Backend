<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call(AddAccredationActivities::class);
        $this->call(AddAccredationLearningFormats::class);
        $this->call(AddAccredationPromotionActivity::class);
        $this->call(AddAccredationSocialEvents::class);
        $this->call(AddAccredationInteractiveTechnologies::class);
        $this->call(AddAccredationAudioVisuals::class);
        $this->call(AddPoliciesSeeder::class);
        $this->call(AssignPoliciesToExisitingUsers::class);
        $this->call(AwardTypesSeeder::class);
        $this->call(AddAccredationPresentationFormats::class);
        $this->call(AddAccredationProducts::class);
        $this->call(GrantPurposeSeeder::class);
        $this->call(AddAccredationTargetAudience::class);
        $this->call(AddCountries::class);
        $this->call(AddNationalities::class);
        $this->call(AddCMESocialEvents::class);
        $this->call(AddCMELearningFormate::class);
        $this->call(AddCMEActivities::class);
        $this->call(AddCMESpeakerRoles::class);
        $this->call(AddMembershipTypes::class);
        $this->call(AddCMEPromotionActivity::class);
        $this->call(AddSalutations::class);
        $this->call(AddCMETargetAudience::class);
        $this->call(AddSpecialties::class);
        $this->call(AddMedicalHealthProfessionals::class);
        $this->call(AddCountriesType::class);
        $this->call(AddCountryTypeListings::class);
        $this->call(AddProducts::class);
        $this->call(AddCMEProducts::class);
        $this->call(AddProductCountryTypeListings::class);
        $this->call(MenuTypes::class);
        $this->call(HealthInnovationInitiativeTypeSeeder::class);
        $this->call(AddPackageSeeder::class);

    }
}
