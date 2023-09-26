import csv
  
with open('aulas_moviles.csv') as file_obj:
    reader_obj = csv.reader(file_obj)

    queriesFile = open("queries.txt", "a")
      
    for row in reader_obj:
        jurisdiccion = row[0]
        n_atm = row[1]
        n_cue = row[2]
        dominio = row[3]
        n_chasis = row[4]
        especialidad = row[5]

        
        insertIntoStr = f'INSERT INTO aulas_moviles VALUES ("{jurisdiccion}", "{n_atm}", "{n_cue}", "{n_chasis}", "{dominio}", "{especialidad}");\n'
        ' '.join(insertIntoStr.split())
        queriesFile.write(insertIntoStr)