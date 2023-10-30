import csv

with open('aulas_moviles.csv') as file_obj:
    reader_obj = csv.reader(file_obj)

    queriesFile = open("queries.txt", "a")
    '''
    CUE VARCHAR(15) PRIMARY KEY NOT NULL,
    n_ATM VARCHAR(20) NOT NULL,
    estado int NOT NULL,
    especialidad_formativa VARCHAR(100) NOT NULL,
    fecha_ult_actualizacion DATETIME NOT NULL,
    '''

    for row in reader_obj:
        cue = row[0]
        n_atm = row[1]
        estado = row[2]
        especialidad_formativa = row[3]
        fecha_ult_actualizacion = row[4]

        insertIntoStr = f'INSERT INTO aulas_moviles VALUES ("{cue}", "{n_atm}", "{estado}", "{n_chasis}", "{dominio}", "{especialidad}");\n'
        ' '.join(insertIntoStr.split())
        queriesFile.write(insertIntoStr)
