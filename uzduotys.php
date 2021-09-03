<!-- 1. Prie praeito šeštadienio užduoties prijungti Bootsrap 4 biblioteką. +
2. Papildyti duomenų bazę nuotraukoje nurodytomis lentelėmis: http://prntscr.com/1qcvjcd +
3. Papildyti projektą prisijungimu ir registracija. Tiek prisijungimas, tiek registracija turi būti vykdoma POST metodu. +-
4. Lentelę "imones_tipas" užpildyti tokias duomenimis: +

ID pavadinimas aprasymas
1  MB          Mažoji Bendrija
2  UAB         Uždaroji akcinė bendrovė
3  AB           Akcinė bendrovė
Galima užpildyti ir daugiau duomenų savo nuožiūra.

5. Lentelėje "imones" pridedamos tikros arba netikros 10 įmonių. Stulpelis "tipas_ID" nurodo, koks yra įmonės tipas pagal lentelę "imones_tipas" +

6. Lentelėje "klientai_teises" gali būti naudojami duomenys iš paskaitų. Lentelę taip pat papildyti bent 3 įrašais. +

7. Lentelėje "vartotojai_teises" sukurti tokias teises: +

ID pavadinimas aprasymas
1  admin       administratorius
2  vadyb       vadybininkas
3  inspekt     inspektorius
4  s_admin     sistemos administratorius

8. "admin" gali: 
   a)Prisijungęs matyti visus vartotojus, juos redaguoti, pridėti bei pašalinti.
   b) Įjungti/išjungti registracijos galimybę.   <----- ? 
   c) Pridėti, matyti, redaguoti, trinti klientus bei jų teises.
   d) Pridėti, matyti, redaguoti, trinti įmones bei jų tipus.
   
($varT[3] == 1 )

   "vadyb" gali:
   a) Pridėti, matyti, redaguoti, trinti klientus bei jų teises.
   b) Pridėti, matyti, redaguoti, trinti įmones bei jų tipus.
   
($varT[3] == 2 )

   "inspek" gali:
   a) Tik matyti klientus bei jų teises.
   b) Tik matyti įmones bei jų tipus.
   c) Matyti, kada koks vartotojas buvo prisijungęs.

($varT[3] == 3 )

   "s_admin" gali:
   a) Prisijungęs pridėti ir ištrinti vartotojus.  <-----(nezinau ka daryti su slaptazodziu) !!!!!!
   c) Pridėti, matyti, redaguoti, trinti klientus bei jų teises.
   d) Pridėti, matyti, redaguoti, trinti įmones bei jų tipus.

($varT[3] == 4 )

Papildomai: Sistemai pritaikyti prisegtą dizainą.

Pastaba. Duomenų bazė gali būti pildoma/koreguojama pagal poreikį. -->