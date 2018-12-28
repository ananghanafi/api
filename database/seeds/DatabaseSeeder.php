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
        $this->call(UsersTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(RoleUserTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
        $this->call(PermissionGroupTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        
        // Master Wilayah Administratif
        $this->call(ProvincesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(SubDistrictsTableSeeder::class);

        $this->call(FundingSourceTableSeeder::class);
        
        $this->call(MOrgTypesTableSeeder::class);
        $this->call(OrganizationsTableSeeder::class);
        $this->call(PhuTableSeeder::class);
        $this->call(PhuAdmAreasTableSeeder::class);

        $this->call(ConstructionTypesTableSeeder::class);
        $this->call(MImplStatusesTableSeeder::class);

        # Well Plans
        $this->call(ConstructionPlansTableSeeder::class);
        $this->call(ConstructionPlans2TableSeeder::class);
        $this->call(ConstructionPlans3TableSeeder::class);
        $this->call(ConstructionPlans4TableSeeder::class);
        $this->call(ConstructionPlans5TableSeeder::class);
        $this->call(ConstructionPlans6TableSeeder::class);

        $this->call(PersonTableSeeder::class);
        $this->call(ZoneTypesTableSeeder::class);
        $this->call(StatusesTableSeeder::class);

        # Canal Block Plans
        $this->call(MCanalBlockingTypesTableSeeder::class);
        $this->call(MCanalTypesTableSeeder::class);

        $this->call(CanalBlockPlansJambiTableSeeder::class);
        $this->call(CanalBlockPlansKalbarTableSeeder::class);
        $this->call(CanalBlockPlansKaltengTableSeeder::class);
        $this->call(CanalBlockPlansRiauTableSeeder::class);
        $this->call(CanalBlockPlansSumselTableSeeder::class);

        # Revegetation Plans
        $this->call(MBurnStatusTableSeeder::class);
        $this->call(MRevegetationTypeTableSeeder::class);
        $this->call(MVegetationDensityTableSeeder::class);
        
        $this->call(RevegetationPlansJambiTableSeeder::class);
        $this->call(RevegetationPlansKalbarTableSeeder::class);
        $this->call(RevegetationPlansKaltengTableSeeder::class);
        $this->call(RevegetationPlansPapuaTableSeeder::class);
        $this->call(RevegetationPlansSumselTableSeeder::class);

        # Canal Hoarding Plans
        $this->call(CanalHoardingPlansTableSeeder::class);

        # Retention Basin Plans
        $this->call(RetentionBasinPlansTableSeeder::class);

        # Revitalization Plans
        $this->call(RevitalizationPlansTableSeeder::class);

        # Donor
        $this->call(MCurrencyTableSeeder::class);
        $this->call(MBrgMandatTableSeeder::class);
        $this->call(MDonorActivityStatusesTableSeeder::class);
    }
}
