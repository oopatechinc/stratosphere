<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    const ISO_AFGHANISTAN_AF = "AF";
    const ISO_ALAND_ISLANDS_AX = "AX";
    const ISO_ALBANIA_AL = "AL";
    const ISO_ALGERIA_DZ = "DZ";
    const ISO_AMERICAN_SAMOA_AS = "AS";
    const ISO_ANDORRA_AD = "AD";
    const ISO_ANGOLA_AO = "AO";
    const ISO_ANGUILLA_AI = "AI";
    const ISO_ANTARCTICA_AQ = "AQ";
    const ISO_ANTIGUA_AND_BARBUDA_AG = "AG";
    const ISO_ARGENTINA_AR = "AR";
    const ISO_ARMENIA_AM = "AM";
    const ISO_ARUBA_AW = "AW";
    const ISO_AUSTRALIA_AU = "AU";
    const ISO_AUSTRIA_AT = "AT";
    const ISO_AZERBAIJAN_AZ = "AZ";
    const ISO_BAHAMAS_BS = "BS";
    const ISO_BAHRAIN_BH = "BH";
    const ISO_BANGLADESH_BD = "BD";
    const ISO_BARBADOS_BB = "BB";
    const ISO_BELARUS_BY = "BY";
    const ISO_BELGIUM_BE = "BE";
    const ISO_BELIZE_BZ = "BZ";
    const ISO_BENIN_BJ = "BJ";
    const ISO_BERMUDA_BM = "BM";
    const ISO_BHUTAN_BT = "BT";
    const ISO_BOLIVIA_BO = "BO";
    const ISO_BOSNIA_AND_HERZEGOVINA_BA = "BA";
    const ISO_BOTSWANA_BW = "BW";
    const ISO_BOUVET_ISLAND_BV = "BV";
    const ISO_BRAZIL_BR = "BR";
    const ISO_BRITISH_ANTARCTIC_TERRITORY_BQ = "BQ";
    const ISO_BRITISH_INDIAN_OCEAN_TERRITORY_IO = "IO";
    const ISO_BRITISH_VIRGIN_ISLANDS_VG = "VG";
    const ISO_BRUNEI_BN = "BN";
    const ISO_BULGARIA_BG = "BG";
    const ISO_BURKINA_FASO_BF = "BF";
    const ISO_BURUNDI_BI = "BI";
    const ISO_CAMBODIA_KH = "KH";
    const ISO_CAMEROON_CM = "CM";
    const ISO_CANADA_CA = "CA";
    const ISO_CANTON_AND_ENDERBURY_ISLANDS_CT = "CT";
    const ISO_CAPE_VERDE_CV = "CV";
    const ISO_CAYMAN_ISLANDS_KY = "KY";
    const ISO_CENTRAL_AFRICAN_REPUBLIC_CF = "CF";
    const ISO_CHAD_TD = "TD";
    const ISO_CHILE_CL = "CL";
    const ISO_CHINA_CN = "CN";
    const ISO_CHRISTMAS_ISLAND_CX = "CX";
    const ISO_COCOS_ISLANDS_CC = "CC";
    const ISO_COLOMBIA_CO = "CO";
    const ISO_COMOROS_KM = "KM";
    const ISO_CONGO_BRAZZAVILLE_CG = "CG";
    const ISO_CONGO_KINSHASA_CD = "CD";
    const ISO_COOK_ISLANDS_CK = "CK";
    const ISO_COSTA_RICA_CR = "CR";
    const ISO_CROATIA_HR = "HR";
    const ISO_CUBA_CU = "CU";
    const ISO_CYPRUS_CY = "CY";
    const ISO_CZECH_REPUBLIC_CZ = "CZ";
    const ISO_COTE_D_IVOIRE_CI = "CI";
    const ISO_DENMARK_DK = "DK";
    const ISO_DJIBOUTI_DJ = "DJ";
    const ISO_DOMINICA_DM = "DM";
    const ISO_DOMINICAN_REPUBLIC_DO = "DO";
    const ISO_DRONNING_MAUD_LAND_NQ = "NQ";
    const ISO_EAST_GERMANY_DD = "DD";
    const ISO_ECUADOR_EC = "EC";
    const ISO_EGYPT_EG = "EG";
    const ISO_EL_SALVADOR_SV = "SV";
    const ISO_EQUATORIAL_GUINEA_GQ = "GQ";
    const ISO_ERITREA_ER = "ER";
    const ISO_ESTONIA_EE = "EE";
    const ISO_ETHIOPIA_ET = "ET";
    const ISO_FALKLAND_ISLANDS_FK = "FK";
    const ISO_FAROE_ISLANDS_FO = "FO";
    const ISO_FIJI_FJ = "FJ";
    const ISO_FINLAND_FI = "FI";
    const ISO_FRANCE_FR = "FR";
    const ISO_FRENCH_GUIANA_GF = "GF";
    const ISO_FRENCH_POLYNESIA_PF = "PF";
    const ISO_FRENCH_SOUTHERN_TERRITORIES_TF = "TF";
    const ISO_FRENCH_SOUTHERN_AND_ANTARCTIC_TERRITORIES_FQ = "FQ";
    const ISO_GABON_GA = "GA";
    const ISO_GAMBIA_GM = "GM";
    const ISO_GEORGIA_GE = "GE";
    const ISO_GERMANY_DE = "DE";
    const ISO_GHANA_GH = "GH";
    const ISO_GIBRALTAR_GI = "GI";
    const ISO_GREECE_GR = "GR";
    const ISO_GREENLAND_GL = "GL";
    const ISO_GRENADA_GD = "GD";
    const ISO_GUADELOUPE_GP = "GP";
    const ISO_GUAM_GU = "GU";
    const ISO_GUATEMALA_GT = "GT";
    const ISO_GUERNSEY_GG = "GG";
    const ISO_GUINEA_GN = "GN";
    const ISO_GUINEA_BISSAU_GW = "GW";
    const ISO_GUYANA_GY = "GY";
    const ISO_HAITI_HT = "HT";
    const ISO_HEARD_ISLAND_AND_MCDONALD_ISLANDS_HM = "HM";
    const ISO_HONDURAS_HN = "HN";
    const ISO_HONG_KONG_SAR_CHINA_HK = "HK";
    const ISO_HUNGARY_HU = "HU";
    const ISO_ICELAND_IS = "IS";
    const ISO_INDIA_IN = "IN";
    const ISO_INDONESIA_ID = "ID";
    const ISO_IRAN_IR = "IR";
    const ISO_IRAQ_IQ = "IQ";
    const ISO_IRELAND_IE = "IE";
    const ISO_ISLE_OF_MAN_IM = "IM";
    const ISO_ISRAEL_IL = "IL";
    const ISO_ITALY_IT = "IT";
    const ISO_JAMAICA_JM = "JM";
    const ISO_JAPAN_JP = "JP";
    const ISO_JERSEY_JE = "JE";
    const ISO_JOHNSTON_ISLAND_JT = "JT";
    const ISO_JORDAN_JO = "JO";
    const ISO_KAZAKHSTAN_KZ = "KZ";
    const ISO_KENYA_KE = "KE";
    const ISO_KIRIBATI_KI = "KI";
    const ISO_KUWAIT_KW = "KW";
    const ISO_KYRGYZSTAN_KG = "KG";
    const ISO_LAOS_LA = "LA";
    const ISO_LATVIA_LV = "LV";
    const ISO_LEBANON_LB = "LB";
    const ISO_LESOTHO_LS = "LS";
    const ISO_LIBERIA_LR = "LR";
    const ISO_LIBYA_LY = "LY";
    const ISO_LIECHTENSTEIN_LI = "LI";
    const ISO_LITHUANIA_LT = "LT";
    const ISO_LUXEMBOURG_LU = "LU";
    const ISO_MACAU_SAR_CHINA_MO = "MO";
    const ISO_MACEDONIA_MK = "MK";
    const ISO_MADAGASCAR_MG = "MG";
    const ISO_MALAWI_MW = "MW";
    const ISO_MALAYSIA_MY = "MY";
    const ISO_MALDIVES_MV = "MV";
    const ISO_MALI_ML = "ML";
    const ISO_MALTA_MT = "MT";
    const ISO_MARSHALL_ISLANDS_MH = "MH";
    const ISO_MARTINIQUE_MQ = "MQ";
    const ISO_MAURITANIA_MR = "MR";
    const ISO_MAURITIUS_MU = "MU";
    const ISO_MAYOTTE_YT = "YT";
    const ISO_METROPOLITAN_FRANCE_FX = "FX";
    const ISO_MEXICO_MX = "MX";
    const ISO_MICRONESIA_FM = "FM";
    const ISO_MIDWAY_ISLANDS_MI = "MI";
    const ISO_MOLDOVA_MD = "MD";
    const ISO_MONACO_MC = "MC";
    const ISO_MONGOLIA_MN = "MN";
    const ISO_MONTENEGRO_ME = "ME";
    const ISO_MONTSERRAT_MS = "MS";
    const ISO_MOROCCO_MA = "MA";
    const ISO_MOZAMBIQUE_MZ = "MZ";
    const ISO_MYANMAR_BURMA_MM = "MM";
    const ISO_NAMIBIA_NA = "NA";
    const ISO_NAURU_NR = "NR";
    const ISO_NEPAL_NP = "NP";
    const ISO_NETHERLANDS_NL = "NL";
    const ISO_NETHERLANDS_ANTILLES_AN = "AN";
    const ISO_NEUTRAL_ZONE_NT = "NT";
    const ISO_NEW_CALEDONIA_NC = "NC";
    const ISO_NEW_ZEALAND_NZ = "NZ";
    const ISO_NICARAGUA_NI = "NI";
    const ISO_NIGER_NE = "NE";
    const ISO_NIGERIA_NG = "NG";
    const ISO_NIUE_NU = "NU";
    const ISO_NORFOLK_ISLAND_NF = "NF";
    const ISO_NORTH_KOREA_KP = "KP";
    const ISO_NORTH_VIETNAM_VD = "VD";
    const ISO_NORTHERN_MARIANA_ISLANDS_MP = "MP";
    const ISO_NORWAY_NO = "NO";
    const ISO_OMAN_OM = "OM";
    const ISO_PACIFIC_ISLANDS_TRUST_TERRITORY_PC = "PC";
    const ISO_PAKISTAN_PK = "PK";
    const ISO_PALAU_PW = "PW";
    const ISO_PALESTINIAN_TERRITORIES_PS = "PS";
    const ISO_PANAMA_PA = "PA";
    const ISO_PANAMA_CANAL_ZONE_PZ = "PZ";
    const ISO_PAPUA_NEW_GUINEA_PG = "PG";
    const ISO_PARAGUAY_PY = "PY";
    const ISO_PEOPLES_DEMOCRATIC_REPUBLIC_OF_YEMEN_YD = "YD";
    const ISO_PERU_PE = "PE";
    const ISO_PHILIPPINES_PH = "PH";
    const ISO_PITCAIRN_ISLANDS_PN = "PN";
    const ISO_POLAND_PL = "PL";
    const ISO_PORTUGAL_PT = "PT";
    const ISO_PUERTO_RICO_PR = "PR";
    const ISO_QATAR_QA = "QA";
    const ISO_ROMANIA_RO = "RO";
    const ISO_RUSSIA_RU = "RU";
    const ISO_RWANDA_RW = "RW";
    const ISO_REUNION_RE = "RE";
    const ISO_SAINT_BARTHELEMY_BL = "BL";
    const ISO_SAINT_HELENA_SH = "SH";
    const ISO_SAINT_KITTS_AND_NEVIS_KN = "KN";
    const ISO_SAINT_LUCIA_LC = "LC";
    const ISO_SAINT_MARTIN_MF = "MF";
    const ISO_SAINT_PIERRE_AND_MIQUELON_PM = "PM";
    const ISO_SAINT_VINCENT_AND_THE_GRENADINES_VC = "VC";
    const ISO_SAMOA_WS = "WS";
    const ISO_SAN_MARINO_SM = "SM";
    const ISO_SAUDI_ARABIA_SA = "SA";
    const ISO_SENEGAL_SN = "SN";
    const ISO_SERBIA_RS = "RS";
    const ISO_SERBIA_AND_MONTENEGRO_CS = "CS";
    const ISO_SEYCHELLES_SC = "SC";
    const ISO_SIERRA_LEONE_SL = "SL";
    const ISO_SINGAPORE_SG = "SG";
    const ISO_SLOVAKIA_SK = "SK";
    const ISO_SLOVENIA_SI = "SI";
    const ISO_SOLOMON_ISLANDS_SB = "SB";
    const ISO_SOMALIA_SO = "SO";
    const ISO_SOUTH_AFRICA_ZA = "ZA";
    const ISO_SOUTH_GEORGIA_AND_THE_SOUTH_SANDWICH_ISLANDS_GS = "GS";
    const ISO_SOUTH_KOREA_KR = "KR";
    const ISO_SPAIN_ES = "ES";
    const ISO_SRI_LANKA_LK = "LK";
    const ISO_SUDAN_SD = "SD";
    const ISO_SURINAME_SR = "SR";
    const ISO_SVALBARD_AND_JAN_MAYEN_SJ = "SJ";
    const ISO_SWAZILAND_SZ = "SZ";
    const ISO_SWEDEN_SE = "SE";
    const ISO_SWITZERLAND_CH = "CH";
    const ISO_SYRIA_SY = "SY";
    const ISO_SAO_TOME_AND_PRINCIPE_ST = "ST";
    const ISO_TAIWAN_TW = "TW";
    const ISO_TAJIKISTAN_TJ = "TJ";
    const ISO_TANZANIA_TZ = "TZ";
    const ISO_THAILAND_TH = "TH";
    const ISO_TIMOR_LESTE_TL = "TL";
    const ISO_TOGO_TG = "TG";
    const ISO_TOKELAU_TK = "TK";
    const ISO_TONGA_TO = "TO";
    const ISO_TRINIDAD_AND_TOBAGO_TT = "TT";
    const ISO_TUNISIA_TN = "TN";
    const ISO_TURKEY_TR = "TR";
    const ISO_TURKMENISTAN_TM = "TM";
    const ISO_TURKS_AND_CAICOS_ISLANDS_TC = "TC";
    const ISO_TUVALU_TV = "TV";
    const ISO_US_MINOR_OUTLYING_ISLANDS_UM = "UM";
    const ISO_US_MISCELLANEOUS_PACIFIC_ISLANDS_PU = "PU";
    const ISO_US_VIRGIN_ISLANDS_VI = "VI";
    const ISO_UGANDA_UG = "UG";
    const ISO_UKRAINE_UA = "UA";
    const ISO_UNION_OF_SOVIET_SOCIALIST_REPUBLICS_SU = "SU";
    const ISO_UNITED_ARAB_EMIRATES_AE = "AE";
    const ISO_UNITED_KINGDOM_GB = "GB";
    const ISO_UNITED_STATES_US = "US";
    const ISO_UNKNOWN_OR_INVALID_REGION_ZZ = "ZZ";
    const ISO_URUGUAY_UY = "UY";
    const ISO_UZBEKISTAN_UZ = "UZ";
    const ISO_VANUATU_VU = "VU";
    const ISO_VATICAN_CITY_VA = "VA";
    const ISO_VENEZUELA_VE = "VE";
    const ISO_VIETNAM_VN = "VN";
    const ISO_WAKE_ISLAND_WK = "WK";
    const ISO_WALLIS_AND_FUTUNA_WF = "WF";
    const ISO_WESTERN_SAHARA_EH = "EH";
    const ISO_YEMEN_YE = "YE";
    const ISO_ZAMBIA_ZM = "ZM";
    const ISO_ZIMBABWE_ZW = "ZW";

    const COUNTRIES = [
        self::ISO_AFGHANISTAN_AF => [
            "name" => "Afghanistan",
            "geographical_unit_name" => "province"
        ],
        self::ISO_ALAND_ISLANDS_AX => [
            "name" => "Åland Islands",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_ALBANIA_AL => [
            "name" => "Albania",
            "geographical_unit_name" => "county"
        ],
        self::ISO_ALGERIA_DZ => [
            "name" => "Algeria",
            "geographical_unit_name" => "province"
        ],
        self::ISO_AMERICAN_SAMOA_AS => [
            "name" => "American Samoa",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_ANDORRA_AD => [
            "name" => "Andorra",
            "geographical_unit_name" => "parish"
        ],
        self::ISO_ANGOLA_AO => [
            "name" => "Angola",
            "geographical_unit_name" => "province"
        ],
        self::ISO_ANGUILLA_AI => [
            "name" => "Anguilla",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_ANTARCTICA_AQ => [
            "name" => "Antarctica",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_ANTIGUA_AND_BARBUDA_AG => [
            "name" => "Antigua and Barbuda",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_ARGENTINA_AR => [
            "name" => "Argentina",
            "geographical_unit_name" => "province"
        ],
        self::ISO_ARMENIA_AM => [
            "name" => "Armenia",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_ARUBA_AW => [
            "name" => "Aruba",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_AUSTRALIA_AU => [
            "name" => "Australia",
            "geographical_unit_name" => "state"
        ],
        self::ISO_AUSTRIA_AT => [
            "name" => "Austria",
            "geographical_unit_name" => "state"
        ],
        self::ISO_AZERBAIJAN_AZ => [
            "name" => "Azerbaijan",
            "geographical_unit_name" => "district"
        ],
        self::ISO_BAHAMAS_BS => [
            "name" => "Bahamas",
            "geographical_unit_name" => "district"
        ],
        self::ISO_BAHRAIN_BH => [
            "name" => "Bahrain",
            "geographical_unit_name" => "governorate"
        ],
        self::ISO_BANGLADESH_BD => [
            "name" => "Bangladesh",
            "geographical_unit_name" => "division"
        ],
        self::ISO_BARBADOS_BB => [
            "name" => "Barbados",
            "geographical_unit_name" => "parish"
        ],
        self::ISO_BELARUS_BY => [
            "name" => "Belarus",
            "geographical_unit_name" => "region"
        ],
        self::ISO_BELGIUM_BE => [
            "name" => "Belgium",
            "geographical_unit_name" => "region"
        ],
        self::ISO_BELIZE_BZ => [
            "name" => "Belize",
            "geographical_unit_name" => "district"
        ],
        self::ISO_BENIN_BJ => [
            "name" => "Benin",
            "geographical_unit_name" => "department"
        ],
        self::ISO_BERMUDA_BM => [
            "name" => "Bermuda",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_BHUTAN_BT => [
            "name" => "Bhutan",
            "geographical_unit_name" => "district"
        ],
        self::ISO_BOLIVIA_BO => [
            "name" => "Bolivia",
            "geographical_unit_name" => "department"
        ],
        self::ISO_BOSNIA_AND_HERZEGOVINA_BA => [
            "name" => "Bosnia and Herzegovina",
            "geographical_unit_name" => "entity"
        ],
        self::ISO_BOTSWANA_BW => [
            "name" => "Botswana",
            "geographical_unit_name" => "district"
        ],
        self::ISO_BOUVET_ISLAND_BV => [
            "name" => "Bouvet Island",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_BRAZIL_BR => [
            "name" => "Brazil",
            "geographical_unit_name" => "state"
        ],
        self::ISO_BRITISH_ANTARCTIC_TERRITORY_BQ => [
            "name" => "British Antarctic Territory",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_BRITISH_INDIAN_OCEAN_TERRITORY_IO => [
            "name" => "British Indian Ocean Territory",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_BRITISH_VIRGIN_ISLANDS_VG => [
            "name" => "British Virgin Islands",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_BRUNEI_BN => [
            "name" => "Brunei",
            "geographical_unit_name" => "district"
        ],
        self::ISO_BULGARIA_BG => [
            "name" => "Bulgaria",
            "geographical_unit_name" => "province"
        ],
        self::ISO_BURKINA_FASO_BF => [
            "name" => "Burkina Faso",
            "geographical_unit_name" => "region"
        ],
        self::ISO_BURUNDI_BI => [
            "name" => "Burundi",
            "geographical_unit_name" => "province"
        ],
        self::ISO_CAMBODIA_KH => [
            "name" => "Cambodia",
            "geographical_unit_name" => "province"
        ],
        self::ISO_CAMEROON_CM => [
            "name" => "Cameroon",
            "geographical_unit_name" => "region"
        ],
        self::ISO_CANADA_CA => [
            "name" => "Canada",
            "geographical_unit_name" => "province"
        ],
        self::ISO_CANTON_AND_ENDERBURY_ISLANDS_CT => [
            "name" => "Canton and Enderbury Islands",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_CAPE_VERDE_CV => [
            "name" => "Cape Verde",
            "geographical_unit_name" => "council"
        ],
        self::ISO_CAYMAN_ISLANDS_KY => [
            "name" => "Cayman Islands",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_CENTRAL_AFRICAN_REPUBLIC_CF => [
            "name" => "Central African Republic",
            "geographical_unit_name" => "prefecture"
        ],
        self::ISO_CHAD_TD => [
            "name" => "Chad",
            "geographical_unit_name" => "region"
        ],
        self::ISO_CHILE_CL => [
            "name" => "Chile",
            "geographical_unit_name" => "region"
        ],
        self::ISO_CHINA_CN => [
            "name" => "China",
            "geographical_unit_name" => "province"
        ],
        self::ISO_CHRISTMAS_ISLAND_CX => [
            "name" => "Christmas Island",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_COCOS_ISLANDS_CC => [
            "name" => "Cocos [Keeling] Islands",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_COLOMBIA_CO => [
            "name" => "Colombia",
            "geographical_unit_name" => "department"
        ],
        self::ISO_COMOROS_KM => [
            "name" => "Comoros",
            "geographical_unit_name" => "island"
        ],
        self::ISO_CONGO_BRAZZAVILLE_CG => [
            "name" => "Congo - Brazzaville",
            "geographical_unit_name" => "province"
        ],
        self::ISO_CONGO_KINSHASA_CD => [
            "name" => "Congo - Kinshasa",
            "geographical_unit_name" => "department"
        ],
        self::ISO_COOK_ISLANDS_CK => [
            "name" => "Cook Islands",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_COSTA_RICA_CR => [
            "name" => "Costa Rica",
            "geographical_unit_name" => "province"
        ],
        self::ISO_CROATIA_HR => [
            "name" => "Croatia",
            "geographical_unit_name" => "county"
        ],
        self::ISO_CUBA_CU => [
            "name" => "Cuba",
            "geographical_unit_name" => "province"
        ],
        self::ISO_CYPRUS_CY => [
            "name" => "Cyprus",
            "geographical_unit_name" => "district"
        ],
        self::ISO_CZECH_REPUBLIC_CZ => [
            "name" => "Czech Republic",
            "geographical_unit_name" => "region"
        ],
        self::ISO_COTE_D_IVOIRE_CI => [
            "name" => "Côte d’Ivoire",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_DENMARK_DK => [
            "name" => "Denmark",
            "geographical_unit_name" => "region"
        ],
        self::ISO_DJIBOUTI_DJ => [
            "name" => "Djibouti",
            "geographical_unit_name" => "region"
        ],
        self::ISO_DOMINICA_DM => [
            "name" => "Dominica",
            "geographical_unit_name" => "parish"
        ],
        self::ISO_DOMINICAN_REPUBLIC_DO => [
            "name" => "Dominican Republic",
            "geographical_unit_name" => "province"
        ],
        self::ISO_DRONNING_MAUD_LAND_NQ => [
            "name" => "Dronning Maud Land",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_EAST_GERMANY_DD => [
            "name" => "East Germany",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_ECUADOR_EC => [
            "name" => "Ecuador",
            "geographical_unit_name" => "province"
        ],
        self::ISO_EGYPT_EG => [
            "name" => "Egypt",
            "geographical_unit_name" => "governorate"
        ],
        self::ISO_EL_SALVADOR_SV => [
            "name" => "El Salvador",
            "geographical_unit_name" => "deparment"
        ],
        self::ISO_EQUATORIAL_GUINEA_GQ => [
            "name" => "Equatorial Guinea",
            "geographical_unit_name" => "province"
        ],
        self::ISO_ERITREA_ER => [
            "name" => "Eritrea",
            "geographical_unit_name" => "region"
        ],
        self::ISO_ESTONIA_EE => [
            "name" => "Estonia",
            "geographical_unit_name" => "county"
        ],
        self::ISO_ETHIOPIA_ET => [
            "name" => "Ethiopia",
            "geographical_unit_name" => "region"
        ],
        self::ISO_FALKLAND_ISLANDS_FK => [
            "name" => "Falkland Islands",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_FAROE_ISLANDS_FO => [
            "name" => "Faroe Islands",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_FIJI_FJ => [
            "name" => "Fiji",
            "geographical_unit_name" => "division"
        ],
        self::ISO_FINLAND_FI => [
            "name" => "Finland",
            "geographical_unit_name" => "region"
        ],
        self::ISO_FRANCE_FR => [
            "name" => "France",
            "geographical_unit_name" => "region"
        ],
        self::ISO_FRENCH_GUIANA_GF => [
            "name" => "French Guiana",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_FRENCH_POLYNESIA_PF => [
            "name" => "French Polynesia",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_FRENCH_SOUTHERN_TERRITORIES_TF => [
            "name" => "French Southern Territories",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_FRENCH_SOUTHERN_AND_ANTARCTIC_TERRITORIES_FQ => [
            "name" => "French Southern and Antarctic Territories",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_GABON_GA => [
            "name" => "Gabon",
            "geographical_unit_name" => "province"
        ],
        self::ISO_GAMBIA_GM => [
            "name" => "Gambia",
            "geographical_unit_name" => "region"
        ],
        self::ISO_GEORGIA_GE => [
            "name" => "Georgia",
            "geographical_unit_name" => "region"
        ],
        self::ISO_GERMANY_DE => [
            "name" => "Germany",
            "geographical_unit_name" => "state"
        ],
        self::ISO_GHANA_GH => [
            "name" => "Ghana",
            "geographical_unit_name" => "region"
        ],
        self::ISO_GIBRALTAR_GI => [
            "name" => "Gibraltar",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_GREECE_GR => [
            "name" => "Greece",
            "geographical_unit_name" => "administration"
        ],
        self::ISO_GREENLAND_GL => [
            "name" => "Greenland",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_GRENADA_GD => [
            "name" => "Grenada",
            "geographical_unit_name" => "parish"
        ],
        self::ISO_GUADELOUPE_GP => [
            "name" => "Guadeloupe",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_GUAM_GU => [
            "name" => "Guam",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_GUATEMALA_GT => [
            "name" => "Guatemala",
            "geographical_unit_name" => "department"
        ],
        self::ISO_GUERNSEY_GG => [
            "name" => "Guernsey",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_GUINEA_GN => [
            "name" => "Guinea",
            "geographical_unit_name" => "region"
        ],
        self::ISO_GUINEA_BISSAU_GW => [
            "name" => "Guinea-Bissau",
            "geographical_unit_name" => "region"
        ],
        self::ISO_GUYANA_GY => [
            "name" => "Guyana",
            "geographical_unit_name" => "region"
        ],
        self::ISO_HAITI_HT => [
            "name" => "Haiti",
            "geographical_unit_name" => "department"
        ],
        self::ISO_HEARD_ISLAND_AND_MCDONALD_ISLANDS_HM => [
            "name" => "Heard Island and McDonald Islands",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_HONDURAS_HN => [
            "name" => "Honduras",
            "geographical_unit_name" => "department"
        ],
        self::ISO_HONG_KONG_SAR_CHINA_HK => [
            "name" => "Hong Kong SAR China",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_HUNGARY_HU => [
            "name" => "Hungary",
            "geographical_unit_name" => "county"
        ],
        self::ISO_ICELAND_IS => [
            "name" => "Iceland",
            "geographical_unit_name" => "municipality"
        ],
        self::ISO_INDIA_IN => [
            "name" => "India",
            "geographical_unit_name" => "state"
        ],
        self::ISO_INDONESIA_ID => [
            "name" => "Indonesia",
            "geographical_unit_name" => "province"
        ],
        self::ISO_IRAN_IR => [
            "name" => "Iran",
            "geographical_unit_name" => "province"
        ],
        self::ISO_IRAQ_IQ => [
            "name" => "Iraq",
            "geographical_unit_name" => "governorate"
        ],
        self::ISO_IRELAND_IE => [
            "name" => "Ireland",
            "geographical_unit_name" => "county"
        ],
        self::ISO_ISLE_OF_MAN_IM => [
            "name" => "Isle of Man",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_ISRAEL_IL => [
            "name" => "Israel",
            "geographical_unit_name" => "district"
        ],
        self::ISO_ITALY_IT => [
            "name" => "Italy",
            "geographical_unit_name" => "region"
        ],
        self::ISO_JAMAICA_JM => [
            "name" => "Jamaica",
            "geographical_unit_name" => "parish"
        ],
        self::ISO_JAPAN_JP => [
            "name" => "Japan",
            "geographical_unit_name" => "division"
        ],
        self::ISO_JERSEY_JE => [
            "name" => "Jersey",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_JOHNSTON_ISLAND_JT => [
            "name" => "Johnston Island",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_JORDAN_JO => [
            "name" => "Jordan",
            "geographical_unit_name" => "governorate"
        ],
        self::ISO_KAZAKHSTAN_KZ => [
            "name" => "Kazakhstan",
            "geographical_unit_name" => "region"
        ],
        self::ISO_KENYA_KE => [
            "name" => "Kenya",
            "geographical_unit_name" => "county"
        ],
        self::ISO_KIRIBATI_KI => [
            "name" => "Kiribati",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_KUWAIT_KW => [
            "name" => "Kuwait",
            "geographical_unit_name" => "governorate"
        ],
        self::ISO_KYRGYZSTAN_KG => [
            "name" => "Kyrgyzstan",
            "geographical_unit_name" => "region"
        ],
        self::ISO_LAOS_LA => [
            "name" => "Laos",
            "geographical_unit_name" => "province"
        ],
        self::ISO_LATVIA_LV => [
            "name" => "Latvia",
            "geographical_unit_name" => "municipality"
        ],
        self::ISO_LEBANON_LB => [
            "name" => "Lebanon",
            "geographical_unit_name" => "governorate"
        ],
        self::ISO_LESOTHO_LS => [
            "name" => "Lesotho",
            "geographical_unit_name" => "district"
        ],
        self::ISO_LIBERIA_LR => [
            "name" => "Liberia",
            "geographical_unit_name" => "county"
        ],
        self::ISO_LIBYA_LY => [
            "name" => "Libya",
            "geographical_unit_name" => "district"
        ],
        self::ISO_LIECHTENSTEIN_LI => [
            "name" => "Liechtenstein",
            "geographical_unit_name" => "municipality"
        ],
        self::ISO_LITHUANIA_LT => [
            "name" => "Lithuania",
            "geographical_unit_name" => "county"
        ],
        self::ISO_LUXEMBOURG_LU => [
            "name" => "Luxembourg",
            "geographical_unit_name" => "canton"
        ],
        self::ISO_MACAU_SAR_CHINA_MO => [
            "name" => "Macau SAR China",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_MACEDONIA_MK => [
            "name" => "Macedonia",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_MADAGASCAR_MG => [
            "name" => "Madagascar",
            "geographical_unit_name" => "faritra"
        ],
        self::ISO_MALAWI_MW => [
            "name" => "Malawi",
            "geographical_unit_name" => "region"
        ],
        self::ISO_MALAYSIA_MY => [
            "name" => "Malaysia",
            "geographical_unit_name" => "state"
        ],
        self::ISO_MALDIVES_MV => [
            "name" => "Maldives",
            "geographical_unit_name" => "atoll"
        ],
        self::ISO_MALI_ML => [
            "name" => "Mali",
            "geographical_unit_name" => "region"
        ],
        self::ISO_MALTA_MT => [
            "name" => "Malta",
            "geographical_unit_name" => "region"
        ],
        self::ISO_MARSHALL_ISLANDS_MH => [
            "name" => "Marshall Islands",
            "geographical_unit_name" => "municipality"
        ],
        self::ISO_MARTINIQUE_MQ => [
            "name" => "Martinique",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_MAURITANIA_MR => [
            "name" => "Mauritania",
            "geographical_unit_name" => "region"
        ],
        self::ISO_MAURITIUS_MU => [
            "name" => "Mauritius",
            "geographical_unit_name" => "island"
        ],
        self::ISO_MAYOTTE_YT => [
            "name" => "Mayotte",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_METROPOLITAN_FRANCE_FX => [
            "name" => "Metropolitan France",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_MEXICO_MX => [
            "name" => "Mexico",
            "geographical_unit_name" => "state"
        ],
        self::ISO_MICRONESIA_FM => [
            "name" => "Micronesia",
            "geographical_unit_name" => "state"
        ],
        self::ISO_MIDWAY_ISLANDS_MI => [
            "name" => "Midway Islands",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_MOLDOVA_MD => [
            "name" => "Moldova",
            "geographical_unit_name" => "raioane"
        ],
        self::ISO_MONACO_MC => [
            "name" => "Monaco",
            "geographical_unit_name" => "quartier"
        ],
        self::ISO_MONGOLIA_MN => [
            "name" => "Mongolia",
            "geographical_unit_name" => "aimag"
        ],
        self::ISO_MONTENEGRO_ME => [
            "name" => "Montenegro",
            "geographical_unit_name" => "opštine"
        ],
        self::ISO_MONTSERRAT_MS => [
            "name" => "Montserrat",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_MOROCCO_MA => [
            "name" => "Morocco",
            "geographical_unit_name" => "region"
        ],
        self::ISO_MOZAMBIQUE_MZ => [
            "name" => "Mozambique",
            "geographical_unit_name" => "province"
        ],
        self::ISO_MYANMAR_BURMA_MM => [
            "name" => "Myanmar [Burma]",
            "geographical_unit_name" => "state"
        ],
        self::ISO_NAMIBIA_NA => [
            "name" => "Namibia",
            "geographical_unit_name" => "region"
        ],
        self::ISO_NAURU_NR => [
            "name" => "Nauru",
            "geographical_unit_name" => "district"
        ],
        self::ISO_NEPAL_NP => [
            "name" => "Nepal",
            "geographical_unit_name" => "province"
        ],
        self::ISO_NETHERLANDS_NL => [
            "name" => "Netherlands",
            "geographical_unit_name" => "county"
        ],
        self::ISO_NETHERLANDS_ANTILLES_AN => [
            "name" => "Netherlands Antilles",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_NEUTRAL_ZONE_NT => [
            "name" => "Neutral Zone",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_NEW_CALEDONIA_NC => [
            "name" => "New Caledonia",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_NEW_ZEALAND_NZ => [
            "name" => "New Zealand",
            "geographical_unit_name" => "realm"
        ],
        self::ISO_NICARAGUA_NI => [
            "name" => "Nicaragua",
            "geographical_unit_name" => "deparment"
        ],
        self::ISO_NIGER_NE => [
            "name" => "Niger",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_NIGERIA_NG => [
            "name" => "Nigeria",
            "geographical_unit_name" => "state"
        ],
        self::ISO_NIUE_NU => [
            "name" => "Niue",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_NORFOLK_ISLAND_NF => [
            "name" => "Norfolk Island",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_NORTH_KOREA_KP => [
            "name" => "North Korea",
            "geographical_unit_name" => "province"
        ],
        self::ISO_NORTH_VIETNAM_VD => [
            "name" => "North Vietnam",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_NORTHERN_MARIANA_ISLANDS_MP => [
            "name" => "Northern Mariana Islands",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_NORWAY_NO => [
            "name" => "Norway",
            "geographical_unit_name" => "municipality"
        ],
        self::ISO_OMAN_OM => [
            "name" => "Oman",
            "geographical_unit_name" => "governorate"
        ],
        self::ISO_PACIFIC_ISLANDS_TRUST_TERRITORY_PC => [
            "name" => "Pacific Islands Trust Territory",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_PAKISTAN_PK => [
            "name" => "Pakistan",
            "geographical_unit_name" => "province"
        ],
        self::ISO_PALAU_PW => [
            "name" => "Palau",
            "geographical_unit_name" => "state"
        ],
        self::ISO_PALESTINIAN_TERRITORIES_PS => [
            "name" => "Palestinian Territories",
            "geographical_unit_name" => "governorate"
        ],
        self::ISO_PANAMA_PA => [
            "name" => "Panama",
            "geographical_unit_name" => "province"
        ],
        self::ISO_PANAMA_CANAL_ZONE_PZ => [
            "name" => "Panama Canal Zone",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_PAPUA_NEW_GUINEA_PG => [
            "name" => "Papua New Guinea",
            "geographical_unit_name" => "province"
        ],
        self::ISO_PARAGUAY_PY => [
            "name" => "Paraguay",
            "geographical_unit_name" => "deparment"
        ],
        self::ISO_PEOPLES_DEMOCRATIC_REPUBLIC_OF_YEMEN_YD => [
            "name" => "People's Democratic Republic of Yemen",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_PERU_PE => [
            "name" => "Peru",
            "geographical_unit_name" => "department"
        ],
        self::ISO_PHILIPPINES_PH => [
            "name" => "Philippines",
            "geographical_unit_name" => "region"
        ],
        self::ISO_PITCAIRN_ISLANDS_PN => [
            "name" => "Pitcairn Islands",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_POLAND_PL => [
            "name" => "Poland",
            "geographical_unit_name" => "voivodeship"
        ],
        self::ISO_PORTUGAL_PT => [
            "name" => "Portugal",
            "geographical_unit_name" => "district"
        ],
        self::ISO_PUERTO_RICO_PR => [
            "name" => "Puerto Rico",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_QATAR_QA => [
            "name" => "Qatar",
            "geographical_unit_name" => "municipality"
        ],
        self::ISO_ROMANIA_RO => [
            "name" => "Romania",
            "geographical_unit_name" => "county"
        ],
        self::ISO_RUSSIA_RU => [
            "name" => "Russia",
            "geographical_unit_name" => "oblast"
        ],
        self::ISO_RWANDA_RW => [
            "name" => "Rwanda",
            "geographical_unit_name" => "province"
        ],
        self::ISO_REUNION_RE => [
            "name" => "Réunion",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_SAINT_BARTHELEMY_BL => [
            "name" => "Saint Barthélemy",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_SAINT_HELENA_SH => [
            "name" => "Saint Helena",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_SAINT_KITTS_AND_NEVIS_KN => [
            "name" => "Saint Kitts and Nevis",
            "geographical_unit_name" => "island"
        ],
        self::ISO_SAINT_LUCIA_LC => [
            "name" => "Saint Lucia",
            "geographical_unit_name" => "district"
        ],
        self::ISO_SAINT_MARTIN_MF => [
            "name" => "Saint Martin",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_SAINT_PIERRE_AND_MIQUELON_PM => [
            "name" => "Saint Pierre and Miquelon",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_SAINT_VINCENT_AND_THE_GRENADINES_VC => [
            "name" => "Saint Vincent and the Grenadines",
            "geographical_unit_name" => "parish"
        ],
        self::ISO_SAMOA_WS => [
            "name" => "Samoa",
            "geographical_unit_name" => "district"
        ],
        self::ISO_SAN_MARINO_SM => [
            "name" => "San Marino",
            "geographical_unit_name" => "municipality"
        ],
        self::ISO_SAUDI_ARABIA_SA => [
            "name" => "Saudi Arabia",
            "geographical_unit_name" => "province"
        ],
        self::ISO_SENEGAL_SN => [
            "name" => "Senegal",
            "geographical_unit_name" => "region"
        ],
        self::ISO_SERBIA_RS => [
            "name" => "Serbia",
            "geographical_unit_name" => "okrug"
        ],
        self::ISO_SERBIA_AND_MONTENEGRO_CS => [
            "name" => "Serbia and Montenegro",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_SEYCHELLES_SC => [
            "name" => "Seychelles",
            "geographical_unit_name" => "district"
        ],
        self::ISO_SIERRA_LEONE_SL => [
            "name" => "Sierra Leone",
            "geographical_unit_name" => "province"
        ],
        self::ISO_SINGAPORE_SG => [
            "name" => "Singapore",
            "geographical_unit_name" => "district"
        ],
        self::ISO_SLOVAKIA_SK => [
            "name" => "Slovakia",
            "geographical_unit_name" => "kraje"
        ],
        self::ISO_SLOVENIA_SI => [
            "name" => "Slovenia",
            "geographical_unit_name" => "municipality"
        ],
        self::ISO_SOLOMON_ISLANDS_SB => [
            "name" => "Solomon Islands",
            "geographical_unit_name" => "province"
        ],
        self::ISO_SOMALIA_SO => [
            "name" => "Somalia",
            "geographical_unit_name" => "state"
        ],
        self::ISO_SOUTH_AFRICA_ZA => [
            "name" => "South Africa",
            "geographical_unit_name" => "province"
        ],
        self::ISO_SOUTH_GEORGIA_AND_THE_SOUTH_SANDWICH_ISLANDS_GS => [
            "name" => "South Georgia and the South Sandwich Islands",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_SOUTH_KOREA_KR => [
            "name" => "South Korea",
            "geographical_unit_name" => "province"
        ],
        self::ISO_SPAIN_ES => [
            "name" => "Spain",
            "geographical_unit_name" => "community"
        ],
        self::ISO_SRI_LANKA_LK => [
            "name" => "Sri Lanka",
            "geographical_unit_name" => "province"
        ],
        self::ISO_SUDAN_SD => [
            "name" => "Sudan",
            "geographical_unit_name" => "state"
        ],
        self::ISO_SURINAME_SR => [
            "name" => "Suriname",
            "geographical_unit_name" => "district"
        ],
        self::ISO_SVALBARD_AND_JAN_MAYEN_SJ => [
            "name" => "Svalbard and Jan Mayen",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_SWAZILAND_SZ => [
            "name" => "Swaziland",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_SWEDEN_SE => [
            "name" => "Sweden",
            "geographical_unit_name" => "county"
        ],
        self::ISO_SWITZERLAND_CH => [
            "name" => "Switzerland",
            "geographical_unit_name" => "canton"
        ],
        self::ISO_SYRIA_SY => [
            "name" => "Syria",
            "geographical_unit_name" => "governorate"
        ],
        self::ISO_SAO_TOME_AND_PRINCIPE_ST => [
            "name" => "São Tomé and Príncipe",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_TAIWAN_TW => [
            "name" => "Taiwan",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_TAJIKISTAN_TJ => [
            "name" => "Tajikistan",
            "geographical_unit_name" => "region"
        ],
        self::ISO_TANZANIA_TZ => [
            "name" => "Tanzania",
            "geographical_unit_name" => "region"
        ],
        self::ISO_THAILAND_TH => [
            "name" => "Thailand",
            "geographical_unit_name" => "province"
        ],
        self::ISO_TIMOR_LESTE_TL => [
            "name" => "Timor-Leste",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_TOGO_TG => [
            "name" => "Togo",
            "geographical_unit_name" => "region"
        ],
        self::ISO_TOKELAU_TK => [
            "name" => "Tokelau",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_TONGA_TO => [
            "name" => "Tonga",
            "geographical_unit_name" => "province"
        ],
        self::ISO_TRINIDAD_AND_TOBAGO_TT => [
            "name" => "Trinidad and Tobago",
            "geographical_unit_name" => "region"
        ],
        self::ISO_TUNISIA_TN => [
            "name" => "Tunisia",
            "geographical_unit_name" => "governorate"
        ],
        self::ISO_TURKEY_TR => [
            "name" => "Turkey",
            "geographical_unit_name" => "province"
        ],
        self::ISO_TURKMENISTAN_TM => [
            "name" => "Turkmenistan",
            "geographical_unit_name" => "region"
        ],
        self::ISO_TURKS_AND_CAICOS_ISLANDS_TC => [
            "name" => "Turks and Caicos Islands",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_TUVALU_TV => [
            "name" => "Tuvalu",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_US_MINOR_OUTLYING_ISLANDS_UM => [
            "name" => "U.S. Minor Outlying Islands",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_US_MISCELLANEOUS_PACIFIC_ISLANDS_PU => [
            "name" => "U.S. Miscellaneous Pacific Islands",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_US_VIRGIN_ISLANDS_VI => [
            "name" => "U.S. Virgin Islands",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_UGANDA_UG => [
            "name" => "Uganda",
            "geographical_unit_name" => "district"
        ],
        self::ISO_UKRAINE_UA => [
            "name" => "Ukraine",
            "geographical_unit_name" => "oblast"
        ],
        self::ISO_UNION_OF_SOVIET_SOCIALIST_REPUBLICS_SU => [
            "name" => "Union of Soviet Socialist Republics",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_UNITED_ARAB_EMIRATES_AE => [
            "name" => "United Arab Emirates",
            "geographical_unit_name" => "emirate"
        ],
        self::ISO_UNITED_KINGDOM_GB => [
            "name" => "United Kingdom",
            "geographical_unit_name" => "country"
        ],
        self::ISO_UNITED_STATES_US => [
            "name" => "United States",
            "geographical_unit_name" => "state"
        ],
        self::ISO_UNKNOWN_OR_INVALID_REGION_ZZ => [
            "name" => "Unknown or Invalid Region",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_URUGUAY_UY => [
            "name" => "Uruguay",
            "geographical_unit_name" => "department"
        ],
        self::ISO_UZBEKISTAN_UZ => [
            "name" => "Uzbekistan",
            "geographical_unit_name" => "region"
        ],
        self::ISO_VANUATU_VU => [
            "name" => "Vanuatu",
            "geographical_unit_name" => "province"
        ],
        self::ISO_VATICAN_CITY_VA => [
            "name" => "Vatican City",
            "geographical_unit_name" => "none"
        ],
        self::ISO_VENEZUELA_VE => [
            "name" => "Venezuela",
            "geographical_unit_name" => "state"
        ],
        self::ISO_VIETNAM_VN => [
            "name" => "Vietnam",
            "geographical_unit_name" => "province"
        ],
        self::ISO_WAKE_ISLAND_WK => [
            "name" => "Wake Island",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_WALLIS_AND_FUTUNA_WF => [
            "name" => "Wallis and Futuna",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_WESTERN_SAHARA_EH => [
            "name" => "Western Sahara",
            "geographical_unit_name" => "unknown"
        ],
        self::ISO_YEMEN_YE => [
            "name" => "Yemen",
            "geographical_unit_name" => "governorate"
        ],
        self::ISO_ZAMBIA_ZM => [
            "name" => "Zambia",
            "geographical_unit_name" => "province"
        ],
        self::ISO_ZIMBABWE_ZW => [
            "name" => "Zimbabwe",
            "geographical_unit_name" => "province"
        ]
    ];

    const COUNTRIES_BY_ISO = [
        self::ISO_AFGHANISTAN_AF => "Afghanistan",
        self::ISO_ALAND_ISLANDS_AX => "Åland Islands",
        self::ISO_ALBANIA_AL => "Albania",
        self::ISO_ALGERIA_DZ => "Algeria",
        self::ISO_AMERICAN_SAMOA_AS => "American Samoa",
        self::ISO_ANDORRA_AD => "Andorra",
        self::ISO_ANGOLA_AO => "Angola",
        self::ISO_ANGUILLA_AI => "Anguilla",
        self::ISO_ANTARCTICA_AQ => "Antarctica",
        self::ISO_ANTIGUA_AND_BARBUDA_AG => "Antigua and Barbuda",
        self::ISO_ARGENTINA_AR => "Argentina",
        self::ISO_ARMENIA_AM => "Armenia",
        self::ISO_ARUBA_AW => "Aruba",
        self::ISO_AUSTRALIA_AU => "Australia",
        self::ISO_AUSTRIA_AT => "Austria",
        self::ISO_AZERBAIJAN_AZ => "Azerbaijan",
        self::ISO_BAHAMAS_BS => "Bahamas",
        self::ISO_BAHRAIN_BH => "Bahrain",
        self::ISO_BANGLADESH_BD => "Bangladesh",
        self::ISO_BARBADOS_BB => "Barbados",
        self::ISO_BELARUS_BY => "Belarus",
        self::ISO_BELGIUM_BE => "Belgium",
        self::ISO_BELIZE_BZ => "Belize",
        self::ISO_BENIN_BJ => "Benin",
        self::ISO_BERMUDA_BM => "Bermuda",
        self::ISO_BHUTAN_BT => "Bhutan",
        self::ISO_BOLIVIA_BO => "Bolivia",
        self::ISO_BOSNIA_AND_HERZEGOVINA_BA => "Bosnia and Herzegovina",
        self::ISO_BOTSWANA_BW => "Botswana",
        self::ISO_BOUVET_ISLAND_BV => "Bouvet Island",
        self::ISO_BRAZIL_BR => "Brazil",
        self::ISO_BRITISH_ANTARCTIC_TERRITORY_BQ => "British Antarctic Territory",
        self::ISO_BRITISH_INDIAN_OCEAN_TERRITORY_IO => "British Indian Ocean Territory",
        self::ISO_BRITISH_VIRGIN_ISLANDS_VG => "British Virgin Islands",
        self::ISO_BRUNEI_BN => "Brunei",
        self::ISO_BULGARIA_BG => "Bulgaria",
        self::ISO_BURKINA_FASO_BF => "Burkina Faso",
        self::ISO_BURUNDI_BI => "Burundi",
        self::ISO_CAMBODIA_KH => "Cambodia",
        self::ISO_CAMEROON_CM => "Cameroon",
        self::ISO_CANADA_CA => "Canada",
        self::ISO_CANTON_AND_ENDERBURY_ISLANDS_CT => "Canton and Enderbury Islands",
        self::ISO_CAPE_VERDE_CV => "Cape Verde",
        self::ISO_CAYMAN_ISLANDS_KY => "Cayman Islands",
        self::ISO_CENTRAL_AFRICAN_REPUBLIC_CF => "Central African Republic",
        self::ISO_CHAD_TD => "Chad",
        self::ISO_CHILE_CL => "Chile",
        self::ISO_CHINA_CN => "China",
        self::ISO_CHRISTMAS_ISLAND_CX => "Christmas Island",
        self::ISO_COCOS_ISLANDS_CC => "Cocos [Keeling] Islands",
        self::ISO_COLOMBIA_CO => "Colombia",
        self::ISO_COMOROS_KM => "Comoros",
        self::ISO_CONGO_BRAZZAVILLE_CG => "Congo - Brazzaville",
        self::ISO_CONGO_KINSHASA_CD => "Congo - Kinshasa",
        self::ISO_COOK_ISLANDS_CK => "Cook Islands",
        self::ISO_COSTA_RICA_CR => "Costa Rica",
        self::ISO_CROATIA_HR => "Croatia",
        self::ISO_CUBA_CU => "Cuba",
        self::ISO_CYPRUS_CY => "Cyprus",
        self::ISO_CZECH_REPUBLIC_CZ => "Czech Republic",
        self::ISO_COTE_D_IVOIRE_CI => "Côte d’Ivoire",
        self::ISO_DENMARK_DK => "Denmark",
        self::ISO_DJIBOUTI_DJ => "Djibouti",
        self::ISO_DOMINICA_DM => "Dominica",
        self::ISO_DOMINICAN_REPUBLIC_DO => "Dominican Republic",
        self::ISO_DRONNING_MAUD_LAND_NQ => "Dronning Maud Land",
        self::ISO_EAST_GERMANY_DD => "East Germany",
        self::ISO_ECUADOR_EC => "Ecuador",
        self::ISO_EGYPT_EG => "Egypt",
        self::ISO_EL_SALVADOR_SV => "El Salvador",
        self::ISO_EQUATORIAL_GUINEA_GQ => "Equatorial Guinea",
        self::ISO_ERITREA_ER => "Eritrea",
        self::ISO_ESTONIA_EE => "Estonia",
        self::ISO_ETHIOPIA_ET => "Ethiopia",
        self::ISO_FALKLAND_ISLANDS_FK => "Falkland Islands",
        self::ISO_FAROE_ISLANDS_FO => "Faroe Islands",
        self::ISO_FIJI_FJ => "Fiji",
        self::ISO_FINLAND_FI => "Finland",
        self::ISO_FRANCE_FR => "France",
        self::ISO_FRENCH_GUIANA_GF => "French Guiana",
        self::ISO_FRENCH_POLYNESIA_PF => "French Polynesia",
        self::ISO_FRENCH_SOUTHERN_TERRITORIES_TF => "French Southern Territories",
        self::ISO_FRENCH_SOUTHERN_AND_ANTARCTIC_TERRITORIES_FQ => "French Southern and Antarctic Territories",
        self::ISO_GABON_GA => "Gabon",
        self::ISO_GAMBIA_GM => "Gambia",
        self::ISO_GEORGIA_GE => "Georgia",
        self::ISO_GERMANY_DE => "Germany",
        self::ISO_GHANA_GH => "Ghana",
        self::ISO_GIBRALTAR_GI => "Gibraltar",
        self::ISO_GREECE_GR => "Greece",
        self::ISO_GREENLAND_GL => "Greenland",
        self::ISO_GRENADA_GD => "Grenada",
        self::ISO_GUADELOUPE_GP => "Guadeloupe",
        self::ISO_GUAM_GU => "Guam",
        self::ISO_GUATEMALA_GT => "Guatemala",
        self::ISO_GUERNSEY_GG => "Guernsey",
        self::ISO_GUINEA_GN => "Guinea",
        self::ISO_GUINEA_BISSAU_GW => "Guinea-Bissau",
        self::ISO_GUYANA_GY => "Guyana",
        self::ISO_HAITI_HT => "Haiti",
        self::ISO_HEARD_ISLAND_AND_MCDONALD_ISLANDS_HM => "Heard Island and McDonald Islands",
        self::ISO_HONDURAS_HN => "Honduras",
        self::ISO_HONG_KONG_SAR_CHINA_HK => "Hong Kong SAR China",
        self::ISO_HUNGARY_HU => "Hungary",
        self::ISO_ICELAND_IS => "Iceland",
        self::ISO_INDIA_IN => "India",
        self::ISO_INDONESIA_ID => "Indonesia",
        self::ISO_IRAN_IR => "Iran",
        self::ISO_IRAQ_IQ => "Iraq",
        self::ISO_IRELAND_IE => "Ireland",
        self::ISO_ISLE_OF_MAN_IM => "Isle of Man",
        self::ISO_ISRAEL_IL => "Israel",
        self::ISO_ITALY_IT => "Italy",
        self::ISO_JAMAICA_JM => "Jamaica",
        self::ISO_JAPAN_JP => "Japan",
        self::ISO_JERSEY_JE => "Jersey",
        self::ISO_JOHNSTON_ISLAND_JT => "Johnston Island",
        self::ISO_JORDAN_JO => "Jordan",
        self::ISO_KAZAKHSTAN_KZ => "Kazakhstan",
        self::ISO_KENYA_KE => "Kenya",
        self::ISO_KIRIBATI_KI => "Kiribati",
        self::ISO_KUWAIT_KW => "Kuwait",
        self::ISO_KYRGYZSTAN_KG => "Kyrgyzstan",
        self::ISO_LAOS_LA => "Laos",
        self::ISO_LATVIA_LV => "Latvia",
        self::ISO_LEBANON_LB => "Lebanon",
        self::ISO_LESOTHO_LS => "Lesotho",
        self::ISO_LIBERIA_LR => "Liberia",
        self::ISO_LIBYA_LY => "Libya",
        self::ISO_LIECHTENSTEIN_LI => "Liechtenstein",
        self::ISO_LITHUANIA_LT => "Lithuania",
        self::ISO_LUXEMBOURG_LU => "Luxembourg",
        self::ISO_MACAU_SAR_CHINA_MO => "Macau SAR China",
        self::ISO_MACEDONIA_MK => "Macedonia",
        self::ISO_MADAGASCAR_MG => "Madagascar",
        self::ISO_MALAWI_MW => "Malawi",
        self::ISO_MALAYSIA_MY => "Malaysia",
        self::ISO_MALDIVES_MV => "Maldives",
        self::ISO_MALI_ML => "Mali",
        self::ISO_MALTA_MT => "Malta",
        self::ISO_MARSHALL_ISLANDS_MH => "Marshall Islands",
        self::ISO_MARTINIQUE_MQ => "Martinique",
        self::ISO_MAURITANIA_MR => "Mauritania",
        self::ISO_MAURITIUS_MU => "Mauritius",
        self::ISO_MAYOTTE_YT => "Mayotte",
        self::ISO_METROPOLITAN_FRANCE_FX => "Metropolitan France",
        self::ISO_MEXICO_MX => "Mexico",
        self::ISO_MICRONESIA_FM => "Micronesia",
        self::ISO_MIDWAY_ISLANDS_MI => "Midway Islands",
        self::ISO_MOLDOVA_MD => "Moldova",
        self::ISO_MONACO_MC => "Monaco",
        self::ISO_MONGOLIA_MN => "Mongolia",
        self::ISO_MONTENEGRO_ME => "Montenegro",
        self::ISO_MONTSERRAT_MS => "Montserrat",
        self::ISO_MOROCCO_MA => "Morocco",
        self::ISO_MOZAMBIQUE_MZ => "Mozambique",
        self::ISO_MYANMAR_BURMA_MM => "Myanmar [Burma]",
        self::ISO_NAMIBIA_NA => "Namibia",
        self::ISO_NAURU_NR => "Nauru",
        self::ISO_NEPAL_NP => "Nepal",
        self::ISO_NETHERLANDS_NL => "Netherlands",
        self::ISO_NETHERLANDS_ANTILLES_AN => "Netherlands Antilles",
        self::ISO_NEUTRAL_ZONE_NT => "Neutral Zone",
        self::ISO_NEW_CALEDONIA_NC => "New Caledonia",
        self::ISO_NEW_ZEALAND_NZ => "New Zealand",
        self::ISO_NICARAGUA_NI => "Nicaragua",
        self::ISO_NIGER_NE => "Niger",
        self::ISO_NIGERIA_NG => "Nigeria",
        self::ISO_NIUE_NU => "Niue",
        self::ISO_NORFOLK_ISLAND_NF => "Norfolk Island",
        self::ISO_NORTH_KOREA_KP => "North Korea",
        self::ISO_NORTH_VIETNAM_VD => "North Vietnam",
        self::ISO_NORTHERN_MARIANA_ISLANDS_MP => "Northern Mariana Islands",
        self::ISO_NORWAY_NO => "Norway",
        self::ISO_OMAN_OM => "Oman",
        self::ISO_PACIFIC_ISLANDS_TRUST_TERRITORY_PC => "Pacific Islands Trust Territory",
        self::ISO_PAKISTAN_PK => "Pakistan",
        self::ISO_PALAU_PW => "Palau",
        self::ISO_PALESTINIAN_TERRITORIES_PS => "Palestinian Territories",
        self::ISO_PANAMA_PA => "Panama",
        self::ISO_PANAMA_CANAL_ZONE_PZ => "Panama Canal Zone",
        self::ISO_PAPUA_NEW_GUINEA_PG => "Papua New Guinea",
        self::ISO_PARAGUAY_PY => "Paraguay",
        self::ISO_PEOPLES_DEMOCRATIC_REPUBLIC_OF_YEMEN_YD => "People's Democratic Republic of Yemen",
        self::ISO_PERU_PE => "Peru",
        self::ISO_PHILIPPINES_PH => "Philippines",
        self::ISO_PITCAIRN_ISLANDS_PN => "Pitcairn Islands",
        self::ISO_POLAND_PL => "Poland",
        self::ISO_PORTUGAL_PT => "Portugal",
        self::ISO_PUERTO_RICO_PR => "Puerto Rico",
        self::ISO_QATAR_QA => "Qatar",
        self::ISO_ROMANIA_RO => "Romania",
        self::ISO_RUSSIA_RU => "Russia",
        self::ISO_RWANDA_RW => "Rwanda",
        self::ISO_REUNION_RE => "Réunion",
        self::ISO_SAINT_BARTHELEMY_BL => "Saint Barthélemy",
        self::ISO_SAINT_HELENA_SH => "Saint Helena",
        self::ISO_SAINT_KITTS_AND_NEVIS_KN => "Saint Kitts and Nevis",
        self::ISO_SAINT_LUCIA_LC => "Saint Lucia",
        self::ISO_SAINT_MARTIN_MF => "Saint Martin",
        self::ISO_SAINT_PIERRE_AND_MIQUELON_PM => "Saint Pierre and Miquelon",
        self::ISO_SAINT_VINCENT_AND_THE_GRENADINES_VC => "Saint Vincent and the Grenadines",
        self::ISO_SAMOA_WS => "Samoa",
        self::ISO_SAN_MARINO_SM => "San Marino",
        self::ISO_SAUDI_ARABIA_SA => "Saudi Arabia",
        self::ISO_SENEGAL_SN => "Senegal",
        self::ISO_SERBIA_RS => "Serbia",
        self::ISO_SERBIA_AND_MONTENEGRO_CS => "Serbia and Montenegro",
        self::ISO_SEYCHELLES_SC => "Seychelles",
        self::ISO_SIERRA_LEONE_SL => "Sierra Leone",
        self::ISO_SINGAPORE_SG => "Singapore",
        self::ISO_SLOVAKIA_SK => "Slovakia",
        self::ISO_SLOVENIA_SI => "Slovenia",
        self::ISO_SOLOMON_ISLANDS_SB => "Solomon Islands",
        self::ISO_SOMALIA_SO => "Somalia",
        self::ISO_SOUTH_AFRICA_ZA => "South Africa",
        self::ISO_SOUTH_GEORGIA_AND_THE_SOUTH_SANDWICH_ISLANDS_GS => "South Georgia and the South Sandwich Islands",
        self::ISO_SOUTH_KOREA_KR => "South Korea",
        self::ISO_SPAIN_ES => "Spain",
        self::ISO_SRI_LANKA_LK => "Sri Lanka",
        self::ISO_SUDAN_SD => "Sudan",
        self::ISO_SURINAME_SR => "Suriname",
        self::ISO_SVALBARD_AND_JAN_MAYEN_SJ => "Svalbard and Jan Mayen",
        self::ISO_SWAZILAND_SZ => "Swaziland",
        self::ISO_SWEDEN_SE => "Sweden",
        self::ISO_SWITZERLAND_CH => "Switzerland",
        self::ISO_SYRIA_SY => "Syria",
        self::ISO_SAO_TOME_AND_PRINCIPE_ST => "São Tomé and Príncipe",
        self::ISO_TAIWAN_TW => "Taiwan",
        self::ISO_TAJIKISTAN_TJ => "Tajikistan",
        self::ISO_TANZANIA_TZ => "Tanzania",
        self::ISO_THAILAND_TH => "Thailand",
        self::ISO_TIMOR_LESTE_TL => "Timor-Leste",
        self::ISO_TOGO_TG => "Togo",
        self::ISO_TOKELAU_TK => "Tokelau",
        self::ISO_TONGA_TO => "Tonga",
        self::ISO_TRINIDAD_AND_TOBAGO_TT => "Trinidad and Tobago",
        self::ISO_TUNISIA_TN => "Tunisia",
        self::ISO_TURKEY_TR => "Turkey",
        self::ISO_TURKMENISTAN_TM => "Turkmenistan",
        self::ISO_TURKS_AND_CAICOS_ISLANDS_TC => "Turks and Caicos Islands",
        self::ISO_TUVALU_TV => "Tuvalu",
        self::ISO_US_MINOR_OUTLYING_ISLANDS_UM => "U.S. Minor Outlying Islands",
        self::ISO_US_MISCELLANEOUS_PACIFIC_ISLANDS_PU => "U.S. Miscellaneous Pacific Islands",
        self::ISO_US_VIRGIN_ISLANDS_VI => "U.S. Virgin Islands",
        self::ISO_UGANDA_UG => "Uganda",
        self::ISO_UKRAINE_UA => "Ukraine",
        self::ISO_UNION_OF_SOVIET_SOCIALIST_REPUBLICS_SU => "Union of Soviet Socialist Republics",
        self::ISO_UNITED_ARAB_EMIRATES_AE => "United Arab Emirates",
        self::ISO_UNITED_KINGDOM_GB => "United Kingdom",
        self::ISO_UNITED_STATES_US => "United States",
        self::ISO_UNKNOWN_OR_INVALID_REGION_ZZ => "Unknown or Invalid Region",
        self::ISO_URUGUAY_UY => "Uruguay",
        self::ISO_UZBEKISTAN_UZ => "Uzbekistan",
        self::ISO_VANUATU_VU => "Vanuatu",
        self::ISO_VATICAN_CITY_VA => "Vatican City",
        self::ISO_VENEZUELA_VE => "Venezuela",
        self::ISO_VIETNAM_VN => "Vietnam",
        self::ISO_WAKE_ISLAND_WK => "Wake Island",
        self::ISO_WALLIS_AND_FUTUNA_WF => "Wallis and Futuna",
        self::ISO_WESTERN_SAHARA_EH => "Western Sahara",
        self::ISO_YEMEN_YE => "Yemen",
        self::ISO_ZAMBIA_ZM => "Zambia",
        self::ISO_ZIMBABWE_ZW => "Zimbabwe"
    ];


    public function states()
    {
        return $this->hasMany('App\Models\State');
    }
}
