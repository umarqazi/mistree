<?php

use App\Service;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        /*////////////////////////Category ID HatchBack////////////////////////*/
        /*/////Maintenance Services Without Doorstep//////*/
        $maintenanceHatchBackServiceWithoutDoorstep = Service::create([
            'name'              => 'Maintenance Services',
            'loyalty_points'    => 0,
            'category_id'       => 1,
            'lead_charges'      => 0,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Child Services without Doorstep/////*/
        $oilChangeMaintenanceHatchBackService = Service::create([
            'name'              => 'Oil Change',
            'service_parent'    => $maintenanceHatchBackServiceWithoutDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $carAcMaintenanceHatchBackService = Service::create([
            'name'              => 'Car AC Service',
            'service_parent'    => $maintenanceHatchBackServiceWithoutDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $batteryReplacementMaintenanceHatchBackService = Service::create([
            'name'              => 'Battery Replacement Service',
            'service_parent'    => $maintenanceHatchBackServiceWithoutDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $tyreReplacementMaintenanceHatchBackService = Service::create([
            'name'              => 'Tyre Replacement Service',
            'service_parent'    => $maintenanceHatchBackServiceWithoutDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $brakeMaintenanceHatchBackService = Service::create([
            'name'              => 'Brake Services',
            'service_parent'    => $maintenanceHatchBackServiceWithoutDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $throttleBodyCleaningMaintenanceHatchBackService = Service::create([
            'name'              => 'Throttle Body Cleaning',
            'service_parent'    => $maintenanceHatchBackServiceWithoutDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $radiatorMaintenanceHatchBackService = Service::create([
            'name'              => 'Radiator Service',
            'service_parent'    => $maintenanceHatchBackServiceWithoutDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $beltReplacementMaintenanceHatchBackService = Service::create([
            'name'              => 'Belt & Hoses Replacement',
            'service_parent'    => $maintenanceHatchBackServiceWithoutDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $computerScanningMaintenanceHatchBackService = Service::create([
            'name'              => 'Computer Scanning',
            'service_parent'    => $maintenanceHatchBackServiceWithoutDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $tuningMaintenanceHatchBackService = Service::create([
            'name'              => 'Tuning',
            'service_parent'    => $maintenanceHatchBackServiceWithoutDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $alignmentAndWheelBalancingMaintenanceHatchBackService = Service::create([
            'name'              => 'Alignment and Wheel Balancing',
            'service_parent'    => $maintenanceHatchBackServiceWithoutDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $carWashAndServiceMaintenanceHatchBackService = Service::create([
            'name'              => 'Car Wash and Service',
            'service_parent'    => $maintenanceHatchBackServiceWithoutDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 30,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $carCleaningMaintenanceHatchBackService = Service::create([
            'name'              => 'Carbon Cleaning',
            'service_parent'    => $maintenanceHatchBackServiceWithoutDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $alignmentAndWheelBalancingMaintenanceHatchBackService = Service::create([
            'name'              => 'Catalytic, Mufflers & Exhaust Cleaning',
            'service_parent'    => $maintenanceHatchBackServiceWithoutDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $carWashAndServiceMaintenanceHatchBackService = Service::create([
            'name'              => 'Engine General Overhauling',
            'service_parent'    => $maintenanceHatchBackServiceWithoutDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Maintenance Services With Doorstep//////*/
        $maintenanceHatchBackServiceWithDoorstep = Service::create([
            'name'              => 'Maintenance Services',
            'loyalty_points'    => 0,
            'category_id'       => 1,
            'lead_charges'      => 0,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);
        
        /*/////Child Services with Doorstep/////*/
        $oilChangeMaintenanceHatchBackService = Service::create([
            'name'              => 'Oil Change',
            'service_parent'    => $maintenanceHatchBackServiceWithDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $carAcMaintenanceHatchBackService = Service::create([
            'name'              => 'Car AC Service',
            'service_parent'    => $maintenanceHatchBackServiceWithDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $batteryReplacementMaintenanceHatchBackService = Service::create([
            'name'              => 'Battery Replacement Service',
            'service_parent'    => $maintenanceHatchBackServiceWithDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $tyreReplacementMaintenanceHatchBackService = Service::create([
            'name'              => 'Tyre Replacement Service',
            'service_parent'    => $maintenanceHatchBackServiceWithDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $brakeMaintenanceHatchBackService = Service::create([
            'name'              => 'Brake Services',
            'service_parent'    => $maintenanceHatchBackServiceWithDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $throttleBodyCleaningMaintenanceHatchBackService = Service::create([
            'name'              => 'Throttle Body Cleaning',
            'service_parent'    => $maintenanceHatchBackServiceWithDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $radiatorMaintenanceHatchBackService = Service::create([
            'name'              => 'Radiator Service',
            'service_parent'    => $maintenanceHatchBackServiceWithDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $beltReplacementMaintenanceHatchBackService = Service::create([
            'name'              => 'Belt & Hoses Replacement',
            'service_parent'    => $maintenanceHatchBackServiceWithDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $computerScanningMaintenanceHatchBackService = Service::create([
            'name'              => 'Computer Scanning',
            'service_parent'    => $maintenanceHatchBackServiceWithDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $tuningMaintenanceHatchBackService = Service::create([
            'name'              => 'Tuning',
            'service_parent'    => $maintenanceHatchBackServiceWithDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $alignmentAndWheelBalancingMaintenanceHatchBackService = Service::create([
            'name'              => 'Alignment and Wheel Balancing',
            'service_parent'    => $maintenanceHatchBackServiceWithDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $carWashAndServiceMaintenanceHatchBackService = Service::create([
            'name'              => 'Car Wash and Service',
            'service_parent'    => $maintenanceHatchBackServiceWithDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 30,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $carCleaningMaintenanceHatchBackService = Service::create([
            'name'              => 'Carbon Cleaning',
            'service_parent'    => $maintenanceHatchBackServiceWithDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $alignmentAndWheelBalancingMaintenanceHatchBackService = Service::create([
            'name'              => 'Catalytic, Mufflers & Exhaust Cleaning',
            'service_parent'    => $maintenanceHatchBackServiceWithDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $carWashAndServiceMaintenanceHatchBackService = Service::create([
            'name'              => 'Engine General Overhauling',
            'service_parent'    => $maintenanceHatchBackServiceWithDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Repair Services without Doorstep//////*/

        $repairHatchBackServiceWithoutDoorstep = Service::create([
            'name'              => 'Repair Services',
            'loyalty_points'    => 0,
            'category_id'       => 1,
            'lead_charges'      => 0,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        /*Child Services without Doorstep*/
        $bodyRepairHatchBackService = Service::create([
            'name'              => 'Body',
            'service_parent'    => $repairHatchBackServiceWithoutDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 1,
            'lead_charges'      => 0,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $transmissionRepairHatchBackService = Service::create([
            'name'              => 'Automatic Transmission Change',
            'service_parent'    => $repairHatchBackServiceWithoutDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 1,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $engineRepairHatchBackService = Service::create([
            'name'              => 'Engine',
            'service_parent'    => $repairHatchBackServiceWithoutDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 1,
            'lead_charges'      => 0,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $electricalRepairHatchBackService = Service::create([
            'name'              => 'Electrical',
            'service_parent'    => $repairHatchBackServiceWithoutDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 1,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $ACRepairHatchBackService = Service::create([
            'name'              => 'AC',
            'service_parent'    => $repairHatchBackServiceWithoutDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 1,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $suspensionRepairHatchBackService = Service::create([
            'name'              => 'Suspension',
            'service_parent'    => $repairHatchBackServiceWithoutDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 1,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Repair Services with Doorstep//////*/

        $repairHatchBackServiceWithDoorstep = Service::create([
            'name'              => 'Repair Services',
            'loyalty_points'    => 0,
            'category_id'       => 1,
            'lead_charges'      => 0,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        /*Child Services with Doorstep*/
        $bodyRepairHatchBackService = Service::create([
            'name'              => 'Body',
            'service_parent'    => $repairHatchBackServiceWithDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 1,
            'lead_charges'      => 0,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $transmissionRepairHatchBackService = Service::create([
            'name'              => 'Automatic Transmission Change',
            'service_parent'    => $repairHatchBackServiceWithDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 1,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $engineRepairHatchBackService = Service::create([
            'name'              => 'Engine',
            'service_parent'    => $repairHatchBackServiceWithDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 1,
            'lead_charges'      => 0,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $electricalRepairHatchBackService = Service::create([
            'name'              => 'Electrical',
            'service_parent'    => $repairHatchBackServiceWithDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 1,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $ACRepairHatchBackService = Service::create([
            'name'              => 'AC',
            'service_parent'    => $repairHatchBackServiceWithDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 1,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $suspensionRepairHatchBackService = Service::create([
            'name'              => 'Suspension',
            'service_parent'    => $repairHatchBackServiceWithDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 1,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Car Detailing Services without Doorstep//////*/
        $carDetailingHatchBackServiceWithoutDoorstep = Service::create([
            'name'              => 'Car Detailing',
            'loyalty_points'    => 0,
            'category_id'       => 1,
            'lead_charges'      => 0,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Child Services without Doorstep/////*/
        $oilChangeMaintenanceHatchBackService = Service::create([
            'name'              => 'Engine Bay Detailing',
            'service_parent'    => $carDetailingHatchBackServiceWithoutDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $carAcMaintenanceHatchBackService = Service::create([
            'name'              => 'Full Interior Detailing',
            'service_parent'    => $carDetailingHatchBackServiceWithoutDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $batteryReplacementMaintenanceHatchBackService = Service::create([
            'name'              => 'Tyre & Rim Detailing',
            'service_parent'    => $carDetailingHatchBackServiceWithoutDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);
        
        /*/////Car Detailing Services with Doorstep//////*/
        $carDetailingHatchBackServiceWithDoorstep = Service::create([
            'name'              => 'Car Detailing',
            'loyalty_points'    => 0,
            'category_id'       => 1,
            'lead_charges'      => 0,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Child Services with Doorstep/////*/
        $oilChangeMaintenanceHatchBackService = Service::create([
            'name'              => 'Engine Bay Detailing',
            'service_parent'    => $carDetailingHatchBackServiceWithDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $carAcMaintenanceHatchBackService = Service::create([
            'name'              => 'Full Interior Detailing',
            'service_parent'    => $carDetailingHatchBackServiceWithDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $batteryReplacementMaintenanceHatchBackService = Service::create([
            'name'              => 'Tyre & Rim Detailing',
            'service_parent'    => $carDetailingHatchBackServiceWithDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Denting Painting Services without Doorstep//////*/
        $dentingPaintingHatchBackServiceWithoutDoorstep = Service::create([
            'name'              => 'Denting Painting',
            'loyalty_points'    => 0,
            'category_id'       => 1,
            'lead_charges'      => 100,
            'is_doorstep'       => 0, 
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Child Services without Doorstep/////*/
        $oilChangeMaintenanceHatchBackService = Service::create([
            'name'              => 'Compound Polish & Scratch Removal',
            'service_parent'    => $dentingPaintingHatchBackServiceWithoutDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $carAcMaintenanceHatchBackService = Service::create([
            'name'              => 'Glass & Ceramics Coating',
            'service_parent'    => $dentingPaintingHatchBackServiceWithoutDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);
        
        /*/////Denting Painting Services with Doorstep//////*/
        $dentingPaintingHatchBackServiceWithDoorstep = Service::create([
            'name'              => 'Denting Painting',
            'loyalty_points'    => 0,
            'category_id'       => 1,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Child Services with Doorstep/////*/
        $oilChangeMaintenanceHatchBackService = Service::create([
            'name'              => 'Compound Polish & Scratch Removal',
            'service_parent'    => $dentingPaintingHatchBackServiceWithDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $carAcMaintenanceHatchBackService = Service::create([
            'name'              => 'Glass & Ceramics Coating',
            'service_parent'    => $dentingPaintingHatchBackServiceWithDoorstep->id,
            'category_id'       => 1,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Vehicle Inspection Services without Doorstep//////*/
        $vehicleInspectionHatchBackServiceWithoutDoorstep = Service::create([
            'name'              => 'Vehicle inspection',
            'loyalty_points'    => 0,
            'category_id'       => 1,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);
        
        /*/////Vehicle Inspection Services with Doorstep//////*/
        $vehicleInspectionHatchBackServiceWithDoorstep = Service::create([
            'name'              => 'Vehicle inspection',
            'loyalty_points'    => 0,
            'category_id'       => 1,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        /*////////////////////////Category ID Sedan////////////////////////*/

        /*/////Maintenance Services without Doorstep//////*/
        $maintenanceSedanServiceWithoutDoorstep = Service::create([
            'name'              => 'Maintenance Services',
            'loyalty_points'    => 0,
            'category_id'       => 2,
            'lead_charges'      => 0,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Child Services without Doorstep/////*/
        $oilChangeMaintenanceSedanService = Service::create([
            'name'              => 'Oil Change',
            'service_parent'    => $maintenanceSedanServiceWithoutDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $carACMaintenanceSedanService = Service::create([
            'name'              => 'Car AC Service',
            'service_parent'    => $maintenanceSedanServiceWithoutDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $batteryReplacementMaintenanceSedanService = Service::create([
            'name'              => 'Battery Replacement Service',
            'service_parent'    => $maintenanceSedanServiceWithoutDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $tyreReplacementMaintenanceSedanService = Service::create([
            'name'              => 'Tyre Replacement Service',
            'service_parent'    => $maintenanceSedanServiceWithoutDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $brakeMaintenanceSedanService = Service::create([
            'name'              => 'Brake Services',
            'service_parent'    => $maintenanceSedanServiceWithoutDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $throttleBodyCleaningMaintenanceSedanService = Service::create([
            'name'              => 'Throttle Body Cleaning',
            'service_parent'    => $maintenanceSedanServiceWithoutDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $radiatorMaintenanceSedanService = Service::create([
            'name'              => 'Radiator Service',
            'service_parent'    => $maintenanceSedanServiceWithoutDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $beltReplacementMaintenanceSedanService = Service::create([
            'name'              => 'Belt & Hoses Replacement',
            'service_parent'    => $maintenanceSedanServiceWithoutDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $computerScanningMaintenanceSedanService = Service::create([
            'name'              => 'Computer Scanning',
            'service_parent'    => $maintenanceSedanServiceWithoutDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $tuningMaintenanceSedanService = Service::create([
            'name'              => 'Tuning',
            'service_parent'    => $maintenanceSedanServiceWithoutDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $alignmentAndWheelBalancingMaintenanceSedanService = Service::create([
            'name'              => 'Alignment and Wheel Balancing',
            'service_parent'    => $maintenanceSedanServiceWithoutDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $carWashAndServiceMaintenanceSedanService = Service::create([
            'name'              => 'Car Wash and Service',
            'service_parent'    => $maintenanceSedanServiceWithoutDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 30,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $carCleaningMaintenanceHatchBackService = Service::create([
            'name'              => 'Carbon Cleaning',
            'service_parent'    => $maintenanceSedanServiceWithoutDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $alignmentAndWheelBalancingMaintenanceHatchBackService = Service::create([
            'name'              => 'Catalytic, Mufflers & Exhaust Cleaning',
            'service_parent'    => $maintenanceSedanServiceWithoutDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $carWashAndServiceMaintenanceHatchBackService = Service::create([
            'name'              => 'Engine General Overhauling',
            'service_parent'    => $maintenanceSedanServiceWithoutDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Maintenance Services with Doorstep//////*/
        $maintenanceSedanServiceWithDoorstep = Service::create([
            'name'              => 'Maintenance Services',
            'loyalty_points'    => 0,
            'category_id'       => 2,
            'lead_charges'      => 0,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);
        
        /*/////Child Services with Doorstep/////*/
        $oilChangeMaintenanceSedanService = Service::create([
            'name'              => 'Oil Change',
            'service_parent'    => $maintenanceSedanServiceWithDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $carACMaintenanceSedanService = Service::create([
            'name'              => 'Car AC Service',
            'service_parent'    => $maintenanceSedanServiceWithDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $batteryReplacementMaintenanceSedanService = Service::create([
            'name'              => 'Battery Replacement Service',
            'service_parent'    => $maintenanceSedanServiceWithDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $batteryReplacementMaintenanceSedanService = Service::create([
            'name'              => 'Tyre Replacement Service',
            'service_parent'    => $maintenanceSedanServiceWithDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $brakeMaintenanceSedanService = Service::create([
            'name'              => 'Brake Services',
            'service_parent'    => $maintenanceSedanServiceWithDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $throttleBodyCleaningMaintenanceSedanService = Service::create([
            'name'              => 'Throttle Body Cleaning',
            'service_parent'    => $maintenanceSedanServiceWithDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $radiatorMaintenanceSedanService = Service::create([
            'name'              => 'Radiator Service',
            'service_parent'    => $maintenanceSedanServiceWithDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $beltReplacementMaintenanceSedanService = Service::create([
            'name'              => 'Belt & Hoses Replacement',
            'service_parent'    => $maintenanceSedanServiceWithDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $computerScanningMaintenanceSedanService = Service::create([
            'name'              => 'Computer Scanning',
            'service_parent'    => $maintenanceSedanServiceWithDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $tuningMaintenanceSedanService = Service::create([
            'name'              => 'Tuning',
            'service_parent'    => $maintenanceSedanServiceWithDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $alignmentAndWheelBalancingMaintenanceSedanService = Service::create([
            'name'              => 'Alignment and Wheel Balancing',
            'service_parent'    => $maintenanceSedanServiceWithDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $carWashAndServiceMaintenanceSedanService = Service::create([
            'name'              => 'Car Wash and Service',
            'service_parent'    => $maintenanceSedanServiceWithDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 30,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);


        $carCleaningMaintenanceHatchBackService = Service::create([
            'name'              => 'Carbon Cleaning',
            'service_parent'    => $maintenanceSedanServiceWithDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $alignmentAndWheelBalancingMaintenanceHatchBackService = Service::create([
            'name'              => 'Catalytic, Mufflers & Exhaust Cleaning',
            'service_parent'    => $maintenanceSedanServiceWithDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $carWashAndServiceMaintenanceHatchBackService = Service::create([
            'name'              => 'Engine General Overhauling',
            'service_parent'    => $maintenanceSedanServiceWithDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Repair Services without Doorstep//////*/
        $repairSedanServiceWithoutDoorstep = Service::create([
            'name'              => 'Repair Services',
            'loyalty_points'    => 0,
            'category_id'       => 2,
            'lead_charges'      => 0,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        /*Child Services without Doorstep*/
        $bodyRepairSedanService = Service::create([
            'name'              => 'Body',
            'service_parent'    => $repairSedanServiceWithoutDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 2,
            'lead_charges'      => 0,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $transmissionRepairSedanService = Service::create([
            'name'              => 'Automatic Transmission Change',
            'service_parent'    => $repairSedanServiceWithoutDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 2,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $engineRepairSedanService = Service::create([
            'name'              => 'Engine',
            'service_parent'    => $repairSedanServiceWithoutDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 2,
            'lead_charges'      => 0,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $electricalRepairSedanService = Service::create([
            'name'              => 'Electrical',
            'service_parent'    => $repairSedanServiceWithoutDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 2,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $ACRepairSedanService = Service::create([
            'name'              => 'AC',
            'service_parent'    => $repairSedanServiceWithoutDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 2,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $suspensionRepairSedanService = Service::create([
            'name'              => 'Suspension',
            'service_parent'    => $repairSedanServiceWithoutDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 2,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Repair Services with Doorstep//////*/
        $repairSedanServiceWithDoorstep = Service::create([
            'name'              => 'Repair Services',
            'loyalty_points'    => 0,
            'category_id'       => 2,
            'lead_charges'      => 0,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);
        
        /*Child Services with Doorstep*/
        $bodyRepairSedanService = Service::create([
            'name'              => 'Body',
            'service_parent'    => $repairSedanServiceWithDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 2,
            'lead_charges'      => 0,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $transmissionRepairSedanService = Service::create([
            'name'              => 'Automatic Transmission Change',
            'service_parent'    => $repairSedanServiceWithDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 2,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $engineRepairSedanService = Service::create([
            'name'              => 'Engine',
            'service_parent'    => $repairSedanServiceWithDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 2,
            'lead_charges'      => 0,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $electricalRepairSedanService = Service::create([
            'name'              => 'Electrical',
            'service_parent'    => $repairSedanServiceWithDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 2,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $ACRepairSedanService = Service::create([
            'name'              => 'AC',
            'service_parent'    => $repairSedanServiceWithDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 2,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $suspensionRepairSedanService = Service::create([
            'name'              => 'Suspension',
            'service_parent'    => $repairSedanServiceWithDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 2,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Car Detailing Services without Doorstep//////*/
        $carDetailingSedanServiceWithoutDoorstep = Service::create([
            'name'              => 'Car Detailing',
            'loyalty_points'    => 0,
            'category_id'       => 2,
            'lead_charges'      => 0,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Child Services without Doorstep/////*/
        $oilChangeMaintenanceHatchBackService = Service::create([
            'name'              => 'Engine Bay Detailing',
            'service_parent'    => $carDetailingSedanServiceWithoutDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $carAcMaintenanceHatchBackService = Service::create([
            'name'              => 'Full Interior Detailing',
            'service_parent'    => $carDetailingSedanServiceWithoutDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $batteryReplacementMaintenanceHatchBackService = Service::create([
            'name'              => 'Tyre & Rim Detailing',
            'service_parent'    => $carDetailingSedanServiceWithoutDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);
        
        /*/////Car Detailing Services with Doorstep//////*/
        $carDetailingSedanServiceWithDoorstep = Service::create([
            'name'              => 'Car Detailing',
            'loyalty_points'    => 0,
            'category_id'       => 2,
            'lead_charges'      => 0,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Child Services with Doorstep/////*/
        $oilChangeMaintenanceHatchBackService = Service::create([
            'name'              => 'Engine Bay Detailing',
            'service_parent'    => $carDetailingSedanServiceWithDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $carAcMaintenanceHatchBackService = Service::create([
            'name'              => 'Full Interior Detailing',
            'service_parent'    => $carDetailingSedanServiceWithDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $batteryReplacementMaintenanceHatchBackService = Service::create([
            'name'              => 'Tyre & Rim Detailing',
            'service_parent'    => $carDetailingSedanServiceWithDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Denting Painting Services without Doorstep//////*/
        $dentingPaintingSedanServiceWithoutDoorstep = Service::create([
            'name'              => 'Denting Painting',
            'loyalty_points'    => 0,
            'category_id'       => 2,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Child Services without Doorstep/////*/
        $oilChangeMaintenanceHatchBackService = Service::create([
            'name'              => 'Compound Polish & Scratch Removal',
            'service_parent'    => $dentingPaintingSedanServiceWithoutDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $carAcMaintenanceHatchBackService = Service::create([
            'name'              => 'Glass & Ceramics Coating',
            'service_parent'    => $dentingPaintingSedanServiceWithoutDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);
        
        /*/////Denting Painting Services with Doorstep//////*/
        $dentingPaintingSedanServiceWithDoorstep = Service::create([
            'name'              => 'Denting Painting',
            'loyalty_points'    => 0,
            'category_id'       => 2,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Child Services with Doorstep/////*/
        $oilChangeMaintenanceHatchBackService = Service::create([
            'name'              => 'Compound Polish & Scratch Removal',
            'service_parent'    => $dentingPaintingSedanServiceWithDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $carAcMaintenanceHatchBackService = Service::create([
            'name'              => 'Glass & Ceramics Coating',
            'service_parent'    => $dentingPaintingSedanServiceWithDoorstep->id,
            'category_id'       => 2,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Vehicle Inspection Services without Doorstep//////*/
        $vehicleInspectionSedanServiceWithoutDoorstep = Service::create([
            'name'              => 'Vehicle inspection',
            'loyalty_points'    => 0,
            'category_id'       => 2,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);
        
        /*/////Vehicle Inspection Services with Doorstep//////*/
        $vehicleInspectionSedanServiceWithDoorstep = Service::create([
            'name'              => 'Vehicle inspection',
            'loyalty_points'    => 0,
            'category_id'       => 2,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        /*////////////////////////Category ID Luxury////////////////////////*/

        /*/////Maintenance Services Without Doorstep//////*/
        $maintenanceLuxuryServiceWithoutDoorstep = Service::create([
            'name'              => 'Maintenance Services',
            'loyalty_points'    => 0,
            'category_id'       => 3,
            'lead_charges'      => 0,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Child Services without Doorstep/////*/
        $oilChangeMaintenanceLuxuryService = Service::create([
            'name'              => 'Oil Change',
            'service_parent'    => $maintenanceLuxuryServiceWithoutDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $carACMaintenanceLuxuryService = Service::create([
            'name'              => 'Car AC Service',
            'service_parent'    => $maintenanceLuxuryServiceWithoutDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $batteryReplacementMaintenanceLuxuryService = Service::create([
            'name'              => 'Battery Replacement Service',
            'service_parent'    => $maintenanceLuxuryServiceWithoutDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $tyreReplacementMaintenanceLuxuryService = Service::create([
            'name'              => 'Tyre Replacement Service',
            'service_parent'    => $maintenanceLuxuryServiceWithoutDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $brakeMaintenanceLuxuryService = Service::create([
            'name'              => 'Brake Services',
            'service_parent'    => $maintenanceLuxuryServiceWithoutDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $throttleBodyCleaningMaintenanceLuxuryService = Service::create([
            'name'              => 'Throttle Body Cleaning',
            'service_parent'    => $maintenanceLuxuryServiceWithoutDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $radiatorMaintenanceLuxuryService = Service::create([
            'name'              => 'Radiator Service',
            'service_parent'    => $maintenanceLuxuryServiceWithoutDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $beltReplacementMaintenanceLuxuryService = Service::create([
            'name'              => 'Belt & Hoses Replacement',
            'service_parent'    => $maintenanceLuxuryServiceWithoutDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $computerScanningMaintenanceLuxuryService = Service::create([
            'name'              => 'Computer Scanning',
            'service_parent'    => $maintenanceLuxuryServiceWithoutDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $tuningMaintenanceLuxuryService = Service::create([
            'name'              => 'Tuning',
            'service_parent'    => $maintenanceLuxuryServiceWithoutDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $alignmentAndWheelBalancingMaintenanceLuxuryService = Service::create([
            'name'              => 'Alignment and Wheel Balancing',
            'service_parent'    => $maintenanceLuxuryServiceWithoutDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $carWashAndServiceMaintenanceLuxuryService = Service::create([
            'name'              => 'Car Wash and Service',
            'service_parent'    => $maintenanceLuxuryServiceWithoutDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 30,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $carCleaningMaintenanceHatchBackService = Service::create([
            'name'              => 'Carbon Cleaning',
            'service_parent'    => $maintenanceLuxuryServiceWithoutDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $alignmentAndWheelBalancingMaintenanceHatchBackService = Service::create([
            'name'              => 'Catalytic, Mufflers & Exhaust Cleaning',
            'service_parent'    => $maintenanceLuxuryServiceWithoutDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $carWashAndServiceMaintenanceHatchBackService = Service::create([
            'name'              => 'Engine General Overhauling',
            'service_parent'    => $maintenanceLuxuryServiceWithoutDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Maintenance Services With Doorstep//////*/
        $maintenanceLuxuryServiceWithDoorstep = Service::create([
            'name'              => 'Maintenance Services',
            'loyalty_points'    => 0,
            'category_id'       => 3,
            'lead_charges'      => 0,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Child Services with Doorstep/////*/
        $oilChangeMaintenanceLuxuryService = Service::create([
            'name'              => 'Oil Change',
            'service_parent'    => $maintenanceLuxuryServiceWithDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $carACMaintenanceLuxuryService = Service::create([
            'name'              => 'Car AC Service',
            'service_parent'    => $maintenanceLuxuryServiceWithDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $batteryReplacementMaintenanceLuxuryService = Service::create([
            'name'              => 'Battery Replacement Service',
            'service_parent'    => $maintenanceLuxuryServiceWithDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $tyreReplacementMaintenanceLuxuryService = Service::create([
            'name'              => 'Tyre Replacement Service',
            'service_parent'    => $maintenanceLuxuryServiceWithDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $brakeMaintenanceLuxuryService = Service::create([
            'name'              => 'Brake Services',
            'service_parent'    => $maintenanceLuxuryServiceWithDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $throttleBodyCleaningMaintenanceLuxuryService = Service::create([
            'name'              => 'Throttle Body Cleaning',
            'service_parent'    => $maintenanceLuxuryServiceWithDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $radiatorMaintenanceLuxuryService = Service::create([
            'name'              => 'Radiator Service',
            'service_parent'    => $maintenanceLuxuryServiceWithDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $beltReplacementMaintenanceLuxuryService = Service::create([
            'name'              => 'Belt & Hoses Replacement',
            'service_parent'    => $maintenanceLuxuryServiceWithDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $computerScanningMaintenanceLuxuryService = Service::create([
            'name'              => 'Computer Scanning',
            'service_parent'    => $maintenanceLuxuryServiceWithDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $tuningMaintenanceLuxuryService = Service::create([
            'name'              => 'Tuning',
            'service_parent'    => $maintenanceLuxuryServiceWithDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $alignmentAndWheelBalancingMaintenanceLuxuryService = Service::create([
            'name'              => 'Alignment and Wheel Balancing',
            'service_parent'    => $maintenanceLuxuryServiceWithDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $carWashAndServiceMaintenanceLuxuryService = Service::create([
            'name'              => 'Car Wash and Service',
            'service_parent'    => $maintenanceLuxuryServiceWithDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 30,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $carCleaningMaintenanceHatchBackService = Service::create([
            'name'              => 'Carbon Cleaning',
            'service_parent'    => $maintenanceLuxuryServiceWithDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $alignmentAndWheelBalancingMaintenanceHatchBackService = Service::create([
            'name'              => 'Catalytic, Mufflers & Exhaust Cleaning',
            'service_parent'    => $maintenanceLuxuryServiceWithDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $carWashAndServiceMaintenanceHatchBackService = Service::create([
            'name'              => 'Engine General Overhauling',
            'service_parent'    => $maintenanceLuxuryServiceWithDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Repair Services without Doorstep//////*/
        $repairLuxuryServiceWithoutDoorstep = Service::create([
            'name'              => 'Repair Services',
            'loyalty_points'    => 0,
            'category_id'       => 3,
            'lead_charges'      => 0,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        /*Child Services without Doorstep*/
        $bodyRepairLuxuryService = Service::create([
            'name'              => 'Body',
            'service_parent'    => $repairLuxuryServiceWithoutDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 3,
            'lead_charges'      => 0,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $transmissionRepairLuxuryService = Service::create([
            'name'              => 'Automatic Transmission Change',
            'service_parent'    => $repairLuxuryServiceWithoutDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 3,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $engineRepairLuxuryService = Service::create([
            'name'              => 'Engine',
            'service_parent'    => $repairLuxuryServiceWithoutDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 3,
            'lead_charges'      => 0,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $electricalRepairLuxuryService = Service::create([
            'name'              => 'Electrical',
            'service_parent'    => $repairLuxuryServiceWithoutDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 3,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $ACRepairLuxuryService = Service::create([
            'name'              => 'AC',
            'service_parent'    => $repairLuxuryServiceWithoutDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 3,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $suspensionRepairLuxuryService = Service::create([
            'name'              => 'Suspension',
            'service_parent'    => $repairLuxuryServiceWithoutDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 3,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);


        /*/////Repair Services with Doorstep//////*/
        $repairLuxuryServiceWithDoorstep = Service::create([
            'name'              => 'Repair Services',
            'loyalty_points'    => 0,
            'category_id'       => 3,
            'lead_charges'      => 0,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        /*Child Services with Doorstep*/
        $bodyRepairLuxuryService = Service::create([
            'name'              => 'Body',
            'service_parent'    => $repairLuxuryServiceWithDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 3,
            'lead_charges'      => 0,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $transmissionRepairLuxuryService = Service::create([
            'name'              => 'Automatic Transmission Change',
            'service_parent'    => $repairLuxuryServiceWithDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 3,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $engineRepairLuxuryService = Service::create([
            'name'              => 'Engine',
            'service_parent'    => $repairLuxuryServiceWithDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 3,
            'lead_charges'      => 0,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $electricalRepairLuxuryService = Service::create([
            'name'              => 'Electrical',
            'service_parent'    => $repairLuxuryServiceWithDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 3,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $ACRepairLuxuryService = Service::create([
            'name'              => 'AC',
            'service_parent'    => $repairLuxuryServiceWithDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 3,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $suspensionRepairLuxuryService = Service::create([
            'name'              => 'Suspension',
            'service_parent'    => $repairLuxuryServiceWithDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 3,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Car Detailing Services without Doorstep//////*/
        $carDetailingLuxuryServiceWithoutDoorstep = Service::create([
            'name'              => 'Car Detailing',
            'loyalty_points'    => 0,
            'category_id'       => 3,
            'lead_charges'      => 0,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Child Services without Doorstep/////*/
        $oilChangeMaintenanceHatchBackService = Service::create([
            'name'              => 'Engine Bay Detailing',
            'service_parent'    => $carDetailingLuxuryServiceWithoutDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $carAcMaintenanceHatchBackService = Service::create([
            'name'              => 'Full Interior Detailing',
            'service_parent'    => $carDetailingLuxuryServiceWithoutDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $batteryReplacementMaintenanceHatchBackService = Service::create([
            'name'              => 'Tyre & Rim Detailing',
            'service_parent'    => $carDetailingLuxuryServiceWithoutDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);
        
        /*/////Car Detailing Services with Doorstep//////*/
        $carDetailingLuxuryServiceWithDoorstep = Service::create([
            'name'              => 'Car Detailing',
            'loyalty_points'    => 0,
            'category_id'       => 3,
            'lead_charges'      => 0,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Child Services with Doorstep/////*/
        $oilChangeMaintenanceHatchBackService = Service::create([
            'name'              => 'Engine Bay Detailing',
            'service_parent'    => $carDetailingLuxuryServiceWithDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $carAcMaintenanceHatchBackService = Service::create([
            'name'              => 'Full Interior Detailing',
            'service_parent'    => $carDetailingLuxuryServiceWithDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $batteryReplacementMaintenanceHatchBackService = Service::create([
            'name'              => 'Tyre & Rim Detailing',
            'service_parent'    => $carDetailingLuxuryServiceWithDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Denting Painting Services without Doorstep//////*/
        $dentingPaintingLuxuryService = Service::create([
            'name'              => 'Denting Painting',
            'loyalty_points'    => 0,
            'category_id'       => 3,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Child Services without Doorstep/////*/
        $oilChangeMaintenanceHatchBackService = Service::create([
            'name'              => 'Compound Polish & Scratch Removal',
            'service_parent'    => $dentingPaintingLuxuryService->id,
            'category_id'       => 3,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $carAcMaintenanceHatchBackService = Service::create([
            'name'              => 'Glass & Ceramics Coating',
            'service_parent'    => $dentingPaintingLuxuryService->id,
            'category_id'       => 3,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);
        
        /*/////Denting Painting Services with Doorstep//////*/
        $dentingPaintingLuxuryServiceWithDoorstep = Service::create([
            'name'              => 'Denting Painting',
            'loyalty_points'    => 0,
            'category_id'       => 3,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Child Services with Doorstep/////*/
        $oilChangeMaintenanceHatchBackService = Service::create([
            'name'              => 'Compound Polish & Scratch Removal',
            'service_parent'    => $dentingPaintingLuxuryServiceWithDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $carAcMaintenanceHatchBackService = Service::create([
            'name'              => 'Glass & Ceramics Coating',
            'service_parent'    => $dentingPaintingLuxuryServiceWithDoorstep->id,
            'category_id'       => 3,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Vehicle Inspection Services without Doorstep//////*/
        $vehicleInspectionLuxuryServiceWithoutDoorstep = Service::create([
            'name'              => 'Vehicle inspection',
            'loyalty_points'    => 0,
            'category_id'       => 3,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);
        
        /*/////Vehicle Inspection Services with Doorstep//////*/
        $vehicleInspectionLuxuryServiceWithDoorstep = Service::create([
            'name'              => 'Vehicle inspection',
            'loyalty_points'    => 0,
            'category_id'       => 3,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        /*////////////////////////Category ID SUV////////////////////////*/

        /*/////Maintenance Services without Doorstep//////*/
        $maintenanceSUVServiceWithoutDoorstep = Service::create([
            'name'              => 'Maintenance Services',
            'loyalty_points'    => 0,
            'category_id'       => 4,
            'lead_charges'      => 0,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Child Services without Doorstep/////*/
        $oilChangeMaintenanceSUVService = Service::create([
            'name'              => 'Oil Change',
            'service_parent'    => $maintenanceSUVServiceWithoutDoorstep->id,
            'category_id'       => 4,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $carACMaintenanceSUVService = Service::create([
            'name'              => 'Car AC Service',
            'service_parent'    => $maintenanceSUVServiceWithoutDoorstep->id,
            'category_id'       => 4,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $batteryReplacementMaintenanceSUVService = Service::create([
            'name'              => 'Battery Replacement Service',
            'service_parent'    => $maintenanceSUVServiceWithoutDoorstep->id,
            'category_id'       => 4,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $tyreReplacementMaintenanceSUVService = Service::create([
            'name'              => 'Tyre Replacement Service',
            'service_parent'    => $maintenanceSUVServiceWithoutDoorstep->id,
            'category_id'       => 4,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $brakeMaintenanceSUVService = Service::create([
            'name'              => 'Brake Services',
            'service_parent'    => $maintenanceSUVServiceWithoutDoorstep->id,
            'category_id'       => 4,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $throttleBodyCleaningMaintenanceSUVService = Service::create([
            'name'              => 'Throttle Body Cleaning',
            'service_parent'    => $maintenanceSUVServiceWithoutDoorstep->id,
            'category_id'       => 4,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $radiatorMaintenanceSUVService = Service::create([
            'name'              => 'Radiator Service',
            'service_parent'    => $maintenanceSUVServiceWithoutDoorstep->id,
            'category_id'       => 4,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $beltReplacementMaintenanceSUVService = Service::create([
            'name'              => 'Belt & Hoses Replacement',
            'service_parent'    => $maintenanceSUVServiceWithoutDoorstep->id,
            'category_id'       => 4,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $computerScanningMaintenanceSUVService = Service::create([
            'name'              => 'Computer Scanning',
            'service_parent'    => $maintenanceSUVServiceWithoutDoorstep->id,
            'category_id'       => 4,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $tuningMaintenanceSUVService = Service::create([
            'name'              => 'Tuning',
            'service_parent'    => $maintenanceSUVServiceWithoutDoorstep->id,
            'category_id'       => 4,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $alignmentAndWheelBalancingMaintenanceSUVService = Service::create([
            'name'              => 'Alignment and Wheel Balancing',
            'service_parent'    => $maintenanceSUVServiceWithoutDoorstep->id,
            'category_id'       => 4,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $carWashAndServiceMaintenanceSUVService = Service::create([
            'name'              => 'Car Wash and Service',
            'service_parent'    => $maintenanceSUVServiceWithoutDoorstep->id,
            'category_id'       => 4,
            'lead_charges'      => 30,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $carCleaningMaintenanceHatchBackService = Service::create([
            'name'              => 'Carbon Cleaning',
            'service_parent'    => $maintenanceSUVServiceWithoutDoorstep->id,
            'category_id'       => 4,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $alignmentAndWheelBalancingMaintenanceHatchBackService = Service::create([
            'name'              => 'Catalytic, Mufflers & Exhaust Cleaning',
            'service_parent'    => $maintenanceSUVServiceWithoutDoorstep->id,
            'category_id'       => 4,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $carWashAndServiceMaintenanceHatchBackService = Service::create([
            'name'              => 'Engine General Overhauling',
            'service_parent'    => $maintenanceSUVServiceWithoutDoorstep->id,
            'category_id'       => 4,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);


        /*/////Maintenance Services with Doorstep//////*/
        $maintenanceSUVServiceWithDoorstep = Service::create([
            'name'              => 'Maintenance Services',
            'loyalty_points'    => 0,
            'category_id'       => 4,
            'lead_charges'      => 0,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Child Services with Doorstep/////*/
        $oilChangeMaintenanceSUVService = Service::create([
            'name'              => 'Oil Change',
            'service_parent'    => $maintenanceSUVServiceWithDoorstep->id,
            'category_id'       => 4,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $carACMaintenanceSUVService = Service::create([
            'name'              => 'Car AC Service',
            'service_parent'    => $maintenanceSUVServiceWithDoorstep->id,
            'category_id'       => 4,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $batteryReplacementMaintenanceSUVService = Service::create([
            'name'              => 'Battery Replacement Service',
            'service_parent'    => $maintenanceSUVServiceWithDoorstep->id,
            'category_id'       => 4,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $tyreReplacementMaintenanceSUVService = Service::create([
            'name'              => 'Tyre Replacement Service',
            'service_parent'    => $maintenanceSUVServiceWithDoorstep->id,
            'category_id'       => 4,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $brakeMaintenanceSUVService = Service::create([
            'name'              => 'Brake Services',
            'service_parent'    => $maintenanceSUVServiceWithDoorstep->id,
            'category_id'       => 4,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $throttleBodyCleaningMaintenanceSUVService = Service::create([
            'name'              => 'Throttle Body Cleaning',
            'service_parent'    => $maintenanceSUVServiceWithDoorstep->id,
            'category_id'       => 4,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $radiatorMaintenanceSUVService = Service::create([
            'name'              => 'Radiator Service',
            'service_parent'    => $maintenanceSUVServiceWithDoorstep->id,
            'category_id'       => 4,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $beltReplacementMaintenanceSUVService = Service::create([
            'name'              => 'Belt & Hoses Replacement',
            'service_parent'    => $maintenanceSUVServiceWithDoorstep->id,
            'category_id'       => 4,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $computerScanningMaintenanceSUVService = Service::create([
            'name'              => 'Computer Scanning',
            'service_parent'    => $maintenanceSUVServiceWithDoorstep->id,
            'category_id'       => 4,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $tuningMaintenanceSUVService = Service::create([
            'name'              => 'Tuning',
            'service_parent'    => $maintenanceSUVServiceWithDoorstep->id,
            'category_id'       => 4,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $alignmentAndWheelBalancingMaintenanceSUVService = Service::create([
            'name'              => 'Alignment and Wheel Balancing',
            'service_parent'    => $maintenanceSUVServiceWithDoorstep->id,
            'category_id'       => 4,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $carWashAndServiceMaintenanceSUVService = Service::create([
            'name'              => 'Car Wash and Service',
            'service_parent'    => $maintenanceSUVServiceWithDoorstep->id,
            'category_id'       => 4,
            'lead_charges'      => 30,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $carCleaningMaintenanceHatchBackService = Service::create([
            'name'              => 'Carbon Cleaning',
            'service_parent'    => $maintenanceSUVServiceWithDoorstep->id,
            'category_id'       => 4,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $alignmentAndWheelBalancingMaintenanceHatchBackService = Service::create([
            'name'              => 'Catalytic, Mufflers & Exhaust Cleaning',
            'service_parent'    => $maintenanceSUVServiceWithDoorstep->id,
            'category_id'       => 4,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $carWashAndServiceMaintenanceHatchBackService = Service::create([
            'name'              => 'Engine General Overhauling',
            'service_parent'    => $maintenanceSUVServiceWithDoorstep->id,
            'category_id'       => 4,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        /*Repair Services without Doorstep//////*/
        $repairSUVServiceWithoutDoorstep = Service::create([
            'name'              => 'Repair Services',
            'loyalty_points'    => 0,
            'category_id'       => 4,
            'lead_charges'      => 0,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        /*Child Services without Doorstep*/
        $bodyRepairSUVService = Service::create([
            'name'              => 'Body',
            'service_parent'    => $repairSUVServiceWithoutDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 4,
            'lead_charges'      => 0,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $transmissionRepairSUVService = Service::create([
            'name'              => 'Automatic Transmission Change',
            'service_parent'    => $repairSUVServiceWithoutDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 4,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $engineRepairSUVService = Service::create([
            'name'              => 'Engine',
            'service_parent'    => $repairSUVServiceWithoutDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 4,
            'lead_charges'      => 0,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $electricalRepairSUVService = Service::create([
            'name'              => 'Electrical',
            'service_parent'    => $repairSUVServiceWithoutDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 4,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $ACRepairSUVService = Service::create([
            'name'              => 'AC',
            'service_parent'    => $repairSUVServiceWithoutDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 4,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $suspensionRepairSUVService = Service::create([
            'name'              => 'Suspension',
            'service_parent'    => $repairSUVServiceWithoutDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 4,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        /*Repair Services with Doorstep//////*/
        $repairSUVServiceWithDoorstep = Service::create([
            'name'              => 'Repair Services',
            'loyalty_points'    => 0,
            'category_id'       => 4,
            'lead_charges'      => 0,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        /*Child Services with Doorstep*/
        $bodyRepairSUVService = Service::create([
            'name'              => 'Body',
            'service_parent'    => $repairSUVServiceWithDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 4,
            'lead_charges'      => 0,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $transmissionRepairSUVService = Service::create([
            'name'              => 'Automatic Transmission Change',
            'service_parent'    => $repairSUVServiceWithDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 4,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $engineRepairSUVService = Service::create([
            'name'              => 'Engine',
            'service_parent'    => $repairSUVServiceWithDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 4,
            'lead_charges'      => 0,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $electricalRepairSUVService = Service::create([
            'name'              => 'Electrical',
            'service_parent'    => $repairSUVServiceWithDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 4,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $ACRepairSUVService = Service::create([
            'name'              => 'AC',
            'service_parent'    => $repairSUVServiceWithDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 4,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $suspensionRepairSUVService = Service::create([
            'name'              => 'Suspension',
            'service_parent'    => $repairSUVServiceWithDoorstep->id,
            'loyalty_points'    => 0,
            'category_id'       => 4,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Car Detailing Services without Doorstep//////*/
        $carDetailingSUVServiceWithoutDoorstep = Service::create([
            'name'              => 'Car Detailing',
            'loyalty_points'    => 0,
            'category_id'       => 4,
            'lead_charges'    => 0,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Child Services without Doorstep/////*/
        $oilChangeMaintenanceHatchBackService = Service::create([
            'name'              => 'Engine Bay Detailing',
            'service_parent'    => $carDetailingSUVServiceWithoutDoorstep->id,
            'category_id'       => 4,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $carAcMaintenanceHatchBackService = Service::create([
            'name'              => 'Full Interior Detailing',
            'service_parent'    => $carDetailingSUVServiceWithoutDoorstep->id,
            'category_id'       => 4,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $batteryReplacementMaintenanceHatchBackService = Service::create([
            'name'              => 'Tyre & Rim Detailing',
            'service_parent'    => $carDetailingSUVServiceWithoutDoorstep->id,
            'category_id'       => 4,
            'lead_charges'      => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Car Detailing Services with Doorstep//////*/
        $carDetailingSUVServiceWithDoorstep = Service::create([
            'name'              => 'Car Detailing',
            'loyalty_points'    => 0,
            'category_id'       => 4,
            'lead_charges'    => 0,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Child Services with Doorstep/////*/
        $oilChangeMaintenanceHatchBackService = Service::create([
            'name'              => 'Engine Bay Detailing',
            'service_parent'    => $carDetailingSUVServiceWithDoorstep->id,
            'category_id'       => 4,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $carAcMaintenanceHatchBackService = Service::create([
            'name'              => 'Full Interior Detailing',
            'service_parent'    => $carDetailingSUVServiceWithDoorstep->id,
            'category_id'       => 4,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $batteryReplacementMaintenanceHatchBackService = Service::create([
            'name'              => 'Tyre & Rim Detailing',
            'service_parent'    => $carDetailingSUVServiceWithDoorstep->id,
            'category_id'       => 4,
            'lead_charges'      => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Denting Painting Services without Doorstep//////*/
        $dentingPaintingSUVService = Service::create([
            'name'              => 'Denting Painting',
            'loyalty_points'    => 0,
            'category_id'       => 4,
            'lead_charges'    => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Child Services without Doorstep/////*/
        $oilChangeMaintenanceHatchBackService = Service::create([
            'name'              => 'Compound Polish & Scratch Removal',
            'service_parent'    => $dentingPaintingSUVService->id,
            'category_id'       => 4,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        $carAcMaintenanceHatchBackService = Service::create([
            'name'              => 'Glass & Ceramics Coating',
            'service_parent'    => $dentingPaintingSUVService->id,
            'category_id'       => 4,
            'lead_charges'      => 100,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Denting Painting Services with Doorstep//////*/
        $dentingPaintingSUVService = Service::create([
            'name'              => 'Denting Painting',
            'loyalty_points'    => 0,
            'category_id'       => 4,
            'lead_charges'    => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Child Services with Doorstep/////*/
        $oilChangeMaintenanceHatchBackService = Service::create([
            'name'              => 'Compound Polish & Scratch Removal',
            'service_parent'    => $dentingPaintingSUVService->id,
            'category_id'       => 4,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        $carAcMaintenanceHatchBackService = Service::create([
            'name'              => 'Glass & Ceramics Coating',
            'service_parent'    => $dentingPaintingSUVService->id,
            'category_id'       => 4,
            'lead_charges'      => 100,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Vehicle Inspection Services Without Doorstep//////*/
        $vehicleInspectionSUVService = Service::create([
            'name'              => 'Vehicle inspection',
            'loyalty_points'    => 0,
            'category_id'       => 4,
            'lead_charges'    => 50,
            'is_doorstep'       => 0,
            'image'             => url('img/thumbnail.png')
        ]);

        /*/////Vehicle Inspection Services with Doorstep//////*/
        $vehicleInspectionSUVService = Service::create([
            'name'              => 'Vehicle inspection',
            'loyalty_points'    => 0,
            'category_id'       => 4,
            'lead_charges'    => 50,
            'is_doorstep'       => 1,
            'image'             => url('img/thumbnail.png')
        ]);

        /*///////////////////////////////////////////////////////////////////////*/
        /*////////////////////////Services Seeder End////////////////////////*/

        Model::reguard();
    }
}
