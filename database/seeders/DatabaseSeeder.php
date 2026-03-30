<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\DoctorAward;
use App\Models\DoctorClinicImage;
use App\Models\DoctorEducation;
use App\Models\DoctorExperience;
use App\Models\DoctorMembership;
use App\Models\DoctorRegistration;
use App\Models\DoctorService;
use App\Models\DoctorSpecialization;
use App\Models\Patient;
use App\Models\PatientFavourite;
use App\Models\Section;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'System Administrator',
                'mobile' => '0600000000',
                'address' => 'Head Office, Casablanca',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        $sectionNames = [
            'Cardiology',
            'Dermatology',
            'Dentistry',
            'Neurology',
            'Pediatrics',
            'Orthopedics',
            'Gynecology',
            'Ophthalmology',
        ];

        $sections = collect($sectionNames)
            ->mapWithKeys(fn (string $name) => [
                $name => Section::firstOrCreate(['name' => $name]),
            ]);

        $specialties = collect($sectionNames)
            ->mapWithKeys(fn (string $name) => [
                $name => Specialty::firstOrCreate(['name' => $name]),
            ]);

        $doctorProfiles = [
            [
                'first_name' => 'Youssef',
                'last_name' => 'Alaoui',
                'email' => 'dr.youssef.alaoui@example.com',
                'mobile' => '0610000001',
                'gender' => 'male',
                'city' => 'Casablanca',
                'clinic_name' => 'Centre Coeur Atlas',
                'clinic_address' => '22 Boulevard Zerktouni, Casablanca',
                'section' => 'Cardiology',
                'specialty' => 'Cardiology',
                'price' => 420,
                'is_free' => false,
                'rating' => 4.8,
                'total_reviews' => 156,
                'biography' => 'Cardiologist with strong experience in preventive cardiology and echocardiography.',
            ],
            [
                'first_name' => 'Salma',
                'last_name' => 'Bennani',
                'email' => 'dr.salma.bennani@example.com',
                'mobile' => '0610000002',
                'gender' => 'female',
                'city' => 'Rabat',
                'clinic_name' => 'SkinCare Rabat',
                'clinic_address' => '15 Avenue Fal Ould Oumeir, Rabat',
                'section' => 'Dermatology',
                'specialty' => 'Dermatology',
                'price' => 350,
                'is_free' => false,
                'rating' => 4.7,
                'total_reviews' => 131,
                'biography' => 'Dermatologist focused on acne management, dermatitis, and skin cancer screening.',
            ],
            [
                'first_name' => 'Karim',
                'last_name' => 'Chraibi',
                'email' => 'dr.karim.chraibi@example.com',
                'mobile' => '0610000003',
                'gender' => 'male',
                'city' => 'Marrakesh',
                'clinic_name' => 'Dental Smile Clinic',
                'clinic_address' => '9 Rue de la Liberte, Marrakesh',
                'section' => 'Dentistry',
                'specialty' => 'Dentistry',
                'price' => 300,
                'is_free' => false,
                'rating' => 4.6,
                'total_reviews' => 98,
                'biography' => 'General dentist specialized in implants, cosmetic dentistry, and oral surgery.',
            ],
            [
                'first_name' => 'Nora',
                'last_name' => 'Tazi',
                'email' => 'dr.nora.tazi@example.com',
                'mobile' => '0610000004',
                'gender' => 'female',
                'city' => 'Fes',
                'clinic_name' => 'Neuro Plus Fes',
                'clinic_address' => '31 Avenue Hassan II, Fes',
                'section' => 'Neurology',
                'specialty' => 'Neurology',
                'price' => 460,
                'is_free' => false,
                'rating' => 4.9,
                'total_reviews' => 112,
                'biography' => 'Neurologist managing headache disorders, epilepsy, and neuropathies.',
            ],
            [
                'first_name' => 'Imane',
                'last_name' => 'Saidi',
                'email' => 'dr.imane.saidi@example.com',
                'mobile' => '0610000005',
                'gender' => 'female',
                'city' => 'Tangier',
                'clinic_name' => 'Kids Health Tangier',
                'clinic_address' => '40 Route de Tetouan, Tangier',
                'section' => 'Pediatrics',
                'specialty' => 'Pediatrics',
                'price' => 280,
                'is_free' => true,
                'rating' => 4.5,
                'total_reviews' => 87,
                'biography' => 'Pediatrician providing preventive care, vaccination follow-up, and acute consultations.',
            ],
            [
                'first_name' => 'Hamza',
                'last_name' => 'El Idrissi',
                'email' => 'dr.hamza.elidrissi@example.com',
                'mobile' => '0610000006',
                'gender' => 'male',
                'city' => 'Agadir',
                'clinic_name' => 'OrthoMove Agadir',
                'clinic_address' => '18 Avenue Hassan I, Agadir',
                'section' => 'Orthopedics',
                'specialty' => 'Orthopedics',
                'price' => 390,
                'is_free' => false,
                'rating' => 4.6,
                'total_reviews' => 73,
                'biography' => 'Orthopedic surgeon handling sports injuries, knee pain, and fracture follow-up.',
            ],
            [
                'first_name' => 'Meryem',
                'last_name' => 'Rami',
                'email' => 'dr.meryem.rami@example.com',
                'mobile' => '0610000007',
                'gender' => 'female',
                'city' => 'Meknes',
                'clinic_name' => 'Femina Care Meknes',
                'clinic_address' => '12 Rue Al Massira, Meknes',
                'section' => 'Gynecology',
                'specialty' => 'Gynecology',
                'price' => 340,
                'is_free' => false,
                'rating' => 4.7,
                'total_reviews' => 145,
                'biography' => 'Gynecologist with focus on prenatal care, fertility counseling, and menopause management.',
            ],
            [
                'first_name' => 'Rachid',
                'last_name' => 'Bouzidi',
                'email' => 'dr.rachid.bouzidi@example.com',
                'mobile' => '0610000008',
                'gender' => 'male',
                'city' => 'Oujda',
                'clinic_name' => 'Vision Oujda Center',
                'clinic_address' => '5 Boulevard Mohammed V, Oujda',
                'section' => 'Ophthalmology',
                'specialty' => 'Ophthalmology',
                'price' => 310,
                'is_free' => false,
                'rating' => 4.4,
                'total_reviews' => 62,
                'biography' => 'Ophthalmologist specialized in cataract screening and diabetic retinopathy follow-up.',
            ],
        ];

        $doctors = collect();

        foreach ($doctorProfiles as $index => $profile) {
            $doctorUser = User::updateOrCreate(
                ['email' => $profile['email']],
                [
                    'name' => 'Dr. '.$profile['first_name'].' '.$profile['last_name'],
                    'mobile' => $profile['mobile'],
                    'address' => $profile['clinic_address'],
                    'password' => Hash::make('password'),
                    'role' => 'doctor',
                    'email_verified_at' => now(),
                ]
            );

            $username = Str::lower('dr.'.Str::slug($profile['first_name'].' '.$profile['last_name'], '.'));

            $doctor = Doctor::updateOrCreate(
                ['user_id' => $doctorUser->id],
                [
                    'username' => $username,
                    'email' => $profile['email'],
                    'first_name' => $profile['first_name'],
                    'last_name' => $profile['last_name'],
                    'phone' => $profile['mobile'],
                    'gender' => $profile['gender'],
                    'date_of_birth' => Carbon::parse('1980-01-01')->addYears($index * 2 + 2)->toDateString(),
                    'biography' => $profile['biography'],
                    'clinic_name' => $profile['clinic_name'],
                    'clinic_address' => $profile['clinic_address'],
                    'address_line_1' => $profile['clinic_address'],
                    'address_line_2' => null,
                    'city' => $profile['city'],
                    'state' => $profile['city'],
                    'country' => 'Morocco',
                    'postal_code' => str_pad((string) (10000 + ($index * 157)), 5, '0', STR_PAD_LEFT),
                    'speciality' => $profile['specialty'],
                    'section_id' => $sections[$profile['section']]->id,
                    'specialty_id' => $specialties[$profile['specialty']]->id,
                    'price' => $profile['price'],
                    'is_free' => $profile['is_free'],
                    'rating' => $profile['rating'],
                    'total_reviews' => $profile['total_reviews'],
                    'image' => null,
                ]
            );

            $this->refreshDoctorProfileData($doctor);
            $doctors->push($doctor);
        }

        $patientProfiles = [
            ['first_name' => 'Amina', 'last_name' => 'Lamrani', 'city' => 'Casablanca', 'email' => 'amina.lamrani@example.com', 'mobile' => '0671000001', 'dob' => '1995-03-18'],
            ['first_name' => 'Sofiane', 'last_name' => 'Berrada', 'city' => 'Rabat', 'email' => 'sofiane.berrada@example.com', 'mobile' => '0671000002', 'dob' => '1991-11-02'],
            ['first_name' => 'Khadija', 'last_name' => 'Ouazzani', 'city' => 'Fes', 'email' => 'khadija.ouazzani@example.com', 'mobile' => '0671000003', 'dob' => '1988-07-24'],
            ['first_name' => 'Mehdi', 'last_name' => 'Idbihi', 'city' => 'Marrakesh', 'email' => 'mehdi.idbihi@example.com', 'mobile' => '0671000004', 'dob' => '1993-04-10'],
            ['first_name' => 'Asmae', 'last_name' => 'Zerouali', 'city' => 'Tangier', 'email' => 'asmae.zerouali@example.com', 'mobile' => '0671000005', 'dob' => '1997-09-01'],
            ['first_name' => 'Omar', 'last_name' => 'Fassi', 'city' => 'Agadir', 'email' => 'omar.fassi@example.com', 'mobile' => '0671000006', 'dob' => '1985-06-15'],
            ['first_name' => 'Houda', 'last_name' => 'Rafik', 'city' => 'Meknes', 'email' => 'houda.rafik@example.com', 'mobile' => '0671000007', 'dob' => '1992-12-20'],
            ['first_name' => 'Yassine', 'last_name' => 'Najjar', 'city' => 'Oujda', 'email' => 'yassine.najjar@example.com', 'mobile' => '0671000008', 'dob' => '1990-02-08'],
            ['first_name' => 'Nadia', 'last_name' => 'Tafraouti', 'city' => 'Tetouan', 'email' => 'nadia.tafraouti@example.com', 'mobile' => '0671000009', 'dob' => '1998-08-13'],
            ['first_name' => 'Anas', 'last_name' => 'Mouline', 'city' => 'Kenitra', 'email' => 'anas.mouline@example.com', 'mobile' => '0671000010', 'dob' => '1994-05-29'],
            ['first_name' => 'Laila', 'last_name' => 'Jabri', 'city' => 'Safi', 'email' => 'laila.jabri@example.com', 'mobile' => '0671000011', 'dob' => '1989-01-17'],
            ['first_name' => 'Zakaria', 'last_name' => 'Bouchra', 'city' => 'El Jadida', 'email' => 'zakaria.bouchra@example.com', 'mobile' => '0671000012', 'dob' => '1996-10-06'],
        ];

        $patients = collect();

        foreach ($patientProfiles as $profile) {
            $patientUser = User::updateOrCreate(
                ['email' => $profile['email']],
                [
                    'name' => $profile['first_name'].' '.$profile['last_name'],
                    'mobile' => $profile['mobile'],
                    'address' => $profile['city'].', Morocco',
                    'password' => Hash::make('password'),
                    'role' => 'patient',
                    'email_verified_at' => now(),
                ]
            );

            $patient = Patient::updateOrCreate(
                ['user_id' => $patientUser->id],
                [
                    'first_name' => $profile['first_name'],
                    'last_name' => $profile['last_name'],
                    'phone' => $profile['mobile'],
                    'date_of_birth' => $profile['dob'],
                    'city' => $profile['city'],
                    'country' => 'Morocco',
                    'image' => null,
                ]
            );

            $patients->push($patient);
        }

        $statusPattern = ['pending', 'approved', 'completed', 'cancelled'];

        foreach ($patients as $index => $patient) {
            $doctor = $doctors[$index % $doctors->count()];
            $consultingFee = (float) $doctor->price;
            $bookingFee = 20.0;
            $videoFee = $index % 3 === 0 ? 40.0 : 0.0;
            $date = Carbon::today()->subDays(6)->addDays($index);

            Appointment::updateOrCreate(
                [
                    'patient_id' => $patient->id,
                    'doctor_id' => $doctor->id,
                    'appointment_date' => $date->toDateString(),
                    'appointment_time' => sprintf('%02d:00:00', 9 + ($index % 8)),
                ],
                [
                    'consulting_fee' => $consultingFee,
                    'booking_fee' => $bookingFee,
                    'video_fee' => $videoFee,
                    'total' => $consultingFee + $bookingFee + $videoFee,
                    'status' => $statusPattern[$index % count($statusPattern)],
                ]
            );

            if ($index % 2 === 0) {
                PatientFavourite::firstOrCreate([
                    'patient_id' => $patient->id,
                    'doctor_id' => $doctor->id,
                ]);
            }
        }
    }

    private function refreshDoctorProfileData(Doctor $doctor): void
    {
        DoctorService::where('doctor_id', $doctor->id)->delete();
        DoctorSpecialization::where('doctor_id', $doctor->id)->delete();
        DoctorEducation::where('doctor_id', $doctor->id)->delete();
        DoctorExperience::where('doctor_id', $doctor->id)->delete();
        DoctorAward::where('doctor_id', $doctor->id)->delete();
        DoctorMembership::where('doctor_id', $doctor->id)->delete();
        DoctorRegistration::where('doctor_id', $doctor->id)->delete();
        DoctorClinicImage::where('doctor_id', $doctor->id)->delete();

        $fullName = trim($doctor->first_name.' '.$doctor->last_name);

        DoctorService::insert([
            ['doctor_id' => $doctor->id, 'service' => 'General consultation', 'created_at' => now(), 'updated_at' => now()],
            ['doctor_id' => $doctor->id, 'service' => 'Follow-up consultation', 'created_at' => now(), 'updated_at' => now()],
            ['doctor_id' => $doctor->id, 'service' => 'Medical report review', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DoctorSpecialization::create([
            'doctor_id' => $doctor->id,
            'specialization' => $doctor->speciality ?? 'General Medicine',
        ]);

        DoctorEducation::create([
            'doctor_id' => $doctor->id,
            'degree' => 'MD - Faculty of Medicine',
            'college' => 'Mohammed V University',
            'year_of_completion' => '2012',
        ]);

        DoctorExperience::insert([
            [
                'doctor_id' => $doctor->id,
                'hospital_name' => 'University Hospital Center',
                'from' => '2013',
                'to' => '2018',
                'designation' => 'Resident Doctor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'doctor_id' => $doctor->id,
                'hospital_name' => $doctor->clinic_name ?? 'Private Clinic',
                'from' => '2018',
                'to' => 'Present',
                'designation' => 'Consultant Specialist',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DoctorAward::create([
            'doctor_id' => $doctor->id,
            'award' => 'Best Specialist Care Award',
            'year' => '2024',
        ]);

        DoctorMembership::create([
            'doctor_id' => $doctor->id,
            'membership' => 'Moroccan Medical Association',
        ]);

        DoctorRegistration::create([
            'doctor_id' => $doctor->id,
            'registration' => 'National Medical Council - '.$fullName,
            'year' => '2013',
        ]);

        DoctorClinicImage::insert([
            ['doctor_id' => $doctor->id, 'image' => 'front-end/assets/img/clinic/clinic-01.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['doctor_id' => $doctor->id, 'image' => 'front-end/assets/img/clinic/clinic-02.jpg', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
