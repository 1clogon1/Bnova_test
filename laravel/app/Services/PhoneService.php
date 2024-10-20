<?php
namespace App\Services;

class PhoneService
{
    /**
     * Массив кодов стран и их соответствий
     * @var array
     */
    protected $countryCodes = [
        '+1' => 'USA / Canada',
        '+7' => 'Russia / Kazakhstan',
        '+20' => 'Egypt',
        '+27' => 'South Africa',
        '+30' => 'Greece',
        '+31' => 'Netherlands',
        '+32' => 'Belgium',
        '+33' => 'France',
        '+34' => 'Spain',
        '+36' => 'Hungary',
        '+39' => 'Italy',
        '+40' => 'Romania',
        '+41' => 'Switzerland',
        '+43' => 'Austria',
        '+44' => 'United Kingdom',
        '+45' => 'Denmark',
        '+46' => 'Sweden',
        '+47' => 'Norway',
        '+48' => 'Poland',
        '+49' => 'Germany',
        '+52' => 'Mexico',
        '+54' => 'Argentina',
        '+55' => 'Brazil',
        '+56' => 'Chile',
        '+57' => 'Colombia',
        '+58' => 'Venezuela',
        '+60' => 'Malaysia',
        '+61' => 'Australia',
        '+62' => 'Indonesia',
        '+63' => 'Philippines',
        '+64' => 'New Zealand',
        '+65' => 'Singapore',
        '+66' => 'Thailand',
        '+81' => 'Japan',
        '+82' => 'South Korea',
        '+84' => 'Vietnam',
        '+86' => 'China',
        '+90' => 'Turkey',
        '+91' => 'India',
        '+92' => 'Pakistan',
        '+93' => 'Afghanistan',
        '+94' => 'Sri Lanka',
        '+95' => 'Myanmar',
        '+98' => 'Iran',
        '+212' => 'Morocco',
        '+213' => 'Algeria',
        '+216' => 'Tunisia',
        '+218' => 'Libya',
        '+220' => 'Gambia',
        '+221' => 'Senegal',
        '+222' => 'Mauritania',
        '+223' => 'Mali',
        '+224' => 'Guinea',
        '+225' => 'Ivory Coast',
        '+226' => 'Burkina Faso',
        '+227' => 'Niger',
        '+228' => 'Togo',
        '+229' => 'Benin',
        '+230' => 'Mauritius',
        '+231' => 'Liberia',
        '+232' => 'Sierra Leone',
        '+233' => 'Ghana',
        '+234' => 'Nigeria',
        '+235' => 'Chad',
        '+236' => 'Central African Republic',
        '+237' => 'Cameroon',
        '+238' => 'Cape Verde',
        '+239' => 'Sao Tome and Principe',
        '+240' => 'Equatorial Guinea',
        '+241' => 'Gabon',
        '+242' => 'Congo',
        '+243' => 'Democratic Republic of the Congo',
        '+244' => 'Angola',
        '+245' => 'Guinea-Bissau',
        '+248' => 'Seychelles',
        '+249' => 'Sudan',
        '+250' => 'Rwanda',
        '+251' => 'Ethiopia',
        '+252' => 'Somalia',
        '+253' => 'Djibouti',
        '+254' => 'Kenya',
        '+255' => 'Tanzania',
        '+256' => 'Uganda',
        '+257' => 'Burundi',
        '+258' => 'Mozambique',
        '+260' => 'Zambia',
        '+261' => 'Madagascar',
        '+262' => 'Reunion',
        '+263' => 'Zimbabwe',
        '+264' => 'Namibia',
        '+265' => 'Malawi',
        '+266' => 'Lesotho',
        '+267' => 'Botswana',
        '+268' => 'Eswatini',
        '+269' => 'Comoros',
        '+290' => 'Saint Helena',
        '+291' => 'Eritrea',
        '+297' => 'Aruba',
        '+298' => 'Faroe Islands',
        '+299' => 'Greenland'
    ];

    /**
     * Массив кодов регионов для США
     * @var array
     */
    protected $usCodes = [
        '205', '251', '256', '334', '479', '501', '870', '213', '310', '323',
        '424', '442', '510', '530', '559', '562', '619', '626', '650', '661',
        '669', '707', '714', '760', '805', '818', '831', '858', '909', '916',
        '925', '949', '951', '202', '203', '215', '267', '610', '484', '646',
        '718', '917', '929', '301', '410', '443', '240', '617', '774', '781',
        '857', '978', '231', '248', '313', '517', '586', '616', '734', '810',
        '906', '218', '320', '507', '612', '651', '763', '952', '601', '662',
        '769', '314', '417', '573', '636', '657', '660', '406', '402', '531',
        '775', '603', '201', '551', '609', '732', '848', '856', '862', '908',
        '973', '505', '575', '212', '315', '332', '347', '518', '585', '607',
        '631', '646', '718', '917', '929', '252', '336', '704', '743', '828',
        '910', '919', '980', '701', '614', '740', '937', '405', '918', '541',
        '971', '215', '267', '412', '434', '484', '570', '610', '717', '724',
        '814', '878', '401', '803', '839', '843', '854', '864', '605', '615',
        '731', '865', '901', '931', '512', '713', '726', '737', '806', '817',
        '830', '832', '903', '915', '940', '956', '972', '979', '385', '435',
        '801', '802', '703', '757', '804', '304', '681', '414', '920', '307',
    ];


    /**
     * Массив кодов регионов для Канады
     * @var array
     */
    protected $canadaCodes = [
        '204', '226', '236', '249', '250', '289', '306', '343', '416', '418',
        '431', '437', '450', '506', '519', '548', '579', '581', '604', '613',
        '647', '672', '705', '709', '778', '780', '782', '807', '819', '825',
        '867', '873', '902', '905'
    ];


