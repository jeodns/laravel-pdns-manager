<?php

namespace Jeodns\Database\Seeders;

use Illuminate\Support\Facades\DB;
use Jeodns\PDNSManager\Models\Location;
use Jeodns\PDNSManager\Contracts\Location\Continent;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table((new Location())->getTable())->insert([
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'AG',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'AI',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'AN',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'AW',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'BB',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'BL',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'BM',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'BQ',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'BS',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'BZ',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'CA',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'CR',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'CU',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'CW',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'DM',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'DO',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'GD',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'GL',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'GP',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'GT',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'HN',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'HT',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'JM',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'KN',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'KY',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'LC',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'MF',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'MQ',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'MS',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'MX',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'NI',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'PA',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'PM',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'PR',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'SV',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'SX',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'TC',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'TT',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'UM',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'US',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'VC',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'VG',
            ],
            [
                'continent' => Continent::NORTH_AMERICA,
                'country' => 'VI',
            ],
            [
                'continent' => Continent::SOUTH_AMERICA,
                'country' => 'AR',
            ],
            [
                'continent' => Continent::SOUTH_AMERICA,
                'country' => 'BO',
            ],
            [
                'continent' => Continent::SOUTH_AMERICA,
                'country' => 'BR',
            ],
            [
                'continent' => Continent::SOUTH_AMERICA,
                'country' => 'CL',
            ],
            [
                'continent' => Continent::SOUTH_AMERICA,
                'country' => 'CO',
            ],
            [
                'continent' => Continent::SOUTH_AMERICA,
                'country' => 'EC',
            ],
            [
                'continent' => Continent::SOUTH_AMERICA,
                'country' => 'FK',
            ],
            [
                'continent' => Continent::SOUTH_AMERICA,
                'country' => 'GF',
            ],
            [
                'continent' => Continent::SOUTH_AMERICA,
                'country' => 'GY',
            ],
            [
                'continent' => Continent::SOUTH_AMERICA,
                'country' => 'PE',
            ],
            [
                'continent' => Continent::SOUTH_AMERICA,
                'country' => 'PY',
            ],
            [
                'continent' => Continent::SOUTH_AMERICA,
                'country' => 'SR',
            ],
            [
                'continent' => Continent::SOUTH_AMERICA,
                'country' => 'UY',
            ],
            [
                'continent' => Continent::SOUTH_AMERICA,
                'country' => 'VE',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'AD',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'AE',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'AF',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'AL',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'AM',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'AM',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'AT',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'AX',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'AZ',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'AZ',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'BA',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'BD',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'BE',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'BG',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'BH',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'BN',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'BT',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'BY',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'CC',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'CH',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'CN',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'CX',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'CY',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'CY',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'CZ',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'DE',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'DK',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'EE',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'ES',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'FI',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'FO',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'FR',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'GB',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'GE',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'GE',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'GG',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'GI',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'GR',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'HK',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'HR',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'HU',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'ID',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'IE',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'IL',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'IM',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'IN',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'IO',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'IQ',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'IR',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'IS',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'IT',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'JE',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'JO',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'JP',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'KG',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'KH',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'KP',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'KR',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'KW',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'KZ',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'KZ',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'LA',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'LB',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'LI',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'LK',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'LT',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'LU',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'LV',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'MC',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'MD',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'ME',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'MK',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'MM',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'MN',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'MO',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'MT',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'MV',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'MY',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'NL',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'NO',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'NP',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'OM',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'PH',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'PK',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'PL',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'PS',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'PT',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'QA',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'RO',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'RS',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'RU',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'RU',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'SA',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'SE',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'SG',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'SI',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'SJ',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'SK',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'SM',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'SY',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'TH',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'TJ',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'TL',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'TM',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'TR',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'TR',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'TW',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'UA',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'UZ',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'VA',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'VN',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'XD',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'XE',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'XS',
            ],
            [
                'continent' => Continent::EURASIA,
                'country' => 'YE',
            ],
            [
                'continent' => Continent::AUSTRALIA,
                'country' => 'AS',
            ],
            [
                'continent' => Continent::AUSTRALIA,
                'country' => 'AU',
            ],
            [
                'continent' => Continent::AUSTRALIA,
                'country' => 'CK',
            ],
            [
                'continent' => Continent::AUSTRALIA,
                'country' => 'FJ',
            ],
            [
                'continent' => Continent::AUSTRALIA,
                'country' => 'FM',
            ],
            [
                'continent' => Continent::AUSTRALIA,
                'country' => 'GU',
            ],
            [
                'continent' => Continent::AUSTRALIA,
                'country' => 'KI',
            ],
            [
                'continent' => Continent::AUSTRALIA,
                'country' => 'MH',
            ],
            [
                'continent' => Continent::AUSTRALIA,
                'country' => 'MP',
            ],
            [
                'continent' => Continent::AUSTRALIA,
                'country' => 'NC',
            ],
            [
                'continent' => Continent::AUSTRALIA,
                'country' => 'NF',
            ],
            [
                'continent' => Continent::AUSTRALIA,
                'country' => 'NR',
            ],
            [
                'continent' => Continent::AUSTRALIA,
                'country' => 'NU',
            ],
            [
                'continent' => Continent::AUSTRALIA,
                'country' => 'NZ',
            ],
            [
                'continent' => Continent::AUSTRALIA,
                'country' => 'PF',
            ],
            [
                'continent' => Continent::AUSTRALIA,
                'country' => 'PG',
            ],
            [
                'continent' => Continent::AUSTRALIA,
                'country' => 'PN',
            ],
            [
                'continent' => Continent::AUSTRALIA,
                'country' => 'PW',
            ],
            [
                'continent' => Continent::AUSTRALIA,
                'country' => 'SB',
            ],
            [
                'continent' => Continent::AUSTRALIA,
                'country' => 'TK',
            ],
            [
                'continent' => Continent::AUSTRALIA,
                'country' => 'TO',
            ],
            [
                'continent' => Continent::AUSTRALIA,
                'country' => 'TV',
            ],
            [
                'continent' => Continent::AUSTRALIA,
                'country' => 'UM',
            ],
            [
                'continent' => Continent::AUSTRALIA,
                'country' => 'VU',
            ],
            [
                'continent' => Continent::AUSTRALIA,
                'country' => 'WF',
            ],
            [
                'continent' => Continent::AUSTRALIA,
                'country' => 'WS',
            ],
            [
                'continent' => Continent::AUSTRALIA,
                'country' => 'XX',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'AO',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'BF',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'BI',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'BJ',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'BW',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'CD',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'CF',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'CG',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'CI',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'CM',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'CV',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'DJ',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'DZ',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'EG',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'EH',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'ER',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'ET',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'GA',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'GH',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'GM',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'GN',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'GQ',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'GW',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'KE',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'KM',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'LR',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'LS',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'LY',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'MA',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'MG',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'ML',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'MR',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'MU',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'MW',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'MZ',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'NA',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'NE',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'NG',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'RE',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'RW',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'SC',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'SD',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'SH',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'SL',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'SN',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'SO',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'SS',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'ST',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'SZ',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'TD',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'TG',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'TN',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'TZ',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'UG',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'YT',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'ZA',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'ZM',
            ],
            [
                'continent' => Continent::AFRICA,
                'country' => 'ZW',
            ],
        ]);
    }
}
