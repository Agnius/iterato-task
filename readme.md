## Informacija apie uzduoties realizavima

Is esmes uzduotis realizuota siektiek kitaip nei butu iprastai
kadangi jau kuris laikas nedirbau prie Symfony buvo idomu grizti bei prisiminti
pagrindinis niuansas kuris man visados uzkliudavo naudojant SF request validation.
Ypac jeigu kuriame REST API, tad pasinaudodamas proga, parasiau savo nedidele Validatoriaus implementacija
- Ziureti Validation servisa ir Model/Request.

Tad pagrindine mintis apsirasyti savo Request modeli kuris atliks validacija - jokiu Forms komponentu ar panasiai.

Pacios uzduoties realizacija ziureti - WeatherService, bei
Weather direktorija - implementuotas strategy patternas tam jeigu ateityje reiketu papildomu weather provideriu.


Paciam sprendimui truksta interface'u ir isskaidymo, aiskesniu pavadinimu.
Del laiko stokos FE dalies neimplementavau.

Kaip pratestuoti

.ENV values

WEATHER_API_PROVIDER=open_weather_map
WEATHER_API_URL=api.openweathermap.org/data/2.5
WEATHER_API_VERSION=2.5

POST /weather

Body
{
    "api_key": "7204e7a4e7facebd9ca806b9698e01e5",
	"city": "Vilnius"
}

Response
<...>