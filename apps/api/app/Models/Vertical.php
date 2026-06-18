<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Vertical extends Model
{
    const VERTICAL_TAG_GENERAL = 'general';
    const VERTICAL_TAG_REAL_ESTATE = 'real_estate';

    const VERTICAL_HAIR_SALONS = 'hair_salons';
    const VERTICAL_BARBER_SHOPS = 'barber_shops';
    const VERTICAL_NAIL_SALONS = 'nail_salons';
    const VERTICAL_SPAS = 'spas';
    const VERTICAL_MASSAGE_THERAPY = 'massage_therapy';
    const VERTICAL_ESTHETICIANS = 'estheticians';
    const VERTICAL_MAKEUP_ARTISTS = 'makeup_artists';
    const VERTICAL_TATTOO_PIERCING = 'tattoo_piercing';
    const VERTICAL_ELECTROLOGISTS = 'electrologists';
    const VERTICAL_HEALTH_WELLNESS = 'health_wellness';
    const VERTICAL_CHIROPRACTORS = 'chiropractors';
    const VERTICAL_PHYSIOTHERAPISTS = 'physiotherapists';
    const VERTICAL_ACUPUNCTURISTS = 'acupuncturists';
    const VERTICAL_DIETICIANS_NUTRITIONISTS = 'dieticians_nutritionists';
    const VERTICAL_COUNSELING_THERAPY = 'counseling_therapy';
    const VERTICAL_MEDICAL_CLINICS = 'medical_clinics';
    const VERTICAL_VACCINATION_SERVICES = 'vaccination_services';
    const VERTICAL_TELEHEALTH_SERVICES = 'telehealth_services';
    const VERTICAL_ALTERNATIVE_MEDICINE = 'alternative_medicine';
    const VERTICAL_FITNESS_SPORTS = 'fitness_sports';
    const VERTICAL_PERSONAL_TRAINING = 'personal_training';
    const VERTICAL_GROUP_FITNESS_CLASSES = 'group_fitness_classes';
    const VERTICAL_SPORTS_COACHING = 'sports_coaching';
    const VERTICAL_MARTIAL_ARTS = 'martial_arts';
    const VERTICAL_PROFESSIONAL_SERVICES = 'professional_services';
    const VERTICAL_CONSULTING = 'consulting';
    const VERTICAL_ACCOUNTANTS = 'accountants';
    const VERTICAL_LAW_FIRMS = 'law_firms';
    const VERTICAL_FINANCIAL_ADVISORS = 'financial_advisors';
    const VERTICAL_TAX_PREPARATION = 'tax_preparation';
    const VERTICAL_MORTGAGE_INSURANCE_BROKERS = 'mortgage_insurance_brokers';
    const VERTICAL_HR_CONSULTING = 'hr_consulting';
    const VERTICAL_IT_CONSULTING = 'it_consulting';
    const VERTICAL_REAL_ESTATE_AGENTS = 'real_estate_agents';
    const VERTICAL_EDUCATION_COACHING = 'education_coaching';
    const VERTICAL_PRIVATE_TUTORING = 'private_tutoring';
    const VERTICAL_LANGUAGE_LESSONS = 'language_lessons';
    const VERTICAL_MUSIC_ART_LESSONS = 'music_art_lessons';
    const VERTICAL_TEST_PREPARATION = 'test_preparation';
    const VERTICAL_CAREER_COACHING = 'career_coaching';
    const VERTICAL_LIFE_COACHING = 'life_coaching';
    const VERTICAL_DRIVING_SCHOOLS = 'driving_schools';
    const VERTICAL_HOME_AUTO_SERVICES = 'home_auto_services';
    const VERTICAL_HOUSE_CLEANING = 'house_cleaning';
    const VERTICAL_HANDYMAN_SERVICES = 'handyman_services';
    const VERTICAL_PLUMBING = 'plumbing';
    const VERTICAL_ELECTRICAL = 'electrical';
    const VERTICAL_HVAC_REPAIR = 'hvac_repair';
    const VERTICAL_HOME_INSPECTION = 'home_inspection';
    const VERTICAL_APPLIANCE_REPAIR = 'appliance_repair';
    const VERTICAL_CAR_REPAIR_MAINTENANCE = 'car_repair_maintenance';
    const VERTICAL_OIL_CHANGES = 'oil_changes';
    const VERTICAL_PET_SERVICES = 'pet_services';
    const VERTICAL_PET_GROOMING = 'pet_grooming';
    const VERTICAL_DOG_TRAINING = 'dog_training';
    const VERTICAL_DOG_WALKING_SITTING = 'dog_walking_sitting';
    const VERTICAL_VETERINARY_APPOINTMENTS_NON_EMERGENCY = 'veterinary_appointments_non_emergency';
    const VERTICAL_CREATIVE_EVENTS = 'creative_events';
    const VERTICAL_PHOTOGRAPHERS = 'photographers';
    const VERTICAL_VIDEOGRAPHERS = 'videographers';
    const VERTICAL_GRAPHIC_DESIGN_CONSULTATIONS = 'graphic_design_consultations';
    const VERTICAL_EVENT_PLANNING_CONSULTATIONS = 'event_planning_consultations';
    const VERTICAL_VENUE_RENTALS = 'venue_rentals';
    const VERTICAL_ART_CREATIVE_WORKSHOPS = 'art_creative_workshops';
    const VERTICAL_TRAVEL_TOURISM = 'travel_tourism';
    const VERTICAL_TOUR_OPERATORS = 'tour_operators';
    const VERTICAL_ACTIVITY_BOOKING = 'activity_booking';
    const VERTICAL_GUIDED_EXPERIENCES = 'guided_experiences';
    const VERTICAL_TRAVEL_AGENCY_CONSULTATIONS = 'travel_agency_consultations';

    const GENERAL_VERTICALS = [
        self::VERTICAL_HAIR_SALONS,
        self::VERTICAL_BARBER_SHOPS,
        self::VERTICAL_NAIL_SALONS,
        self::VERTICAL_SPAS,
        self::VERTICAL_MASSAGE_THERAPY,
        self::VERTICAL_ESTHETICIANS,
        self::VERTICAL_MAKEUP_ARTISTS,
        self::VERTICAL_TATTOO_PIERCING,
        self::VERTICAL_ELECTROLOGISTS,
        self::VERTICAL_HEALTH_WELLNESS,
        self::VERTICAL_CHIROPRACTORS,
        self::VERTICAL_PHYSIOTHERAPISTS,
        self::VERTICAL_ACUPUNCTURISTS,
        self::VERTICAL_DIETICIANS_NUTRITIONISTS,
        self::VERTICAL_COUNSELING_THERAPY,
        self::VERTICAL_MEDICAL_CLINICS,
        self::VERTICAL_VACCINATION_SERVICES,
        self::VERTICAL_TELEHEALTH_SERVICES,
        self::VERTICAL_ALTERNATIVE_MEDICINE,
        self::VERTICAL_FITNESS_SPORTS,
        self::VERTICAL_PERSONAL_TRAINING,
        self::VERTICAL_GROUP_FITNESS_CLASSES,
        self::VERTICAL_SPORTS_COACHING,
        self::VERTICAL_MARTIAL_ARTS,
        self::VERTICAL_PROFESSIONAL_SERVICES,
        self::VERTICAL_CONSULTING,
        self::VERTICAL_ACCOUNTANTS,
        self::VERTICAL_LAW_FIRMS,
        self::VERTICAL_FINANCIAL_ADVISORS,
        self::VERTICAL_TAX_PREPARATION,
        self::VERTICAL_MORTGAGE_INSURANCE_BROKERS,
        self::VERTICAL_HR_CONSULTING,
        self::VERTICAL_IT_CONSULTING,
        self::VERTICAL_EDUCATION_COACHING,
        self::VERTICAL_PRIVATE_TUTORING,
        self::VERTICAL_LANGUAGE_LESSONS,
        self::VERTICAL_MUSIC_ART_LESSONS,
        self::VERTICAL_TEST_PREPARATION,
        self::VERTICAL_CAREER_COACHING,
        self::VERTICAL_LIFE_COACHING,
        self::VERTICAL_DRIVING_SCHOOLS,
        self::VERTICAL_HOME_AUTO_SERVICES,
        self::VERTICAL_HOUSE_CLEANING,
        self::VERTICAL_HANDYMAN_SERVICES,
        self::VERTICAL_PLUMBING,
        self::VERTICAL_ELECTRICAL,
        self::VERTICAL_HVAC_REPAIR,
        self::VERTICAL_HOME_INSPECTION,
        self::VERTICAL_APPLIANCE_REPAIR,
        self::VERTICAL_CAR_REPAIR_MAINTENANCE,
        self::VERTICAL_OIL_CHANGES,
        self::VERTICAL_PET_SERVICES,
        self::VERTICAL_PET_GROOMING,
        self::VERTICAL_DOG_TRAINING,
        self::VERTICAL_DOG_WALKING_SITTING,
        self::VERTICAL_VETERINARY_APPOINTMENTS_NON_EMERGENCY,
        self::VERTICAL_CREATIVE_EVENTS,
        self::VERTICAL_PHOTOGRAPHERS,
        self::VERTICAL_VIDEOGRAPHERS,
        self::VERTICAL_GRAPHIC_DESIGN_CONSULTATIONS,
        self::VERTICAL_EVENT_PLANNING_CONSULTATIONS,
        self::VERTICAL_VENUE_RENTALS,
        self::VERTICAL_ART_CREATIVE_WORKSHOPS,
        self::VERTICAL_TRAVEL_TOURISM,
        self::VERTICAL_TOUR_OPERATORS,
        self::VERTICAL_ACTIVITY_BOOKING,
        self::VERTICAL_GUIDED_EXPERIENCES,
        self::VERTICAL_TRAVEL_AGENCY_CONSULTATIONS,
    ];

    const REAL_ESTATE_VERTICALS = [
        self::VERTICAL_REAL_ESTATE_AGENTS
    ];


    public function industry(): BelongsTo
    {
        return $this->belongsTo(Industry::class);
    }

    public function templates(): BelongsToMany
    {
        return $this->belongsToMany(Template::class)->withTimestamps();
    }
}
