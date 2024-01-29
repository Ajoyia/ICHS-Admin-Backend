<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoreProfessionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('profile_cards')->insert([
            [
                'name' =>'Dr. Adnane Elmerini' ,
                'image' => 'https://ichs-prod-static-content.s3.eu-west-1.amazonaws.com/file_manager/images/C1c6CgQbuUoB6nobavdBzdQ5RoI99Kjgi1jYUTFM.png',
                'detail' => '',
                'category_id' => 1,
                'country_id' => 149,
                'job_title' => 'ICHS Congress Commissioner',
                'credentails' => 'BDS',
                'designation'=>'Cosmetic Dentist, Private Practice',
                'speciality_id' => 16,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' =>'Dr. Bianca Rebello' ,
                'image' => 'https://www.index.ae/ichs/wp-content/uploads/2022/07/bianca.png',
                'detail' => '',
                'category_id' => 1,
                'country_id' => 31,
                'job_title' => 'ICHS Education, Research and Innovation Faculty',
                'credentails' => 'DDS, MSc',
                'designation'=>'',
                'speciality_id' => 16,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Prof. Hani Ounsi',
                'image' => 'https://www.index.ae/ichs/wp-content/uploads/2022/07/hani.png',
                'detail' => '',
                'category_id' => 1,
                'credentails'=>'  DCD, DESE, MSc, PhD, MRACDS, FICD ',
                'designation'=>'  Endodontics, Department of Restorative Dentistry and Endodontics, Siena University ',
                'country_id'=>  117   ,
                'job_title'=>'ICHS Congress Commissioner',
                'speciality_id' => 16,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Dr. John J. Young, Jr.',
                'image' => 'https://www.index.ae/ichs/wp-content/uploads/2022/07/john-young.png',
                'detail' => '',
                'category_id' => 1,
                'credentails'=>' DDS ',
                'designation'=>' Member, American Dental Association, Greater New York Dental Meeting Committee Fellow, Private Practice ',
                'country_id'=> 233 ,
                'job_title'=>'ICHS Education, Research and Innovation Faculty',
                'speciality_id' => 16,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Dr. Kashif Hafeez',
                'image' => 'https://www.index.ae/ichs/wp-content/uploads/2022/07/kashif-hafeez.png',
                'detail' => '',
                'category_id' => 1,
                'credentails'=>' BDS, MFDRCSI, FFDRCSl, FDSRCSEd, PG Cert Med Ed, FDTFRCSEd ',
                'designation'=>' Honorary Professor, RAK College of Dental Sciences United Arab Emirates; Dental Ambassador, South West England, Royal College of Surgeons Edinburgh; Honorary Clinical Teaching Fellow, University College London, Eastman Dental Institute Visiting Lecturer, Dental Faculty, Oral & Craniofacial Sciences King’s College London ',
                'country_id'=>232,
                'job_title'=>'ICHS Education, Research and Innovation Faculty',
                'speciality_id' => 16,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Prof. Dr. Majeed Rana',
                'image' => 'https://www.index.ae/ichs/wp-content/uploads/2022/07/majeed-rana.png',
                'detail' => '',
                'category_id' => 1,
                'credentails'=>'  MD, PhD ',
                'designation'=>'  Vice Director of the Heinrich Heine University Düsseldorf Department of Oral and Maxillofacial and Plastic Facial Surgery University Düsseldorf – Germany; Chairman, AEEDC Dubai World Oral & Maxillofacial Surgery Conference ',
                'country_id'=>  82 ,
                'job_title'=>'ICHS Education, Research and Innovation Faculty',
                'speciality_id' => 16,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Dr. Marwa Al Hothali',
                'image' => 'https://www.index.ae/ichs/wp-content/uploads/2022/07/marwa.png',
                'detail' => '',
                'category_id' => 1,
                'credentails'=>'  BDS, Pedo. Cert., PhD ',
                'designation'=>'  Pediatric Dentist, Comprehensive Specialized Clinics of Security Forces and Security Forces Hospital ',
                'country_id'=>  194,
                'job_title'=>'ICHS Education, Research and Innovation Faculty',
                'speciality_id' => 16,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Dr. Mohammad H. Al-Harthy',
                'image' => 'https://www.index.ae/ichs/wp-content/uploads/2022/07/al-harithy.png',
                'detail' => '',
                'category_id' => 1,
                'credentails'=>'  BDS, MDSc, PhD ',
                'designation'=>'  Board Member, Saudi Dental Society; Assistant Professor & Consultant, Oral Medicine/Orofacial Pain & TMD, Faculty of Dentistry, Umm Al-Qura University, Saudi Arabia; Visiting Assistant Professor, Faculty of Odontology, Malmö University, Malmö, Sweden ',
                'country_id'=>  194,
                'job_title'=>'ICHS Congress Commissioner',
                'speciality_id' => 16,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Dr. Nahawand Thabet',
                'image' => 'https://www.index.ae/ichs/wp-content/uploads/2022/07/nahawand.png',
                'detail' => '',
                'category_id' => 1,
                'credentails'=>  'DDS' ,
                'designation'=>'  Oral & Maxillofacial Surgeon, FDI Council Member (Representative of Africa), Head of Scientific Committee, AEEDC Education Cairo, Private Practice ',
                'country_id'=>  65 ,
                'job_title'=>'ICHS Congress Commissioner',
                'speciality_id' => 16,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Prof. Abdulla Molokhia',
                'image' =>'https://www.index.ae/ichs/wp-content/uploads/2022/07/abdullah-molokhia.png',
                'detail' => '',
                'category_id' => 1,
                'credentails'=> ' PhD ',
               'designation'=>'  Professor, Pharmaceutics ',
                'country_id'=>  65 ,
                'job_title'=>'ICHS Congress Commissioner',
                'speciality_id' => 333,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()

              ],
              [
                  'name' => 'Prof. Albert Wertheimer',
                 'image' => 'https://www.index.ae/ichs/wp-content/uploads/2022/08/MicrosoftTeams-image-23.png',
                 'detail' => '',
                 'category_id' => 1,
                'credentails'=> ' PhD, MBA ',
               'designation'=>'  Professor, Nova Southeastern University ',
                'country_id'=>  233 ,
                'job_title'=>'ICHS Congress Commissioner',
                'speciality_id' => 333,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()

              ],
              [
                  'name' => 'Prof. Barry A. Bleidt',
                 'image' => 'https://www.index.ae/ichs/wp-content/uploads/2022/07/barry-bledit.png',
                 'detail' => '',
                 'category_id' => 1,
                'credentails'=> ' PhD, PharmD, RPh, FAPhA, FNPhA ',
               'designation'=>'  Professor of Sociobehavioral and Administrative Pharmacy, Nova Southeastern University ',
                'country_id'=>  233 ,
                'job_title'=>'ICHS Congress Commissioner',
                'speciality_id' => 333,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()

              ],
              [
                  'name' => 'Prof. Emad Elazazy',
                 'image' => 'https://www.index.ae/ichs/wp-content/uploads/2022/07/emad-elzazy.png',
                 'detail' => '',
                 'category_id' => 1,
                'credentails'=> 'PhD, PharmD ',
               'designation'=>'  Professor of Governance and Pharmaceutical Practices; CEO, Arab Academy for Excellence in Governance; Senior Healthcare Consultant; Secretary General, 65ian Healthcare Society (EHS) ',
                'country_id'=>  65 ,
                'job_title'=>'ICHS Congress Commissioner',
                'speciality_id' => 333,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()

              ],
              [
                  'name' => 'Dr. Ibrahim Al-Khars',
                 'image' => 'https://www.index.ae/ichs/wp-content/uploads/2022/07/ibrahim-khars.png',
                 'detail' => '',
                 'category_id' => 1,
                'credentails'=> ' MS, MBA ',
               'designation'=>'  Managing Director, Business Development Manager and Senior Consultant for People & Business Development Center ',
                'country_id'=>  194 ,
                'job_title'=>'ICHS Congress Commissioner',
                'speciality_id' => 333,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()

              ],
              [
                  'name' => 'Prof. Ibrahim A. Alsarra',
                 'image' => 'https://www.index.ae/ichs/wp-content/uploads/2022/07/ibrahim-alsarr.png',
                 'detail' => '',
                 'category_id' => 1,
                'credentails'=> ' PhD ',
               'designation'=>'  Professor of Pharmaceutics and Pharmaceutical Biotechnology, College of Pharmacy, King Saud University ',
                'country_id'=>  194 ,
                'job_title'=>'ICHS Congress Commissioner',
                'speciality_id' => 333,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()

              ],
              [
                  'name' => 'Mr. Mohammed Arfan Asif',
                 'image' => 'https://www.index.ae/ichs/wp-content/uploads/2022/08/Mr.Mohammed-Arfan-Asif.png',
                 'detail' => '',
                 'category_id' => 1,
                'credentails'=> ' M.Pharm. ',
               'designation'=>'  Senior Principal Pharmacist, Dubai Health Authority ',
                'country_id'=>  231 ,
                'job_title'=>'ICHS Congress Commissioner',
                'speciality_id' => 333,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()

              ],
              [
                  'name' => 'Prof. Paul W. Bush',
                 'image' => 'https://www.index.ae/ichs/wp-content/uploads/2022/07/paul-bush.png',
                 'detail' => '',
                 'category_id' => 1,
                'credentails'=> ' PharmD, MBA, BCPS, FASHP ',
               'designation'=>'  Vice President of Global Resource Development and Consulting, American Society of Health-System Pharmacists; Professor, University of North Carolina Eschelman School of Pharmacy ',
                'country_id'=>  233 ,
                'job_title'=>'ICHS Congress Commissioner',
                'speciality_id' => 333,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()

              ],
              [
                  'name' => 'Prof. Robert Sindelar',
                 'image' => 'https://www.index.ae/ichs/wp-content/uploads/2022/07/robert.png',
                 'detail' => '',
                 'category_id' => 1,
                'credentails'=> ' PhD, FCAHS ',
               'designation'=>'  Professor and Dean Emeritus, Faculty of Pharmaceutical Sciences, University of British Columbia ',
                'country_id'=>  39 ,
                'job_title'=>'ICHS Congress Commissioner',
                'speciality_id' => 333,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()

              ],
              [
                  'name' => 'Dr. Ashraf Mohammad Swidan',
                'image' =>'https://www.index.ae/ichs/wp-content/uploads/2022/07/ashraf-swidan.png',
                'detail' => '',
                'category_id' => 1,
                'credentails' =>'  FRCGP, DTM&H, MBchB ',
                'designation'=>'  Specialist Senior Family Physician, Doctor For Every Citizen, Primary Health Care Sector, Dubai Health Authority; Associate Professor, Dubai Medical College   ',
                'country_id'=>  231,
                'job_title'=>'ICHS Congress Commissioner',
                'speciality_id' => 68,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Dr. Aswathy Kumaran',
                'image' =>'https://www.index.ae/ichs/wp-content/uploads/2022/07/aswathy-kumaran.png',
                'detail' => '',
                'category_id' => 1,
                'credentails' =>'  MBBS, DGO, MS, DNB, FNB ',
                'designation'=>'  Consultant Reproductive Medicine, Aster MIRAKL, Department of Reproductive Medicine, Aster MIMS Hospital- Calicut India and Aster Wayanad Hospital  ',
                'country_id'=>  101,
                'job_title'=>'ICHS Education, Research and Innovation Faculty',
                'speciality_id' => 68,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Dr. Marcus Zanetti',
                'image' =>'https://www.index.ae/ichs/wp-content/uploads/2022/07/marcus-zanetti.png',
                'detail' => '',
                'category_id' => 1,
                'credentails' =>'  MD, PhD ',
                'designation'=>'  Professor, Research and Teaching Institute, Hospital Sírio-Libanês ',
                'country_id'=>  31 ,
                'job_title'=>'ICHS Congress Commissioner',
                'speciality_id' => 68,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Dr. Prasan Rao',
                'image' =>  'https://www.index.ae/ichs/wp-content/uploads/2022/07/prasan-rao.png',
                'detail' => '',
                'category_id' => 1,
                'credentails'=>  'MS, FRCS' ,
                'designation'=>  'Medical Director, Specialist Ophthalmologist & Vitreoretinal Surgeon, Medcare Eye Centre' ,
                'country_id'=>  231 ,
                'job_title'=>' ICHS Education, Research and Innovation Faculty',
                'speciality_id' => 271,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'image'=>'https://www.index.ae/ichs/wp-content/uploads/2022/07/sunil-raina.png',
                'detail' => '',
                'category_id' => 1,
                'name'=>'Dr. Sunil Raina',
                'credentails'=>' MD, FIAPSM' ,
                'designation'=>'Head, Department of Community Medicine, Tanda Medical College, Himachal Pradesh' ,
                'country_id'=>101 ,
                'job_title'=>'ICHS Congress Commissioner',
                'speciality_id' => 58,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'image'=>'https://www.index.ae/ichs/wp-content/uploads/2022/07/ramy-mansour.png',
                'detail' => '',
                'category_id' => 1,
                'name'=>' Dr. Ramy Mansour',
                'credentails'=>'  MB, ChB, MSc, FRCR',
                'designation'=>'  Consultant Musculoskeletal Radiologist, Clinical Lead of MSK Imaging, Oxford University Hospitals; RCR BSSR Travelling Professor',
                'country_id'=>  232,
                'job_title'=>'ICHS Congress Commissioner',
                'speciality_id' => 40,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'image'=>'https://www.index.ae/ichs/wp-content/uploads/2022/07/fuad.png',
                'detail' => '',
                'category_id' => 1,
                'name'=>'Dr.rer.nat. Fuad Ali Tarbah',
                'credentails'=>'',
                'designation'=>'Senior Forensic Toxicologist & Director of Training & Development, Crime Laboratory, Forensic Science and Criminology Department, Dubai Police',
                'country_id'=> 231,
                'job_title'=>'ICHS Education, Research and Innovation Faculty',
                'speciality_id' => 294,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
