## Проект берет актуальный курс с cbr

## Настроена авторизация в проекут по роуту /login
Представляет из себя форму с апвторизацией

## Сделана страничка с возможностью конвертации валют /currency
Представляет из себя форму с конвертацией валют

## Команда для крона
Добавил команду котору можно заускать например раз в час по крону `php bin/console currency:update-cache`

## Что-то типа свагера

### GET /api/v1/currency – Получение курса с cbr приводим в json формат
Результат кешируем на час

response: http-200
```json
{
  "date": "29.09.2024",
  "name": "Foreign Currency Market",
  "currency": [
    {
      "id": "R01010",
      "numCode": 36,
      "charCode": "AUD",
      "nominal": 1,
      "name": "Австралийский доллар",
      "value": 63.7677,
      "unitRate": 63.7677
    },
    {
      "id": "R01020A",
      "numCode": 944,
      "charCode": "AZN",
      "nominal": 1,
      "name": "Азербайджанский манат",
      "value": 54.5368,
      "unitRate": 54.5368
    },
    {
      "id": "R01035",
      "numCode": 826,
      "charCode": "GBP",
      "nominal": 1,
      "name": "Фунт стерлингов Соединенного королевства",
      "value": 124.1978,
      "unitRate": 124.1978
    },
    {
      "id": "R01060",
      "numCode": 51,
      "charCode": "AMD",
      "nominal": 100,
      "name": "Армянских драмов",
      "value": 23.937,
      "unitRate": 0.23937
    },
    {
      "id": "R01090B",
      "numCode": 933,
      "charCode": "BYN",
      "nominal": 1,
      "name": "Белорусский рубль",
      "value": 28.8707,
      "unitRate": 28.8707
    },
    {
      "id": "R01100",
      "numCode": 975,
      "charCode": "BGN",
      "nominal": 1,
      "name": "Болгарский лев",
      "value": 52.8783,
      "unitRate": 52.8783
    },
    {
      "id": "R01115",
      "numCode": 986,
      "charCode": "BRL",
      "nominal": 1,
      "name": "Бразильский реал",
      "value": 17.0399,
      "unitRate": 17.0399
    },
    {
      "id": "R01135",
      "numCode": 348,
      "charCode": "HUF",
      "nominal": 100,
      "name": "Венгерских форинтов",
      "value": 26.037,
      "unitRate": 0.26037
    },
    {
      "id": "R01150",
      "numCode": 704,
      "charCode": "VND",
      "nominal": 10000,
      "name": "Вьетнамских донгов",
      "value": 38.4412,
      "unitRate": 0.00384412
    },
    {
      "id": "R01200",
      "numCode": 344,
      "charCode": "HKD",
      "nominal": 1,
      "name": "Гонконгский доллар",
      "value": 11.9475,
      "unitRate": 11.9475
    },
    {
      "id": "R01210",
      "numCode": 981,
      "charCode": "GEL",
      "nominal": 1,
      "name": "Грузинский лари",
      "value": 33.9793,
      "unitRate": 33.9793
    },
    {
      "id": "R01215",
      "numCode": 208,
      "charCode": "DKK",
      "nominal": 1,
      "name": "Датская крона",
      "value": 13.8685,
      "unitRate": 13.8685
    },
    {
      "id": "R01230",
      "numCode": 784,
      "charCode": "AED",
      "nominal": 1,
      "name": "Дирхам ОАЭ",
      "value": 25.2451,
      "unitRate": 25.2451
    },
    {
      "id": "R01235",
      "numCode": 840,
      "charCode": "USD",
      "nominal": 1,
      "name": "Доллар США",
      "value": 92.7126,
      "unitRate": 92.7126
    },
    {
      "id": "R01239",
      "numCode": 978,
      "charCode": "EUR",
      "nominal": 1,
      "name": "Евро",
      "value": 103.4694,
      "unitRate": 103.4694
    },
    {
      "id": "R01240",
      "numCode": 818,
      "charCode": "EGP",
      "nominal": 10,
      "name": "Египетских фунтов",
      "value": 19.173,
      "unitRate": 1.9173
    },
    {
      "id": "R01270",
      "numCode": 356,
      "charCode": "INR",
      "nominal": 10,
      "name": "Индийских рупий",
      "value": 11.0809,
      "unitRate": 1.10809
    },
    {
      "id": "R01280",
      "numCode": 360,
      "charCode": "IDR",
      "nominal": 10000,
      "name": "Индонезийских рупий",
      "value": 61.1117,
      "unitRate": 0.00611117
    },
    {
      "id": "R01335",
      "numCode": 398,
      "charCode": "KZT",
      "nominal": 100,
      "name": "Казахстанских тенге",
      "value": 19.3741,
      "unitRate": 0.193741
    },
    {
      "id": "R01350",
      "numCode": 124,
      "charCode": "CAD",
      "nominal": 1,
      "name": "Канадский доллар",
      "value": 68.8085,
      "unitRate": 68.8085
    },
    {
      "id": "R01355",
      "numCode": 634,
      "charCode": "QAR",
      "nominal": 1,
      "name": "Катарский риал",
      "value": 25.4705,
      "unitRate": 25.4705
    },
    {
      "id": "R01370",
      "numCode": 417,
      "charCode": "KGS",
      "nominal": 10,
      "name": "Киргизских сомов",
      "value": 11.011,
      "unitRate": 1.1011
    },
    {
      "id": "R01375",
      "numCode": 156,
      "charCode": "CNY",
      "nominal": 1,
      "name": "Китайский юань",
      "value": 13.2163,
      "unitRate": 13.2163
    },
    {
      "id": "R01500",
      "numCode": 498,
      "charCode": "MDL",
      "nominal": 10,
      "name": "Молдавских леев",
      "value": 53.2501,
      "unitRate": 5.32501
    },
    {
      "id": "R01530",
      "numCode": 554,
      "charCode": "NZD",
      "nominal": 1,
      "name": "Новозеландский доллар",
      "value": 58.5017,
      "unitRate": 58.5017
    },
    {
      "id": "R01535",
      "numCode": 578,
      "charCode": "NOK",
      "nominal": 10,
      "name": "Норвежских крон",
      "value": 87.7453,
      "unitRate": 8.77453
    },
    {
      "id": "R01565",
      "numCode": 985,
      "charCode": "PLN",
      "nominal": 1,
      "name": "Польский злотый",
      "value": 24.164,
      "unitRate": 24.164
    },
    {
      "id": "R01585F",
      "numCode": 946,
      "charCode": "RON",
      "nominal": 1,
      "name": "Румынский лей",
      "value": 20.782,
      "unitRate": 20.782
    },
    {
      "id": "R01589",
      "numCode": 960,
      "charCode": "XDR",
      "nominal": 1,
      "name": "СДР (специальные права заимствования)",
      "value": 125.4967,
      "unitRate": 125.4967
    },
    {
      "id": "R01625",
      "numCode": 702,
      "charCode": "SGD",
      "nominal": 1,
      "name": "Сингапурский доллар",
      "value": 72.1611,
      "unitRate": 72.1611
    },
    {
      "id": "R01670",
      "numCode": 972,
      "charCode": "TJS",
      "nominal": 10,
      "name": "Таджикских сомони",
      "value": 87.0492,
      "unitRate": 8.70492
    },
    {
      "id": "R01675",
      "numCode": 764,
      "charCode": "THB",
      "nominal": 10,
      "name": "Таиландских батов",
      "value": 28.5841,
      "unitRate": 2.85841
    },
    {
      "id": "R01700J",
      "numCode": 949,
      "charCode": "TRY",
      "nominal": 10,
      "name": "Турецких лир",
      "value": 27.1654,
      "unitRate": 2.71654
    },
    {
      "id": "R01710A",
      "numCode": 934,
      "charCode": "TMT",
      "nominal": 1,
      "name": "Новый туркменский манат",
      "value": 26.4893,
      "unitRate": 26.4893
    },
    {
      "id": "R01717",
      "numCode": 860,
      "charCode": "UZS",
      "nominal": 10000,
      "name": "Узбекских сумов",
      "value": 72.793,
      "unitRate": 0.0072793
    },
    {
      "id": "R01720",
      "numCode": 980,
      "charCode": "UAH",
      "nominal": 10,
      "name": "Украинских гривен",
      "value": 22.4984,
      "unitRate": 2.24984
    },
    {
      "id": "R01760",
      "numCode": 203,
      "charCode": "CZK",
      "nominal": 10,
      "name": "Чешских крон",
      "value": 41.1197,
      "unitRate": 4.11197
    },
    {
      "id": "R01770",
      "numCode": 752,
      "charCode": "SEK",
      "nominal": 10,
      "name": "Шведских крон",
      "value": 91.5229,
      "unitRate": 9.15229
    },
    {
      "id": "R01775",
      "numCode": 756,
      "charCode": "CHF",
      "nominal": 1,
      "name": "Швейцарский франк",
      "value": 109.7061,
      "unitRate": 109.7061
    },
    {
      "id": "R01805F",
      "numCode": 941,
      "charCode": "RSD",
      "nominal": 100,
      "name": "Сербских динаров",
      "value": 88.4327,
      "unitRate": 0.884327
    },
    {
      "id": "R01810",
      "numCode": 710,
      "charCode": "ZAR",
      "nominal": 10,
      "name": "Южноафриканских рэндов",
      "value": 54.0397,
      "unitRate": 5.40397
    },
    {
      "id": "R01815",
      "numCode": 410,
      "charCode": "KRW",
      "nominal": 1000,
      "name": "Вон Республики Корея",
      "value": 69.7244,
      "unitRate": 0.0697244
    },
    {
      "id": "R01820",
      "numCode": 392,
      "charCode": "JPY",
      "nominal": 100,
      "name": "Японских иен",
      "value": 63.7463,
      "unitRate": 0.637463
    }
  ]
}
```