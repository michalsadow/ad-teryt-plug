<?php

return [

  'PRZESLIJMI_ADTERYTPLUG_DESTINATION_DIR' => 'Folder, do którego wtyczka TERYT zapisuje słownik TERYT.',
  'PRZESLIJMI_ADTERYTPLUG_SOURCES_TERC' => 'Ścieżka pod którą musi się znaleźć aktualny słownik TERYT pochodzący ze strony Głównego Urzędu Statystycznego.',

  /**
   * Scopes.
   */
  'Przeslijmi.AgileDataTerytPlug.scope.v' => 'województwa',
  'Przeslijmi.AgileDataTerytPlug.scope.c' => 'powiaty',
  'Przeslijmi.AgileDataTerytPlug.scope.m' => 'gminy',
  'Przeslijmi.AgileDataTerytPlug.scope.a' => 'obszary gmin (miejskie i wiejskie) - tylko gdy są wydzielone',

  /**
   * Details.
   */
  'Przeslijmi.AgileDataTerytPlug.details.v.teryt.desc' => 'TERYT województwa (dwie cyfry)',
  'Przeslijmi.AgileDataTerytPlug.details.v.name.desc' => 'nazwa województwa małymi literami (np. pomorskie)',
  'Przeslijmi.AgileDataTerytPlug.details.v.nameUc.desc' => 'nazwa województwa pisana dużymi literami (np. POMORSKIE)',
  'Przeslijmi.AgileDataTerytPlug.details.c.teryt.desc' => 'TERYT powiatu (cztery cyfry)',
  'Przeslijmi.AgileDataTerytPlug.details.c.type.desc' => 'typ powiatu',
  'Przeslijmi.AgileDataTerytPlug.details.c.typeOriginal.desc' => 'typ powiatu oryginalny (za GUS)',
  'Przeslijmi.AgileDataTerytPlug.details.c.name.desc' => 'nazwa powiatu (np. gdański, np. Gdynia)',
  'Przeslijmi.AgileDataTerytPlug.details.c.nameUc.desc' => 'nazwa powiatu pisana dużymi literami (np. GDAŃSKI, GDYNIA)',
  'Przeslijmi.AgileDataTerytPlug.details.c.suffix.desc' => 'dopisek `mnpp.` dla miast na prawach powiatu',
  'Przeslijmi.AgileDataTerytPlug.details.c.voivodeship.teryt.desc' => 'TERYT województwa tego powiatu (dwie cyfry)',
  'Przeslijmi.AgileDataTerytPlug.details.c.voivodeship.name.desc' => 'nazwa województwa tego powiatu',
  'Przeslijmi.AgileDataTerytPlug.details.m.teryt.desc' => 'TERYT gminy (siedem cyfr)',
  'Przeslijmi.AgileDataTerytPlug.details.m.type.desc' => 'typ gminy',
  'Przeslijmi.AgileDataTerytPlug.details.m.typeOriginal.desc' => 'typ gminy oryginalny (za GUS)',
  'Przeslijmi.AgileDataTerytPlug.details.m.name.desc' => 'nazwa gminy (np. Kartuzy, np. Żukowo)',
  'Przeslijmi.AgileDataTerytPlug.details.m.county.teryt.desc' => 'TERYT powiatu tej gminy (cztery cyfry)',
  'Przeslijmi.AgileDataTerytPlug.details.m.county.name.desc' => 'nazwa powiatu tej gminy',
  'Przeslijmi.AgileDataTerytPlug.details.m.voivodeship.teryt.desc' => 'TERYT województwa tej gminy (dwie cyfry)',
  'Przeslijmi.AgileDataTerytPlug.details.m.voivodeship.name.desc' => 'nazwa województwa tej gminy',
  'Przeslijmi.AgileDataTerytPlug.details.a.teryt.desc' => 'TERYT obszaru (siedem cyfr)',
  'Przeslijmi.AgileDataTerytPlug.details.a.type.desc' => 'typ obszaru',
  'Przeslijmi.AgileDataTerytPlug.details.a.typeOriginal.desc' => 'typ obszaru oryginalny (za GUS)',
  'Przeslijmi.AgileDataTerytPlug.details.a.name.desc' => 'nazwa obszaru (np. Kartuzy)',
  'Przeslijmi.AgileDataTerytPlug.details.a.municipality.teryt.desc' => 'TERYT gminy tego obszaru (siedem cyfry)',
  'Przeslijmi.AgileDataTerytPlug.details.a.municipality.name.desc' => 'nazwa gminy tego obszaru',
  'Przeslijmi.AgileDataTerytPlug.details.a.county.teryt.desc' => 'TERYT powiatu tego obszaru (cztery cyfry)',
  'Przeslijmi.AgileDataTerytPlug.details.a.county.name.desc' => 'nazwa powiatu tego obszaru',
  'Przeslijmi.AgileDataTerytPlug.details.a.voivodeship.teryt.desc' => 'TERYT województwa tego obszaru (dwie cyfry)',
  'Przeslijmi.AgileDataTerytPlug.details.a.voivodeship.name.desc' => 'nazwa województwa tego obszaru',

  'Przeslijmi.AgileDataTerytPlug.details.v.teryt.column' => 'TERYT',
  'Przeslijmi.AgileDataTerytPlug.details.v.name.column' => 'wojewodztwo',
  'Przeslijmi.AgileDataTerytPlug.details.v.nameUc.column' => 'wojewodztwo_duzymi',
  'Przeslijmi.AgileDataTerytPlug.details.c.teryt.column' => 'TERYT',
  'Przeslijmi.AgileDataTerytPlug.details.c.type.column' => 'typ',
  'Przeslijmi.AgileDataTerytPlug.details.c.typeOriginal.column' => 'typ_oryginalny',
  'Przeslijmi.AgileDataTerytPlug.details.c.name.column' => 'powiat',
  'Przeslijmi.AgileDataTerytPlug.details.c.nameUc.column' => 'powiat_duzymi',
  'Przeslijmi.AgileDataTerytPlug.details.c.suffix.column' => 'dopisek_mnpp',
  'Przeslijmi.AgileDataTerytPlug.details.c.voivodeship.teryt.column' => 'TERYT_wojewodztwa',
  'Przeslijmi.AgileDataTerytPlug.details.c.voivodeship.name.column' => 'wojewodztwo',
  'Przeslijmi.AgileDataTerytPlug.details.m.teryt.column' => 'TERYT',
  'Przeslijmi.AgileDataTerytPlug.details.m.type.column' => 'typ',
  'Przeslijmi.AgileDataTerytPlug.details.m.typeOriginal.column' => 'typ_oryginalny',
  'Przeslijmi.AgileDataTerytPlug.details.m.name.column' => 'nazwa',
  'Przeslijmi.AgileDataTerytPlug.details.m.county.teryt.column' => 'TERYT_powiatu',
  'Przeslijmi.AgileDataTerytPlug.details.m.county.name.column' => 'powiat',
  'Przeslijmi.AgileDataTerytPlug.details.m.voivodeship.teryt.column' => 'TERYT_wojewodztwa',
  'Przeslijmi.AgileDataTerytPlug.details.m.voivodeship.name.column' => 'wojewodztwo',
  'Przeslijmi.AgileDataTerytPlug.details.a.teryt.column' => 'TERYT',
  'Przeslijmi.AgileDataTerytPlug.details.a.type.column' => 'typ',
  'Przeslijmi.AgileDataTerytPlug.details.a.typeOriginal.column' => 'typ_oryginalny',
  'Przeslijmi.AgileDataTerytPlug.details.a.name.column' => 'nazwa',
  'Przeslijmi.AgileDataTerytPlug.details.a.municipality.teryt.column' => 'TERYT_gminy',
  'Przeslijmi.AgileDataTerytPlug.details.a.municipality.name.column' => 'gmina',
  'Przeslijmi.AgileDataTerytPlug.details.a.county.teryt.column' => 'TERYT_powiatu',
  'Przeslijmi.AgileDataTerytPlug.details.a.county.name.column' => 'powiat',
  'Przeslijmi.AgileDataTerytPlug.details.a.voivodeship.teryt.column' => 'TERYT_wojewodztwa',
  'Przeslijmi.AgileDataTerytPlug.details.a.voivodeship.name.column' => 'wojewodztwo',

  /**
   * Operation - ReadFromTerc.
   */
  'Przeslijmi.AgileDataTerytPlug.Operations.ReadFromTerc.sourceName' => 'TERYT',
  'Przeslijmi.AgileDataTerytPlug.Operations.ReadFromTerc.title' => 'czytanie z bazy TERYT TERC (podział administracyjny Polski)',
  'Przeslijmi.AgileDataTerytPlug.Operations.ReadFromTerc.fields.fileUri.name' => [ 'redirect' => 'Przeslijmi.AgileDataTerytPlug.Operations.ReadFromTerc.fields.scope.name' ],
  'Przeslijmi.AgileDataTerytPlug.Operations.ReadFromTerc.fields.mapColumns.name' => [ 'redirect' => 'Przeslijmi.AgileDataTerytPlug.Operations.ReadFromTerc.fields.details.name' ],
  'Przeslijmi.AgileDataTerytPlug.Operations.ReadFromTerc.fields.scope.name' => 'Z którego zbioru pobrać dane?',
  'Przeslijmi.AgileDataTerytPlug.Operations.ReadFromTerc.fields.scope.desc' => '',
  'Przeslijmi.AgileDataTerytPlug.Operations.ReadFromTerc.fields.details.name' => 'Które dane mają zostać pobrane?',
  'Przeslijmi.AgileDataTerytPlug.Operations.ReadFromTerc.fields.details.desc' => '',
  'Przeslijmi.AgileDataTerytPlug.Operations.ReadFromTerc.exc.NodeIsEmptyException.fileUri' => 'Nie wskazano z którego zbioru pobrać dane.',
  'Przeslijmi.AgileDataTerytPlug.Operations.ReadFromTerc.exc.NodeIsMissingException.mapColumns' => 'Nie wskazano które dane mają zostać pobrane.',

  /**
   * Operation - MergeWithTerc.
   */
  'Przeslijmi.AgileDataTerytPlug.Operations.MergeWithTerc.title' => 'dodanie kolumn z bazy TERYT TERC (podział administracyjny Polski)',
  'Przeslijmi.AgileDataTerytPlug.Operations.MergeWithTerc.fields.scope.name' => 'Z którego zbioru danych dodać kolumny?',
  'Przeslijmi.AgileDataTerytPlug.Operations.MergeWithTerc.fields.scope.desc' => '',
  'Przeslijmi.AgileDataTerytPlug.Operations.MergeWithTerc.fields.mergeProperties.name' => 'Pola łączące',
  'Przeslijmi.AgileDataTerytPlug.Operations.MergeWithTerc.fields.mergeProperties.desc' => 'Po jakich kolumnach mają być połączone rekordy. Musi być wybrana przynajmniej jedna para kolumn.',
  'Przeslijmi.AgileDataTerytPlug.Operations.MergeWithTerc.fields.mergeProperties.sourceField.name' => 'pole z TERYT',
  'Przeslijmi.AgileDataTerytPlug.Operations.MergeWithTerc.fields.mergeProperties.sourceProp.name' => 'odpowiadająca mu kolumna danych',
  'Przeslijmi.AgileDataTerytPlug.Operations.MergeWithTerc.fields.mapColumns.name' => 'Mapa kolumn',
  'Przeslijmi.AgileDataTerytPlug.Operations.MergeWithTerc.fields.mapColumns.desc' => 'Jakie kolumny mają być wzięte z <strong>TERYT</strong> i jak mają się nazywać w połączonym zestawieniu.',
  'Przeslijmi.AgileDataTerytPlug.Operations.MergeWithTerc.fields.mapColumns.sourceField.name' => 'pole z TERYT',
  'Przeslijmi.AgileDataTerytPlug.Operations.MergeWithTerc.fields.mapColumns.destinationProp.name' => 'nowa kolumna danych',
  'Przeslijmi.AgileDataTerytPlug.Operations.MergeWithTerc.exc.NodeIsEmptyException.fileUri' => 'Nie wskazano z którego zbioru pobrać dane.',



];