    /**
     * Массив кодов регионов для России
     * @var array
     */
    protected $russiaCodes = [
        '495', '499', '812', '907', '909', '910', '911', '912', '913', '914',
        '915', '916', '917', '918', '919', '920', '921', '922', '923', '924',
        '925', '926', '927', '928', '929', '930', '931', '932', '933', '934',
        '935', '936', '937', '938', '939', '940', '941', '942', '943', '944',
        '945', '946', '947', '948', '949', '950', '951', '952', '953', '954',
        '955', '956', '957', '958', '959', '960', '961', '962', '963', '964',
        '965', '966', '967', '968', '969', '970', '971', '972', '973', '974',
        '975', '976', '977', '978', '979', '980', '981', '982', '983', '984',
        '985', '986', '987', '988', '989', '990', '991', '992', '993', '994',
        '995', '996', '997', '998', '999'
    ];

    /**
     * Массив кодов регионов для Казахстана
     * @var array
     */
    protected $kazakhstanCodes = [
        '701', '702', '703', '704', '705', '706', '707', '708', '709', '710',
        '711', '712', '713', '714', '715', '716', '717', '718', '719', '720',
        '721', '722', '723', '724', '725', '726', '727', '728', '729', '730',
        '731', '732', '733', '734', '735', '736', '737', '738', '739', '740',
        '741', '742', '743', '744', '745', '746', '747', '748', '749', '750',
        '751', '752', '753', '754', '755', '756', '757', '758', '759', '760',
        '761', '762', '763', '764', '765', '766', '767', '768', '769', '770',
        '771', '772', '773', '774', '775', '776', '777', '778', '779', '780',
        '781', '782', '783', '784', '785', '786', '787', '788', '789', '790',
        '791', '792', '793', '794', '795', '796', '797', '798', '799'
    ];


    /**
     * Определяет страну по номеру телефона.
     *
     * @param string $phone
     * @return string
     */
    public function getCountryByPhone(string $phone): string
    {
        // Стандартизируем номер телефона
        $phone = $this->sanitizePhoneNumber($phone);

        // Обработка номеров, начинающихся с 8 (замена на +7 для России/Казахстана)
        if (strpos($phone, '8') === 0) {
            $phone = preg_replace('/^8/', '+7', $phone);
        }

        // Валидируем номер телефона
        if (!$this->isValidPhoneNumber($phone)) {
            return 'Неверный номер телефона';
        }

        // Извлекаем код страны из номера телефона
        $country = $this->extractCountryFromPhone($phone);

        // Если страна найдена, возвращаем её, иначе сообщение о неизвестной стране
        return $country ?? 'Неизвестная страна';
    }

    /**
     * Стандартизирует номер телефона: удаляет лишние символы
     *
     * @param string $phone
     * @return string
     */
    protected function sanitizePhoneNumber(string $phone): string
    {
        // Удаляем все символы кроме + и цифр
        return preg_replace('/[^\d\+]/', '', $phone);
    }

    /**
     * Проверяет, является ли номер телефона валидным
     *
     * @param string $phone
     * @return bool
     */
    protected function isValidPhoneNumber(string $phone): bool
    {
        // Проверка на наличие международного префикса
        if (!preg_match('/^\+/', $phone)) {
            return false; // Номер должен начинаться с "+"
        }

        // Примерная проверка длины номера (9-15 символов)
        $length = strlen($phone);
        if ($length < 9 || $length > 15) {
            return false;
        }

        return true;
    }

    /**
     * Извлекает код страны и возвращает страну
     *
     * @param string $phone
     * @return string|null
     */
    protected function extractCountryFromPhone(string $phone): ?string
    {
        // Проходим по массиву кодов стран
        foreach ($this->countryCodes as $code => $country) {
            if (strpos($phone, $code) === 0) {
                // Дополнительная проверка для России/Казахстана
                if ($code === '+7') {
                    return $this->determineRussiaOrKazakhstan($phone);
                }
                elseif($code === '+1'){
                    return $this->formatUSPhoneNumber($phone);
                }

                return $country;
            }
        }

        return null;
    }

    /**
     * Определяет, является ли номер российским или казахстанским
     *
     * @param string $phone
     * @return string
     */
    protected function determineRussiaOrKazakhstan(string $phone): string
    {
        $areaCode = substr($phone, 2, 3); // Извлекаем код региона

        if (in_array($areaCode, $this->russiaCodes)) {
            return 'Russian';
        } elseif (in_array($areaCode, $this->kazakhstanCodes)) {
            return 'Kazakhstan';
        }

        return 'Неизвестный регион в зоне +7';
    }



    public function formatUSPhoneNumber($phone)
    {
        $areaCode = substr($phone, 2, 3); // Извлекаем код региона

        // Массив кодов для подстран США с соответствующими названиями
        $usSubCodes = [
            '340' => 'United States Virgin Islands',
            '670' => 'Northern Mariana Islands',
            '671' => 'Guam',
            '684' => 'American Samoa',
            '787' => 'Puerto Rico',
            '939' => 'Puerto Rico',
        ];

        if (in_array($areaCode, $this->usCodes)) {
            return 'USA';
        } elseif (in_array($areaCode, $this->canadaCodes)) {
            return 'Canada';
        } elseif (array_key_exists($areaCode, $usSubCodes)) {
            return $usSubCodes[$areaCode]; // Возвращаем соответствующее название территории
        }

        return 'Неизвестный регион в зоне +7';
    }

}
