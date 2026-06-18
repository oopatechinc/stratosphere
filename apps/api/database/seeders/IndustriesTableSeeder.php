<?php

namespace Database\Seeders;

use App\Models\Industry;
use App\Models\Vertical;
use App\Models\Template;
use Illuminate\Database\Seeder;

class IndustriesTableSeeder extends Seeder
{
    const INDUSTRIES = [
        'Beauty & Personal Care' => [
            'Hair Salons' => Vertical::VERTICAL_HAIR_SALONS,
            'Barber Shops' => Vertical::VERTICAL_BARBER_SHOPS,
            'Nail Salons' => Vertical::VERTICAL_NAIL_SALONS,
            'Spas' => Vertical::VERTICAL_SPAS,
            'Massage Therapy' => Vertical::VERTICAL_MASSAGE_THERAPY,
            'Estheticians' => Vertical::VERTICAL_ESTHETICIANS,
            'Makeup Artists' => Vertical::VERTICAL_MAKEUP_ARTISTS,
            'Tattoo & Piercing' => Vertical::VERTICAL_TATTOO_PIERCING,
            'Electrologists' => Vertical::VERTICAL_ELECTROLOGISTS
        ],
        'Health & Wellness' => [
            'Chiropractors' => Vertical::VERTICAL_CHIROPRACTORS,
            'Physiotherapists' => Vertical::VERTICAL_PHYSIOTHERAPISTS,
            'Acupuncturists' => Vertical::VERTICAL_ACUPUNCTURISTS,
            'Dieticians/Nutritionists' => Vertical::VERTICAL_DIETICIANS_NUTRITIONISTS,
            'Counseling & Therapy' => Vertical::VERTICAL_COUNSELING_THERAPY,
            'Medical Clinics' => Vertical::VERTICAL_MEDICAL_CLINICS,
            'Vaccination Services' => Vertical::VERTICAL_VACCINATION_SERVICES,
            'Telehealth Services' => Vertical::VERTICAL_TELEHEALTH_SERVICES,
            'Alternative Medicine' => Vertical::VERTICAL_ALTERNATIVE_MEDICINE
        ],
        'Fitness & Sports' => [
            'Personal Training' => Vertical::VERTICAL_PERSONAL_TRAINING,
            'Group Fitness Classes (Yoga, Pilates, Spin)' => Vertical::VERTICAL_GROUP_FITNESS_CLASSES,
            'Sports Coaching' => Vertical::VERTICAL_SPORTS_COACHING,
            'Martial Arts' => Vertical::VERTICAL_MARTIAL_ARTS
        ],
        'Professional Services' => [
            'Consulting' => Vertical::VERTICAL_CONSULTING,
            'Accountants' => Vertical::VERTICAL_ACCOUNTANTS,
            'Law Firms' => Vertical::VERTICAL_LAW_FIRMS,
            'Financial Advisors' => Vertical::VERTICAL_FINANCIAL_ADVISORS,
            'Tax Preparation' => Vertical::VERTICAL_TAX_PREPARATION,
            'Mortgage/Insurance Brokers' => Vertical::VERTICAL_MORTGAGE_INSURANCE_BROKERS,
            'HR Consulting' => Vertical::VERTICAL_HR_CONSULTING,
            'IT Consulting' => Vertical::VERTICAL_IT_CONSULTING,
            'Real Estate Agents' => Vertical::VERTICAL_REAL_ESTATE_AGENTS,
        ],
        'Education & Coaching' => [
            'Private Tutoring' => Vertical::VERTICAL_PRIVATE_TUTORING,
            'Language Lessons' => Vertical::VERTICAL_LANGUAGE_LESSONS,
            'Music/Art Lessons' => Vertical::VERTICAL_MUSIC_ART_LESSONS,
            'Test Preparation' => Vertical::VERTICAL_TEST_PREPARATION,
            'Career Coaching' => Vertical::VERTICAL_CAREER_COACHING,
            'Life Coaching' => Vertical::VERTICAL_LIFE_COACHING,
            'Driving Schools' => Vertical::VERTICAL_DRIVING_SCHOOLS
        ],
        'Home & Auto Services' => [
            'House Cleaning' => Vertical::VERTICAL_HOUSE_CLEANING,
            'Handyman Services' => Vertical::VERTICAL_HANDYMAN_SERVICES,
            'Plumbing' => Vertical::VERTICAL_PLUMBING,
            'Electrical' => Vertical::VERTICAL_ELECTRICAL,
            'HVAC Repair' => Vertical::VERTICAL_HVAC_REPAIR,
            'Home Inspection' => Vertical::VERTICAL_HOME_INSPECTION,
            'Appliance Repair' => Vertical::VERTICAL_APPLIANCE_REPAIR,
            'Car Repair/Maintenance' => Vertical::VERTICAL_CAR_REPAIR_MAINTENANCE,
            'Oil Changes' => Vertical::VERTICAL_OIL_CHANGES
        ],
        'Pet Services' => [
            'Pet Grooming' => Vertical::VERTICAL_PET_GROOMING,
            'Dog Training' => Vertical::VERTICAL_DOG_TRAINING,
            'Dog Walking/Sitting' => Vertical::VERTICAL_DOG_WALKING_SITTING,
            'Veterinary Appointments (non-emergency)' => Vertical::VERTICAL_VETERINARY_APPOINTMENTS_NON_EMERGENCY
        ],
        'Creative & Events' => [
            'Photographers' => Vertical::VERTICAL_PHOTOGRAPHERS,
            'Videographers' => Vertical::VERTICAL_VIDEOGRAPHERS,
            'Graphic Design Consultations' => Vertical::VERTICAL_GRAPHIC_DESIGN_CONSULTATIONS,
            'Event Planning Consultations' => Vertical::VERTICAL_EVENT_PLANNING_CONSULTATIONS,
            'Venue Rentals' => Vertical::VERTICAL_VENUE_RENTALS,
            'Art/Creative Workshops' => Vertical::VERTICAL_ART_CREATIVE_WORKSHOPS
        ],
        'Travel & Tourism' => [
            'Tour Operators' => Vertical::VERTICAL_TOUR_OPERATORS,
            'Activity Booking (Water Sports, Hikes)' => Vertical::VERTICAL_ACTIVITY_BOOKING,
            'Guided Experiences' => Vertical::VERTICAL_GUIDED_EXPERIENCES,
            'Travel Agency Consultations' => Vertical::VERTICAL_TRAVEL_AGENCY_CONSULTATIONS
        ]
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::INDUSTRIES as $industry => $verticals) {
            $industry = Industry::query()->create([
                'name' => $industry,
            ]);

            foreach ($verticals as $vertical => $tag) {
                Vertical::query()->create([
                    'industry_id' => $industry->id,
                    'name' => $vertical,
                    'tag' => $tag,
                ]);
            }
        }
    }
}
