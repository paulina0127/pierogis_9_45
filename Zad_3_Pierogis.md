# Zadanie 3
## Analiza dokumentów występujących w ramach dziedziny problemowej
### Umowa adopcyjna
![Umowa adopcyjna](./dokumenty/umowa_adopcyjna.jpg) <br />
umowa_adopcyjna = kiedy_zawarta + dane_schroniska + dane_opiekunaa+ dane_zwierzęcia  + adres_stałego_pobytu_zwierzęcia <br />
kiedy_zawarta = dzien + rok + gdzie_zawarta <br />
dane_opiekuna = imie, nazwisko + adres + tel + email + nr_i_seria  _dowodu_osobistego + pesel <br />
dane_zwierzęcia = (opis) + wiek + imie + nr_chipa + płeć

### Książeczka zdrowia psa
![Dane zwierzęcia i właściciel](./dokumenty/książeczka_zdrowia_1.jpg) <br />
ksiazeczka_zdrowia_psa = dane_zwierzęcia + (właściciel) + {pasożyty} + {wizyty_lekarskie} + {szczepienia} <br />
dane_zwierzęcia = imię + rasa + data_urodzenia + płeć + maść + nr_identyfikacyjny + (znaki_szczególne) + (zdjęcie) <br />
właściciel = imię + nazwisko + adres + numer_telefonu + (adres_email) <br /> <br />
![Pasożyty](./dokumenty/książeczka_zdrowia_2.jpg) <br />
pasożyty = data + {rodzaj} + {preparat} + pieczątka + podpis_lekarza <br />
rodzaj = [ p. wewnętrzne | pchły | kleszcze ] <br /> <br />
![Wizyty lekarskie](./dokumenty/książeczka_zdrowia_3.jpg) <br />
wizyty_lekarskie = data + opis_wizyty + podpis_lekarza <br /> <br />
![Szczepienia](./dokumenty/książeczka_zdrowia_4.jpg) <br />
szczepienia = data + {preparat} + pieczątka, podpis_lekarza

### Karta ewidencyjna zwierzęcia
![Karta ewidencyjna zwierzęcia](./dokumenty/karta_ewidencyjna.jpg) <br />
karta_ewidencyjna_zwierzęcia = nr_ewidencji + nazwa_zwierzęcia + płeć + rasa + nr_chipa + data_ur  + waga + nr_boksu + znaki_szczególne + (opis_zwierzęcia) +  nr_książeczki _zdrowia + adnotacje_przyjęcia_zwierzęcia <br />
adnotacje_przyjęcia_zwierzęcia = data_przyjęcia + (uwagi)

### Dokument przyjęcia z zewnątrz
![Dokument przyjęcia z zewnątrz](./dokumenty/dokument_pz.jpg) <br />
dokument_pz = data_przyjęcia + nr_dokumentu + odbiorca + dostawca + towar + wydał_podpis + odebrał_podpis <br />
odbiorca = nazwa + adres + nip <br />
dostawca = nazwa + adres + nip <br />
towar = nazwa + ilość + jednostka + cena + wartość
